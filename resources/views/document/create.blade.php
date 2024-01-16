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
                                    value="{{old('title')}}" required>
                            </div>

                            <div class="form-group text-gray-200 mb-4">
                                <label for="pdf_file">{{ __('PDF File') }}</label>
                                <input type="file" name="pdf_file" id="pdf_file"
                                    class="form-control-file w-full rounded-md mt-1" required>
                            </div>
                            <div class="form-group gap-2 mb-4">
                                <label for="category" class="text-gray-200 mr-4 mb-2">{{ __('Category') }}</label>
                                <select name="category_id" id="category" class="w-full rounded-md form-control">
                                    <option value="{{$categories ? '': 'selected'}}"> choose categories </option>
                                    @foreach($categories as $category)
                                    @if(old('category_id')==$category->id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif  
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex ">
                                @foreach($tags as $tag)
                                <div class="flex items-center me-4">
                                    <input  id="tags" type="checkbox" value="{{$tag->id}}" name="tags[]"
                                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="{{$tag->name}}"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$tag->name}}</label>
                                </div>
                                @endforeach

                            </div>

                            <button type="submit"
                                class="btn btn-primary px-4 py-1 rounded-full bg-slate-700 text-gray-200 mt-4">{{
                                __('Create
                                Document') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        
    <script>
        $(document).ready(function(){
            $('tags').select2({
                placeholder : 'select',
                allowClear : true,
            });
            $("#tags").select2({
                ajax: {
                    url : "{{route('get-tags')}}",
                    type: 'post',
                    delay: 250,
                    dataType: json,
                    data: function(params){
                        return {
                            name: params.term,
                            "_token" : "{{csrf_token()}}",
                        };
                    },
                    processResult:function(data){"
                        results = $.map(data, function(item){
                            return {
                                id : item.id,
                                text: item.title,
                            }
                        })
                    }
                }
            })
        })
    </script>
    @endpush

</x-app-layout>