@extends('layouts.app')

@section('title', 'FAQs | Efarmer')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        <h1 class="text-4xl md:text-5xl font-extrabold">
            Frequently Asked Questions
        </h1>

    </div>

</section>


<section class="py-16">

    <div class="max-w-4xl mx-auto px-5">

        <div class="space-y-4">

            @foreach([
                ['q' => 'How do I buy a goat?', 'a' => 'Browse the available goats, open a listing and contact the seller to discuss the purchase.'],
                ['q' => 'Can I sell my goats on Efarmer?', 'a' => 'Yes. Register as a seller and submit your goat listing.'],
                ['q' => 'Are sellers verified?', 'a' => 'Efarmer is designed to verify sellers before approving listings.'],
                ['q' => 'Does Efarmer provide delivery?', 'a' => 'Delivery arrangements can be coordinated between buyers, sellers and delivery partners.'],
                ['q' => 'How do I contact a seller?', 'a' => 'Open a goat listing and use the available contact options.']
            ] as $faq)

                <details class="border rounded-xl p-5">

                    <summary class="font-bold cursor-pointer">
                        {{ $faq['q'] }}
                    </summary>

                    <p class="text-gray-600 mt-4 leading-7">
                        {{ $faq['a'] }}
                    </p>

                </details>

            @endforeach

        </div>

    </div>

</section>

@endsection