<div>
    <a href="{{ route('expense.create') }}" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create a New Expense</a>
    @if($userExpenses->isEmpty())
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("There are no users") }}
        </div>
    </div>
    @else
    <input class="dark:text-black"type="text" wire:model.live="search" placeholder="Search expenses...">
    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-{{session('color')}}-800 rounded-lg bg-{{session('color')}}-50 dark:bg-gray-800 dark:text-{{session('color')}}-400" role="alert">
            {{session('status')}}
        </div>
    @endif
    <div class="bg-white dark:bg-gray-800 mt-4 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th wire:click="sortBy('description')" scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Description
                        </th>
                        <th wire:click="sortBy('amount')" scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th wire:click="sortBy('expense_date')" scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th wire:click="sortBy('payment_method')" scope="col" class="px-6 py-3">
                            Payment Method
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Invoice
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categories
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userExpenses as $ue)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$ue->description}}
                            </th>
                            <td class="px-6 py-4">
                                {{$ue->amount}}€
                            </td>
                            <td class="px-6 py-4">
                                {{$ue->expense_date}}
                            </td>
                            <td class="px-6 py-4">
                                {{$ue->payment_method}}
                            </td>
                            <td class="px-6 py-4">
                                <a target="_blank" alt="Invoice" href="{{asset('storage/images/'.$ue->image)}}">See invoice</a>
                            </td>
                            <td class="px-6 py-4">
                                <ul>
                                    @foreach ($ue->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('expense.edit', ['expense'=>$ue])}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Edit Expense</a>
                                <form class="mt-5" action="{{route('expense.destroy', ['expense'=>$ue])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Delete Expense</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$userExpenses->links()}}
        </div>
    </div>
    @endif
</div>
