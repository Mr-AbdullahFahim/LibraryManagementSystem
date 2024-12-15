<x-app-layout>
    <div class="flex h-screen">
        @include('admin.partials.sidebar')
        <div class="flex-1 p-8 overflow-y-auto bg-white scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-900">Membership Subscriptions</h2>
                <div class="flex items-center space-x-2 hover:text-gray-600 cursor-pointer" onclick="toggleModal()">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span>Add a subscription</span>
                </div>
            </div>
            <div class="mt-12">
                <div class="bg-gray-100 p-6 rounded-2xl shadow-md mt-6">
                    <table class="min-w-full table-auto rounded-md overflow-hidden">
                        <thead>
                            <tr class="bg-gray-300 font-extrabold">
                                <th class="px-6 py-3 text-center text-gray-800">Mem_ID</th>
                                <th class="px-6 py-3 text-center text-gray-800">Name</th>
                                <th class="px-6 py-3 text-center text-gray-800">Email</th>
                                <th class="px-6 py-3 text-center text-gray-800">Membership_Deadline</th>
                                <th class="px-6 py-3 text-center text-gray-800">Mem_status</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($members as $member)
                                @if($member->membership_deadline > now())
                                    <tr class="bg-gray-200 border-b border-gray-400 transition duration-200 font-medium">
                                        <td class="px-6 py-4 text-center">{{$member->id}}</td>
                                        <td class="px-6 py-4 text-center capitalize">{{$member->name}}</td>
                                        <td class="px-6 py-4 text-center">{{$member->email}}</td>
                                        <td class="px-6 py-4 text-center">{{$member->membership_deadline}}</td>
                                        <td class="px-6 py-4 capitalize text-center">Active</td>
                                    </tr>
                                @endif
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-addsubscription></x-addsubscription>
</x-app-layout>