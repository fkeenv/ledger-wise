<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return UserRepository::login($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        /** @var User $user */
        return UserRepository::logout($this->user);
    }
}
