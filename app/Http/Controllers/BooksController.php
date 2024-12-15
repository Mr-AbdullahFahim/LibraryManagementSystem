<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    public function index(){
        $books = Books::orderBy('created_at', 'desc')->get();
        return view('admin.books', compact('books'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publish_year' => 'required|integer|min:1700|max:' . date('Y'),
            'isbn' => 'required|string|unique:books,isbn|max:13',
            'count' => 'required|integer|min:1',
            'coverpic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
        ]);

        // Handle the file upload
        if ($request->hasFile('coverpic')) {
            $coverPic = $request->file('coverpic');
            $uniqueFileName = uniqid() . '.' . $coverPic->getClientOriginalExtension(); // Create a unique file name
            $coverPic->storeAs('public/covers', $uniqueFileName); // Save the file to 'storage/app/public/covers'
        } else {
            return back()->withErrors(['coverpic' => 'Cover image is required.']);
        }

        // Save the book data to the database
        Books::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'genre' => $request->input('genre'),
            'published_year' => $request->input('publish_year'),
            'isbn' => $request->input('isbn'),
            'count' => $request->input('count'),
            'cover_image' => 'covers/' . $uniqueFileName, // Save the cover image path
        ]);

        return redirect()->route('books')->with('success', 'Book added successfully!');
    }

    public function edit($id)
    {
        // Find the book
        $book = Books::findOrFail($id);
        return response()->json($book); // Send the book data to the frontend
    }

    public function update(Request $request, $id)
    {
        // Validate the fields excluding the cover image
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publish_year' => 'required|integer|min:1700|max:' . date('Y'),
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $id, // Exclude current book's ISBN
            'count' => 'required|integer|min:1',
        ]);

        // Find the book
        $book = Books::findOrFail($id);

        // Update only the fields excluding cover_image
        $book->title=$request->title;
        $book->author=$request->author;
        $book->published_year=$request->publish_year;
        $book->isbn=$request->isbn;
        $book->count=$request->count;
        $book->save();

        return redirect()->route('books')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        // Find the book to delete
        $book = Books::findOrFail($id);

        // Check if the book has a cover image, and delete it if it exists
        if ($book->cover_image && \Storage::exists('public/' . $book->cover_image)) {
            \Storage::delete('public/' . $book->cover_image);  // Delete the image from storage
        }

        // Delete the book from the database
        $book->delete();

        return redirect()->route('books')->with('success', 'Book and its image deleted successfully!');
    }
}