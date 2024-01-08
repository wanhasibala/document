<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4 text-gray-200">Edit User</h1>

        <form method="POST" action="{{ route('document.update', $document)  }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="title" class="text-gray-200">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{$document->title}}">
            </div>

            <div class="form-group text-gray-200">
                <label for="pdf_file">{{ __('PDF File') }}</label>
                <input type="file" name="pdf_file" id="pdf_file" class="form-control-file" required value="{{$document->file_path}}">
            </div>

            <div class="form-group ">
                <label for="category" class="text-gray-200 mr-4">{{ __('Category') }}</label>
                <input type="text" name="category" id="category" class="form-control" value="{{$document->category_id}}">
            </div>

            <div class="form-group mb-4">
                <label for="tags" class="text-gray-200 mr-4">{{ __('Tags (JSON)') }}</label>
                <textarea name="tags" id="tags" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary px-4 py-1 rounded-full bg-slate-700 text-gray-200">{{
                __('Create Document') }}</button>
        </form>

</x-app-layout>