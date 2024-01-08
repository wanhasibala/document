<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Metadata;
use App\Models\Tags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        // Load the user's documents with relationships (e.g., tags, category) and apply sorting
        $document = $user->documents()
            // ->with('tags', 'category')
            ->orderBy($sortBy, $sortOrder)
            ->get();
        return view('document.index', compact('document', 'sortBy', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $existingTags = Tag::pluck('name')->toArray();
        $userId = Auth::id();
        $categories = Category::all();
        $tags = Tags::pluck('name')->toArray();
        return view('document.create', compact('categories'), compact('tags'));
    }

    protected function syncTags($tags)
    {
        $tagNames = json_decode($tags, true);

        // Sync tags with the tags table
        Tags::whereIn('name', $tagNames)->get()->each(function ($tag) use ($tagNames) {
            $key = array_search($tag->name, $tagNames);
            if ($key !== false) {
                unset($tagNames[$key]);
            }
        });

        foreach ($tagNames as $tagName) {
            Tags::create(['name' => $tagName]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'file_path' => 'required|mimes:pdf|max:500', // Adjust file size as needed
        //     'category_id' => 'nullable|exists:categories,id',
        //     'tags' => 'nullable|json',
        // ]);
        // Validate the request and handle file upload
        $title = $request->input('title');

        $path = $request->file('pdf_file')->storeAs('pdf_files', Str::random(10) . '.pdf');
        // Create or find the category
        $category = Category::firstOrCreate(['name' => $request->input('category')]);
        $tags = json_encode($request->input('tags'));

        // Create a new document record
        // dd($request);
        Document::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'file_path' => $path,
            'category_id' => $category->id,
            'tags' => $tags, // Assumes 'tags' is an array,
        ]);
        $this->syncTags($tags);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('document.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        return view('document.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
