<?php

namespace Modules\Support\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\User\Entities\{User};
use Modules\Support\Entities\{Ticket, TicketMessage, TicketParticipant, TicketMoment, MessageImage, TicketLog, TicketAdminVote, TicketAdminMessage, TicketRating};
use Modules\Support\Events\{TicketEvent};

use Auth;
use JavaScript;
use Carbon;

class SupportController extends Controller
{
    public function index(Request $request) {
      if(Auth::check()) {
        if (isset($request->params['searchrequest'])) {
          if ($request->params['searchrequest'] !== "") {
            $search = $request->params['searchrequest'];
          } else {
            $search = "";
          }
        } else {
          $search = "";
        }
        if (isset($request->params['tickets_page'])) {
          $data['tickets'] = self::getTicketsByUserId(Auth::user()->id, $request->params['sort'], $request->params['tickets_page'], $search);
        } else {
          if (isset($request->params['sort'])) {
              $data['tickets'] = self::getTicketsByUserId(Auth::user()->id, $request->params['sort'], 0, $search);
          } else {
              $data['tickets'] = self::getTicketsByUserId(Auth::user()->id, "created_at", 0, $search);
          }
        }
        foreach($data['tickets'] as $ticket) {
          $ticket['messages'] = Ticket::getTicketMessages($ticket['id']);
          $nm = -1;
          foreach($ticket['messages'] as $key=>$msg) {
            if ($msg->author_id == Auth::user()->id) {
              $nm = $key;
            }
          }
          if ($nm == -1) {
            $ticket['newmessages'] = count($ticket['messages']);
          } else {
            $ticket['newmessages'] = count($ticket['messages']) - $nm - 1;
          }
        }
        $data['tickets']->toJson();
        JavaScript::put([
          'tickets' => $data['tickets'],
        ]);
        if (isset($request->params['tickets_page']) || isset($request->params['sort'])){
          return $data['tickets'];
        } else {
          return view('support::support', $data);
        }

      }
    }

    public function checkRoute(Request $request) {
      if (isset($request->params['id'])) {
        if (is_numeric($request->params['id'])) {
          $result = Ticket::where('user_id', Auth::user()->id)->where('id', $request->params['id'])->get();
          if (empty($result)) {
            $part = TicketParticipant::where('user_id', Auth::user()->id)->where('ticket_id', $request->params['id'])->get();
            return $part;
          } else {
            return $result;
          }
        }
      }
    }

