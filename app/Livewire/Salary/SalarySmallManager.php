<?php

namespace App\Livewire\Salary;

use App\Models\Salary;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

#[Lazy]
class SalarySmallManager extends Component
{
    use WithoutUrlPagination;

    public $salary_id, $date, $owner_id, $driver_id, $salary, $comment;
    public $editForm = false, $confirmingDeletion = false;
    public $createOrUpdate;
    public $isOpenForm = false;


    public function render()
    {
        $salaries = Salary::where('driver_id', Auth::user()->id)
            ->where('profit_id', 0)
            ->with('driver')
            ->with('log')
            ->orderByDesc('date')
            ->take(3)
            ->get();
        return view('livewire.salary.salary-small-manager', ['salaries' => $salaries]);
    }

    public function placeholder()
    {
        return view('livewire.salary.spinner');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->date = date('Y-m-d');
        $this->createOrUpdate = 0;
        $this->toggle();
    }

    public function edit($id)
    {
        $this->createOrUpdate = 1;

        $salary = Salary::findOrFail($id);

        $this->salary_id = $salary->id;
        $this->date = $salary->date;
        $this->salary = $salary->sum;
        $this->comment = $salary->comment;
        $this->toggle();
    }

    public function store()
    {
        $this->validate([
            'date' => 'required|date|before_or_equal:today',
            'salary' => 'required|decimal:0,2|min:10|max:9999999.99',
            'comment' => 'nullable|string',
        ]);

        Salary::updateOrCreate(
            ['id' => $this->salary_id],
            [
                'date' => $this->event_date,
                'owner' => Auth::user()->last_name,
                'driver_id' => Auth::user()->id,
                'salary' => $this->sum,
                'comment' => $this->comment,
            ]
        );
        $this->toggle();
        $this->resetInputFields();
        $this->dispatch('salaryUpdate');
    }

    public function confirmDelete($id)
    {
        $this->salary_id = $id;
        $this->confirmingDeletion = true;
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        Salary::find($this->salary_id)->delete();
        $this->confirmingDeletion = false;
        $this->dispatch('salaryUpdate');
    }

    public function toggle()
    {
        $this->isOpenForm = !$this->isOpenForm;
    }

    private function resetInputFields()
    {
        $this->salary_id = null;
        $this->date = '';
        $this->owner_id = '';
        $this->driver_id = '';
        $this->salary = '';
        $this->comment = '';
    }
}
