<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id','ticket_id','quantity','unit_price','attendee_name'];

    public function order() { return $this->belongsTo(Order::class); }
    public function ticket() { return $this->belongsTo(Ticket::class); }
    public function codes() { return $this->hasMany(TicketCode::class); }
}
