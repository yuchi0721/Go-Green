<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class greenStore extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'intro',
        'address',
        'phone'
    ];

    public function comment(){
        return $this->hasMany(store_comments::class);
    }
}
