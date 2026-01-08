@php
    $isActive = fn($route) => request()->routeIs($route) ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
    $iconClass = fn($route) => request()->routeIs($route) ? 'text-red-600' : 'text-gray-400';
    $user = auth()->user();
@endphp

<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider">My Account</div>
            <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ $isActive('dashboard') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ $iconClass('dashboard') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Overview
                    </a>
                </li>
                 <li>
                    <a href="{{ route('orders.index') }}" class="{{ $isActive('orders.*') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ $iconClass('orders.*') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        My Orders
                    </a>
                </li>
                 <li>
                    <a href="{{ route('profile.edit') }}" class="{{ $isActive('profile.*') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ $iconClass('profile.*') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile Settings
                    </a>
                </li>
            </ul>
        </li>

        @if($user && ($user->hasRole('publisher') || $user->hasRole('admin')))
            <li>
                <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider">Publisher Studio</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                    <li>
                        <a href="{{ route('publisher.dashboard') }}" class="{{ $isActive('publisher.dashboard') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ $iconClass('publisher.dashboard') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('publisher.books.index') }}" class="{{ $isActive('publisher.books.*') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ $iconClass('publisher.books.*') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            My Books
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if($user && $user->hasRole('admin'))
            <li>
                <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider">Admin Panel</div>
                <ul role="list" class="-mx-2 mt-2 space-y-1">
                     <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ $isActive('admin.dashboard') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ $iconClass('admin.dashboard') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="{{ $isActive('admin.orders.*') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ $iconClass('admin.orders.*') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Manage Orders
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('admin.users.index') }}" class="{{ $isActive('admin.users.*') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ $iconClass('admin.users.*') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manage Users
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('admin.books.index') }}" class="{{ $isActive('admin.books.*') }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                            <svg class="{{ $iconClass('admin.books.*') }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Manage Books
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</nav>
