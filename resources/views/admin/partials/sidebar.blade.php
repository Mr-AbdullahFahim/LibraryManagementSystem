<div class="sidebar bg-gray-100 text-gray-800 p-6 w-64 h-full flex flex-col space-y-6">
    <a href="{{ route('dashboard') }}" class="grid grid-cols-3 items-center justify-center hover:scale-105 transition duration-200 ease-in-out">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        <div class="col-span-2 text-violet-950 text-lg font-semibold">Librarian</div>
    </a>
    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('dashboard') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('members') }}" class="flex items-center space-x-3 text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('members') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
        <i class="fa-solid fa-users"></i>
        <span>Members</span>
    </a>

    <a href="{{ route('subscription') }}" class="flex items-center space-x-3 text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('subscriptions') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
        <i class="fas fa-credit-card"></i>
        <span>Subscriptions</span>
    </a>

    <a href="{{ route('books') }}" class="flex items-center space-x-3 text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('books') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
        <i class="fa-solid fa-book"></i>
        <span>Books</span>
    </a>

    <a href="{{ route('checkout') }}" class="flex items-center space-x-3 text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('checkout') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
        <i class="fa-solid fa-person-walking-luggage fa-lg"></i>
        <span>Checkout</span>
    </a>

    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('profile') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
        <i class="fa-solid fa-gear fa-lg"></i>
        <span>Settings</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" class="flex items-center text-gray-800 hover:text-gray-600 transition duration-150 ease-in-out {{ Request::is('logout') ? 'bg-gray-300 rounded-lg p-2 -mx-2' : '' }}">
    @csrf
        <button type="submit" class="flex items-center space-x-3">
            <i class="fa-solid fa-right-from-bracket fa-lg"></i>
            <span>Logout</span>
        </button>
    </form>

</div>
