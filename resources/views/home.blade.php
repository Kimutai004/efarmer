@include('partials.nav')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Efarmer | Buy & Sell Quality Goats</title>

    <meta
        name="description"
        content="Efarmer is Kenya's trusted online marketplace for buying and selling quality goats."
    >

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- Google Font -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },

                    colors: {
                        efarmer: {
                            50: '#f1f9f1',
                            100: '#dff0df',
                            200: '#bfe0bf',
                            300: '#8fc88f',
                            400: '#5db35d',
                            500: '#319931',
                            600: '#218321',
                            700: '#196919',
                            800: '#155415',
                            900: '#103f10',
                            950: '#072607'
                        }
                    }
                }
            }
        }
    </script>

    <style>

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .hero {
            background-image:
                linear-gradient(
                    90deg,
                    rgba(0,0,0,.78),
                    rgba(0,0,0,.50),
                    rgba(0,0,0,.10)
                ),
                url('https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=2000&q=90');

            background-size: cover;
            background-position: center;
        }

        .goat-card {
            transition: all .3s ease;
        }

        .goat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,.12);
        }

        .goat-card img {
            transition: transform .4s ease;
        }

        .goat-card:hover img {
            transform: scale(1.06);
        }

        .search-box {
            box-shadow: 0 12px 35px rgba(0,0,0,.12);
        }

        .step-line {
            position: absolute;
            left: 15%;
            right: 15%;
            top: 30px;
            border-top: 2px dashed #a6d7a6;
        }

        @media(max-width:768px) {

            .hero {
                background-position: 65% center;
            }

            .step-line {
                display: none;
            }
        }

    </style>
</head>


<body class="bg-white text-gray-800">







<!-- ========================================================= -->
<!-- HERO -->
<!-- ========================================================= -->

<section class="hero relative min-h-[520px]">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="min-h-[520px] flex items-center">

            <div class="max-w-2xl text-white">

                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">

                    Buy & Sell

                    <br>

                    Quality Goats

                    <br>

                    <span class="text-green-400">
                        the Smart Way
                    </span>

                </h1>


                <p class="mt-6 text-lg md:text-xl text-gray-100 max-w-xl leading-8">

                    Efarmer connects farmers and buyers across Kenya.
                    Find healthy goats, fair prices and trusted sellers.

                </p>


                <div class="flex flex-wrap gap-5 mt-8">

                    <a
                        href="#goats"
                        class="bg-efarmer-500 hover:bg-efarmer-400 px-7 py-3.5 rounded-lg font-bold flex items-center gap-3 transition"
                    >

                        <i class="fa-solid fa-cow"></i>

                        Browse Goats

                    </a>

                </div>

            </div>

        </div>

    </div>



    <!-- SEARCH BOX -->

    <div class="absolute left-0 right-0 -bottom-9">

        <div class="max-w-6xl mx-auto px-5">

            <form
                action="#goats"
                method="GET"
                class="search-box bg-white rounded-xl p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3"
            >

                <!-- Breed -->

                <select
                    name="breed"
                    class="border rounded-lg px-4 py-3 outline-none focus:ring-2 focus:ring-efarmer-400"
                >

                    <option value="">
                        All Breeds
                    </option>

                    <option>Boer</option>
                    <option>Galla</option>
                    <option>Alpine</option>
                    <option>Saanen</option>

                </select>


                <!-- Location -->

                <select
                    name="location"
                    class="border rounded-lg px-4 py-3 outline-none focus:ring-2 focus:ring-efarmer-400"
                >

                    <option value="">
                        All Locations
                    </option>

                    <option>Nairobi</option>
                    <option>Nakuru</option>
                    <option>Kiambu</option>
                    <option>Machakos</option>
                    <option>Nyeri</option>
                    <option>Kajiado</option>

                </select>


                <!-- Gender -->

                <select
                    name="gender"
                    class="border rounded-lg px-4 py-3 outline-none focus:ring-2 focus:ring-efarmer-400"
                >

                    <option value="">
                        All Genders
                    </option>

                    <option>Male</option>
                    <option>Female</option>

                </select>


                <!-- PRICE -->

                <select
                    name="price"
                    class="border rounded-lg px-4 py-3 outline-none focus:ring-2 focus:ring-efarmer-400"
                >

                    <option value="">
                        Max Price
                    </option>

                    <option value="10000">
                        KSh 10,000
                    </option>

                    <option value="20000">
                        KSh 20,000
                    </option>

                    <option value="50000">
                        KSh 50,000
                    </option>

                    <option value="100000">
                        KSh 100,000
                    </option>

                </select>


                <button
                    type="submit"
                    class="bg-efarmer-600 hover:bg-efarmer-700 text-white rounded-lg font-bold flex items-center justify-center gap-2"
                >

                    <i class="fa-solid fa-magnifying-glass"></i>

                    Search Goats

                </button>

            </form>

        </div>

    </div>

