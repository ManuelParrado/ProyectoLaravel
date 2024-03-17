<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ExpenseTable extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortAsc = true;

    #[On('updatelist')]
    public function render()
    {

        $user = User::find(Auth::id());

        $userExpenses = $user->expenses()
            ->with('categories')
            ->where('description', 'like', '%' . $this->search . '%')
            ->orWhere('amount', 'like', '%' . $this->search . '%')
            ->orWhere('expense_date', 'like', '%' . $this->search . '%')
            ->orWhere('payment_method', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(5);

        return view('livewire.expense-table')->with('userExpenses', $userExpenses);
    }

    public function sortBy($field)
    {
        // Alterna la ordenación ascendente/descendente de un campo, reiniciando a ascendente al cambiar de campo.
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
            $this->sortField = $field;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
