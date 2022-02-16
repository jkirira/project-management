<?php

namespace App\Http\Controllers;

use App\TenantDetails;
use Illuminate\Http\Request;

class TenantDetailsController extends Controller
{
    public function index()
    {
        $tds = TenantDetails::latest()->get();

        return $tds;
    }
}
