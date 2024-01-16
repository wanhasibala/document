<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Imports\UserImport;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin');
        $users = User::paginate(5);
        $categories = Category::all();
        $document = Document::first();
        $audits = ModelsAudit::with('user')->get();
        return view('admin.index', compact('users', 'categories', 'audits'));
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }
    public function userexport(){
        return Excel::download(new UserExport, 'user.xlsx');
    }
    public function userimport(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
    
        $file = $request->file('file');
    
        Excel::import(new UserImport, $file);
    
        return redirect()->back()->with('success', 'Data imported successfully.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // 'roles' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            // 'roles' =>$request->input('is_admin'),
        ]);

        // $user->assignRole($request->input('roles'));

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'is_admin' => ['required', 'boolean'],
        ]);

        $user->update([
            'name' => request('name'),
            // 'is_admin' => request('is_admin'),
        ]);

        return redirect()->route('admin.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}