</section>



<!-- ========================================================= -->
<!-- TRUST FEATURES -->
<!-- ========================================================= -->

<section class="pt-24 pb-12 bg-gray-50">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">


            <!-- FEATURE -->

            <div class="flex items-center gap-4">

                <div class="feature-icon rounded-full flex items-center justify-center text-efarmer-600 text-xl">

                    <i class="fa-solid fa-shield-halved"></i>

                </div>

                <div>

                    <h3 class="font-bold text-lg">
                        Verified Sellers
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        All sellers are verified for your safety
                    </p>

                </div>

            </div>


            <!-- FEATURE -->

            <div class="flex items-center gap-4">

                <div class="feature-icon rounded-full flex items-center justify-center text-efarmer-600 text-xl">

                    <i class="fa-solid fa-heart-pulse"></i>

                </div>

                <div>

                    <h3 class="font-bold text-lg">
                        Healthy Goats
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Health checked & vaccination ready
                    </p>

                </div>

            </div>


            <!-- FEATURE -->

            <div class="flex items-center gap-4">

                <div class="feature-icon rounded-full flex items-center justify-center text-efarmer-600 text-xl">

                    <i class="fa-solid fa-truck"></i>

                </div>

                <div>

                    <h3 class="font-bold text-lg">
                        Safe Delivery
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        We deliver your goat safely
                    </p>

                </div>

            </div>


            <!-- FEATURE -->

            <div class="flex items-center gap-4">

                <div class="feature-icon rounded-full flex items-center justify-center text-efarmer-600 text-xl">

                    <i class="fa-solid fa-tag"></i>

                </div>

                <div>

                    <h3 class="font-bold text-lg">
                        Fair Prices
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Transparent pricing, no hidden fees
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================= -->
<!-- FEATURED GOATS -->
<!-- ========================================================= -->

<section
    id="goats"
    class="py-20 bg-white"
