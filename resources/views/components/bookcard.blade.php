<div class="grid grid-cols-3 gap-4 py-4 pl-4 bg-gray-100 rounded-lg shadow-md">
    <!-- Book Cover -->
    <div class="flex justify-center items-center">
        <img src="{{ asset('storage/public/' . $book->cover_image) }}" alt="Book Cover" class="w-36 h-44 object-cover rounded-lg shadow-lg">
    </div>

    <!-- Book Details -->
    <div class="space-y-2 col-span-2">
        <div class="text-lg font-semibold text-gray-800">Title: <span class="font-normal">{{$book->title}}</span></div>
        <div class="text-sm text-gray-600">Author: <span class="font-normal">{{$book->author}}</span></div>
        <div class="text-sm text-gray-600">Published Year: <span class="font-normal">{{$book->published_year}}</span></div>
        <div class="text-sm text-gray-600">ISBN: <span class="font-normal">{{$book->isbn}}</span></div>
        <div class="text-sm text-gray-600">No. of Books Available: <span class="font-normal">{{$book->count}}</span></div>

        <!-- Action Buttons (Edit and Delete) -->
        <div class="flex mr-4 justify-end gap-1 items-center">
            <!-- Edit Button -->
            <button onclick="openEditForm({{ $book->id }})" class="text-blue-800 py-1 px-4 hover:text-blue-600">
                <i class="fa-solid fa-pen-to-square"></i>Edit
            </button>

            <!-- Delete Button -->
            <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>