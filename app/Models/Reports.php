<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //
    protected $table = 'reports';
    protected $fillable = [
        'report_type',
        'file_path',
        'user_id',
        'start_date',
        'end_date',
    ];

}