>

    <div class="max-w-7xl mx-auto px-5 lg:px-8">


        <!-- TITLE -->

        <div class="flex items-center justify-between mb-10">

            <div>

                <h2 class="text-3xl font-extrabold text-efarmer-900">
                    Featured Goats
                </h2>

                <div class="w-12 h-1 bg-efarmer-500 mt-3"></div>

            </div>


            <a
                href="#"
                class="hidden sm:flex items-center gap-2 text-efarmer-700 font-semibold"
            >

                View All Goats

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>



        <!-- GOAT GRID -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


            <!-- GOAT 1 -->

            <article class="goat-card bg-white border rounded-xl overflow-hidden">

                <div class="relative overflow-hidden h-56">

                    <img
                        src="https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=700&q=80"
                        class="goat-card-image w-full h-full object-cover"
                        alt="Boer Male Goat"
                    >

                    <span class="absolute top-3 left-3 bg-efarmer-600 text-white text-xs px-3 py-1.5 rounded-md font-bold">
                        For Sale
                    </span>

                    <button class="absolute top-3 right-3 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-500 hover:text-red-500">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>


                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Boer Male Goat
                    </h3>


                    <p class="text-gray-500 text-sm mt-2">

                        <i class="fa-solid fa-location-dot text-efarmer-600"></i>

                        Nakuru, Kenya

                    </p>


                    <div class="flex gap-2 mt-3 flex-wrap">

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            Male
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            1 Year
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            45kg
                        </span>

                    </div>


                    <div class="mt-4 text-2xl font-extrabold text-efarmer-600">
                        KSh 18,000
                    </div>


                    <a
                        href="#"
                        class="mt-4 bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-3 rounded-lg flex items-center justify-center gap-2 font-semibold"
                    >

                        <i class="fa-solid fa-eye"></i>

                        View Details

                    </a>

                </div>

            </article>



            <!-- GOAT 2 -->

            <article class="goat-card bg-white border rounded-xl overflow-hidden">

                <div class="relative overflow-hidden h-56">

                    <img
                        src="https://images.unsplash.com/photo-1551884831-bbf3cdc6469e?auto=format&fit=crop&w=700&q=80"
                        class="goat-card-image w-full h-full object-cover"
                        alt="Alpine Female Goat"
                    >

                    <span class="absolute top-3 left-3 bg-efarmer-600 text-white text-xs px-3 py-1.5 rounded-md font-bold">
                        For Sale
                    </span>

                    <button class="absolute top-3 right-3 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-500 hover:text-red-500">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>


                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Alpine Female Goat
                    </h3>


                    <p class="text-gray-500 text-sm mt-2">

                        <i class="fa-solid fa-location-dot text-efarmer-600"></i>

                        Kiambu, Kenya

                    </p>


                    <div class="flex gap-2 mt-3 flex-wrap">

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            Female
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            1.5 Years
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            40kg
                        </span>

                    </div>


                    <div class="mt-4 text-2xl font-extrabold text-efarmer-600">
                        KSh 15,500
                    </div>


                    <a
                        href="#"
                        class="mt-4 bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-3 rounded-lg flex items-center justify-center gap-2 font-semibold"
                    >

                        <i class="fa-solid fa-eye"></i>

                        View Details

                    </a>

                </div>

            </article>



            <!-- GOAT 3 -->

            <article class="goat-card bg-white border rounded-xl overflow-hidden">

                <div class="relative overflow-hidden h-56">

                    <img
                        src="https://images.unsplash.com/photo-1516467508483-a7212febe31a?auto=format&fit=crop&w=700&q=80"
                        class="goat-card-image w-full h-full object-cover"
                        alt="Galla Buck"
                    >

                    <span class="absolute top-3 left-3 bg-efarmer-600 text-white text-xs px-3 py-1.5 rounded-md font-bold">
                        For Sale
                    </span>

                    <button class="absolute top-3 right-3 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-500 hover:text-red-500">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>


                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Galla Buck
                    </h3>


                    <p class="text-gray-500 text-sm mt-2">

                        <i class="fa-solid fa-location-dot text-efarmer-600"></i>

                        Machakos, Kenya

                    </p>


                    <div class="flex gap-2 mt-3 flex-wrap">

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            Male
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            1 Year
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            50kg
                        </span>

                    </div>


                    <div class="mt-4 text-2xl font-extrabold text-efarmer-600">
                        KSh 20,000
                    </div>


                    <a
                        href="#"
                        class="mt-4 bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-3 rounded-lg flex items-center justify-center gap-2 font-semibold"
                    >

                        <i class="fa-solid fa-eye"></i>

                        View Details

                    </a>

                </div>

            </article>



            <!-- GOAT 4 -->

            <article class="goat-card bg-white border rounded-xl overflow-hidden">

                <div class="relative overflow-hidden h-56">

                    <img
                        src="https://images.unsplash.com/photo-1548247416-ec66f4900b2e?auto=format&fit=crop&w=700&q=80"
                        class="goat-card-image w-full h-full object-cover"
                        alt="Saanen Female Goat"
                    >

                    <span class="absolute top-3 left-3 bg-efarmer-600 text-white text-xs px-3 py-1.5 rounded-md font-bold">
                        For Sale
                    </span>

                    <button class="absolute top-3 right-3 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-500 hover:text-red-500">

                        <i class="fa-regular fa-heart"></i>

                    </button>

                </div>


                <div class="p-5">

                    <h3 class="font-bold text-lg">
                        Saanen Female
                    </h3>


                    <p class="text-gray-500 text-sm mt-2">

                        <i class="fa-solid fa-location-dot text-efarmer-600"></i>

                        Nyeri, Kenya

                    </p>


                    <div class="flex gap-2 mt-3 flex-wrap">

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            Female
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            1 Year
                        </span>

                        <span class="bg-gray-100 px-2.5 py-1 rounded text-xs">
                            38kg
                        </span>

                    </div>


                    <div class="mt-4 text-2xl font-extrabold text-efarmer-600">
                        KSh 16,500
                    </div>


                    <a
                        href="#"
                        class="mt-4 bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-3 rounded-lg flex items-center justify-center gap-2 font-semibold"
                    >

                        <i class="fa-solid fa-eye"></i>

                        View Details

                    </a>

                </div>

            </article>

        </div>

    </div>

</section>



<!-- ========================================================= -->
<!-- HOW IT WORKS -->
<!-- ========================================================= -->

<section
    id="how-it-works"
    class="py-20 bg-efarmer-50"
