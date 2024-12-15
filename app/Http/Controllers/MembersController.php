<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;

class MembersController extends Controller
{
    public function index()
    {
        $members = Members::orderBy('created_at', 'desc')->get();
        return view('admin.members', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email',
            'phone' => 'required|string|max:20|unique:members,phone',
            'address' => 'required|string',
        ]);

        Members::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'membership_deadline' => now()->addMonth(),
        ]);

        return redirect()->back()->with('success', 'New member registered successfully.');
    }

    public function editMember($id)
    {
        $member = Members::findOrFail($id);
        return response()->json($member);
    }

    public function updateMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id,
            'phone' => 'required|string|unique:members,phone,' . $id,
            'address' => 'required|string',
        ]);

        $member = Members::findOrFail($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->save();

        if ($request->ajax()) {
            return response()->json(['message' => 'Member updated successfully!']);
        }
        return redirect()->back()->with('success', 'Member updated successfully!');
    }
    public function destroy($id)
    {
        $member = Members::findOrFail($id);
        $member->delete();

        return response()->json(['message' => 'Member deleted successfully!']);
    }
}
