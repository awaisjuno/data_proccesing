<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatasetModel;
use App\Models\User;

class DatasetAccess extends Model
{
    use HasFactory;

    protected $table = 'access_control';

    protected $primaryKey = 'access_id';

    protected $fillable = ['set_id', 'user_id', 'given_by', 'created_at', 'is_active', 'is_delete'];

    public $timestamps = false;

    public function dataset()
    {
        return $this->belongsTo(DatasetModel::class, 'set_id', 'set_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
