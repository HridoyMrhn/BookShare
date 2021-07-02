<?php

use App\Models\Book;
use App\Models\BookRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function user(){
    return User::where('id', Auth::id())->first();
}

function category(){
    return Category::all();
}

function all_categoty(){
    return Category::all();
}

function book(){
    return Book::where('user_id', Auth::id())->get();
}

function bookApproved(){
    return Book::where('status', 'approved')->count();
}

function bookUnapproved(){
    return Book::where('status', 'pending')->count();
}

function myBook(){
    return Book::where('user_id', Auth::id())->count();
}

function bookRequest(){
    return BookRequest::where('owner_id', Auth::id())->count();
}

function bookOrder(){
    return BookRequest::where('user_id', Auth::id())->count();
}
