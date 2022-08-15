<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'to',
        'from',
    ];

    protected $appends = ['selfMessage'];

    public function getUserMessags(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');
    //Or: return $this->belongsTo(Profile::class, 'foreign_key');
}


public function getSelfMessageAttribute()
    {
        return $this->user_id === Auth::user()->id;
    }

}
