<?php

namespace App\Http\Controllers;

use App\FinancialHistory;
use App\Http\Requests\FinancialHistoryRequest;
use App\Interfaces\FinancialHistoryInterface;
use App\TenantDetails;
use Illuminate\Http\Request;

class FinancialHistoryController extends Controller
{
    protected $historyRepo;

    public function __construct(FinancialHistoryInterface $historyRepo){
        $this->historyRepo = $historyRepo;
    }

    public function index(TenantDetails $tenant){
        $this->historyRepo->getTenantHistory($tenant);
    }

    public function store(FinancialHistoryRequest $request)
    {
        $this->historyRepo->addHistory($request);
    }

    public function update(FinancialHistory $history, FinancialHistoryRequest $request)
    {
        $this->historyRepo->updateHistory($history, $request);
    }

    public function destroy(FinancialHistory $history)
    {
        $this->historyRepo->deleteHistory($history);
    }
}