>

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="text-center mb-14">

            <h2 class="text-3xl md:text-4xl font-extrabold text-efarmer-900">
                How It Works
            </h2>

            <div class="w-12 h-1 bg-efarmer-500 mx-auto mt-3"></div>

        </div>


        <div class="relative">

            <div class="step-line"></div>


            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative">


                <!-- STEP 1 -->

                <div class="text-center">

                    <div class="relative z-10 mx-auto w-16 h-16 bg-white border-2 border-efarmer-400 rounded-full flex items-center justify-center text-efarmer-600 text-2xl">

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </div>

                    <h3 class="font-bold text-lg mt-5">
                        1. Search
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Browse goats by location,
                        breed, gender or price.
                    </p>

                </div>


                <!-- STEP 2 -->

                <div class="text-center">

                    <div class="relative z-10 mx-auto w-16 h-16 bg-white border-2 border-efarmer-400 rounded-full flex items-center justify-center text-efarmer-600 text-2xl">

                        <i class="fa-solid fa-comment-dots"></i>

                    </div>

                    <h3 class="font-bold text-lg mt-5">
                        2. Contact Seller
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Chat or call the seller
                        to ask questions.
                    </p>

                </div>


                <!-- STEP 3 -->

                <div class="text-center">

                    <div class="relative z-10 mx-auto w-16 h-16 bg-white border-2 border-efarmer-400 rounded-full flex items-center justify-center text-efarmer-600 text-2xl">

                        <i class="fa-solid fa-handshake"></i>

                    </div>

                    <h3 class="font-bold text-lg mt-5">
                        3. Agree & Pay
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Agree on price and
                        complete payment.
                    </p>

                </div>


                <!-- STEP 4 -->

                <div class="text-center">

                    <div class="relative z-10 mx-auto w-16 h-16 bg-white border-2 border-efarmer-400 rounded-full flex items-center justify-center text-efarmer-600 text-2xl">

                        <i class="fa-solid fa-truck"></i>

                    </div>

                    <h3 class="font-bold text-lg mt-5">
                        4. Delivery
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Get your goat delivered
                        safely to you.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================= -->
<!-- SELL CTA -->
<!-- ========================================================= -->

<section
    id="sell"
    class="py-20 bg-white"
>

    <div class="max-w-6xl mx-auto px-5">

        <div class="bg-efarmer-800 rounded-2xl overflow-hidden">

            <div class="grid md:grid-cols-2">

                <div class="p-10 md:p-14 text-white">

                    <span class="text-green-300 font-semibold">
                        FOR FARMERS
                    </span>

                    <h2 class="text-3xl md:text-4xl font-extrabold mt-3">
                        Have goats to sell?
                    </h2>

                    <p class="mt-5 text-green-50 leading-7">
                        Reach thousands of potential buyers
                        across Kenya and sell your goats at
                        a fair market price.
                    </p>

                    <a
                        href="#"
                        class="inline-flex items-center gap-3 mt-8 bg-white text-efarmer-800 px-7 py-3.5 rounded-lg font-bold hover:bg-green-50"
                    >

                        List Your Goat

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>


                <div
                    class="min-h-[320px] bg-cover bg-center"
                    style="
                        background-image:
                        url('https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=1000&q=80');
                    "
                >
                </div>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================= -->
<!-- NEWSLETTER -->
<!-- ========================================================= -->

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="py-8 flex flex-col lg:flex-row items-center justify-between gap-6">

            <div class="flex items-center gap-4">

                <div class="text-4xl">
                    <i class="fa-regular fa-envelope"></i>
                </div>

                <div>

                    <h3 class="font-bold text-xl">
                        Stay updated with the latest goats,
                        farming tips and offers.
                    </h3>

                    <p class="text-green-200 text-sm mt-1">
                        Subscribe to the Efarmer newsletter.
                    </p>

                </div>

            </div>


            <form class="flex w-full lg:w-auto">

                <input
                    type="email"
                    placeholder="Enter your email address"
                    class="w-full lg:w-80 px-5 py-3 rounded-l-lg text-gray-900 outline-none"
                >

                <button
                    type="submit"
                    class="bg-efarmer-500 hover:bg-efarmer-400 px-7 py-3 rounded-r-lg font-bold"
                >
                    Subscribe
                </button>

            </form>

        </div>

    </div>

</section>

@include('partials.footer')


<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script>

    const mobileMenuButton =
        document.getElementById('mobileMenuButton');

    const mobileMenu =
        document.getElementById('mobileMenu');


    mobileMenuButton.addEventListener('click', function () {

        mobileMenu.classList.toggle('hidden');

    });


    // Favorite buttons

    document
        .querySelectorAll('.goat-card button')
        .forEach(button => {

            button.addEventListener('click', function () {

                const icon =
                    this.querySelector('i');

                icon.classList.toggle('fa-regular');
                icon.classList.toggle('fa-solid');

                if (icon.classList.contains('fa-solid')) {

                    icon.style.color = '#ef4444';

                } else {

                    icon.style.color = '';

                }

            });

        });

</script>

</body>

</html>