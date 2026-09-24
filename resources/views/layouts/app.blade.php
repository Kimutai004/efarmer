<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Efarmer | Buy & Sell Quality Goats in Kenya')</title>

    <meta name="description" content="@yield('description', 'Efarmer is Kenya\'s trusted marketplace for buying and selling healthy, quality goats directly from farmers.')">

    <meta name="theme-color" content="#1a4629">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Efarmer">
    <meta property="og:title" content="@yield('title', 'Efarmer | Buy & Sell Quality Goats in Kenya')">
    <meta property="og:description" content="@yield('description', 'Efarmer is Kenya\'s trusted marketplace for buying and selling healthy, quality goats directly from farmers.')">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    @yield('meta')

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <script>
        /*
        |--------------------------------------------------------------------------
        | Efarmer brand theme
        |--------------------------------------------------------------------------
        | Palette lifted straight from the Efarmer logo:
        |   primary -> fresh leaf green     (#3aa55a)
        |   accent  -> terracotta orange   (#d27c37)
        |--------------------------------------------------------------------------
        */
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    },

                    colors: {
                        efarmer: {
                            50: '#f2faf3',
                            100: '#e0f4e4',
                            200: '#c2e9ca',
                            300: '#96d8a4',
                            400: '#63c078',
                            500: '#3aa55a',
                            600: '#2c8748',
                            700: '#246c3b',
                            800: '#1f5631',
                            900: '#1a4629',
                            950: '#0d2716',
                        },

                        clay: {
                            50: '#fdf7f1',
                            100: '#faecdd',
                            200: '#f3d6b6',
                            300: '#e9b987',
                            400: '#de9a56',
                            500: '#d27c37',
                            600: '#b96426',
                            700: '#964d1f',
                            800: '#793f1e',
                            900: '#63351c',
                            950: '#361a0c',
                        },

                        /* Keeps legacy green-* markup on-brand */
                        green: {
                            50: '#f2faf3',
                            100: '#e0f4e4',
                            200: '#c2e9ca',
                            300: '#96d8a4',
                            400: '#63c078',
                            500: '#3aa55a',
                            600: '#2c8748',
                            700: '#246c3b',
                            800: '#1f5631',
                            900: '#1a4629',
                            950: '#0d2716',
                        },
                    },

                    boxShadow: {
                        soft: '0 18px 45px -24px rgba(13, 39, 22, .30)',
                        card: '0 26px 60px -28px rgba(13, 39, 22, .45)',
                    },

                    borderRadius: {
                        '4xl': '2rem',
                    },
                },
            },
        }
    </script>

    <style>
        :root {
            --brand: #2c8748;
            --brand-dark: #1f5631;
            --brand-deep: #0d2716;
            --brand-light: #e0f4e4;
            --accent: #d27c37;
            --accent-dark: #b96426;
            --line: #dceee1;
        }
        * { scroll-behavior: smooth; }

        body { font-family: 'Inter', system-ui, sans-serif; }

        h1, h2, h3, .font-display { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }

        ::selection { background: #c2e9ca; color: #1a4629; }

        /* ---------------------------------------------------------------
        | Buttons
        ---------------------------------------------------------------- */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            padding: .8rem 1.5rem;
            border-radius: .9rem;
            font-weight: 700;
            font-size: .95rem;
            line-height: 1;
            border: 1px solid transparent;
            transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease, color .2s ease;
            cursor: pointer;
        }

        .btn:active { transform: translateY(1px) scale(.99); }

        .btn-primary { background: var(--brand); color: #fff; }

        .btn-primary:hover {
            background: var(--brand-dark);
            box-shadow: 0 16px 30px -16px rgba(31, 86, 49, .8);
        }

        .btn-accent { background: var(--accent); color: #fff; }

        .btn-accent:hover {
            background: var(--accent-dark);
            box-shadow: 0 16px 30px -16px rgba(185, 100, 38, .85);
        }

        .btn-dark { background: var(--brand-deep); color: #fff; }

        .btn-dark:hover { background: #1a4629; }

        .btn-white { background: #fff; color: var(--brand-dark); }

        .btn-white:hover { background: var(--brand-light); }

        .btn-outline { border-color: var(--line); color: var(--brand-dark); background: #fff; }

        .btn-outline:hover { border-color: var(--brand); color: var(--brand); background: #f2faf5; }

        .btn-ghost { background: transparent; color: var(--brand-dark); }

        .btn-ghost:hover { background: var(--brand-light); }

        .btn-lg { padding: 1.05rem 2rem; font-size: 1.05rem; border-radius: 1rem; }
        /* ---------------------------------------------------------------
        | Surfaces, chips & motion
        ---------------------------------------------------------------- */
        .card-soft {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 1.5rem;
            box-shadow: 0 4px 18px -14px rgba(13, 39, 22, .35);
        }

        .lift { transition: transform .35s cubic-bezier(.2, .8, .2, 1), box-shadow .35s ease; }

        .lift:hover { transform: translateY(-6px); box-shadow: 0 30px 60px -30px rgba(13, 39, 22, .45); }

        .zoom img { transition: transform .6s cubic-bezier(.2, .8, .2, 1); }

        .zoom:hover img { transform: scale(1.06); }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .35rem .8rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            background: var(--brand-light);
            color: var(--brand-dark);
        }

        .chip-accent { background: #faecdd; color: #964d1f; }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-size: .75rem;
            font-weight: 800;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .divider-line {
            height: 4px;
            width: 64px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--accent), var(--brand));
        }

        .hero-overlay {
            background: linear-gradient(105deg, rgba(13, 39, 22, .92) 8%, rgba(26, 70, 41, .72) 46%, rgba(13, 39, 22, .22) 100%);
        }

        .noise-dots {
            background-image: radial-gradient(rgba(255, 255, 255, .16) 1px, transparent 1px);
            background-size: 18px 18px;
        }

        [data-reveal] {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity .7s ease, transform .7s cubic-bezier(.2, .8, .2, 1);
        }

        [data-reveal].is-visible { opacity: 1; transform: none; }

        @media (prefers-reduced-motion: reduce) {
            [data-reveal] { opacity: 1; transform: none; transition: none; }
        }

        /* ---------------------------------------------------------------
        | Form controls (fallback styling for unstyled fields)
        ---------------------------------------------------------------- */
        main input[type="text"],
        main input[type="email"],
        main input[type="tel"],
        main input[type="number"],
        main input[type="date"],
        main input[type="password"],
        main input[type="search"],
        main select,
        main textarea {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: .85rem;
            padding: .75rem 1rem;
            width: 100%;
            color: #374151;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        main input:focus,
        main select:focus,
        main textarea:focus {
            outline: none;
            border-color: #63c078;
            box-shadow: 0 0 0 4px rgba(99, 192, 120, .25);
        }

        .field-label {
            display: block;
            font-size: .85rem;
            font-weight: 700;
            color: var(--brand-dark);
            margin-bottom: .45rem;
        }
        /* ---------------------------------------------------------------
        | Article typography (blog)
        ---------------------------------------------------------------- */
        .article-prose { font-size: 1.0625rem; line-height: 1.9; color: #4b5563; }

        .article-prose > * + * { margin-top: 1.35rem; }

        .article-prose h2 {
            font-size: 1.75rem;
            line-height: 1.3;
            font-weight: 800;
            color: #1a4629;
            margin-top: 3rem;
            letter-spacing: -.01em;
        }

        .article-prose h3 { font-size: 1.25rem; font-weight: 700; color: #1f5631; margin-top: 2rem; }

        .article-prose a { color: var(--accent-dark); font-weight: 600; text-decoration: underline; }

        .article-prose strong { color: #1a4629; font-weight: 700; }

        .article-prose ul, .article-prose ol { padding-left: 1.15rem; }

        .article-prose ul { list-style: disc; }

        .article-prose ol { list-style: decimal; }

        .article-prose li + li { margin-top: .5rem; }

        .article-prose blockquote {
            border-left: 4px solid var(--accent);
            background: #fdf7f1;
            padding: 1.25rem 1.5rem;
            border-radius: 0 1.25rem 1.25rem 0;
            font-size: 1.15rem;
            font-style: italic;
            color: #63351c;
        }

        .article-prose figure { margin: 2rem 0; }

        .article-prose figure img { border-radius: 1.5rem; width: 100%; }

        .article-prose figcaption {
            font-size: .8rem;
            color: #9ca3af;
            margin-top: .75rem;
            text-align: center;
        }

        .drop-cap::first-letter {
            float: left;
            font-family: 'Plus Jakarta Sans', serif;
            font-size: 3.6rem;
            line-height: .82;
            font-weight: 800;
            color: var(--brand);
            padding: .35rem .65rem .1rem 0;
        }

        .toc-link { transition: color .2s ease, background .2s ease, padding .2s ease; }

        .toc-link.active {
            color: var(--brand-dark);
            background: var(--brand-light);
            font-weight: 700;
            padding-left: 1rem;
        }

        /* ---------------------------------------------------------------
        | Misc
        ---------------------------------------------------------------- */
        .skip-link {
            position: absolute;
            left: 1rem;
            top: -4rem;
            z-index: 100;
            background: var(--brand-deep);
            color: #fff;
            padding: .7rem 1.1rem;
            border-radius: .75rem;
            transition: top .25s ease;
        }

        .skip-link:focus { top: 1rem; }

        #toTop { opacity: 0; visibility: hidden; transition: opacity .3s ease, visibility .3s ease; }

        #toTop.is-visible { opacity: 1; visibility: visible; }

        ::-webkit-scrollbar { width: 10px; height: 10px; }

        ::-webkit-scrollbar-track { background: #eef7f1; }

        ::-webkit-scrollbar-thumb { background: #96d8a4; border-radius: 999px; border: 2px solid #eef7f1; }

        ::-webkit-scrollbar-thumb:hover { background: var(--brand); }

        .flash-toast { animation: toast-in .5s cubic-bezier(.2, .8, .2, 1) both; }

        @keyframes toast-in {
            from { opacity: 0; transform: translate(-50%, -14px); }
            to { opacity: 1; transform: translate(-50%, 0); }
        }
    </style>

    @stack('styles')

</head>
<body class="bg-[#f6fcf8] text-gray-700 antialiased">

    <a href="#main" class="skip-link">Skip to content</a>

    @include('partials.nav')

    @if(session('success') || session('error') || session('status'))
        <div
            id="flashToast"
            class="flash-toast fixed z-[60] left-1/2 -translate-x-1/2 top-4 w-[min(92vw,560px)] rounded-2xl px-5 py-4 shadow-card flex items-start gap-3
                {{ session('error') ? 'bg-red-50 text-red-800 border border-red-200' : 'bg-efarmer-900 text-white' }}"
        >
            <i class="fa-solid {{ session('error') ? 'fa-circle-exclamation' : 'fa-circle-check' }} mt-0.5"></i>

            <p class="flex-1 text-sm font-semibold">
                {{ session('success') ?? session('error') ?? session('status') }}
            </p>

            <button type="button" onclick="document.getElementById('flashToast').remove()" aria-label="Dismiss">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <button
        id="toTop"
        type="button"
        aria-label="Back to top"
        class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-efarmer-900 text-white shadow-card hover:bg-efarmer-800 flex items-center justify-center"
    >
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* Reveal on scroll */
            var revealTargets = document.querySelectorAll('[data-reveal]');

            if ('IntersectionObserver' in window && revealTargets.length) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry, index) {
                        if (! entry.isIntersecting) return;

                        entry.target.style.transitionDelay = (index * 70) + 'ms';
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

                revealTargets.forEach(function (target) { observer.observe(target); });
            } else {
                revealTargets.forEach(function (target) { target.classList.add('is-visible'); });
            }

            /* Back to top */
            var toTop = document.getElementById('toTop');

            if (toTop) {
                window.addEventListener('scroll', function () {
                    toTop.classList.toggle('is-visible', window.scrollY > 480);
                }, { passive: true });

                toTop.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            /* Auto dismiss flash toast */
            var toast = document.getElementById('flashToast');

            if (toast) {
                setTimeout(function () {
                    toast.style.transition = 'opacity .4s ease, transform .4s ease';
                    toast.style.opacity = '0';
                    toast.style.transform = 'translate(-50%, -16px)';
                    setTimeout(function () { toast.remove(); }, 420);
                }, 6000);
            }
        });
    </script>

</body>

</html>

