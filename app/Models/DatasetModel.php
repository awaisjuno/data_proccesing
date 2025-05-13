<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatasetModel extends Model
{
    protected $table = 'dataset';
    protected $primaryKey = 'set_id';
    public $timestamps = false;

    protected $fillable = [
        'set_name',
        'set_description',
        'created_by'
    ];
}


?>