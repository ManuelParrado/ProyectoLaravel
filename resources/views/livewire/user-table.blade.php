<div>
    <a href="{{ route('user.create') }}" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create a New User</a>
    <input class="shadow-sm text-sm rounded-lg w-52 p-2.5 bg-purple-800 border-gray-600 placeholder-gray-200 text-white focus:ring-blue-500 focus:border-pink-300 shadow-sm-light" type="text" wire:model.live="search" placeholder="Search users...">
    @if($users->isEmpty())
    <div class="bg-white mt-3 dark:bg-purple-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("No users found") }}
        </div>
    </div>
    @else
    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-{{session('color')}}-800 rounded-lg bg-{{session('color')}}-50 dark:bg-gray-800 dark:text-{{session('color')}}-400" role="alert">
            {{session('status')}}
        </div>
    @endif
    <div class="bg-white dark:bg-gray-800 mt-4 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-200">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-purple-800 dark:text-gray-400">
                    <tr>
                        <th wire:click="sortBy('email')" scope="col" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                            Email
                        </th>
                        <th wire:click="sortBy('name')" scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th wire:click="sortBy('last_name')" scope="col"class="px-6 py-3 ">
                            Last Name
                        </th>
                        <th wire:click="sortBy('role')" scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th wire:click="sortBy('created_at')" scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th wire:click="sortBy('updated_at')" scope="col" class="px-6 py-3">
                            Updated At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr class="bg-white border-b dark:bg-purple-800/10 dark:border-purple-700">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$u->email}}
                            </td>
                            <td class="px-6 py-4">
                                {{$u->name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$u->last_name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$u->role}}
                            </td>
                            <td class="px-6 py-4">
                                {{$u->created_at}}
                            </td>
                            <td class="px-6 py-4">
                                {{$u->updated_at}}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{route('user.edit', ['user'=>$u])}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Edit User</a>
                                <form class="mt-5" action="{{route('user.destroy', ['user'=>$u])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Delete User</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
    @endif
</div>
