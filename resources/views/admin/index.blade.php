<x-app-layout>

    <div class="bg-gray-200 min-h-screen flex justify-center">
        <div class=" p-8 rounded  w-full md:w-[50vw] m-8 bg-gray-100  ">
            <div class="text-lg font-semibold flex justify-between items-baseline">
                Customer
                <a href="{{route('admin.users')}}" class="font-light text-sm text-gray-600">view all</a>
            </div>
            <!-- Admin-specific content goes here -->
            <div class="bg-gray-100  mt-4 rounded-lg border">
                <table class="table mt- w-full rounded-lg">
                    <thead class="border bg-gray-200">
                        <tr>
                            <th class="w-[150px]">Name</th>
                            <th class="w-[150px]">Email</th>
                            <th class="w-[100px]">Dates</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($users as $user)
                        <tr>
                            <td class="p-2 ">{{ $user->name }}</td>
                            <td class="p-2 ">{{ $user->email }}</td>
                            <td class="p-2 ">{{ $user->created_at->diffForHumans()}}</td>
                            <td class="p-2 ">
                                <div class=" flex text-xs px-2 justify-center border border-blue-500 rounded-full">
                                    @if($user->is_admin = 1)
                                    admin
                                    @else
                                    user
                                    @endif
                                </div>
                            </td>
                            <td class="p-2  flex flex-row items-baseline text-xs gap-2">
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
            <div class="mt-4 text-lg font-semibold">
                Category list
            </div>
            @if($categories->isEmpty())
            <p>there is no categories create
                <a href="" class="text-blue-600">new one</a>
            </p>
            @else
            @foreach($categories as $category)
            <li>{{$category->name}}</li>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>