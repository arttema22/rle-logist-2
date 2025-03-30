<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\MoonShine\Pages\DriverSalary\DriverSalaryIndexPage;
use App\MoonShine\Pages\TestPage;
use App\MoonShine\Resources\Driver\DriverSalaryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryContriller extends Controller
{
    public function test(
        TestPage $page
    ): TestPage {
        // $salaries = Salary::where('driver_id', Auth::user()->id)
        //     ->where('profit_id', 0)
        //     ->with('driver')
        //     //->with('log')
        //     ->orderByDesc('date')
        //     ->get();

        return $page;
    }
    public function test2(DriverSalaryIndexPage $page, DriverSalaryResource $resource)
    {
        return $page->simulateRoute($page, $resource)->loaded();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::where('driver_id', Auth::user()->id)
            ->where('profit_id', 0)
            ->with('driver')
            //->with('log')
            ->orderByDesc('date')
            ->get();
        return view('salary.index', ['salaries' => $salaries]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
