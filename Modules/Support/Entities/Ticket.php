<?php

namespace Modules\Support\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Support\Entities\{TicketMessage, MessageImage, TicketParticipant, TicketMoment, TicketLog, TicketAdminMessage, TicketAdminVote};
use Modules\User\Entities\{User};

use Auth, Carbon;

class Ticket extends Model
{
    protected $fillable = [];

    private $states = [
      1 => 'Открытый и ожидает ответ',
      2 => 'Открытый и ожидает ответ юзера',
      3 => 'Закрыт и отклонен',
      4 => 'Закрыт и решен',
    ];

    public static function getCategories() {
      $categories = self::select('category')->distinct()->get();
      return $categories;
    }

    public static function getTicketMessages($id) {
      $ticketmessages = TicketMessage::where('ticket_id', $id)->get();
      //$ticketmessages_ids = $data['ticketmessages']->pluck(['id']);
      Carbon::setLocale('ru');
      foreach($ticketmessages as $key => $message) {
          $message['images'] = MessageImage::where('message_id', $message->id)->get();
          $message['author'] = User::find($message->author_id);
          $date = new Carbon($message['created_at']);
          $message['forhumans'] = $date->diffForHumans();
      }
      return $ticketmessages;
    }
}
