<?php

namespace App\Repositories;

use App\Http\Requests\FinancialHistoryRequest;
use App\Interfaces\FinancialHistoryInterface;
use App\FinancialHistory;
use App\TenantDetails;
use Carbon\Traits\Date;

class FinancialHistoryRepository implements FinancialHistoryInterface
{
    
    public function getTenantHistory(TenantDetails $tenant)
    {
        return $tenant->financialHistory;
    }

    public function getHistoryById($id)
    {
        return FinancialHistory::find($id);
    }

    public function addHistory(FinancialHistoryRequest $request)
    {
        $request['payment_date'] = Date::now();

        return FinancialHistory::create($request->all());
    }

    public function updateHistory(FinancialHistory $history, FinancialHistoryRequest $request)
    {
        $validated = $request->validated();

        return $history->update($validated);
    }

    public function deleteHistory(FinancialHistory $history)
    {
        return $history->delete();
    }
}
