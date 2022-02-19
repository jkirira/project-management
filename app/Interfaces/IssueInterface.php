<?php

namespace App\Interfaces;

use App\Http\Requests\IssueRequest;
use App\Issue;

interface IssueInterface
{

    public function getAllIssues();

    public function getIssueById($id);

    public function getIssuesByUser($user);

    public function getResolvedIssuesByUser($user);

    public function getUnresolvedIssuesByUser($user);

    public function getUnansweredIssuesByUser($user);

    public function addIssue(IssueRequest $request);

    public function updateIssue(Issue $issue, IssueRequest $request);

    public function deleteIssue($issue);
}
