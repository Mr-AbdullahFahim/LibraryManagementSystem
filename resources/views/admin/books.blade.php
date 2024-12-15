<x-app-layout>
    <div class="flex h-screen">
        @include('admin.partials.sidebar')
        <div class="flex-1 p-8 overflow-y-auto bg-white scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-900">Books</h2>
                <div class="flex items-center space-x-2 hover:text-gray-600 cursor-pointer" onclick="toggleModal()">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Book</span>
                </div>
            </div>
            <div class="container mx-auto p-6 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($books as $book)
                    <x-bookcard :book="$book"></x-bookcard>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Add Book Modal (optional) -->
    <x-addbook></x-addbook>

    <!-- Edit Book Modal -->
    <div id="editBookModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-700">Edit Book</h3>
                <button class="text-black hover:text-gray-500" onclick="toggleEditModal()">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>

            <!-- Edit Form -->
            <form method="POST" id="editForm">
                @csrf
                <div class="mb-4">
                    <label for="editTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="editTitle" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editAuthor" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" id="editAuthor" name="author" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editPublishYear" class="block text-sm font-medium text-gray-700">Published Year</label>
                    <input type="text" id="editPublishYear" name="publish_year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editIsbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" id="editIsbn" name="isbn" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editCount" class="block text-sm font-medium text-gray-700">No. of Books Available</label>
                    <input type="number" id="editCount" name="count" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 mr-2" onclick="toggleEditModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleEditModal() {
            const modal = document.getElementById('editBookModal');
            modal.classList.toggle('hidden');
        }

        function openEditForm(bookId) {
            toggleEditModal();

            fetch(`/books/${bookId}/edit`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch book data');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('editTitle').value = data.title;
                document.getElementById('editAuthor').value = data.author;
                document.getElementById('editPublishYear').value = data.published_year;
                document.getElementById('editIsbn').value = data.isbn;
                document.getElementById('editCount').value = data.count;

                const form = document.getElementById('editForm');
                form.action = `/books/${bookId}/update`;
            })
            .catch(error => {
                console.error('Error:', error);
                toggleEditModal();
            });
        }
    </script>
</x-app-layout>
