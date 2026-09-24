@php
    /* Primary navigation – single source of truth for desktop + mobile */
    $navLinks = [
        ['label' => 'Home', 'route' => 'home', 'icon' => 'fa-house', 'active' => request()->routeIs('home')],
        ['label' => 'Goats for Sale', 'route' => 'goats.index', 'icon' => 'fa-cow', 'active' => request()->routeIs('goats.*')],
        ['label' => 'How It Works', 'route' => 'how-it-works', 'icon' => 'fa-circle-question', 'active' => request()->routeIs('how-it-works')],
        ['label' => 'Blog', 'route' => 'blog.index', 'icon' => 'fa-newspaper', 'active' => request()->routeIs('blog.*')],
        ['label' => 'Contact', 'route' => 'contact', 'icon' => 'fa-headset', 'active' => request()->routeIs('contact')],
    ];

    $isAuth = auth()->check();
@endphp

<!-- ========================================================= -->
<!-- UTILITY BAR -->
<!-- ========================================================= -->

<div class="hidden md:block bg-efarmer-950 text-white/80 text-[13px]">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="h-10 flex items-center justify-between">

            <div class="flex items-center gap-6">

                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-clay-400"></i>
                    Delivering across Kenya
                </span>

                <a href="tel:+254712345678" class="flex items-center gap-2 hover:text-white transition">
                    <i class="fa-solid fa-phone text-clay-400"></i>
                    +254 712 345 678
                </a>

                <a href="mailto:info@e-farmer.co.ke" class="flex items-center gap-2 hover:text-white transition">
                    <i class="fa-solid fa-envelope text-clay-400"></i>
                    info@e-farmer.co.ke
                </a>

            </div>

            <div class="flex items-center gap-4">

                <span class="text-white/50">Follow</span>

                <a href="#" aria-label="Facebook" class="hover:text-clay-400 transition"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="X" class="hover:text-clay-400 transition"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" aria-label="Instagram" class="hover:text-clay-400 transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="WhatsApp" class="hover:text-clay-400 transition"><i class="fa-brands fa-whatsapp"></i></a>

            </div>

        </div>

    </div>

</div>

<!-- ========================================================= -->
<!-- NAVIGATION -->
<!-- ========================================================= -->

<header
    id="siteHeader"
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-efarmer-100 transition-shadow duration-300"
>

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="h-[76px] flex items-center justify-between gap-4">

            <!-- LOGO -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0 group">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Efarmer – order your goat online and get it delivered"
                    class="h-12 lg:h-14 w-auto object-contain transition-transform duration-300 group-hover:scale-[1.03]"
                >

            </a>

            <!-- DESKTOP MENU -->

            <nav class="hidden lg:flex items-center gap-1">

                @foreach($navLinks as $link)

                    <a
                        href="{{ route($link['route']) }}"
                        class="px-4 py-2.5 rounded-xl text-[15px] font-semibold transition
                            {{ $link['active']
                                ? 'text-efarmer-800 bg-efarmer-50'
                                : 'text-gray-600 hover:text-efarmer-800 hover:bg-efarmer-50/70' }}"
                    >
                        {{ $link['label'] }}
                    </a>

                @endforeach

            </nav>

            <!-- ACTIONS -->

            <div class="flex items-center gap-2 lg:gap-3">

                <a href="tel:+254712345678" class="hidden xl:flex items-center gap-3 pr-4 border-r border-efarmer-100 group">

                    <span class="w-10 h-10 rounded-xl bg-clay-50 text-clay-600 flex items-center justify-center group-hover:bg-clay-100 transition">
                        <i class="fa-solid fa-phone-volume"></i>
                    </span>

                    <span class="leading-tight">
                        <span class="block text-[11px] uppercase tracking-wider text-gray-400 font-bold">Call us</span>
                        <span class="block text-sm font-bold text-efarmer-900">0712 345 678</span>
                    </span>

                </a>

                @if($isAuth)

                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex btn btn-outline">
                        <i class="fa-solid fa-gauge-high"></i>
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                        @csrf

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}" class="hidden sm:inline-flex btn btn-outline">
                        <i class="fa-solid fa-user"></i>
                        Login
                    </a>

                    <a href="{{ route('goats.index') }}" class="hidden sm:inline-flex btn btn-primary">
                        <i class="fa-solid fa-cow"></i>
                        Browse Goats
                    </a>

                @endif

                <!-- MOBILE BUTTON -->

                <button
                    id="mobileMenuButton"
                    type="button"
                    aria-label="Toggle navigation"
                    aria-expanded="false"
                    class="lg:hidden w-11 h-11 rounded-xl border border-efarmer-100 text-efarmer-800 flex items-center justify-center text-lg hover:bg-efarmer-50 transition"
                >
                    <i class="fa-solid fa-bars"></i>
                </button>

            </div>

        </div>

    </div>

    <!-- ========================================================= -->
    <!-- MOBILE MENU -->
    <!-- ========================================================= -->

    <div id="mobileMenu" class="lg:hidden hidden border-t border-efarmer-100 bg-white">

        <div class="max-w-7xl mx-auto px-5 py-5">

            <nav class="flex flex-col gap-1">

                @foreach($navLinks as $link)

                    <a
                        href="{{ route($link['route']) }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition
                            {{ $link['active'] ? 'bg-efarmer-50 text-efarmer-800' : 'text-gray-600 hover:bg-efarmer-50/70' }}"
                    >
                        <i class="fa-solid {{ $link['icon'] }} w-5 text-efarmer-500"></i>
                        {{ $link['label'] }}
                    </a>

                @endforeach

            </nav>

            <div class="mt-4 pt-4 border-t border-efarmer-100 grid grid-cols-2 gap-3">

                @if($isAuth)

                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-primary w-full">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fa-solid fa-user"></i> Login
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>

                @endif

            </div>

            <div class="mt-4 flex items-center justify-between text-sm text-gray-500">

                <a href="tel:+254712345678" class="flex items-center gap-2 font-semibold text-efarmer-700">
                    <i class="fa-solid fa-phone"></i> +254 712 345 678
                </a>

                <a href="mailto:info@e-farmer.co.ke" class="flex items-center gap-2">
                    <i class="fa-solid fa-envelope"></i> Email
                </a>

            </div>

        </div>

    </div>

</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        var button = document.getElementById('mobileMenuButton');
        var menu = document.getElementById('mobileMenu');
        var header = document.getElementById('siteHeader');

        if (button && menu) {
            button.addEventListener('click', function () {
                var isOpen = ! menu.classList.contains('hidden');

                menu.classList.toggle('hidden', isOpen);
                button.setAttribute('aria-expanded', String(! isOpen));

                button.innerHTML = isOpen
                    ? '<i class="fa-solid fa-bars"></i>'
                    : '<i class="fa-solid fa-xmark"></i>';
            });
        }

        if (header) {
            var applyShadow = function () {
                header.classList.toggle('shadow-soft', window.scrollY > 8);
            };

            applyShadow();
            window.addEventListener('scroll', applyShadow, { passive: true });
        }
    });
</script>
@endpush

