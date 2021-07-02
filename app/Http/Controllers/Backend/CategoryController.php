<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFrom;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.category.index', [
            'categories' => Category::all(),
            'parent_categories' => Category::where('parent_id', null)->get()
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
    public function store(CategoryFrom $request)
    {
        // dd($request->all());
        if(request()->hasFile('category_image')){
            $file = request()->file('category_image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('category', $file_name);
            }
        }
        Category::create($request->except('_token', 'category_image') + [
            'category_image' => $file_name,
            'category_slug' => Str::slug($request->category_name),
        ]);
        session()->flash('status', 'Category has been Added!');
        return back();
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
    public function update(CategoryFrom $request, Category $category)
    {
        $category->update($request->except('_token', 'category_image') + [
            'category_slug' => Str::slug($request->category_name),
        ]);

        if(request()->hasFile('category_image')){
            $file = request()->file('category_image');
            if($file->isValid()){
                if(file_exists(public_path('uploads/category/'.$category->category_image))){
                   unlink(public_path('uploads/category/'.$category->category_image));
                } else{
                    $file_name = $category->category_image;
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('category', $file_name);
                $category->update([
                    'category_image' => $file_name
                ]);
            }
        }
        session()->flash('status', 'Category has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Category::where('parent_id', $id)->delete();
        // $category->delete();
        // $category->where('parent_id', $category)->delete();
        session()->flash('status', 'Category has been Deleted!');
        return back();
    }
}
