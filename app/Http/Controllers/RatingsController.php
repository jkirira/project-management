<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Reply;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Issue $issue)
    {
        Rating::create([
            'user_id' => auth()->id(),
            'issue_id' => $issue->id,
            'comment' => request('comment'),
            'value' => request('value'),
        ]);
        return back();
    }
}
