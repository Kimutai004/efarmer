<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') | Efarmer</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: {
                        efarmer: {
                            50: '#f1f9f1', 100: '#dff0df', 200: '#bfe0bf', 300: '#8fc88f',
                            400: '#5db35d', 500: '#319931', 600: '#218321', 700: '#196919',
                            800: '#155415', 900: '#103f10', 950: '#072607'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { transition: all .2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,.1); }
        .sidebar-link.active { background: rgba(255,255,255,.15); border-left: 3px solid #5db35d; }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-efarmer-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-5 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold">
                    E<span class="text-green-400">f</span>armer
                </a>
                <p class="text-xs text-green-200/60 mt-1">Admin Panel</p>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <div class="px-5 mb-2 text-xs uppercase text-green-200/50 font-semibold">Main</div>

                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line w-5"></i> Dashboard
                </a>

                <a href="{{ route('admin.goats.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.goats.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cow w-5"></i> Goats
                </a>

                <a href="{{ route('admin.breeds.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.breeds.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-dna w-5"></i> Breeds
                </a>

                <a href="{{ route('admin.customers.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users w-5"></i> Customers
                </a>
                <a href="{{ route('admin.payments.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-credit-card w-5"></i> Payments
                </a>

                <a href="{{ route('admin.sales.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping w-5"></i> Sales
                </a>

                <a href="{{ route('admin.expenses.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.expenses.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-money-bill w-5"></i> Expenses
                </a>

                <a href="{{ route('admin.reports.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-3 {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-lines w-5"></i> Reports
                </a>
            </nav>

            <div class="p-4 border-t border-white/10">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm text-green-200/70 hover:text-white">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> View Site
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-gray-600" onclick="document.getElementById('mobileSidebar').classList.toggle('hidden')">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-lg font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500 hidden sm:block">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-semibold">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3">
                        <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3">
                        <i class="fa-solid fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>