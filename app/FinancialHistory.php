<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialHistory extends Model
{
    protected $guarded = [];

    public function tenant()
    {
        return $this->belongsTo(TenantDetails::class, 'tenant_id');
    }
}
