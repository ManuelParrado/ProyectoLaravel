<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-20">
        <div class="container mx-auto flex items-center justify-center">
            <div class="max-w-2xl bg-white shadow-lg p-8 rounded-lg flex items-center">
                <div class="flex-shrink-0">
                    <img src="{{ asset('storage/images/logo/logo.jpeg') }}" alt="Welcome Image" class="w-64 h-64 object-cover rounded-md">
                </div>
                <div class="ml-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Your Expense App</h1>
                    <p class="text-lg text-gray-600">Start managing your expenses effortlessly with our powerful expense tracking application.</p>
                    @guest
                    <a href="{{ route('expense.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">Get Started</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
