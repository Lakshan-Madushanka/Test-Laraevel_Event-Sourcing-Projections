<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
      'uuid',
      'name',
      'balance'
    ];

    //relationships
    public function user(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function transactionCount(): HasOne
    {
        return $this->hasOne(TransactionCount::class, 'account_uuid', 'uuid');
    }
}
