<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = DB::table('users')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('phone_number', 'like', '%' . $search . '%')
            ->orWhere('id', $search)
            ->get();

        return view('user', compact('users'));
    
    }


}

