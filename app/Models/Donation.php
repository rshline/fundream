<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'campaigns_id',
        'users_id',
        'nominal',
        'message',
        'is_verified',
        'is_anon',
        'donation_method',
        'proof_img'
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    
    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaigns_id', 'id');
    }
}
