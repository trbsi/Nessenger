<?php

namespace App\Code\V1\Messages\Controllers;

use App\Code\V1\Messages\Services\SaveMessageService;
use App\Code\V1\Messages\Services\SearchMessagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessagesController
{
    public function send(Request $request, SaveMessageService $saveMessageService)
    {
        $model = $saveMessageService->saveMessage($request->message);
        return response()->json([
            'message' => $model->getMessage()
        ]);
    }

    public function search(Request $request, SearchMessagesService $searchMessagesService)
    {
        $result = $searchMessagesService->search($request->message);
        return response()->json($result);
    }
}
