<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Efarmer')
    </title>

    <meta
        name="description"
        content="@yield('description', 'Efarmer - Buy and sell quality goats across Kenya.')"
    >

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

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
                        inter: ['Inter', 'sans-serif']
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

        .page-hero {
            background:
                linear-gradient(
                    90deg,
                    rgba(7,38,7,.88),
                    rgba(16,63,16,.65),
                    rgba(0,0,0,.15)
                );
        }

        .card-hover {
            transition: .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(0,0,0,.10);
        }

        .goat-image {
            transition: .4s ease;
        }

        .card-hover:hover .goat-image {
            transform: scale(1.05);
        }

    </style>

    @stack('styles')

</head>


<body class="bg-white text-gray-800">

    @include('partials.nav')


    <main>
        @yield('content')
    </main>


    @include('partials.footer')


    @stack('scripts')

</body>

</html>