<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WorldWarService;

class TestController extends Controller
{
    private WorldWarService $testService;

    public function __construct(WorldWarService $testService)
    {
        $this->testService = $testService;
    }

    public function test() {
        dd($this->testService->index());
    }
}
