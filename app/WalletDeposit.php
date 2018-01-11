<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletDeposit extends Model
{
  protected $fillable = ['reference', 'user_id', 'bank_detail_id', 'slip_photo', 'status'];

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
       'slip_photo' => $data['slip_photo'],
       'status' => $this->pending
    ]);

    if ($deposit)
    {
      return true;
    }

    return false;
  }
}
