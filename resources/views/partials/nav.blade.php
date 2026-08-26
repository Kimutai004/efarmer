<!-- ========================================================= -->
<!-- TOP BAR -->
<!-- ========================================================= -->

<div class="bg-efarmer-900 text-white text-sm">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="min-h-[36px] flex items-center justify-between">

            <div class="flex items-center gap-6">

                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot"></i>
                    Delivering across Kenya
                </span>

                <span class="hidden sm:flex items-center gap-2">
                    <i class="fa-solid fa-phone"></i>
                    +254 712 345 678
                </span>
                <span class="hidden md:flex items-center gap-2">
                    <i class="fa-solid fa-envelope"></i>
                    support@efarmer.co.ke
                </span>
            </div>
            <div class="hidden md:flex items-center gap-4">
                <span>Follow us:</span>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- NAVIGATION -->
<!-- ========================================================= -->

<header class="bg-white border-b">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="h-[86px] flex items-center justify-between">

            <!-- LOGO -->

            <a
                href="{{ route('home') }}"
                class="flex flex-col"
            >

                <span class="text-4xl font-extrabold tracking-tight text-efarmer-800">
                    E<span class="text-efarmer-500">f</span>armer
                </span>

                <span class="text-xs text-gray-500">
                    Smart Farming. Better Livelihoods.
                </span>

            </a>


            <!-- DESKTOP MENU -->

            <nav class="hidden lg:flex items-center gap-9">

               <a href="{{ route('home') }}">
    Home
</a>

<a href="{{ route('goats.index') }}">
    Goats for Sale
</a>

<a href="{{ route('seller.create') }}">
    Sell Your Goat
</a>

<a href="{{ route('how-it-works') }}">
    How It Works
</a>

<a href="{{ route('blog.index') }}">
    Blog
</a>

<a href="{{ route('contact') }}">
    Contact
</a>

            </nav>


            <!-- ACTIONS -->

            <div class="hidden md:flex items-center gap-3">

                <button
                    class="relative w-11 h-11 rounded-lg border flex items-center justify-center hover:bg-efarmer-50"
                >

                    <i class="fa-solid fa-cart-shopping text-efarmer-700"></i>

                    <span class="absolute -top-2 -right-2 bg-efarmer-600 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">
                        0
                    </span>

                </button>

            </div>


            <!-- MOBILE BUTTON -->

            <button
                id="mobileMenuButton"
                class="lg:hidden text-2xl text-efarmer-800"
            >

                <i class="fa-solid fa-bars"></i>

            </button>

        </div>


        <!-- MOBILE MENU -->

        <div
            id="mobileMenu"
            class="hidden pb-5 lg:hidden"
        >

            <nav class="flex flex-col gap-4">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <a href="#goats">
                    Goats for Sale
                </a>

                <a href="#sell">
                    Sell Your Goat
                </a>

                <a href="#how-it-works">
                    How It Works
                </a>

                <a href="#blog">
                    Blog
                </a>

                <a href="#contact">
                    Contact
                </a>

                <hr>

                <a href="#">
                    Login
                </a>

                <a
                    href="#"
                    class="bg-efarmer-600 text-white text-center py-3 rounded-lg"
                >
                    Register
                </a>

            </nav>

        </div>

    </div>

</header>