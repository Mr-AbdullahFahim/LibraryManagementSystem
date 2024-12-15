<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Checkout;

class Dashboard extends Controller
{
    public function index(){
        $checkoutcount=Checkout::all()->count();
        $overdue = Checkout::whereDate('created_at', now()->subWeek()->toDateString())->get();
        $overdueCount=$overdue->count();
        $newMembersCount = Members::where('created_at', '>=', now()->subWeek())->count();
        $subscriptionCount = Members::where('membership_deadline', '>=', now()->toDateString())->count();
        return view('admin.dashboard',compact(['checkoutcount','overdue','overdueCount','newMembersCount','subscriptionCount']));
    }
}
