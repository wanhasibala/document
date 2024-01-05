<x-app-layout>
    <div class="container m-8 bg-slate-800 p-2 rounded-md">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-gray-100 text-xl mb-4 font-semibold">{{ __('Create Document') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('document.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="text-gray-200">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group text-gray-200">
                                <label for="pdf_file">{{ __('PDF File') }}</label>
                                <input type="file" name="pdf_file" id="pdf_file" class="form-control-file" required>
                            </div>

                            <div class="form-group ">
                                <label for="category" class="text-gray-200 mr-4">{{ __('Category') }}</label>
                                <input type="text" name="category" id="category" class="form-control">
                            </div>

                            <div class="form-group mb-4">
                                <label for="tags" class="text-gray-200 mr-4">{{ __('Tags (JSON)') }}</label>
                                <textarea name="tags" id="tags" class="form-control" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary px-4 py-1 rounded-full bg-slate-700 text-gray-200">{{ __('Create Document') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>