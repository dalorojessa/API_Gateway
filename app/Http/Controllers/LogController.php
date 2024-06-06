<?php

namespace App\Http\Controllers;

use App\Models\RequestLog;

class LogController extends Controller
{
    public function recentLogs()
    {
        $logs = RequestLog::orderBy('created_at', 'desc')->take(15)->get();

        return response()->json($logs);
    }
}
