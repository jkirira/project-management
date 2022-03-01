<?php

namespace App\Repositories;

use App\Http\Requests\IssueRequest;
use App\Interfaces\IssueInterface;
use App\Issue;

class IssueRepository implements IssueInterface
{

    public function getAllIssues()
    {
        return Issue::latest()->get();
    }

    public function getIssueById($id)
    {
        return Issue::with('replies')->find($id);
    }

    public function getIssuesByUser($user)
    {
        return $user->issues;
    }

    public function getIssuesByManager($id)
    {
        return $issues = Issue::where('manager_id', $id)->get();
    }

    public function getResolvedIssuesByUser($user){
        return $user->issues->where('status', 'resolved');
    }

    public function getUnresolvedIssuesByUser($user){
        return $user->issues->where('status', 'unresolved');
    }

    public function getUnansweredIssuesByUser($user){
        return $user->issues->where('status', 'unanswered');
    }

    public function addIssue(IssueRequest $request)
    {
        $tenant = auth()->user();
        $manager = $tenant->tenantDetails->unit->project->manager;
        $project = $tenant->tenantDetails->unit->project;

        $request['tenant_id'] = $tenant->id;
        $request['manager_id'] = $manager ? $manager->id : null;
        $request['project_id'] = $project ? $project->id : null;

        return Issue::create($request->all());
    }

    public function updateIssue(Issue $issue, IssueRequest $request)
    {
        $validated = $request->validated();

        return $issue->update($validated);
    }

    public function deleteIssue($issue)
    {
        return $issue->delete();
    }
}
