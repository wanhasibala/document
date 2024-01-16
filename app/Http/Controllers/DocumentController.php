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
        // dd(request('search'));
        $user = Auth::user();
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $search = $request->input('search');
        $filter = $request->input('filter');
        $categories = Category::all();
        // dd($sortOrder);
        // Load the user's documents with relationships (e.g., tags, category) and apply sorting
        $document = $user->documents()
            // ->with('tags', 'category')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($filter, function ($query) use ($filter) {
                $query->where('category_id', $filter);
            })
            ->orderBy($request->input('sort_by', 'created_at'), $request->input('sort_order', 'desc'))
            ->get();
        return view('document.index', compact('document',  'search', 'categories', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $existingTags = Tag::pluck('name')->toArray();
        $userId = Auth::id();
        $categories = Category::all();
        $tags = Tags::all();
        return view('document.create', compact('categories', 'tags') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $title = $request->input('title');
        $path = $request->file('pdf_file')->storeAs('pdf_files', Str::random(10) . '.pdf');
        // Create or find the category
        $category = Category::firstOrCreate(['id' => $request->input('category')]);
        $tags = json_encode($request->tags);
        // Create a new document record
        
        // dd($tags);
        Document::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'file_path' => $path,
            'category_id' => $category,
            'tags_id' => $tags, // Assumes 'tags' is an array,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        $tags = json_decode($document->tags_id);
        return view('document.show', compact('document', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $categories = Category::all();
        $tags = Tags::all();
        return view('document.edit', compact('document', 'categories', 'tags'));
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
        $document->delete();
        return redirect('/document')->with('status', 'Document finally deleted');
    }
    public function trash(Document $document)
    {
        // $document = Auth::user()->documents();
        $trash = $document::onlyTrashed()->get();
        return view('document.trash', compact('trash'));
    }
    public function restore($id)
    {
        $user = Auth::user();
        $document = $user->documents()->onlyTrashed()->findOrFail($id);
        $document->restore();
        return redirect()->route('document.trash')->with('succes', 'succesfully restored');
    }
    public function permanentDelete($id)
    {
        $user = Auth::user();
        $document = $user->documents()->onlyTrashed()->findOrFail($id);
        $document->forceDelete();
        return redirect()->route('document.trash')->with('succes', 'succesfully restored');
    }
    public function getTags(Request $request){
        $tags = [];
        if($search = $request->name){
            $tags = Tags::where('title', 'LIKE', "%$search%")->get();
        }   
        return response()->json($tags); 
        dd($tags);
    }
}
