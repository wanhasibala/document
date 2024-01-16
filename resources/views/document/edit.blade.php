<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4 text-gray-200">Edit User</h1>

        <form method="POST" action="{{ route('document.update', $document)  }}">
            @csrf
            @method('put')

            <div class="form-group  gap-2 mb-4">
                <label for="title" class="text-gray-200 ">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" class="form-control w-full rounded-md mt-1"
                    value="{{$document->title}}">
            </div>

            <div class="form-group text-gray-200 mb-4">
                <label for="pdf_file">{{ __('PDF File') }}</label>
                <input type="file" name="pdf_file" id="pdf_file" class="form-control-file w-full rounded-md mt-1"
                    required>
            </div>
            <div class="form-group gap-2 mb-4">
                <label for="category" class="text-gray-200 mr-4 mb-2">{{ __('Category') }}</label>
                <select name="category" id="category" class="w-full rounded-md form-control">
                    <option value="{{$categories ? '': 'selected'}}"> choose categories </option>
                    @foreach($categories as $category)
                    @if(old('category_id', $category->id)==$category->id)
                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div>
                <div class="flex ">
                    @foreach($tags as $tag)
                    <div class="flex items-center me-4">
                        @if(old('tags_id', $tag->id)==$tag->id)
                        <input id="tags" type="checkbox" value="{{$tag->id}}" name="tags[]" 
                            class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="{{$tag->name}}"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->name}}</label>
                        @else
                        <input id="tags" type="checkbox" value="{{$tag->id}}" name="tags[]"
                            class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="{{$tag->name}}"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->name}}</label>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- <select>
                    @foreach( $tags as $tag)
                    {{$tag}}
                    <option value="{{$tag}}" selected hidden> {{$tag}}</option>
                    @endforeach

                </select> --}}
                <button type="submit" class="btn btn-primary px-4 py-1 rounded-full bg-slate-700 text-gray-200 mt-4">{{
                    __('update') }}</button>
        </form>

</x-app-layout>