<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Issue;
use App\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Issue $issue, RatingRequest $request)
    {
        $request['tenant_id'] = auth()->user()->id;

        $issue = $issue->addRating($request->all());

//        $rating = Rating::create([
//            'tenant_id' => auth()->id(),
//            'issue_id' => $issue->id,
//            'comment' => $request->comment,
//            'value' => $request->value,
//        ]);

        return response()->json(['message' => 'Response Successful!', 'issue'=> $issue], 200);
    }
}
