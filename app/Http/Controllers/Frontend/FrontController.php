<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Publisher;

class FrontController extends Controller
{
    public function index(){
        return view('frontend.layouts.index', [
            'book' => Book::orderBy('id', 'desc')->get(),
            'publishers' => Publisher::all(),
            'authors' => Author::all(),
            'categories' => Category::all(),
            'banners' => Banner::all(),
        ]);
    }


    public function about(){
        return view('frontend.layouts.pages.about');
    }


    public function contact(){
        return view('frontend.layouts.pages.contact', [

        ]);
    }


    public function profile($user_name){
        return view('frontend.layouts.pages.profile', [
            'user_profile' => User::where('user_name', $user_name)->first()
        ]);
    }


    public function category($slug){
        $category = Category::where('category_slug', $slug)->firstOrFail();
        $books_pagination = $category->categoryWithBook()->paginate(1);
        return view('frontend.layouts.pages.category', compact('category', 'books_pagination'));
    }

}
