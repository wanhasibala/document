<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Metadata;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('document.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();
        $categories = Category::all();
        return view('document.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request and handle file upload
        $path = $request->file('pdf_file')->store('pdf_files');

        // Create or find the category
        $category = Category::firstOrCreate(['name' => $request->input('tags')]);

        // Create a new document record
        // dd(json_decode($request->input('tags')));
        Document::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'file_path' => $path,
            'category_id' => $category->id,
            'tags' => json_decode($request->input('tags')),
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
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
