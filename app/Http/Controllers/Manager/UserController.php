<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = User::select('*')->paginate(20); // PER_PAGE
        return view('manager.users.index', compact('lists'));
    }
}
