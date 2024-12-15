<x-app-layout>
    <div class="flex h-screen">
        @include('admin.partials.sidebar')
        <div class="flex-1 p-8 overflow-y-auto bg-white scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-900">Members</h2>
                <div class="flex items-center space-x-2 hover:text-gray-600 cursor-pointer" onclick="toggleModal()">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Add Member</span>
                </div>
            </div>
            <div class="mt-12">
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md mt-6">
                    <table class="min-w-full table-auto rounded-md overflow-hidden border border-gray-300">
                        <thead>
                            <tr class="bg-gray-300 font-extrabold">
                                <th class="px-6 py-3 text-center text-gray-800">Mem_ID</th>
                                <th class="px-6 py-3 text-center text-gray-800">Name</th>
                                <th class="px-6 py-3 text-center text-gray-800">Email</th>
                                <th class="px-6 py-3 text-center text-gray-800">Phone</th>
                                <th class="px-6 py-3 text-center text-gray-800">Address</th>
                                <th class="px-6 py-3 text-center text-gray-800">Mem_status</th>
                                <th class="px-6 py-3 text-center text-gray-800">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                                <tr class="bg-gray-200 border-b border-gray-400 transition duration-200 font-medium">
                                    <td class="px-6 py-4">{{ $member->id }}</td>
                                    <td class="px-6 py-4">{{ $member->name }}</td>
                                    <td class="px-6 py-4">{{ $member->email }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $member->phone }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $member->address }}</td>
                                    @if($member->membership_deadline > now())
                                        <td class="px-6 py-4 capitalize text-center">Active</td>
                                    @else
                                        <td class="px-6 py-4 capitalize text-center">Inactive</td>
                                    @endif
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-4">
                                            <div class="grid place-items-center text-gray-800 cursor-pointer hover:text-gray-600" onclick="openEditForm({{ $member->id }})">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                <div>Edit</div>
                                            </div>
                                            <div class="grid place-items-center text-gray-800 cursor-pointer hover:text-gray-600" onclick="deleteMember({{ $member->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <div>Delete</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <x-addmember></x-addmember>

    <!-- Edit Member Modal -->
    <div id="editMemberModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-700">Edit Member</h3>
                <button class="text-black hover:text-gray-500" onclick="closeEditModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
            </div>

            <!-- Edit Form -->
            <form method="POST" id="editForm">
                @csrf
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="editName" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="editEmail" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editPhone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" id="editPhone" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editAddress" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="editAddress" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 mr-2" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editMemberModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editMemberModal').classList.add('hidden');
        }

        function openEditForm(memberId) {
            openEditModal();

            fetch(`/members/${memberId}/edit`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch member data');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('editName').value = data.name;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editPhone').value = data.phone;
                document.getElementById('editAddress').value = data.address;

                const form = document.getElementById('editForm');
                form.action = `/members/${memberId}/update`;
            })
            .catch(error => {
                console.error('Error:', error);
                closeEditModal();
            });
        }
        function deleteMember(memberId) {
            if (confirm("Are you sure you want to delete this member?")) {
                // Send an AJAX DELETE request
                fetch(`/members/${memberId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);  // Show success message
                    location.reload();    // Reload the page to reflect changes
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</x-app-layout>
