<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_comments extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'hotel_id',
        'comment'
    ];
    public function hotel(){
        return $this->BelongsTo(greenHotel::class);
    }
    public function user(){
        return $this->BelongsTo(User::class);
    }
}
