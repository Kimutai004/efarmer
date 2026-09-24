<!-- ========================================================= -->
<!-- FOOTER -->
<!-- ========================================================= -->

<footer class="relative bg-efarmer-950 text-white overflow-hidden">

    <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full bg-efarmer-900/60 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 pt-16 pb-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12">

            <!-- BRAND -->

            <div class="lg:col-span-4">

                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-white rounded-2xl px-4 py-3">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Efarmer"
                        class="h-12 w-auto object-contain"
                    >

                </a>

                <p class="text-white/60 mt-6 leading-7">
                    Kenya's trusted online marketplace for buying quality goats
                    quality goats. We connect farmers and buyers with fair
                    prices, healthy livestock and reliable delivery.
                </p>

                <div class="flex gap-3 mt-6">

                    <a href="#" aria-label="Facebook"
                       class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-clay-500 transition">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#" aria-label="X"
                       class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-clay-500 transition">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>

                    <a href="#" aria-label="Instagram"
                       class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-clay-500 transition">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://wa.me/254712345678" aria-label="WhatsApp"
                       class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-clay-500 transition">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>

                </div>

            </div>


            <!-- MARKETPLACE -->

            <div class="lg:col-span-2">

                <h3 class="font-display font-bold text-base mb-5 text-white">
                    Marketplace
                </h3>

                <ul class="space-y-3 text-white/60 text-sm">

                    <li><a href="{{ route('goats.index') }}" class="hover:text-clay-400 transition">Goats for Sale</a></li>
                    <li><a href="{{ route('how-it-works') }}" class="hover:text-clay-400 transition">How It Works</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-clay-400 transition">Blog</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-clay-400 transition">About Us</a></li>

                </ul>

            </div>


            <!-- HELP -->

            <div class="lg:col-span-2">

                <h3 class="font-display font-bold text-base mb-5 text-white">
                    Help &amp; Support
                </h3>

                <ul class="space-y-3 text-white/60 text-sm">

                    <li><a href="{{ route('faqs') }}" class="hover:text-clay-400 transition">FAQs</a></li>
                    <li><a href="{{ route('buying-guide') }}" class="hover:text-clay-400 transition">Buying Guide</a></li>
                    <li><a href="{{ route('shipping') }}" class="hover:text-clay-400 transition">Shipping &amp; Delivery</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-clay-400 transition">Terms &amp; Conditions</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-clay-400 transition">Privacy Policy</a></li>

                </ul>

            </div>

            <!-- CONTACT -->

            <div class="lg:col-span-4">

                <h3 class="font-display font-bold text-base mb-5 text-white">
                    Talk to us
                </h3>

                <div class="space-y-4 text-sm">

                    <a href="tel:+254712345678" class="flex items-start gap-3 text-white/70 hover:text-white transition">
                        <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-clay-400 flex-shrink-0">
                            <i class="fa-solid fa-phone"></i>
                        </span>

                        <span>
                            <span class="block text-white font-semibold">+254 712 345 678</span>
                            <span class="block text-white/50 text-xs">Mon – Sat, 8am – 6pm</span>
                        </span>
                    </a>

                    <a href="mailto:info@e-farmer.co.ke" class="flex items-start gap-3 text-white/70 hover:text-white transition">
                        <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-clay-400 flex-shrink-0">
                            <i class="fa-solid fa-envelope"></i>
                        </span>

                        <span>
                            <span class="block text-white font-semibold">info@e-farmer.co.ke</span>
                            <span class="block text-white/50 text-xs">We reply within 24 hours</span>
                        </span>
                    </a>

                    <div class="flex items-start gap-3 text-white/70">
                        <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-clay-400 flex-shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>

                        <span>
                            <span class="block text-white font-semibold">Nairobi, Kenya</span>
                            <span class="block text-white/50 text-xs">Delivering countrywide</span>
                        </span>
                    </div>

                </div>

                <div class="mt-6 flex flex-wrap gap-2">

                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-bold text-white/80">
                        <i class="fa-solid fa-mobile-screen text-clay-400"></i> M-Pesa
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-bold text-white/80">
                        <i class="fa-solid fa-shield-halved text-clay-400"></i> Verified goats
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- BOTTOM BAR -->

    <div class="relative border-t border-white/10">

        <div class="max-w-7xl mx-auto px-5 lg:px-8 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-white/50">

                <span>&copy; {{ date('Y') }} Efarmer. All rights reserved.</span>

                <span class="flex items-center gap-2">
                    Made with <i class="fa-solid fa-heart text-clay-400"></i> for farmers in Kenya
                </span>

                <span class="flex items-center gap-4">
                    <a href="{{ route('terms') }}" class="hover:text-white transition">Terms</a>
                    <a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy</a>
                    <a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a>
                </span>

            </div>

        </div>

    </div>

</footer>

