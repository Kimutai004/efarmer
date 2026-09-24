@php
    $adminLinks = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'fa-chart-line', 'active' => request()->routeIs('admin.dashboard')],
        ['label' => 'Goats', 'route' => 'admin.goats.index', 'icon' => 'fa-cow', 'active' => request()->routeIs('admin.goats.*')],
        ['label' => 'Breeds', 'route' => 'admin.breeds.index', 'icon' => 'fa-dna', 'active' => request()->routeIs('admin.breeds.*')],
        ['label' => 'Customers', 'route' => 'admin.customers.index', 'icon' => 'fa-users', 'active' => request()->routeIs('admin.customers.*')],
        ['label' => 'Payments', 'route' => 'admin.payments.index', 'icon' => 'fa-credit-card', 'active' => request()->routeIs('admin.payments.*')],
        ['label' => 'Sales', 'route' => 'admin.sales.index', 'icon' => 'fa-cart-shopping', 'active' => request()->routeIs('admin.sales.*')],
        ['label' => 'Expenses', 'route' => 'admin.expenses.index', 'icon' => 'fa-money-bill-wave', 'active' => request()->routeIs('admin.expenses.*')],
        ['label' => 'Reports', 'route' => 'admin.reports.index', 'icon' => 'fa-file-lines', 'active' => request()->routeIs('admin.reports.*')],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | Efarmer Admin</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        efarmer: {
                            50: '#f2faf3', 100: '#e0f4e4', 200: '#c2e9ca',
                            300: '#96d8a4', 400: '#63c078', 500: '#3aa55a',
                            600: '#2c8748', 700: '#246c3b', 800: '#1f5631',
                            900: '#1a4629', 950: '#0d2716',
                        },
                        clay: {
                            50: '#fdf7f1', 100: '#faecdd', 200: '#f3d6b6',
                            300: '#e9b987', 400: '#de9a56', 500: '#d27c37',
                            600: '#b96426', 700: '#964d1f', 800: '#793f1e',
                            900: '#63351c', 950: '#361a0c',
                        },
                        green: {
                            50: '#f2faf3', 100: '#e0f4e4', 200: '#c2e9ca',
                            300: '#96d8a4', 400: '#63c078', 500: '#3aa55a',
                            600: '#2c8748', 700: '#246c3b', 800: '#1f5631',
                            900: '#1a4629', 950: '#0d2716',
                        },
                    },
                    boxShadow: {
                        soft: '0 18px 45px -24px rgba(13, 39, 22, .30)',
                        card: '0 26px 60px -28px rgba(13, 39, 22, .45)',
                    },
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
        ::selection { background: #c2e9ca; color: #1a4629; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .85rem;
            margin: 0 .75rem;
            padding: .7rem .9rem;
            border-radius: .9rem;
            font-size: .9rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .65);
            transition: all .2s ease;
        }
        .sidebar-link:hover { background: rgba(255, 255, 255, .08); color: #fff; }
        .sidebar-link.active {
            background: #d27c37;
            color: #fff;
            box-shadow: 0 12px 24px -14px rgba(210, 124, 55, .9);
        }

        /* Modern defaults for admin forms */
        .admin-panel input[type="text"],
        .admin-panel input[type="email"],
        .admin-panel input[type="tel"],
        .admin-panel input[type="number"],
        .admin-panel input[type="date"],
        .admin-panel input[type="password"],
        .admin-panel input[type="search"],
        .admin-panel select,
        .admin-panel textarea {
            background: #fff;
            border: 1px solid #dceee1;
            border-radius: .8rem;
            padding: .7rem 1rem;
            width: 100%;
            font-size: .9rem;
            color: #374151;
            transition: border-color .2s ease, box-shadow .2s ease;
        }
        .admin-panel input:focus,
        .admin-panel select:focus,
        .admin-panel textarea:focus {
            outline: none;
            border-color: #63c078;
            box-shadow: 0 0 0 4px rgba(99, 192, 120, .25);
        }

        .admin-panel label { font-size: .85rem; font-weight: 600; color: #1f5631; }

        /* Table polish */
        .admin-panel table thead th {
            background: #f2faf3;
            color: #246c3b;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 700;
        }
        .admin-panel table tbody tr { transition: background .15s ease; }
        .admin-panel table tbody tr:hover { background: #f5fbf7; }

        /* Pagination */
        .admin-panel nav[role="navigation"] p { font-size: .8rem; color: #9ca3af; }
    </style>

    @stack('styles')
</head>

<body class="bg-[#eef6f1] text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- MOBILE SIDEBAR -->

        <div id="mobileSidebar" class="fixed inset-0 z-50 hidden md:hidden" aria-hidden="true">

            <button type="button" class="absolute inset-0 w-full h-full bg-black/50" aria-label="Close navigation" onclick="document.getElementById('mobileSidebar').classList.add('hidden')"></button>

            <aside class="relative z-10 w-72 h-full bg-efarmer-950 text-white flex flex-col shadow-card">

                <div class="px-5 pt-6 pb-5 border-b border-white/10 flex items-start justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex bg-white rounded-2xl px-3 py-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Efarmer" class="h-10 w-auto object-contain">
                    </a>

                    <button type="button" class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center hover:bg-white/20" aria-label="Close navigation" onclick="document.getElementById('mobileSidebar').classList.add('hidden')">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto py-4 space-y-1">
                    <div class="px-6 mb-2 text-[11px] uppercase tracking-wider text-white/40 font-bold">Manage</div>

                    @foreach($adminLinks as $link)
                        <a href="{{ route($link['route']) }}" class="sidebar-link {{ $link['active'] ? 'active' : '' }}">
                            <i class="fa-solid {{ $link['icon'] }} w-5 text-center"></i>
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="p-5 border-t border-white/10 grid grid-cols-2 gap-3">
                    <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 rounded-xl bg-white/10 py-2.5 text-sm font-bold hover:bg-white/20 transition">
                        <i class="fa-solid fa-store"></i> Site
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-clay-500 py-2.5 text-sm font-bold hover:bg-clay-600 transition">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>

            </aside>

        </div>

        <!-- DESKTOP SIDEBAR -->

        <aside class="w-72 bg-efarmer-950 text-white flex-shrink-0 hidden md:flex flex-col">

            <div class="px-5 pt-6 pb-5 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex bg-white rounded-2xl px-3 py-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Efarmer" class="h-11 w-auto object-contain">
                </a>
                <p class="text-[11px] uppercase tracking-wider text-white/40 font-bold mt-3 px-1">Admin console</p>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 space-y-1">
                <div class="px-6 mb-2 text-[11px] uppercase tracking-wider text-white/40 font-bold">Manage</div>

                @foreach($adminLinks as $link)
                    <a href="{{ route($link['route']) }}" class="sidebar-link {{ $link['active'] ? 'active' : '' }}">
                        <i class="fa-solid {{ $link['icon'] }} w-5 text-center"></i>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-5 border-t border-white/10">
                <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-2xl bg-white/5 hover:bg-white/10 transition px-4 py-3.5">
                    <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-clay-300">
                        <i class="fa-solid fa-store"></i>
                    </span>
                    <span>
                        <span class="block text-sm font-bold">View store</span>
                        <span class="block text-xs text-white/40">Back to the site</span>
                    </span>
                </a>
            </div>

        </aside>
        <!-- MAIN COLUMN -->

        <div class="admin-panel flex-1 flex flex-col overflow-hidden">

            <!-- TOP BAR -->

            <header class="bg-white/90 backdrop-blur border-b border-efarmer-100 h-[72px] flex items-center justify-between px-5 lg:px-8 flex-shrink-0">

                <div class="flex items-center gap-4">

                    <button type="button" class="md:hidden w-10 h-10 rounded-xl border border-efarmer-100 text-efarmer-800 flex items-center justify-center" aria-label="Open navigation" onclick="document.getElementById('mobileSidebar').classList.remove('hidden')">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div>
                        <h1 class="font-display text-lg font-extrabold text-efarmer-900 leading-tight">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-gray-400 hidden sm:block">{{ now()->format('l, F d, Y') }}</p>
                    </div>

                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('goats.index') }}" class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-efarmer-100 px-4 py-2.5 text-sm font-bold text-efarmer-700 hover:bg-efarmer-50 transition">
                        <i class="fa-solid fa-store"></i>
                        Store
                    </a>

                    <span class="hidden lg:flex items-center gap-2.5 rounded-xl bg-efarmer-50 pl-1.5 pr-4 py-1.5">
                        <span class="w-8 h-8 rounded-lg bg-efarmer-600 text-white flex items-center justify-center font-extrabold text-sm">
                            {{ Str::substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </span>
                        <span class="text-sm font-bold text-efarmer-900">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-red-50 border border-red-100 px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-100 transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>

                </div>

            </header>

            <!-- PAGE CONTENT -->

            <main class="flex-1 overflow-y-auto p-5 lg:p-8">

                @if(session('success'))
                    <div class="mb-6 rounded-2xl border border-efarmer-200 bg-white px-5 py-4 flex items-start gap-3 text-efarmer-800 shadow-sm">
                        <i class="fa-solid fa-circle-check text-efarmer-500 mt-0.5"></i>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 flex items-start gap-3 text-red-700">
                        <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                        <p class="text-sm font-semibold">{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

    @stack('scripts')

</body>
</html>

