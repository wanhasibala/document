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
                <input type="file" name="pdf_file" id="pdf_file"
                    class="form-control-file w-full rounded-md mt-1" required>
            </div>
            <div class="form-group gap-2 mb-4">
                <label for="category" class="text-gray-200 mr-4 mb-2">{{ __('Category') }}</label>
                <select name="category" id="category" class="w-full rounded-md form-control" >
                    <option value="{{$document->categories }}"> choose categories </option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tags" class="text-gray-200 mb-2">Tags</label>
                <select id="tags" name="tags[]" class=" tags form-control w-full"  >
                    <option value="{{$document->tags}}"
                @foreach($tags as $tag)
                <option value="{{$tag->name}}">{{$tag->name}}</option>
                @endforeach
                </select>
            </div>
            
            {{-- <select>
                @foreach( $tags as $tag)
                {{$tag}}
                <option value="{{$tag}}" selected hidden> {{$tag}}</option>
                @endforeach

            </select> --}}
            <button type="submit"
                class="btn btn-primary px-4 py-1 rounded-full bg-slate-700 text-gray-200 mt-4">{{ __('Create
                Document') }}</button>
        </form>

</x-app-layout>