<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class greenHotel extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'intro',
        'address',
        'phone'
    ];

    public function comment(){
        return $this->hasMany(Hotel_comments::class);
    }
}
