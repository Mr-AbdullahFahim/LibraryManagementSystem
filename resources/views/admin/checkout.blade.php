<x-app-layout>
    <div class="flex h-screen">
        @include('admin.partials.sidebar')
        <div class="flex-1 p-8 overflow-y-auto bg-white scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-900">Checkouts</h2>
                <div class="flex items-center space-x-2 hover:text-gray-600 cursor-pointer" onclick="toggleModal()">
                    <i class="fa-solid fa-person-walking-luggage fa-lg"></i>
                    <span>Add Checkout</span>
                </div>
            </div>
            <div class="mt-12">
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md mt-6">
                    <table class="min-w-full table-auto rounded-md overflow-hidden border border-gray-300">
                        <thead>
                            <tr class="bg-gray-300 font-extrabold">
                                <th class="px-6 py-3 text-center text-gray-800">Mem_ID</th>
                                <th class="px-6 py-3 text-center text-gray-800">Name</th>
                                <th class="px-6 py-3 text-center text-gray-800">ISBN</th>
                                <th class="px-6 py-3 text-center text-gray-800">Book_Title</th>
                                <th class="px-6 py-3 text-center text-gray-800">checkout_Date</th>
                                <th class="px-6 py-3 text-center text-gray-800">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkouts as $checkout)
                                <tr class="bg-gray-200 border-b border-gray-400 transition duration-200 font-medium">
                                    <td class="px-6 py-4 text-center">{{ $checkout->memberid }}</td>
                                    <td class="px-6 py-4 text-center">{{ $checkout->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $checkout->isbn }}</td>
                                    <td class="px-6 py-4 capitalize text-center">{{ $checkout->booktitle }}</td>
                                    <td class="px-6 py-4 capitalize text-center">{{ $checkout->created_at }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('checkout.returned') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <!-- Passing both memberid and isbn to identify the specific checkout record -->
                                            <input type="hidden" name="memberid" value="{{ $checkout->memberid }}">
                                            <input type="hidden" name="isbn" value="{{ $checkout->isbn }}">
                                            <button 
                                                type="submit" 
                                                class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out hover:bg-blue-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                                Returned
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-addcheckout></x-addcheckout>
</x-app-layout>