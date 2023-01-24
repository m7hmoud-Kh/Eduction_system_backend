<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Branch\BranchStoreRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {

    }

    public function store(BranchStoreRequest $request)
    {
        Branch::create($request);
        
    }

    public function update()
    {

    }

    public function destory()
    {

    }
}
