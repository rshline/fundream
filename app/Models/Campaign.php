<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'title',
        'description',
        'status',
        'target',
        'deadline',
        'total_donation',
        'count_donation',
        'cover_img',
    ];
    
    public function users(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'users_id');
    }
    
    public function donations(){
        return $this->hasMany(Donation::class, 'campaigns_id', 'id');
    }

}
