<x-app-layout>
    <div class="container mx-auto p-4 text-gray-200 min-w-48">
        <div class="flex flex-row justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold mb-4">Document List</h1>
            <div class="flex flex-row gap-4 items-center  ">
                <form action="/document">
                    <div class="flex flex-row gap-2">

                        
                        <div class="form-group ">
                            <select class="form-control bg-gray-700 rounded-full  " id="filter" name="filter">
                                <option value={{ $filter ? '' : 'selected' }}>All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $filter==$category->id ? 'selected' : '' }}>{{
                                    $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-row gap-2 items-center form group">
                            <input type="text" class="h-8 bg-slate-800 rounded-md w-32" name="search" id="search"
                                value="{{$search}}">
                        </div>
                        <button type="submit">go</button>
                </form>
            </div>

            <x-dropdown name="sort" id="sort" class="text-gray-700 text-sm rounded-md ">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>Sort By</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link
                        href="{{ route('document.index', ['sort_by' => 'created_at', 'sort_order' => 'desc']) }}">
                        Created (Newest)</x-dropdown-link>
                    <x-dropdown-link
                        href="{{ route('document.index', ['sort_by' => 'created_at', 'sort_order' => 'asc']) }}">
                        Created (Last)</x-dropdown-link>
                    <x-dropdown-link
                        href="{{ route('document.index', ['sort_by' => 'title', 'sort_order' => 'desc']) }}">
                        Title A-Z</x-dropdown-link>
                    <x-dropdown-link
                        href="{{ route('document.index', ['sort_by' => 'title', 'sort_order' => 'asc']) }}">
                        Title Z-A</x-dropdown-link>
                </x-slot>
            </x-dropdown>



        </div>
    </div>
    @if($document->isEmpty())
    <p>There's no document</p>
    @else
    @foreach ($document as $document)
    <div class="w-full  rounded-md mb-4">
        <div class=" flex flex-row p-1 rounded-sm items-center justify-between ">
            <div class="flex flex-row items-center ">
                <div class="w-4 h-4 rounded-sm bg-gray-300 mx-2"></div>
                {{$document->title}}
                <div class="text-sm ml-10">
                    {{$document->category->name}}
                </div>
            </div>
            <div>
                <a href="{{ route('document.show', $document) }}" class="text-blue-500 hover:underline">View</a>
                <a href="{{ route('document.edit', $document) }}" class="text-yellow-500 hover:underline">Edit</a>
                <form class="inline" action="{{ route('document.destroy', $document) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        <div class="w-full h-[1px] bg-gray-800"> </div>
    </div>
    @endforeach
    </tbody>
    </table>
    @endif

    </div>
</x-app-layout>