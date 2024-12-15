<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index(){
        $members=Members::all();
        return view('admin.subscriptions',compact('members'));
    }
    public function update(Request $request){
        $request->validate([
            'memberid' => 'required|integer|exists:members,id', 
        ]);
    
        $member = Members::findOrFail($request->memberid);
    
        if ($member->membership_deadline>now()) {
            $member->membership_deadline = Carbon::parse($member->membership_deadline)->addMonth();
        } else {
            $member->membership_deadline = now()->addMonth();
        }
    
        // Save the changes
        $member->save();
        return redirect()->back()->with('success', 'Subscription updated successfully!');
    }
}
