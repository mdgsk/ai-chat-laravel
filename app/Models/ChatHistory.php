<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    protected $fillable = [
        'conversation_id',
        'question',
        'answer',
        'provider',
        'model',
        'time_taken'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
