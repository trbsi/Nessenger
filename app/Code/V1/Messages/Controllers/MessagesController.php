<?php

namespace App\Code\V1\Messages\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessagesController
{
    public function send(Request $request)
    {
        return response()->json([]);
    }
}
