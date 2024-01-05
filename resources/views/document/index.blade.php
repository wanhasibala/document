<x-app-layout>
    <div class="container mx-auto p-4 text-gray-200">
        <div class="flex flex-row justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold mb-4">Document List</h1>
            <select name="sort" id="sort" class="text-gray-700">
                <option value="ascending">ascending</option>
                <option value="descending">descending</option>
            </select>
        </div>

        <table class="min-w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">File Name</th>
                    <th class="py-2 px-4 border-b">Owner</th>
                    <th class="py-2 px-4 border-b">File name</th>
                    <th class="py-2 px-4 border-b">Uploaded At</th>
                    <th class="py-2 px-4 border-b">Category</th>
                    <th class="py-2 px-4 border-b">Expires At</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($document as $document)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $document->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $document->user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $document->file_path }}</td>
                    <td class="py-2 px-4 border-b">{{ $document->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="py-2 px-4 border-b">{{ $document->category_id }}</td>
                    <td class="py-2 px-4 border-b"></td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('document.show', $document) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('document.edit', $document) }}"
                            class="text-yellow-500 hover:underline">Edit</a>
                        <form class="inline" action="{{ route('document.destroy', $document) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>