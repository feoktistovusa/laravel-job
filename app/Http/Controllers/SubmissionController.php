<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSubmission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        ProcessSubmission::dispatch($validated);

        return response()->json(['message' => 'Submission is being processed'], 202);
    }
}
