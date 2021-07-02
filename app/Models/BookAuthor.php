<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function relationBook_authorWithAuthor(){
        return $this->belongsToMany(Author::class, 'author_id', 'id');
    }

}
