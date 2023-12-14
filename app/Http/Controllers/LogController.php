<?php

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index()
    {
        $logEntries = ActivityLog::orderBy('created_at', 'desc')->get();

        $logEntries->transform(function ($logEntry) {
            $logEntry->formattedCreatedAt = Carbon::parse($logEntry->created_at)->format('F-d-Y');
            return $logEntry;
        });

        return view('Logs/index', ['logEntries' => $logEntries]);
    }
}
