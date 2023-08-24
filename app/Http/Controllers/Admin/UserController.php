<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('Admin.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required",
            'email' => "required|unique:users,email,$id",
        ], [], [
            'name.required' => "الاسم مطلوب",
            "email.required" => "البريد الالكتروني مطلوب",
            "email.unique" => "البريد الالكتروني موجود مسبقا",
        ]);
        $user = User::findOrFail($id);
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
        ]);
        return redirect()->back()->with('succes', 'تم تحديث بيانات المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('succes', 'تم حذف المستخدم بنجاح');
    }
}