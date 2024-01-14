<x-app-layout>

    <div class="min-h-screen text-gray-200 flex flex-col m-8 md:flex-row gap-10">
        <div class="  rounded md:w-[50vw] min-w-[500px] ">
            <div class="text-lg font-semibold flex justify-between items-baseline">
                User list
                {{-- <a href="{{route('admin.users')}}" class="font-light text-sm ">view all</a> --}}
            </div>
            <!-- Admin-specific content goes here -->
            <div class="  mt-4 rounded-lg border border-gray-600">
                <table class="table mt- w-full rounded-lg">
                    <thead class="border bg-gray-700 border-gray-600">
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
        </div>
        <div class="w-[30vw]">
            <div class="mt-4 text-lg font-semibold">
                Category list
            </div>
            @if($categories->isEmpty())
            <p>there is no categories create
                <a href="" class="text-blue-600">new one</a>
            </p>
            @else
            <form action="{{route('category.store')}}" method="post" class="flex gap-4 my-4 justify-start">
                @csrf
                <input type="text" name="name" id="name" class="bg-gray-700 w-[30vw] h-8 rounded-md ">
                <button type="submit" class="rounded-full border-[.5px] border-gray-700 px-2 " >create</button>
            </form>
            @foreach($categories as $category)
           
            <div class="flex justify-between ">
                <p>{{$category->name}}</p>

                <div class="flex gap-5">
                    <a href="{{route('category.edit', $category)}}">edit</a>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger text-xs text-red-800"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>