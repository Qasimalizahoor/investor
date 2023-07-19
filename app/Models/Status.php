<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['status' ];
    protected $primaryKey = 'id';

    public function investor()
    {
        return $this->hasOne(Investor::class,'status_id');
    }
}
