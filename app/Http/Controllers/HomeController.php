<?php

namespace App\Http\Controllers;

use App\Code\V1\Messages\Services\GetLastMessagesService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(GetLastMessagesService $getLastMessagesService)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $username = $user->getUserName();
        }

        return view('home', [
            'username' => $username ?? '',
            'lastMessages' => $getLastMessagesService->getLastMessagesForCurrentUser(),
        ]);
    }
}
