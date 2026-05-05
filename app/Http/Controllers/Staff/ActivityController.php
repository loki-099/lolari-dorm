<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Boarder;
use App\Models\BoarderActivity;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = \App\Models\BoarderActivity::with('boarder.user')->orderBy('created_at', 'desc')->paginate(10);
        return view('staff.activity.index', compact('activities'));
    }

    public function scan()
    {
        return view('staff.activity.scan');
    }

    public function record(Request $request)
    {
        $validated = $request->validate([
            'qr_code' => 'required|string',
            'activity_type' => 'required|in:entry,exit'
        ]);

        try {
            // Find boarder by QR code
            $boarder = Boarder::where('qrcode_value', $validated['qr_code'])->firstOrFail();

            // Record the activity
            BoarderActivity::create([
                'boarder_id' => $boarder->id,
                'activity_name' => $validated['activity_type'],
                'activity_reason' => "none",
                'activity_date' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activity recorded: ' . ucfirst($validated['activity_type'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Boarder not found or error recording activity: ' . $e->getMessage()
            ], 404);
        }
    }

    public function destroy(BoarderActivity $activity)
    {
        $activity->delete();

        return redirect()->route('staff.activity.index')
            ->with('success', 'Activity deleted successfully');
    }
}
