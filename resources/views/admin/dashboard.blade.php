<x-app-layout>
<div class="flex h-screen">
    @include('admin.partials.sidebar')
    <div class="flex-1 p-8 overflow-y-auto bg-white scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
        <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
            <!-- Total Users -->
            <div class="bg-gray-100 p-6 rounded-xl shadow-md transition-transform duration-200 transform hover:scale-105 grid grid-cols-3">
                <div class="bg-blue-900 rounded-full w-14 h-14 text-white flex items-center justify-center">
                    <i class="fa-solid fa-person-walking-luggage fa-lg"></i>
                </div>
                <div class="col-span-2">
                    <h3 class="text-sm font-semibold text-gray-600">Borrowed</h3>
                    <p class="text-2xl font-extrabold text-gray-800 mt-2">{{$checkoutcount}}</p>
                </div>
            </div>
            <!-- Approved Users -->
            <div class="bg-gray-100 p-6 rounded-xl shadow-md transition-transform transform duration-200 hover:scale-105 grid grid-cols-3">
                <div class="bg-blue-900 rounded-full w-14 h-14 text-white flex items-center justify-center">
                    <i class="fas fa-calendar-times fa-lg"></i>
                </div>
                <div class="col-span-2">
                    <h3 class="text-sm font-semibold text-gray-600">Overdue</h3>
                    <p class="text-2xl font-extrabold text-gray-800 mt-2">{{$overdueCount}}</p>
                </div>
            </div>
            <!-- Pending Requests -->
            <div class="bg-gray-100 p-6 rounded-xl shadow-md transition-transform transform duration-200 hover:scale-105 grid grid-cols-3">
                <div class="bg-blue-900 rounded-full w-14 h-14 text-white flex items-center justify-center">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="col-span-2">
                    <h3 class="text-sm font-semibold text-gray-600">Subscriptions</h3>
                    <p class="text-2xl font-extrabold text-gray-800 mt-2">{{$subscriptionCount}}</p>
                </div>
            </div>
            <!-- Denied Requests -->
            <div class="bg-gray-100 p-6 rounded-xl shadow-md transition-transform transform duration-200 hover:scale-105 grid grid-cols-3">
                <div class="bg-blue-900 rounded-full w-14 h-14 text-white flex items-center justify-center">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="col-span-2">
                    <h3 class="text-sm font-semibold text-gray-600">New members</h3>
                    <p class="text-2xl font-extrabold text-gray-800 mt-2">{{$newMembersCount}}</p>
                </div>
            </div>
        </div>

        <!-- Pending Requests Table -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900">Overdue Checkouts</h2>
            <div class="bg-gray-100 p-6 rounded-2xl shadow-md mt-6">
                <table class="min-w-full table-auto rounded-md overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left font-semibold text-gray-800">MemberID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-800">Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-800">ISBN</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-800">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($overdue as $x)
                            <tr class="bg-gray-300 border-b border-gray-400 hover:bg-gray-400 cursor-pointer transition duration-200">
                                <td class="px-6 py-4">{{$x->memberid}}</td>
                                <td class="px-6 py-4">{{$x->name}}</td>
                                <td class="px-6 py-4">{{$x->isbn}}</td>
                                <td class="px-6 py-4 capitalize">{{$x->booktitle}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
