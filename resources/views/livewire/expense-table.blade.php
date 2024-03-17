<div>
    <a href="{{ route('expense.create') }}" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create a New Expense</a>
    <input class="shadow-sm text-sm rounded-lg w-52 p-2.5 bg-purple-800 border-gray-600 placeholder-gray-200 text-white focus:ring-blue-500 focus:border-pink-300 shadow-sm-light" type="text" wire:model.live="search" placeholder="Search expenses...">
    @if($userExpenses->isEmpty())
    <div class="bg-white mt-3 dark:bg-purple-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("No expenses found") }}
        </div>
    </div>
    @else
    @if (session('status'))
        <div class="p-4 mb-4 mt-4 text-sm text-{{session('color')}}-800 rounded-lg bg-{{session('color')}}-50 dark:bg-purple-800 dark:text-{{session('color')}}-400" role="alert">
            {{session('status')}}
        </div>
    @endif
    <div class="bg-white dark:bg-gray-800 mt-4 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-200">
                <thead class="text-xs text-gray-200 uppercase bg-gray-50 dark:bg-purple-800 dark:text-gray-400">
                    <tr>
                        <th wire:click="sortBy('description')" scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                            <div class="flex items-center">
                                Description
                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            </div>
                        </th>
                        <th wire:click="sortBy('amount')" scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Amount
                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            </div>
                        </th>
                        <th wire:click="sortBy('expense_date')" scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Date
                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            </div>
                        </th>
                        <th wire:click="sortBy('payment_method')" scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Payment Method
                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Invoice
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categories
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userExpenses as $ue)
                        <tr class="bg-white border-b dark:bg-purple-800/10 dark:border-purple-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
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
                                <a class="text-gray-200 hover:text-gray-400 underline" target="_blank" alt="Invoice" href="{{asset('storage/images/'.$ue->image)}}">See invoice</a>
                            </td>
                            <td class="px-6 py-4">
                                <ul>
                                    @foreach ($ue->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 pt-4">
                                <a href="{{ route('expense.edit', ['expense' => $ue]) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Edit Expense
                                </a>
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
            <div class="text-white">{{ $userExpenses->links() }}</div>
        </div>
    </div>
    @endif
</div>
