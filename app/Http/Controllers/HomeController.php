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
        $errorMessage = null;
        if ($user) {
            $username = $user->getUserName();
        } else {
            $errorMessage = __('home.you_are_not_logged_in', [
                'loginUrl' => route('login'),
                'loginTestUrl' => route('login', ['test' => 1]),
                'appName' => env('APP_NAME'),
            ]);
        }

        return view('home', [
            'username' => $username ?? '',
            'errorMessage' => $errorMessage,
            'lastMessages' => $getLastMessagesService->getLastMessagesForCurrentUser(),
            'maxResults' => GetLastMessagesService::MAX_RESULTS
        ]);
    }
}
