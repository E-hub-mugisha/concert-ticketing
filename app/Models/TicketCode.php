<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCode extends Model
{
    protected $fillable = ['order_item_id','code','used'];

    public function orderItem() { return $this->belongsTo(OrderItem::class); }
}
