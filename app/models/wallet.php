<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'is_activated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addToBalance($amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    public function subtractFromBalance($amount)
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->save();
        }
    }
}
