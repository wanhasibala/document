<x-app-layout>
    <div class="container mx-auto p-4 text-gray-200 min-w-48">
        <div class="flex flex-row justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold mb-4">Trash </h1>
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
                        href="{{ route('document.index', ['sort_by' => 'created_at', 'sort_order' => 'desc']) }}">
                        Created (Newest)</x-dropdown-link>
                    <x-dropdown-link
                        href="{{ route('document.index', ['sort_by' => 'created_at', 'sort_order' => 'desc']) }}">Title
                        A-Z</x-dropdown-link>
                    <x-dropdown-link
                        href="{{ route('document.index', ['sort_by' => 'created_at', 'sort_order' => 'desc']) }}">Title
                        A-Z</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
        @if($trash->isEmpty())
           <p>There's no item in trash</p> 
           @else
       
        @foreach ($trash as $document)
        <div class="w-full  rounded-md mb-4">
            <div class=" flex flex-row p-1 rounded-sm items-center justify-between ">
                <div class="flex flex-row items-center ">
                    <div class="w-4 h-4 rounded-sm bg-gray-300 mx-2"></div>
                    {{$document->title}}
                </div>
                <div>
                    <form action="{{route('document.restore', $document->id)}}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit">Restore</button>
                    </form>
                    <form class="inline" action="{{ route('document.permanentDelete', $document) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-500 hover:underline">permanent delete</button>
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