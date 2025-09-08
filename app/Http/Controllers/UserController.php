<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $req)
{
    $user = User::where('email', $req->email)->first();

    if (!$user || !\Illuminate\Support\Facades\Hash::check($req->password, $user->password)) {
        return "Username or password is not Match";
    } else {
        $req->session()->put('user', $user);
        return redirect('/');   // Login ke baad product page
    }
}

}