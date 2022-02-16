<?php

namespace App\Services;

use App\Issue;
use App\Repositories\IssueRepository;
use Illuminate\Http\Request;

class IssueService
{
    public function __construct(IssueRepository $issue)
    {
        $this->issue = $issue ;
    }

    public function index()
    {
        return $this->issue->all();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        return $this->issue->create($attributes);
    }

    public function read($id)
    {
        return $this->issue->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->issue->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->issue->delete($id);
    }

}
