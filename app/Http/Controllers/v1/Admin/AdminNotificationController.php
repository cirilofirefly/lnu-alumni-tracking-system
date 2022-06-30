<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index()
    {
        return response()->json(AdminNotification::orderBy('created_at', 'desc')->get());
    }

    public function countNotification()
    {
        return response()->json(AdminNotification::where(function ($query) {
            $query->where('notification_status', 'like', false);
        })->get()->count());
    }

    public function store(Request $request)
    {
        return response()->json(AdminNotification::create($request->all()), 200);
    }

    public function update(Request $request)
    {
        $ids = $request->notification_id;
        foreach ($ids as $id) {
            $notif = AdminNotification::where('id', $id)->first();
            $notif->update(['notification_status' => true]);
        }
        return response()->json($notif);
    }
}
