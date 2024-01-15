<x-app-layout>
    <div class="container m-8 min-w-48 bg-slate-800 p-2 rounded-md">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="card-header text-gray-100 text-xl mb-4 font-semibold">{{ __('Create Document') }}</div>

                    <div class="card-body gap-4">
                        <form method="POST" action="{{ route('document.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group  gap-2 mb-4">
                                <label for="title" class="text-gray-200 ">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control w-full rounded-md mt-1"
                                    required>
                            </div>

                            <div class="form-group text-gray-200 mb-4">
                                <label for="pdf_file">{{ __('PDF File') }}</label>
                                <input type="file" name="pdf_file" id="pdf_file"
                                    class="form-control-file w-full rounded-md mt-1" required>
                            </div>
                            <div class="form-group gap-2 mb-4">
                                <label for="category" class="text-gray-200 mr-4 mb-2">{{ __('Category') }}</label>
                                <select name="category" id="category" class="w-full rounded-md form-control" >
                                    <option value="{{$categories ? '': 'selected'}}"> choose categories </option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>

                                <label for="tags" class="text-gray-200 mb-2">Tags</label>
                                <select id="tags" name="tags[]" class=" tags form-control w-full" multiple >
                                @foreach($tags as $tag)
                                <option value="{{$tag}}">{{$tag}}</option>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>