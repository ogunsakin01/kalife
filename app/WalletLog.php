<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WalletLog extends Model
{
  public $debit = 0;

  public $credit = 1;

  public function fetchAuthenticatedUserWalletLog()
  {
    $logs = static::where('id', auth()->id())->get();

    $data = array();

    foreach ($logs as $key => $log)
    {
      $record = [
        'amount' => number_format(($log->amount/ 100)),
        'transaction_type' => $this->generateTransactionTypeHtmlByTransactionTypeId($log->transaction_type),
        'performed_on' => Carbon::parse($log->created_at)->toFormattedDateString()
      ];

      $data[] = $record;
    }

    return $data;
  }

  public function generateTransactionTypeHtmlByTransactionTypeId($transactionType)
  {
    if ($transactionType == $this->debit)
    {
      return '<span class="badge badge-danger"><i class="fa fa-times-circle"></i>&nbsp;DEBIT</span>';
    }
    else if ($transactionType == $this->credit)
    {
      return '<span class="badge badge-success"><i class="fa fa-check"></i>&nbsp;CREDIT</span>';
    }
  }

  public static function createLog($user_id,$amount,$type){
    $log = new static();
    $log->user_id = $user_id;
    $log->amount = $amount;
    $log->transaction_type = $type;
    $log->save();
  }

  public static function getLogsOfAuthenticatedUser(){
      return static::where('user_id', auth()->user()->id)
          ->orderBy('id','desc')
          ->get();
  }
}
