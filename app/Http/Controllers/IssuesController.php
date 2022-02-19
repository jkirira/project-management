<?php

namespace App\Http\Controllers;

use App\Filters\IssuesFilters;
use App\Http\Requests\IssueRequest;
use App\Interfaces\IssueInterface;
use App\Issue;
use App\User;
use Illuminate\Http\Request;

class IssuesController extends Controller
{

    protected $issueRepo;

    public function __construct(IssueInterface $issueRepo)
    {
        $this->issueRepo = $issueRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user=null)
    {
//        $issues = Issue::latest()->filter($filters);
//
//        $issues = $issues->get();

//        $issues = Issue::latest()->get();

        if($user)
        {
            $issues = $this->issueRepo->getIssuesByUser($user);
            return response()->json($issues, 200);
        }

        $issues = $this->issueRepo->getAllIssues();
        return response()->json($issues, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssueRequest $request)
    {

//        $issue = Issue::create([
//            'tenant_id' => auth()->id(),
//            'title' => $request['title'],
//            'body' => $request['body'],
//            'status' => "unanswered",
//        ]);

        $issue = $this->issueRepo->addIssue($request);
        return response()->json(['message' => 'Issue Successfully created!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
//    public function show(Issue $issue)
    public function show($id)
    {
//        $issue = Issue::with('replies')->find($id);

        $issue = $this->issueRepo->getIssueById($id);
        return response()->json($issue, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue, Request $request)
    {
        if($request->resolve){
            $issue->resolve();
            return response(['message' => 'Issue Resolved'], 200);
        }
        $issue->unresolve();
        return response(['message' => 'Issue marked as Unresolved'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Issue $issue, IssueRequest $request)
    {
        $issue = $this->issueRepo->updateIssue($issue, $request);
        return response()->json($issue, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Issue $issue)
    public function destroy($issue)
    {
//        $this->authorize('update', $issue);
//        $issue = Issue::find($id);
//
//        $issue->delete();

        $this->issueRepo->deleteIssue($issue);

        return response()->json(["success"], 204);

    }
}
