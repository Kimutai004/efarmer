@extends('layouts.app')

@section('title', 'FAQs | Efarmer Help & Support')
@section('description', 'Answers to common questions about buying goats, selling on Efarmer, M-Pesa payments and delivery across Kenya.')

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'Help & support',
    'title' => 'Questions? Answers.',
    'subtitle' => 'Everything you need to know about buying, selling, paying and delivery on Efarmer.',
    'image' => 'WhatsApp Image 2026-08-27 at 13.12.15.jpeg',
    'crumb' => 'FAQs',
])

<section class="py-16 lg:py-20">

    <div class="max-w-4xl mx-auto px-5 lg:px-8">

        <div class="space-y-4">

            @foreach([
                ['q' => 'How do I buy a goat on Efarmer?', 'a' => 'Browse the marketplace, tap any goat to see photos, health records and price, then checkout. You will receive an M-Pesa prompt on your phone, an instant receipt, and our team will arrange delivery.'],
                ['q' => 'Do farmers list their own goats on Efarmer?', 'a' => 'Not right now — Efarmer sells its own goats directly. Every animal is raised, vet-checked and photographed by our team before it is listed, with breed, age, weight and health records attached.'],
                ['q' => 'Are the goats verified?', 'a' => 'Yes. Every goat is reviewed before it goes live. Listings show breed, age, weight and health records so you know what you are paying for.'],
                ['q' => 'How do I pay?', 'a' => 'Checkout is done with M-Pesa. You receive a secure payment prompt on the phone number you provide, and a digital receipt is issued immediately after payment.'],
                ['q' => 'Does Efarmer deliver?', 'a' => 'Yes — we arrange safe livestock transport after every confirmed order and deliver to your farm or nearest town within Kenya.'],
                ['q' => 'Can I visit or inspect a goat before buying?', 'a' => 'Absolutely. Contact our team on +254 712 345 678 or WhatsApp and we will coordinate an inspection before you pay.'],
                ['q' => 'What does delivery cost?', 'a' => 'A standard transport fee of KSh 300 per goat applies at checkout. Remote or long-distance deliveries may be quoted separately by our team.'],
                ['q' => 'I paid but did not receive my goats yet. What now?', 'a' => 'Your order is confirmed and safe. Deliveries are scheduled by our logistics team. Share your payment reference with our team and we will track it down immediately.'],
            ] as $faq)

                <details class="faq-item group card-soft overflow-hidden">

                    <summary class="flex items-center justify-between gap-4 p-5 sm:p-6 cursor-pointer list-none">
                        <span class="font-bold text-efarmer-900">{{ $faq['q'] }}</span>

                        <span class="faq-icon w-9 h-9 rounded-xl bg-efarmer-50 text-efarmer-700 flex items-center justify-center flex-shrink-0 transition-all">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </span>
                    </summary>

                    <div class="px-5 sm:px-6 pb-6 text-gray-600 leading-7 text-sm">
                        {{ $faq['a'] }}
                    </div>

                </details>

            @endforeach

        </div>

        <div class="card-soft p-8 mt-10 text-center">

            <span class="w-12 h-12 mx-auto rounded-2xl bg-clay-50 text-clay-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-headset"></i>
            </span>

            <h2 class="font-display text-xl font-extrabold text-efarmer-900 mt-4">
                Still need help?
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Talk to a real person — we reply within one working day.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mt-6">

                <a href="{{ route('contact') }}" class="btn btn-primary">
                    <i class="fa-solid fa-envelope"></i>
                    Contact us
                </a>

                <a href="https://wa.me/254712345678" class="btn btn-outline">
                    <i class="fa-brands fa-whatsapp"></i>
                    WhatsApp
                </a>

            </div>

        </div>

    </div>

</section>

@endsection

@push('styles')
<style>
    .faq-item summary::-webkit-details-marker { display: none; }

    .faq-item[open] .faq-icon {
        background: #d27c37;
        color: #fff;
        transform: rotate(45deg);
    }
</style>
@endpush
