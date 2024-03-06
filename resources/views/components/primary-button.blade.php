<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 bg-pink-800 dark:bg-purple-300 hover:bg-pink-900 dark:hover:bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-gray-200 dark:text-gray-800 uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>

