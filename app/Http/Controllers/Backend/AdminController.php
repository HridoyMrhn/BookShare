<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    public function dashboard(){
        return view('backend.layouts.dashboard', [
            'total_books' => Book::count(),
            'total_authors' => Author::count(),
            'total_publishers' => Publisher::count(),
            'total_categories' => Category::count()
        ]);
    }
}
