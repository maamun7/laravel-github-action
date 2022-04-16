<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TestService;

class TestController extends Controller
{
    public TestService $test;

    public function __construct(TestService $testService)
    {
        $this->test = $testService;
    }

    /**
     * @return void
     */
    public function test(): void
    {
        dd($this->test->getAll());
    }
}
