<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetailModel extends Model
{
    protected $table = 'user_detail';
    protected $primaryKey = 'user_detail_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'mobile',
        'register_date'
    ];
}


?>