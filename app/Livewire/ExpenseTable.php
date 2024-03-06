<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpenseTable extends Component
{
    public function render()
    {
        $user = User::find(Auth::id());
        $userExpenses = $user->expenses()->with('categories')->get();
        return view('livewire.expense-table')->with('user', $user)->with('userExpenses', $userExpenses);
    }
}
