<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use App\Models\TranslationBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function relationBookWithCategory(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function relationBookWithPublisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function relationBookWithUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function relationBookWithAuthor(){
        return $this->hasMany(BookAuthor::class);
    }

    public function translationBook(){
        return $this->hasMany(Book::class, 'id', 'translator_id');
    }

    public function realtionAuthorWithBook_author(){
        return $this->belongsToMany(Author::class,'book_authors','book_id','author_id');
    }
}
