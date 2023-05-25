<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function makeAdmin($id)
{
   
    if (Auth::user() && Auth::user()->is_super_admin) {
        $user = User::find($id);
        $user->is_admin = 1;
        $user->save();
        
        return redirect('/admin/users');
    }


    return redirect('home');
}

    public function removeAdmin($id)
    {
        if (Auth::user() && Auth::user()->is_super_admin) {
            $user = User::find($id);
            if ($user && $user->is_admin) {
                $user->is_admin = 0;
                $user->save();
            }
    
            return redirect('/admin/users');
        }
    
        return redirect('home'); 
    }
    
}
