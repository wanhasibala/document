<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4 text-gray-200">Edit User</h1>

        <form method="POST" action="{{ route('admin.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-200">User Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="text" name="password" id="password" value="{{ $user->password }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            {{-- <div class="mb-4">
                <label for="is_admin" class="block text-sm font-medium text-gray-600">Is Admin?</label>
                <select name="is_admin" id="is_admin" class="mt-1 p-2 border rounded-md w-full">
                    <option value="0" {{ $user->is_admin === 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $user->is_admin === 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div> --}}

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
        </form>
    </div>
</x-app-layout>