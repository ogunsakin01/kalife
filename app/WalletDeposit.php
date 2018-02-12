<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletDeposit extends Model
{
  protected $fillable = ['reference', 'user_id', 'amount', 'bank_detail_id', 'slip_photo', 'status'];

  public $declined = 0;
  public $approved = 1;
  public $pending = 2;

  public function reference()
  {
    return 'WDR-'. rand(000,999) .'-KLF-'.uniqid();
  }

  public function store(array $data)
  {
    $deposit = static::create([
       'reference' => $this->reference(),
       'user_id' => auth()->id(),
       'bank_detail_id' => $data['bank_detail_id'],
       'amount' => $data['amount'],
       'slip_photo' => $data['slip_photo'],
       'status' => $this->pending
    ]);

    if ($deposit)
    {
      return true;
    }

    return false;
  }

  public static function storeOrUpdate($data){
        $bankPayment = static::updateOrCreate(
            [
                'reference' => $data->reference
            ],
            [
                'user_id'        => $data->user_id,
                'amount'         => $data->amount * 100,
                'bank_detail_id' => $data->bank_detail_id,
                'slip_photo'     => $data->slip_photo,
                'status'         => $data->status
            ]);
        return $bankPayment;
    }

  public static function getDepositsByUserId($id){
      return static::where('user_id', $id)
          ->orderBy('id','desc')
          ->get();
  }

  public static function getAllDeposit(){
      return static::orderBy('id','desc')->get();
  }

  public static function updateWalletDeposit($reference,$type){
      $walletDeposit = static::where('reference',$reference)->first();
      $walletDeposit->status = $type;
      $walletDeposit->update();
      return $walletDeposit;
  }
}
