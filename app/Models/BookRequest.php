<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function relationBook_requestWithBook(){
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function relationBook_requestWithUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function relationBook_orderWithUser(){
        return $this->belongsTo(User::class, 'owner_id');
    }
}
