<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new expense') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="max-w-lg mx-auto bg-gray-800 p-5 rounded-lg">
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
                    <select id="payment_method" class="bg-gray-50 border mb-3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a payment method</option>
                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card Payment</option>
                        <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card Payment</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                        <option value="mobile_wallet" {{ old('payment_method') == 'mobile_wallet' ? 'selected' : '' }}>Mobile Wallet Payment</option>
                        <option value="cryptocurrency" {{ old('payment_method') == 'cryptocurrency' ? 'selected' : '' }}>Cryptocurrency Payment</option>
                        <option value="check_payment" {{ old('payment_method') == 'check_payment' ? 'selected' : '' }}>Check Payment</option>
                        <option value="direct_debit" {{ old('payment_method') == 'direct_debit' ? 'selected' : '' }}>Direct Debit</option>
                        <option value="online_banking" {{ old('payment_method') == 'online_banking' ? 'selected' : '' }}>Online Banking</option>
                        <option value="apple_pay" {{ old('payment_method') == 'apple_pay' ? 'selected' : '' }}>Apple Pay</option>
                        <option value="google_pay" {{ old('payment_method') == 'google_pay' ? 'selected' : '' }}>Google Pay</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="image" :value="__('Upload invoice image')" />
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file">
                </div>

                <div class="mb-3 mt-3">
                    <div class="flex flex-row">
                        <x-input-label :value="__('Select any category')" />
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        @foreach($allCategories as $category)
                            <div class="flex items-center">
                                <input id="category_{{ $category->id }}" type="checkbox" value="{{ $category->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="category_{{ $category->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 flex justify-center">
                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create Expense</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
