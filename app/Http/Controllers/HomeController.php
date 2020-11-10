<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Nubs\RandomNameGenerator\All;

class HomeController extends Controller
{
    public function home()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $username = $user->getUsername();
        } else {
            if (!isset($_COOKIE['uid'])) {
                $generator = All::create();
                $username = $generator->getName();
                setcookie('uid', $username, time() + (8640000 * 30), "/");
            } else {
                $username = $_COOKIE['uid'];
            }
        }
        return view('home', [
            'username' => $username
        ]);
    }
}
