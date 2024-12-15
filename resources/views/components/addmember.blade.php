<div id="addMemberModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-700">Add Member</h3>
                <button class="text-black hover:text-gray-500" onclick="toggleModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{route('members.store')}}">
                @csrf
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input 
                        type="text" 
                        id="name"
                        name="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                        placeholder="Enter member's name" required>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                        placeholder="Enter member's email" required>
                </div>

                <!-- Phone Field -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input 
                        type="text" 
                        id="phone"
                        name="phone"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                        placeholder="Enter member's phone" required>
                </div>

                <!-- Address Field -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea 
                        id="address" 
                        rows="3"
                        name="address"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        placeholder="Enter member's address" required></textarea>
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
                        Add Member
                    </button>
                </div>
            </form>
        </div>
        <script>
            function toggleModal() {
                const modal = document.getElementById('addMemberModal');
                modal.classList.toggle('hidden');
            }
        </script>
    </div>