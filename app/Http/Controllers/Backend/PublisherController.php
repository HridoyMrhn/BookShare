<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Publisher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherForm;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.publisher.index', [
            'publishers' => Publisher::all()
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
    public function store(PublisherForm $request)
    {
        if(request()->hasFile('publisher_image')){
            $file = request()->file('publisher_image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('publisher', $file_name);
            }
        }
        Publisher::insert($request->except('_token', 'publisher_image') + [
            'publisher_slug' => Str::slug($request->publisher_name),
            'publisher_image' => $file_name,
            'created_at' => Carbon::now()
        ]);
        return back()->with('status', 'Publisher has been Added!');
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
    public function update(PublisherForm $request, Publisher $publisher)
    {
        $publisher->update($request->except('_token', 'publisher_image') + [
            'publisher_slug' => Str::slug($request->publisher_name),
        ]);

        $file_path = public_path('uploads/publisher/'.$publisher->publisher_image);
        if(request()->hasFile('publisher_image')){
            $file = request()->file('publisher_image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('publisher', $file_name);

                if(file_exists($file_path)){
                    unlink($file_path);
                }
                $publisher->update([
                    'publisher_image' => $file_name
                ]);
            }
        }
        return back()->with('status', 'Publisher has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return back()->with('status', 'Publisher has been Deleted!');
    }
}
