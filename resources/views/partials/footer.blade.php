
<!-- ========================================================= -->
<!-- FOOTER -->
<!-- ========================================================= -->
<footer class="bg-efarmer-950 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-14">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <div>

                <div class="text-3xl font-extrabold">
                    E<span class="text-green-400">f</span>armer
                </div>

                <p class="text-green-100/70 mt-4 leading-7">
                    Kenya's trusted online marketplace for
                    buying and selling quality goats.
                    Empowering farmers and growing communities.
                </p>

                <div class="flex gap-3 mt-6">

                    <a href="#"
                       class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#"
                       class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#"
                       class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>

                </div>

            </div>


            <div>

                <h3 class="font-bold text-lg mb-5">
                    Quick Links
                </h3>

                <ul class="space-y-3 text-green-100/70">

                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('goats.index') }}">
                            Goats for Sale
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('seller.create') }}">
                            Sell Your Goat
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('how-it-works') }}">
                            How It Works
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('blog.index') }}">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <div>

                <h3 class="font-bold text-lg mb-5">
                    Help & Support
                </h3>

                <ul class="space-y-3 text-green-100/70">

                    <li>
                        <a href="{{ route('faqs') }}">
                            FAQs
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('buying-guide') }}">
                            Buying Guide
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shipping') }}">
                            Shipping & Delivery
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('terms') }}">
                            Terms & Conditions
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('privacy') }}">
                            Privacy Policy
                        </a>
                    </li>

                </ul>

            </div>


            <div>

                <h3 class="font-bold text-lg mb-5">
                    Contact Us
                </h3>

                <div class="space-y-4 text-green-100/70">

                    <p>
                        <i class="fa-solid fa-phone text-green-400 mr-2"></i>
                        +254 712 345 678
                    </p>

                    <p>
                        <i class="fa-solid fa-envelope text-green-400 mr-2"></i>
                        support@efarmer.co.ke
                    </p>

                    <p>
                        <i class="fa-solid fa-location-dot text-green-400 mr-2"></i>
                        Nairobi, Kenya
                    </p>

                </div>

            </div>

        </div>

    </div>


    <div class="border-t border-white/10">

        <div class="max-w-7xl mx-auto px-5 lg:px-8 py-5">

            <div class="flex flex-col md:flex-row justify-between gap-3 text-sm text-green-100/50">

                <span>
                    © {{ date('Y') }} Efarmer. All Rights Reserved.
                </span>

                <span>
                    Made with
                    <span class="text-red-400">♥</span>
                    for farmers in Kenya
                </span>

            </div>

        </div>

    </div>

</footer>