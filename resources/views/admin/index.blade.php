<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">

            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <a class="text-sm py-2 px-4 bg-black text-white rounded-2xl" href="/dashboard/admin/create">Create new user</a>
        </div>
    </x-slot>

    <div class="bg-gray-200 min-h-screen flex ">
        <div class="bg-white p-8 rounded shadow-md w-full m-8  ">
            <!-- Admin-specific content goes here -->

            <table class="table mt-3 w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="p-1 border">{{ $user->name }}</td>
                        <td class="p-1 border">{{ $user->email }}</td>
                        <td class="p-1 border flex flex-row items-center">
                            <a href="{{ route('admin.edit', $user) }}"
                                class="btn btn-sm btn-primary p-1 bg-gray-600 m-1 text-white rounded-md text-sm ">Edit</a>
                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger text-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>