<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Members;
use App\Models\Books;

class CheckoutController extends Controller
{
    public function index(){
        $checkouts = Checkout::orderBy('created_at', 'desc')->get();
        return view('admin.checkout', compact('checkouts'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'memberid' => 'required|integer',
            'isbn' => 'required|string|max:13',
        ]);

        // Fetch the book using ISBN
        $book = Books::where('isbn', $request->isbn)->first();

        // Check if the book exists and has stock available
        if ($book && $book->count > 0) {
            // Fetch member's name from the Members table
            $membername = Members::where('id', $request->memberid)->firstOrFail()->name;

            // Create a new checkout record
            Checkout::create([
                'memberid' => $request->input('memberid'),
                'name' => $membername,
                'isbn' => $request->input('isbn'),
                'booktitle' => $book->title,
            ]);

            // Decrease the stock count by 1
            $book->count = $book->count - 1;
            $book->save();

            return redirect()->back()->with('success', 'Book checked out successfully.');
        } else {
            // If no stock is available
            return redirect()->back()->with('fail', 'There is no stock available for this book.');
        }
    }
    
    public function returned(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'memberid' => 'required|integer',
            'isbn' => 'required|string|max:13',
        ]);

        // Find the checkout record using both memberid and isbn
        $checkout = Checkout::where('memberid', $request->memberid)
                            ->where('isbn', $request->isbn)
                            ->first();

        if ($checkout) {
            // Find the book by ISBN
            $book = Books::where('isbn', $request->isbn)->first();

            if ($book) {
                // Increase the stock count of the book
                $book->count = $book->count + 1;
                $book->save();

                // Delete the checkout record
                $checkout->delete();

                return redirect()->back()->with('success', 'Book returned and stock updated successfully.');
            }

            return redirect()->back()->with('fail', 'Book not found.');
        }

        return redirect()->back()->with('fail', 'Checkout record not found for this member and book.');
    }
}
