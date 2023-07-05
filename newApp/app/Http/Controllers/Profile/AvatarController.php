<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function update(Request $request)
    {
        $request->validate();
        dd($request->all());
        // store avatar
        return redirect(route('profile.edit'));
    }
}
