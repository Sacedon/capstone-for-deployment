<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::with('user')->orderByDesc('created_at')->paginate(5);

        return view('history', compact('activityLogs'));
    }
}
