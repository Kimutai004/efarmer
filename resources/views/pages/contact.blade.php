@extends('layouts.app')

@section('title', 'Contact Efarmer | Talk to Our Livestock Team')
@section('description', 'Call, WhatsApp or message the Efarmer team. We help buyers and farmers across Kenya with orders, listings and delivery.')

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'We reply fast',
    'title' => 'Talk to us',
    'subtitle' => 'Questions about a goat, your order or a listing? Call, WhatsApp or send a message — we respond within one working day.',
    'image' => 'WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg',
    'crumb' => 'Contact',
])

<section class="py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-3 gap-6">

            @foreach([
                ['icon' => 'fa-phone-volume', 'title' => 'Call us', 'line1' => '+254 712 345 678', 'line2' => 'Mon – Sat, 8am – 6pm', 'href' => 'tel:+254712345678'],
                ['icon' => 'fa-brands fa-whatsapp', 'title' => 'WhatsApp', 'line1' => '+254 712 345 678', 'line2' => 'Chat with our team', 'href' => 'https://wa.me/254712345678'],
                ['icon' => 'fa-envelope', 'title' => 'Email', 'line1' => 'support@efarmer.co.ke', 'line2' => 'Replies within 24 hours', 'href' => 'mailto:support@efarmer.co.ke'],
            ] as $channel)

                <a href="{{ $channel['href'] }}" class="card-soft lift p-7 flex items-start gap-4" data-reveal>

                    <span class="w-12 h-12 rounded-2xl bg-clay-50 text-clay-600 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid {{ $channel['icon'] }}"></i>
                    </span>

                    <span>
                        <span class="block font-display font-bold text-efarmer-900">{{ $channel['title'] }}</span>
                        <span class="block text-efarmer-700 font-semibold mt-1">{{ $channel['line1'] }}</span>
                        <span class="block text-sm text-gray-500 mt-1">{{ $channel['line2'] }}</span>
                    </span>

                </a>

            @endforeach

        </div>

        <div class="grid lg:grid-cols-5 gap-6 mt-10">

            <div class="lg:col-span-3 card-soft p-8 lg:p-10">

                <h2 class="font-display text-2xl font-extrabold text-efarmer-900">
                    Send us a message
                </h2>

                <p class="text-gray-500 mt-2 text-sm">
                    Tell us how we can help and we will get back to you quickly.
                </p>

                <form action="#" method="POST" class="mt-8 grid sm:grid-cols-2 gap-5">

                    <label class="block">
                        <span class="field-label">Your name</span>
                        <input type="text" name="name" placeholder="Jane Wanjiku">
                    </label>

                    <label class="block">
                        <span class="field-label">Phone or email</span>
                        <input type="text" name="contact" placeholder="0712 000 000">
                    </label>

                    <label class="block sm:col-span-2">
                        <span class="field-label">What is this about?</span>
                        <select name="topic">
                            <option>Buying a goat</option>
                            <option>Selling a goat</option>
                            <option>My order or delivery</option>
                            <option>Payments</option>
                            <option>Something else</option>
                        </select>
                    </label>

                    <label class="block sm:col-span-2">
                        <span class="field-label">Message</span>
                        <textarea name="message" rows="5" placeholder="How can we help?"></textarea>
                    </label>

                    <div class="sm:col-span-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-paper-plane"></i>
                            Send message
                        </button>
                    </div>

                </form>

            </div>

            <div class="lg:col-span-2 space-y-6">

                <div class="relative overflow-hidden rounded-3xl bg-efarmer-900 text-white p-8">

                    <div class="absolute inset-0 noise-dots opacity-25"></div>

                    <div class="relative">

                        <h3 class="font-display font-extrabold text-xl">
                            Visit us
                        </h3>

                        <p class="text-white/70 mt-3 text-sm leading-7">
                            Nairobi, Kenya<br>
                            Open Monday to Saturday,<br>
                            8:00am to 6:00pm EAT.
                        </p>

                        <div class="mt-6 rounded-2xl bg-white/10 p-4 text-sm text-white/80">
                            <i class="fa-solid fa-truck-fast text-clay-300"></i>
                            Deliveries run to all 47 counties after every confirmed order.
                        </div>

                    </div>

                </div>

                <div class="card-soft p-8">

                    <h3 class="font-display font-extrabold text-xl text-efarmer-900">
                        Quick answers
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Most buyers find their answer in our guides.
                    </p>

                    <div class="mt-5 space-y-3">

                        <a href="{{ route('faqs') }}" class="flex items-center justify-between rounded-2xl border border-efarmer-100 px-4 py-3 text-sm font-semibold text-efarmer-800 hover:border-efarmer-400 hover:bg-efarmer-50 transition">
                            FAQs
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                        <a href="{{ route('buying-guide') }}" class="flex items-center justify-between rounded-2xl border border-efarmer-100 px-4 py-3 text-sm font-semibold text-efarmer-800 hover:border-efarmer-400 hover:bg-efarmer-50 transition">
                            Goat buying guide
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                        <a href="{{ route('shipping') }}" class="flex items-center justify-between rounded-2xl border border-efarmer-100 px-4 py-3 text-sm font-semibold text-efarmer-800 hover:border-efarmer-400 hover:bg-efarmer-50 transition">
                            Shipping &amp; delivery
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


@endsection
