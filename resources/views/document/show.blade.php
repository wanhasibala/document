<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between">
            <div class="flex flex-row gap-2 text-white bg-gray-700 pr-4 pl-1 rounded-full ">
                <x-heroicon-o-chevron-left class="w-4 h4 text-white" />
                <a href="{{route('document.index')}}">back</a>
            </div>
            <a class="text-white px-2 rounded-full bg-yellow-800" href="{{route('document.edit', $document)}}">edit
                document</a>
        </div>
    </x-slot>
    <div class=" md:container md:mx-auto text-gray-200  m-4 flex flex-col  md:w-[600px]">
        {{-- Header --}}
        <div class=" text-2xl font-semibold ">
            <div class="mb-2">
                {{$document->title}}
            </div>
            <div class="flex text-sm items-end gap-4">
                <div class=" bg-green-700 px-2 py-1 rounded-full  ">
                    {{$document->category->name}}
                </div>
                {{$document->updated_at->diffForHumans()}}
            </div>
        </div>
        {{-- Document content --}}
        <div class="  bg-gray-700 mt-4 p-2 h-[200px] flex justify-center items-center rounded-md">
            {{$document->file_path}}
        </div>
        <div class="flex text-sm">
            <div class="mt-4 px-2 bg-gray-700 rounded-full">
                {{$document->tags}}
            </div>
        </div>
        <div class="mt-10">
            Document History
        </div>
        @forelse($audit as $audit)

        {{-- {{$modified->}} --}}
        {{-- {{$audit->created_at}} --}}
        {{-- @lang('document.' .$audit->event. '.modified.'.$attribute, $modified) --}}
        <div class="flex gap-10">
            {{-- {{$attribute}} --}}
            <div>{{$audit->created_at->diffForHumans()}}</div>
            <div>{{$audit->event}}</div>
            {{-- @foreach($audit->with('old_values') as $values ) --}}
            {{-- <div>{{$values->}}</div> --}}
            {{-- @endforeach --}}
        </div>
        @empty
        @endforelse
    </div>

</x-app-layout>