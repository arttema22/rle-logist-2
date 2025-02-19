<?php

namespace App\Livewire\Salary;

use App\Models\Salary;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

#[Lazy]
class SalaryManager extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $salary_id, $event_date, $owner_id, $driver_id, $sum, $comment;
    public $editForm = false, $confirmingDeletion = false;
    public $createOrUpdate;

    public function render()
    {
        //sleep(3);
        // $salaries = Salary::where('driver_id', Auth::user()->id)->orderByDesc('event_date')->simplePaginate(5, pageName: 'salaries');
        $salaries = Salary::where('driver_id', Auth::user()->id)
            ->with('driver')
            ->with('log')->orderByDesc('date')->get();

        return view('livewire.salary.salary-manager', ['salaries' => $salaries]);
    }

    public function placeholder()
    {
        return view('livewire.salary.spinner');
    }
}
