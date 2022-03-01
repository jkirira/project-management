<?php

namespace App\Interfaces;

use App\Http\Requests\FinancialHistoryRequest;
use App\FinancialHistory;
use App\TenantDetails;

interface FinancialHistoryInterface
{

//    public function getAllHistory();

    public function getHistoryById($id);

    public function getTenantHistory(TenantDetails $tenant);

    public function addHistory(FinancialHistoryRequest $request);

    public function updateHistory(FinancialHistory $history, FinancialHistoryRequest $request);

    public function deleteHistory(FinancialHistory $history);
}
