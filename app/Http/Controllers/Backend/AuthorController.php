<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorForm;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.author.index', [
            'authors' => Author::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->hasFile('author_image')){
            $file = request()->file('author_image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('author', $file_name);
            }
        }

        Author::insert($request->except('_token', 'author_image') + [
            'author_slug' => Str::slug($request->author_name),
            'author_image' => $file_name,
            'created_at' => Carbon::now()
        ]);
        return back()->with('author_status', 'Author Added Succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorForm $request, Author $author)
    {
        $author->update($request->except('_token', 'author_image') + [
            'author_slug' => Str::slug($request->author_name)
        ]);

        $file_path = public_path('uploads/author/'.$author->author_image);
        if(request()->hasFile('author_image')){
            $file = request()->file('author_image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('author', $file_name);

                if(file_exists($file_path)){
                    unlink($file_path);
                }
                $author->update([
                    'author_image' => $file_name
                ]);
            }
        }
        return back()->with('author_status', 'Author Updated Succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return back()->with('author_status', 'Author Deleted!');
    }
}
