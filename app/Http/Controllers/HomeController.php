<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $username = $user->getUserName();
        }

        return view('home', [
            'username' => $username ?? ''
        ]);
    }
}
