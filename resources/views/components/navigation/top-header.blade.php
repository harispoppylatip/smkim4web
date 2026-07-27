<header class="sticky top-0 z-20 bg-white/95 backdrop-blur-sm border-b border-[#e2e2e5]">
    <div class="flex items-center justify-between h-16 px-4 md:px-6">
        {{-- Left: Mobile menu toggle + Page title --}}
        <div class="flex items-center gap-3">
            {{-- Mobile hamburger --}}
            <button type="button" id="mobile-menu-toggle"
                class="lg:hidden p-2 -ml-2 rounded-lg text-[#43474f] hover:bg-[#f3f3f6] transition-colors"
                aria-label="Toggle menu">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            {{-- Page Title --}}
            <h1 class="text-lg font-semibold text-[#1a1c1e] font-heading">@yield('page_title', 'Dashboard')</h1>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-2">
            {{-- Notification --}}
            <button class="relative p-2 rounded-lg text-[#43474f] hover:bg-[#f3f3f6] transition-colors"
                aria-label="Notifications">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#ba1a1a] rounded-full"></span>
            </button>

            {{-- User dropdown --}}
            <div class="relative" id="user-dropdown">
                <button id="user-dropdown-button"
                    class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-[#f3f3f6] transition-colors">
                    <div
                        class="w-7 h-7 rounded-full bg-[#003366] flex items-center justify-center text-white text-xs font-semibold">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <span
                        class="hidden md:block text-sm font-medium text-[#1a1c1e]">{{ auth()->user()->name ?? 'User' }}</span>
                    <svg class="hidden md:block w-4 h-4 text-[#737780]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div id="user-dropdown-menu"
                    class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-[#e2e2e5] overflow-hidden z-50">
                    {{-- User Info --}}
                    <div class="px-4 py-3 border-b border-[#e2e2e5]">
                        <p class="text-sm font-semibold text-[#1a1c1e]">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-xs text-[#737780] truncate">{{ auth()->user()->email ?? '' }}</p>
                    </div>

                    {{-- Menu Items --}}
                    <div class="py-1">
                        <a href="{{ route('admin.profile.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#43474f] hover:bg-[#f3f3f6] transition-colors">
                            <span class="material-symbols-outlined text-base">manage_accounts</span>
                            <span>Profil Admin</span>
                        </a>
                    </div>

                    {{-- Logout --}}
                    <div class="border-t border-[#e2e2e5] py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-[#ba1a1a] hover:bg-[#fff1f1] transition-colors">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
