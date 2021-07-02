<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BookForm;
use App\Http\Requests\BookRequestForm;
use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;

class FrontBookController extends Controller
{
    public function bookList(){
        return view('frontend.layouts.book.list', [
            'book' => Book::where('status', 'approved')->orderBy('id', 'desc')->paginate(20)
        ]);
    }


    public function bookCreate(){
        return view('frontend.layouts.book.create', [
            'books' => Book::all(),
            'authors' => Author::all(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
        ]);
    }


    public function bookStore(BookForm $request){
        $file_name = '';
        if($request->hasFile('book_image')){
            $file = $request->file('book_image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('book', $file_name);
            }
        }

        $book_id = Book::insertGetId($request->except('_token', 'author_id', 'book_image') + [
            'book_slug' => Str::slug($request->book_name),
            'book_image' => $file_name,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        foreach($request->author_id as $data){
            BookAuthor::create([
                'author_id' => $data,
                'book_id' => $book_id
            ]);
        }
        session()->flash('status', 'Book has been Added!');
        return redirect()->route('index');
    }


    public function bookDetails($slug){
        return view('frontend.layouts.book.details', [
            'book' => Book::where('book_slug', $slug)->first(),
        ]);
    }


    public function bookEdit($slug){
        $book = Book::where('book_slug', $slug)->first();
        // dd($book->realtionAuthorWithBook_author);
        // dd($book->realtionAuthorWithBook_author->pluck('id')->toArray());
        // die();

        $book_tb = Book::where('status', 'approved')->get();
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('frontend.layouts.book.edit', compact('book_tb', 'categories', 'publishers', 'book', 'authors'));
    }


    public function bookUpdate(BookForm $request, $id){
        $book_id = Book::findOrFail($id);
        // For Author Update
        $book_id->realtionAuthorWithBook_author()->sync($request->author_id);

        $book_id->update($request->except('_token', 'author_id', 'book_image') + [
            'book_slug' => Str::slug($request->book_name),
            'user_id' => Auth::id(),
        ]);

        $file_name = $book_id->book_image;
        $file_path = public_path('uploads/book/'.$book_id->book_image);
        if($request->hasFile('book_image')){
            $file = $request->file('book_image');
            if($file->isValid()){
                if(file_exists($file_path)){
                    unlink($file_path);
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('book', $file_name);
                $book_id->update([
                    'book_image' => $file_name
                ]);
            }
        }

        session()->flash('status', 'Book has been Update!');
        return redirect()->route('user.dashboard.book.upload');
    }


    public function bookDelete($slug){
        Book::where('book_slug', $slug)->delete();
        session()->flash('status', 'Book has been Deleted!');
        return redirect()->route('user.dashboard.book.upload');
    }


    public function bookSearch(Request $request){
        $search = request()->value;
        if(empty($search)){
            return redirect()->route('user.book.list')->with('status', 'Maybe you serch empty data!');
        }

        $book = Book::where('status', 'approved')
            ->where('book_name', 'like', '%'.$search.'%')
            ->orWhere('book_isbn', 'like', '%'.$search.'%')
            ->orWhere('book_info', 'like', '%'.$search.'%')
            ->paginate(10);

        foreach($book as $data){
            $data->increment('total_search');
            $data->save();
        }
        return view('frontend.layouts.book.list', compact('search', 'book'));
    }


    public function advanceSearch(Request $request){
        // dd($request->all());
        $search = $request->t_d;
        $search_author = $request->author;
        $search_publisher = $request->publisher;
        $search_category = $request->category;

        if(empty($search) && empty($search_publisher) && empty($search_category)){
            return back()->with('status', 'Maybe you serch empty data!');
        }

        elseif(empty($search) && empty($search_category) && !empty($search_publisher)){
             $book = Book::where('status', 'approved')
            ->where('publisher_id', $search_publisher)->paginate(10);
            // print_r($book);
        } elseif(empty($search) && empty($search_publisher) && !empty($search_category)){
            // dd($search_category);
            $book = Book::where('status', 'approved')
            ->where('category_id', $search_category)->paginate(10);
        } elseif(empty($search) && !empty($search_publisher) && !empty($search_category)){
            // dd($search_category);
            $book = Book::where('status', 'approved')
            ->where('publisher_id', $search_publisher)
            ->orWhere('category_id', $search_category)->paginate(10);
        }

        else{
            $book = Book::where('status', 'approved')
            ->where('book_name', 'like', '%'.$search.'%')
            ->orWhere('book_isbn', 'like', '%'.$search.'%')
            ->orWhere('book_info', 'like', '%'.$search.'%')
            ->orWhere('publisher_id', $search_publisher)
            ->orWhere('category_id', $search_category)->paginate(10);
        }
        return view('frontend.layouts.book.list', compact('book', 'search'));
    }


    // User book request function
    public function bookRequest(BookRequestForm $request, $slug){
        $book_id = Book::where('book_slug', $slug)->first();
        // if($book_id->book_quantity >= $book_id->book_quantity ){
        //     echo 'yes';
        // } else{
        //     echo 'no';
        // }
        BookRequest::create([
            'book_id' => $book_id->id,
            'user_id' => Auth::id(),
            'owner_id' => $book_id->user_id,
            'user_msg' => $request->user_msg,
        ]);
        return back()->with('status', 'Book Request has been send to the User!');
    }


    public function bookRequestUpdate(Request $request, $id){
        BookRequest::find($id)->update([
            'user_msg' => $request->user_msg,
        ]);
        return back()->with('status', 'Book Request has been Updated!');
    }

    public function bookRequestCancel(BookRequest $id){
        $id->delete();
        return back()->with('status', 'Book Request has been Updated!');
    }



    // owner book request function
    public function bookRequestApprove(Request $request, $id){
        BookRequest::findOrFail($id)->update([
            'status' => 2
        ]);
        return back()->with('status', 'Book Request has been Approved!');
    }

    public function bookRequestUnapprove(BookRequest $id){
        $id->update([
            'status' => 3
        ]);
        return back()->with('status', 'Book Request has been Unapproved!');
    }


    // User book request function
    public function bookOrderApprove(Request $request, BookRequest $id){
        $id->update([
            'status' => 4
        ]);

        $book_id = Book::findOrFail($id->book_id);
        $book_id->decrement('book_quantity');
        return back()->with('status', 'Book Order has been Confirm by You!');
    }

    public function bookOrderUnapprove(Request $request, BookRequest $id){
        $id->update([
            'status' => 5
        ]);
        return back()->with('status', 'Book Order has been Rejected by You!');
    }


    // Book Return function
    public function bookReturnRequest(BookRequest $id){
        $id->update([
            'status' => 6
        ]);
        return back()->with('status', 'Book Return Request has been Send!');
    }

    public function bookReturnConfirm(BookRequest $id){
        $id->update([
            'status' => 7
        ]);
        $book_id = Book::findOrFail($id->book_id);
        $book_id->increment('book_quantity');
        $book_id->increment('total_borrowed');
        return back()->with('status', 'Book Return Request has been Accepted!');
    }
}
