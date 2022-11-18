<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelationController extends Controller
{
    public function one_to_one() {

//        $user = Auth::user();
//        $profile = Profile::where('user_id', $user)->first();
//        return $user->profile;

//        $profile = Profile::find(1);
//        dd($profile->user);

        $user = User::all();

        return view('admin.one_to_one', [
            'users' => $user,
        ]);





    }
}
