<?php
// app/Http/Controllers/ReminderController.php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'date' => 'required|date',
        ]);

        $reminder = new Reminder();
        $reminder->title = $request->title;
        $reminder->category = $request->category;
        $reminder->date = $request->date;
        $reminder->user_id = Auth::id();
        $reminder->save();

        return response()->json(['message' => 'Reminder created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $reminder = Reminder::findOrFail($id);
        $reminder->title = $request->title;
        $reminder->category = $request->category;
        $reminder->date = $request->date;
        $reminder->save();

        return response()->json(['message' => 'Reminder updated successfully'], 200);
    }
}