<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BookForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.book.index', [
            'books' => Book::latest()->get()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.layouts.book.create', [
            'books' => Book::all(),
            'authors' => Author::all(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookForm $request)
    {
        // dd($request->author_id);
        // die();
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
        return redirect()->route('book.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.layouts.book.show', [
            'book' => Book::findOrFail($id)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $selected = $book->authors->pluck('id')->toArray();
        return view('backend.layouts.book.edit', [
            'book' => Book::with('realtionAuthorWithBook_author')->findOrFail($id),
            'books' => Book::where('status', 'pending')->get(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'authors' => Author::all(),
            'book_authors' => BookAuthor::where('book_id', $id)->get(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookForm $request, $id)
    {
        $book_id = Book::find($id);
        // For Author Update
        $book_id->realtionAuthorWithBook_author()->sync($request->author_id);

        $book_id->update($request->except('_token', '_method', 'author_id', 'book_image') + [
            'book_slug' => Str::slug($request->book_name),
            'user_id' => Auth::id()
        ]);

        $file_name = $book_id->book_image;
        $file_path = public_path('uploads/book/'.$file_name);
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

        return redirect()->route('book.index')->with('status', 'Book has been Updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        Book::findOrFail($book)->delete();
        BookAuthor::where('book_id', $book)->delete();
        session()->flash('status', 'This Book has beeen Deleted!');
        return back();
    }


    public function bookApprove($id){
        $book_id = Book::findOrFail($id);
        $book_id->update([
            'status' => 'approved'
        ]);
        return back()->with('status', 'Book has been Approved!');
    }


    public function bookUnapprove($id){
        $book_id = Book::findOrFail($id);
        $book_id->update([
            'status' => 'pending'
        ]);
        return back()->with('status', 'Book has been Unapproved!');
    }


    public function bookApproveList(){
        return view('backend.layouts.book.index', [
            'books' => Book::where('status', 'approved')->get()
        ]);
    }


    public function bookUnapproveList(){
        return view('backend.layouts.book.index', [
            'books' => Book::where('status', 'pending')->get()
        ]);
    }
}
