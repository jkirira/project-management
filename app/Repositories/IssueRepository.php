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
        return Issue::find($id);
    }

    public function getIssuesByUser($user)
    {
        return $user->issues;
    }

    public function addIssue(IssueRequest $request)
    {
        $tenant = auth()->user();
        $request->tenant_id = $tenant->id;
        $request->manager_id = $tenant->unit->project->manager->id;
        Issue::create($request);
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
