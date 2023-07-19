<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investor extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable = ['email','phone','address','user_id','status_id'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
