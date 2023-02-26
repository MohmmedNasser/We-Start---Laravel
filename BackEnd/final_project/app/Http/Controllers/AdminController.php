<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function settings() {
        return view('admin.settings');
    }

    public function settings_data(Request $request) {

        $logo = setting('logo');
        if($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('uploads/logo', 'custom');
        }
        setting()->set('site_name', $request->site_name);
        setting()->set('logo', $logo);
        setting()->set('facebook', $request->facebook);
        setting()->set('twitter', $request->twitter);
        setting()->set('linkedin', $request->linkedin);
        setting()->save();

        return redirect()->back();
    }
}
