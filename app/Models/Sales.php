<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
    protected $table = 'sales';
    protected $fillable = [
        'invoice_no',
        'user_id',
        'subtotal',
        'discount',
        'tax',
        'paid_amount',
        'due_amount',
        'payment_method',
        'payment_status',
    ];

}
