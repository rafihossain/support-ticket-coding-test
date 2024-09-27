<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketMessage extends Model
{
    use HasFactory;
    protected $fillable = ['message','notify','attachment','support_ticket_id','type','user_id'];

    public function user_info(){
        return User::find($this->attributes['user_id']);
    }

}
