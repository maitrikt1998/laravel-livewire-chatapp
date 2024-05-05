<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
    ];


    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }

    public static function readMessages($senderId, ?int $receiverId)
    {
        Message::query()->where('sender_id', $senderId)->where('receiver_id', $receiverId )->update(['is_read'=>true]);
    }

    public function scopeMessageList($query, $selectedUser)
    {
        return $query->where(function(Builder $query) use($selectedUser){
            $query->where('sender_id',auth()->id())
                ->where('receiver_id',$selectedUser); 
        })->orWhere(function(Builder $query) use($selectedUser){
            $query->where('sender_id',$selectedUser)
                ->where('receiver_id',auth()->id());
        }); 
    }
}
