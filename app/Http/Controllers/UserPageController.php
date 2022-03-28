<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('user_page', compact('user'));
    }
}
