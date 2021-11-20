<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store_comments extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'store_id',
        'comment'
    ];

    public function store(){
        return $this->BelongsTo(greenStore::class);
    }
    public function user(){
        return $this->BelongsTo(User::class);
    }
}
