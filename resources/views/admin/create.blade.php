<x-app-layout>
    <div class="bg-gray-200 min-h-screen flex ">
        <div class="bg-white p-8 rounded shadow-md w-full m-8  ">
            <div class="flex flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold ">Create New User</h1>
                <a class="text-sm py-2 px-4 bg-black text-white rounded-2xl" href="/dashboard/admin">Create</a>
            </div>
            <form action="{{ route('admin.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                {{-- <div class="mb-4">
                    <label for="is_admin" class="block text-sm font-medium text-gray-600">Is Admin?</label>
                    <select name="is_admin" type="is_admin" class=" form-control mt-1 p-2 border rounded-md w-full" required>
                        <option value="0" {{ $user->is_admin === 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $user->is_admin === 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div> --}}
                <button type="submit" class="text-sm py-2 px-4 bg-black text-white rounded-xl ">Create</button>
            </form>
        </div>
    </div>
</x-app-layout>