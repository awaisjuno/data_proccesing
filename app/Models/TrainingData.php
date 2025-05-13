<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingData extends Model
{
    protected $table = 'training_data';

    protected $primaryKey = 'training_id';

    public $timestamps = false;

    protected $fillable = [
        'set_id', 'label', 'data', 'created_date', 'update_date', 'is_active', 'is_delete'
    ];
}
