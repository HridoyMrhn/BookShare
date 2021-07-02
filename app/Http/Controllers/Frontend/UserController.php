<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(){
        return view('frontend.layouts.dashboard.dashboard', [
            'user' => User::where('id', Auth::id())->first()
        ]);
    }


    public function dashboardBookUploads(){
        return view('frontend.layouts.dashboard.upload-books', [
            'book' => Book::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(2)
        ]);
    }


    public function dashboardUpdate(Request $request, $id){
        User::findOrFail($id)->update($request->except('_token', 'image') + [
            'password' => Hash::make($request->password)
        ]);
        $user = User::findOrFail($id);
        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('user', $file_name);

                if (!is_null($user->image)) {
                    $file_path = "uploads/user/".$user->image;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                User::findOrFail($id)->update([
                    'image' => $file_name
                ]);
            }
        }
        return back()->with('status', 'Profile has been Updated!');
    }


    public function dashboardBookRequest(){
        return view('frontend.layouts.dashboard.book-request', [
            'book_request' => BookRequest::where('owner_id', Auth::id())->paginate(10)
        ]);
    }


    public function dashboardBookOrders(){
        return view('frontend.layouts.dashboard.book-order', [
            'book_order' => BookRequest::where('user_id', Auth::id())->paginate(10)
        ]);
    }
}
