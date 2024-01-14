<x-app-layout>
    <div class="flex text-gray-200 m-8 p-8 gap-4">
        <form action="{{route('category.update', $category)}}" method="POST">
            @csrf
            @method('put')
            <input type="text" value="{{$category->name}}" class="bg-gray-700 rounded-md w-[250px]" name="name" id="name">
            <button type="submit" class="px-8 py-1 bg-green-800 rounded-md">save</button>
        </form>
    </div>
</x-app-layout>