    public function getTicketsByUserId($id, $sort, $tickets_page = 0, $searchrequest) {
      $ids = TicketParticipant::where('user_id', Auth::user()->id);
      $ticket_ids = $ids->pluck('ticket_id');
        if (Auth::user()->role == "administrator") {
          if ($sort == "created_at" || $sort == "all") {
            $alltickets = Ticket::where('title', 'like', '%' . $searchrequest . '%')->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'tickets_page');
          } else {
            switch ($sort) {
              case "open": {
                $alltickets = Ticket::where('title', 'like', '%' . $searchrequest . '%')->whereIn('state', [1, 2])->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'tickets_page');
                break;
              }
              case "close": {
                $alltickets = Ticket::where('title', 'like', '%' . $searchrequest . '%')->whereIn('state', [3, 4])->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'tickets_page');
                break;
              }
              default: {
                $alltickets = Ticket::where('title', 'like', '%' . $searchrequest . '%')->where('category', $sort)->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'tickets_page');
                break;
              }
            }
          }
        } else {
          if ($sort == "created_at" || $sort == "all") {
            $alltickets = Ticket::whereIn('id', $ticket_ids)->orWhere('user_id', $id)->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'tickets_page');
          } else {
            $alltickets = Ticket::where('category', $sort)->where(function ($query) use ($id, $ticket_ids) {
            $query->whereIn('id', $ticket_ids)->orWhere('user_id', $id); })->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'tickets_page');
          }
        }
      foreach($alltickets as $ticket) {
          if ($ticket['category'] == "Жалоба на игрока" || $ticket['category'] == "Жалоба на админа") {
            $ticket['complaint'] = User::find($ticket->title);
          }
          $users = TicketParticipant::where('ticket_id', $ticket->id)->get();
          if (count($users)) {
            $participants = [];
            foreach ($users as $user) {
              $participants[] = User::find($user->user_id);
            }
            $ticket['participants'] = $participants;
          } else {
            $ticket['participants'] = array();
          }
          if (Auth::user()->role == 'administrator') {
            $moments = TicketMoment::where('ticket_id', $ticket['id'])->get();
            if (count($moments)) {
              $ticketmoments = [];
              foreach ($moments as $moment) {
                $ticketmoments[] = $moment;
              }
              $ticket['moments'] = $ticketmoments;
            } else {
              $ticket['moments'] = null;
            }
          }
          $description = TicketMessage::select('text')->where('ticket_id', $ticket['id'])->first();
          $ticket['description'] = $description['text'];
          if (Auth::user()->role == 'administrator') {
            $ticket['logs'] = TicketLog::where('ticket_id', $ticket->id)->get();
            if ($ticket->category == "Читы") {
              $ticket['votes'] = TicketAdminVote::where('ticket_id', $ticket->id)->get();
              $ticket['yesvotes'] = TicketAdminVote::where('ticket_id', $ticket->id)->where('vote', 1)->count();
              $ticket['novotes'] = TicketAdminVote::where('ticket_id', $ticket->id)->where('vote', 0)->count();
              $ticket['voted'] = 0;
              foreach ($ticket['votes'] as $vote) {
                $vote['user'] = User::find($vote->admin_id);
                if ($vote->admin_id == Auth::user()->id) {
                  if ($vote->vote == 0) {
                    $ticket['voted'] = 1;
                  } else {
                    $ticket['voted'] = 2;
                  }
                }
              }
            }
            $ticket['adminmessages'] = TicketAdminMessage::where('ticket_id', $ticket->id)->get();
            foreach ($ticket['logs'] as $log) {
              $log['userinfo'] = User::find($log->user);
            }
            foreach ($ticket['adminmessages'] as $message) {
              $message['user'] = User::find($message->admin_id);
            }
          }
      }
      return $alltickets;
    }

    public function addNewTicket(Request $request) {
        if (isset($request->params['problem'])) {
          $ticket = new Ticket();
          $ticket->user_id = Auth::user()->id;
          if ($request->params['category'] == 5 || $request->params['category'] == 6) {
              if (isset($request->params['complaint'])) {
                if (is_numeric($request->params['complaint'])) {
                  $usercomplaint = User::find($request->params['complaint']);
                  if (!empty($usercomplaint)) {
                    if ($request->params['category'] == 6) {
                      if ($usercomplaint->role !== 'administrator') {
                        return ["error" => true, "message" => "Введен не администратор"];
                      }
                    }
                  } else {
                    return ["error" => true, "message" => "Не найден пользователь"];
                  }
                  $ticket->title = $request->params['complaint'];
                } else {
                  return ["error" => true, "message" => "Введен неправильный id"];
                }
              }
          } else {
              $ticket->title = $request->params['problem'];
          }
          $ticket->state = 1;
          $ticket->admin_id = 0;
          switch($request->params['category']) {
            case "1":
            {
              $ticket->category = "Другое";
              $ticket->save();
              if (isset($request->params['desc'])) {
                $message = new TicketMessage();
                $message->author_id = Auth::user()->id;
                $message->text = $request->params['desc'];
                $message->ticket_id = $ticket->id;
                $message->save();
              }
              break;
            }
            case "2":
            {
              $ticket->category = "Читы";
              $ticket->save();
              if (isset($request->params['times'])) {
                foreach($request->params['times'] as $key => $time) {
                  if (($key % 2 == 0) && ($time != null) && ($time != "") && ($request->params['times'][$key+1] != "") && ($request->params['times'][$key+1] != null)) {
                    $minute = $time;
                    $second = $request->params['times'][$key+1];
                    if (strlen($minute) == 1) {
                      $minute = "0" . $minute;
                    }
                    if (strlen($second) == 1) {
                      $second = "0" . $second;
                    }
                    $timemoment = $minute. ":" . $second;
                    $moment = new TicketMoment();
                    $moment->ticket_id = $ticket->id;
                    $moment->moment = $timemoment;
                    if (isset($request->params['timecomments'][$key])) {
                      if ($request->params['timecomments'][$key] != null) {
                        $moment->comment = $request->params['timecomments'][$key];
                      }
                    }
                    $moment->save();
                    $ticket['moments'] = TicketMoment::where('ticket_id', $ticket['id'])->get();
                  }
                }
              }
                if (isset($request->params['gamenumber'])) {
                  $text = "Игра: " . $request->params['gamenumber'];
                  if (isset($request->params['cheatplayer'])) {
                    $text .= " Пользователь: " . $request->params['cheatplayer'];
                  }
                } else {
                  if (isset($request->params['cheatplayer'])) {
                    $text = "Пользователь: " . $request->params['cheatplayer'];

                  }
                }
                if (isset($text)) {
                  $message = new TicketMessage();
                  $message->author_id = Auth::user()->id;
                  $message->ticket_id = $ticket->id;
                  $message->text = $text;
                  $message->save();
                }
                $ticket['votes'] = TicketAdminVote::where('ticket_id', $ticket->id)->get();
                $ticket['yesvotes'] = TicketAdminVote::where('ticket_id', $ticket->id)->where('vote', 1)->count();
                $ticket['novotes'] = TicketAdminVote::where('ticket_id', $ticket->id)->where('vote', 0)->count();
                $ticket['voted'] = 0;
                foreach ($ticket['votes'] as $vote) {
                  $vote['user'] = User::find($vote->admin_id);
                  if ($vote->admin_id == Auth::user()->id) {
                    if ($vote->vote == 0) {
                      $ticket['voted'] = 1;
                    } else {
                      $ticket['voted'] = 2;
                    }
                  }
                }
              break;
            }
            case "3":
            {
              $ticket->category = "Баги";
              $ticket->save();
              if (isset($request->params['desc'])) {
                $message = new TicketMessage();
                $message->author_id = Auth::user()->id;
                $message->text = $request->params['desc'];
                $message->ticket_id = $ticket->id;
                $message->save();
              }
              break;
            }
            case "4":
            {
              $ticket->category = "Финансы";
              $ticket->save();
              if (isset($request->params['desc'])) {
                $message = new TicketMessage();
                $message->author_id = Auth::user()->id;
                $message->text = $request->params['desc'];
                $message->ticket_id = $ticket->id;
                $message->save();
              }
              break;
            }
            case "5":
            {
              $ticket->category = "Жалоба на игрока";
              $ticket->save();
              $ticket->complaint = User::find($request->params['complaint']);
              if (isset($request->params['desc'])) {
                $message = new TicketMessage();
                $message->author_id = Auth::user()->id;
                $message->text = $request->params['desc'];
                $message->ticket_id = $ticket->id;
                $message->save();
              }
              break;
            }
            case "6":
            {
              $ticket->category = "Жалоба на админа";
              $ticket->save();
              $ticket->complaint = User::find($ticket->title);
              if (isset($request->params['desc'])) {
              $message = new TicketMessage();
              $message->author_id = Auth::user()->id;
              $message->text = $request->params['desc'];
              $message->ticket_id = $ticket->id;
              $message->save();
              }
              break;
            }
            case "7":
            {
              $ticket->category = "Магазин";
              $ticket->save();
              $ticket->complaint = User::find($ticket->title);
              if (isset($request->params['desc'])) {
              $message = new TicketMessage();
              $message->author_id = Auth::user()->id;
              $message->text = $request->params['desc'];
              $message->ticket_id = $ticket->id;
              $message->save();
              }
              break;
            }
          }
          $log = new TicketLog();
          $log->ticket_id = $ticket->id;
          $log->user = $ticket->user_id;
          $log->comment = "Открыл тикет";
          $log->save();
          $log['userinfo'] = User::find($log->user);
          if (isset($request->params['participants'])) {
              $tparts = [];
              foreach($request->params['participants'] as $value) {
                  $participant = new TicketParticipant();
                  $participant->ticket_id = $ticket->id;
                  $participant->user_id = $value;
                  $participant->save();
                  $part = User::find($participant->user_id);
                  $participant = $part;
                  $tparts[] = $participant;
              }
              $ticket['participants'] = $tparts;

          }
        }
        $ticket['messages'] = Ticket::getTicketMessages($ticket->id);
        $description = TicketMessage::select('text')->where('ticket_id', $ticket['id'])->first();
        $ticket['description'] = $description['text'];
        $ticket['newmessages'] = 0;
        $ticket['logs'] = TicketLog::where('ticket_id', $ticket->id)->get();
        foreach ($ticket['logs'] as $log) {
          $log['userinfo'] = User::find($log->user);
        }
        event(new TicketEvent($ticket, "ticket"));
        event(new TicketEvent($log, "log"));
        return $ticket;
    }

    public function uploadFile(Request $request) {
      if (!$request->file('image')->isValid()) {
        return ["error" => true, "message" => "Invalid file"];
      }
      $path = $request->file('image')->store("", "tickets_images");
      $file = new MessageImage();
      $file->url = $path;
      $file->message_id = $request->message_id;
      $file->save();
      return $file;
    }

    public function voteForCheats(Request $request) {
      $vote = new TicketAdminVote();
      $vote->vote = $request->params['vote'];
      $vote->ticket_id = $request->params['ticket'];
      $vote->admin_id = Auth::user()->id;
      $vote->save();
      $vote['user'] = Auth::user();
      return $vote;
    }

    public function addNewTicketMessage(Request $request) {
        $message = new TicketMessage();
        $message->author_id = Auth::user()->id;
        $message->text = $request->params['text'];
        $message->ticket_id = $request->params['ticket_id'];
        $message->save();
        $ticket = Ticket::find($request->params['ticket_id']);
        if (Auth::user()->role == 'administrator') {
          $ticket->state = 2;
          if ($ticket->admin_id == 0) {
            $ticket->admin_id = Auth::user()->id;
          }
        } else {
          $ticket->state = 1;
        }
        $ticket->updated_at = $message->created_at;
        $ticket->save();
        Carbon::setLocale('ru');
        $date = new Carbon($message['created_at']);
        $message['forhumans'] = $date->diffForHumans();
        $log = new TicketLog();
        $log->ticket_id = $message->ticket_id ;
        $log->user = $message->author_id;
        $log->comment = "Добавил новое сообщение";
        $log->save();
        $log['userinfo'] = User::find($log->user);
        event(new TicketEvent($log, "log"));
        $message['author'] = Auth::user();
        $message['images'] = MessageImage::where('message_id', $message->id)->get();
        event(new TicketEvent($message, "message"));
        return $message;
    }

    public function addNewTicketAdminMessage(Request $request) {
        $message = new TicketAdminMessage();
        $message->admin_id = Auth::user()->id;
        $message->text = $request->params['text'];
        $message->ticket_id = $request->params['ticket_id'];
        $message->save();
        $message['user'] = Auth::user();
        event(new TicketEvent($message, "adminmessage"));
        return $message;
    }

    public function searchUsers(Request $request) {
        if ($request->params['searchusers'] == "") {
            $searchusers = null;
            return $searchusers;
        } else {
            $searchusers = User::where('id', $request->params['searchusers'])->orWhere('name', 'like', $request->params['searchusers'] . '%')->get();
            return $searchusers;
        }
    }

    public function addUserToParticipants(Request $request) {
      $part = new TicketParticipant();
      $part->ticket_id = $request->params['ticket_id'];
      $part->user_id = $request->params['user_id'];
      $part->save();
      $participant = User::find($part->user_id);
      $participant['ticket_id'] = $request->params['ticket_id'];
      event(new TicketEvent($participant, "part"));
    }

    public function changeTicketState(Request $request) {
      $ticket = Ticket::find($request->params['ticket_id']);
      $ticket->state = $request->params['state'];
      $ticket->save();
      $log = new TicketLog();
      $log->ticket_id = $ticket->id;
      $log->user = $ticket->user_id;
      $log->comment = "Закрыл тикет";
      $log->save();
      if ((int)$request->params['qualityrating'] !== 0 || (int)$request->params['speedrating'] !== 0) {
        $rating = new TicketRating();
        $rating->rating = $request->params['speedrating'];
        $rating->rating_quality = $request->params['speedrating'];
        $rating->ticket_id = $request->params['ticket_id'];
        $rating->user_id = Auth::user()->id;
        $rating->admin_id = $ticket->admin_id;
        if (isset($request->params['comment'])) {
          $rating->comment = $request->params['comment'];
        }
        $rating->save();
      }
      $log['userinfo'] = User::find($log->user);
      event(new TicketEvent($log, "log"));
      event(new TicketEvent($ticket, "state"));
      return $ticket->id;
    }

    public function showTicket(Request $request) {
        $ticket_messages = Ticket::getTicketMessages($request->ticket_id);
        return $ticket_messages;
    }

    public function getTicket(Request $request) {
        $ticket = Ticket::find($request->ticket_id);
        return $ticket;
    }
}
