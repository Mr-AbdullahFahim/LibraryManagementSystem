<div id="addbookModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-700">Add Book</h3>
            <button class="text-black hover:text-gray-500" onclick="toggleModal()">
                <i class="fa-solid fa-xmark fa-lg"></i>
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input 
                    type="text" 
                    id="title"
                    name="title"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Enter book's title" required>
            </div>

            <!-- Author Field -->
            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                <input 
                    type="text" 
                    id="author"
                    name="author"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Enter author of the book" required>
            </div>

            <!-- Genre Field -->
            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                <input 
                    type="text" 
                    id="genre"
                    name="genre"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Enter genre of the book" required>
            </div>

            <!-- Publish Year Field -->
            <div class="mb-4">
                <label for="publish_year" class="block text-sm font-medium text-gray-700">Publish Year</label>
                <select name="publish_year" id="publish_year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="" disabled selected>Select year</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                <input 
                    type="text" 
                    id="isbn"
                    name="isbn"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Enter the ISBN" required>
            </div>

            <div class="mb-4">
                <label for="count" class="block text-sm font-medium text-gray-700">Count</label>
                <input 
                    type="number" 
                    id="count"
                    name="count"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    placeholder="Enter count of the book available" required>
            </div>

            <div class="mb-4">
                <label for="coverpic" class="block text-sm font-medium text-gray-700">Cover pic of the book</label>
                <input 
                    type="file" 
                    id="coverpic"
                    name="coverpic"
                    accept="image/*" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                    required>
            </div>
            <!-- Action Buttons -->
            <div class="flex justify-end">
                <button 
                    type="button" 
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 mr-2"
                    onclick="toggleModal()">
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Add Book
                </button>
            </div>
        </form>
    </div>
    <script>
        function toggleModal() {
            const modal = document.getElementById('addbookModal');
            modal.classList.toggle('hidden');
        }

        const yearDropdown = document.getElementById('publish_year');
        const currentYear = new Date().getFullYear();
        const startYear = 1700;

        for (let year = currentYear; year >= startYear; year--) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearDropdown.appendChild(option);
        }
    </script>
</div>