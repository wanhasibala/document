<x-app-layout>
    <div class=" bg-gray-900 text-gray-200 flex flex-col m-8 md:flex-row gap-10 justify-center">
        <div class="  rounded md:w-[70vw] min-w-[500px] ">
            <div class="text-lg font-semibold flex justify-between items-baseline">
                User list
                {{-- <a href="{{route('admin.users')}}" class="font-light text-sm ">view all</a> --}}
                <a href="{{route('userexport')}}" class="bg-green-700 px-4 py-1 rounded-full text-sm"> export users</a>
            </div>
            <!-- Admin-specific content goes here -->
            <div class="  mt-4 rounded-lg border border-gray-600">
                <table class="table mt- w-full rounded-lg">
                    <thead class="border bg-gray-700 border-gray-600">
                        <tr>
                            <th class="w-[150px] md:w-[20vw]">Name</th>
                            <th class="w-[150px] md:w-[20vw]">Email</th>
                            <th class="w-[100px] md:w-[15vw]">Dates</th>
                            <th class="w-[100px]">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm ">
                        @foreach ($users as $user)
                        <tr>
                            <td class="p-2 ">{{ $user->name }}</td>
                            <td class="p-2 ">{{ $user->email }}</td>
                            <td class="p-2 ">{{ $user->created_at}}</td>
                            <td class="p-2 ">
                                <div class=" flex text-xs px-2 justify-center border border-blue-500 rounded-full">
                                    @if($user->is_admin = 1)
                                    admin
                                    @else
                                    user
                                    @endif
                                </div>
                            </td>
                            <td class="p-2  flex flex-row justify-center text-xs gap-2">
                                <a href="{{ route('admin.edit', $user) }}"
                                    class=" text-green-500 rounded-md text-xs ">Edit</a>
                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger text-xs text-red-800"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="mt-8">

                <form action="{{ route('userimport') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xlsx, .xls">
                    <button type="submit">Import</button>
                </form>
            </div>
        </div>
</x-app-layout>