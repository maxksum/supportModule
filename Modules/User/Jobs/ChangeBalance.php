<?php

namespace Modules\User\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Modules\User\Entities\User;
use Modules\Product\Entities\Product;
use Modules\Core\Entities\Operation;

class ChangeBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $product;
    public $user_sum;
    public $product_sum;
    public $operation_code;
    public $comment;
    public $callback;
    public $params;

    public $tries = 1;



    public function __construct($user, $product, $user_sum, $product_sum, $operation_code, $comment = "", $callback = false, $params = [])
    {
        //
        $this->user = $user;
        $this->product = $product;
        $this->user_sum = $user_sum;
        $this->product_sum = $product_sum;
        $this->operation_code = $operation_code;
        $this->comment = $comment;
        $this->callback = $callback;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $user = User::find($this->user);
      $product = Product::find($this->product);

      if (!$user || !$product) {
        $this->fail();
      }

      if ($this->user_sum < 0 && abs($this->user_sum) > $user->money) {
        if ($this->callback !== false) {
          $this->callback::dispatch(["error" => true, "message" => "Недостаточно средств на балансе для совершения операции", "user_id" => $this->user]);
          return $this->fail();
        }
      }

      $user->money += $this->user_sum;
      $user->save();

      $operation = new Operation();
      $operation->sum = $this->user_sum;
      $operation->new_balance = $user->money;
      $operation->user_id = $user->id;
      $operation->product_code = $product->id;
      $operation->operation_code = $this->operation_code;
      $operation->comment = $this->comment;
      $operation->save();


      if ($this->product_sum != 0) {
        $product->money += $this->product_sum;
        $product->save();

        $operation = new Operation();
        $operation->sum = $this->product_sum;
        $operation->new_balance = $product->money;
        $operation->product_id = $product->id;
        $operation->product_code = $product->id;
        $operation->operation_code = $this->operation_code;
        $operation->comment = $this->comment;
        $operation->save();
      }
    }
}
