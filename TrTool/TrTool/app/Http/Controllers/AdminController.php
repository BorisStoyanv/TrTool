<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        $badges = Badge::all();
    
        return view('admin.dashboard', ['users' => $users, 'badges' => $badges]);
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }
    public function assignBadge(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'badge_id' => 'required|exists:badges,id',
        ]);
    
        $user = User::find($request->input('user_id'));
        $badge = Badge::find($request->input('badge_id'));
    
        $user->badges()->attach($badge);
    
        return back()->with('success', 'Badge assigned successfully.');
    }
    public function showAssignBadgeForm(User $user)
    {
        $badges = Badge::all();

        return view('admin.assignBadge', [
            'user' => $user,
            'badges' => $badges,
        ]);
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
