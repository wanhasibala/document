<x-app-layout>
   
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4 text-gray-100" >Document Management System Dashboard</h1>

        <div class="grid grid-cols-2 gap-4">
            <!-- Document Statistics -->
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-lg font-semibold mb-2">Document Statistics</h2>
                {{-- <ul>
                    <li>Total Documents: {{ $totalDocuments }}</li>
                    <li>Active Documents: {{ $activeDocuments }}</li>
                    <li>Archived Documents: {{ $archivedDocuments }}</li>
                </ul> --}}
            </div>

            <!-- Recent Documents -->
            <div class="bg-white p-4 rounded-md shadow-md">
                <h2 class="text-lg font-semibold mb-">Recent Documents</h2>
                <ul>
                    @foreach ($documents as $document)
                        <li>{{ $document->name }} - {{ $document->created_at->diffForHumans() }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Document Actions -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">Document Actions</h2>
            <div class="flex space-x-4">
                <a href="{{ route('document.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Document</a>
                <a href="{{ route('document.index') }}" class="bg-green-500 text-white px-4 py-2 rounded">View All Documents</a>
            </div>
        </div>
    </div>
</x-app-layout>
