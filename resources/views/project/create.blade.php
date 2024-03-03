<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new expense') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('expense.store')}}" method="POST" class="max-w-lg mx-auto bg-gray-800 p-5 rounded-lg" enctype="multipart/form-data">
                @csrf

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="payment_method" :value="__('Select a payment method')" />
                    <select id="payment_method" name="payment_method" class="bg-gray-50 border mb-3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a payment method</option>
                        <option value="Credit Card Payment" {{ old('payment_method') == 'Credit Card Payment' ? 'selected' : '' }}>Credit Card Payment</option>
                        <option value="Debit Card Payment" {{ old('payment_method') == 'Debit Card Payment' ? 'selected' : '' }}>Debit Card Payment</option>
                        <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="PayPal" {{ old('payment_method') == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                        <option value="Cash on Delivery (COD)" {{ old('payment_method') == 'Cash on Delivery (COD)' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                        <option value="Mobile Wallet Payment" {{ old('payment_method') == 'Mobile Wallet Payment' ? 'selected' : '' }}>Mobile Wallet Payment</option>
                        <option value="Cryptocurrency Payment" {{ old('payment_method') == 'Cryptocurrency Payment' ? 'selected' : '' }}>Cryptocurrency Payment</option>
                        <option value="Check Payment" {{ old('payment_method') == 'Check Payment' ? 'selected' : '' }}>Check Payment</option>
                        <option value="Direct Debit" {{ old('payment_method') == 'Direct Debit' ? 'selected' : '' }}>Direct Debit</option>
                        <option value="Online Banking" {{ old('payment_method') == 'Online Banking' ? 'selected' : '' }}>Online Banking</option>
                        <option value="Apple Pay" {{ old('payment_method') == 'Apple Pay' ? 'selected' : '' }}>Apple Pay</option>
                        <option value="Google Pay" {{ old('payment_method') == 'Google Pay' ? 'selected' : '' }}>Google Pay</option>
                    </select>
                    <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="image" :value="__('Upload invoice image')" />
                    <input  id="image" type="file" name="image" accept=".jpeg, .jpg, .png" value="{{old('image')}}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPEG, PNG or JPG (MAX. 2MB).</p>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="mb-3 mt-3">
                    <div class="flex flex-row">
                        <x-input-label :value="__('Select any category')" />
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        @foreach($allCategories as $category)
                            <div class="flex items-center">
                                <input id="category_{{ $category->id }}" type="checkbox" name="selected_categories[]" value="{{ $category->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="category_{{ $category->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('selected_categories')" class="mt-2" />
                </div>

                <div class="mt-4 flex justify-center">
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create Expense</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
