@extends('layouts.app')

@section('title', 'Privacy Policy | Efarmer')
@section('description', 'How Efarmer collects, uses and protects your personal information.')

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'Your data, respected',
    'title' => 'Privacy Policy',
    'subtitle' => 'Last updated ' . date('F Y') . '. Here is how we handle your information.',
    'crumb' => 'Privacy',
])

<section class="py-16 lg:py-20">

    <div class="max-w-4xl mx-auto px-5 lg:px-8">

        <div class="card-soft p-8 lg:p-12 article-prose">

            <h2>Information we collect</h2>

            <p>To run the marketplace we may collect:</p>

            <ul>
                <li>Contact details you provide (name, phone, email, delivery location).</li>
                <li>Transaction records such as payment references, amounts and receipts.</li>
            </ul>

            <h2>How we use information</h2>

            <p>We use your information to:</p>

            <ul>
                <li>Process orders, payments and deliveries.</li>
                <li>Communicate with you about listings, orders and support.</li>
                <li>Improve the platform and keep it secure.</li>
            </ul>

            <p>
                We never sell your personal information. Payment processing is
                handled through M-Pesa and we only share delivery details with the
                parties needed to complete your order.
            </p>

            <h2>Data security</h2>

            <p>
                We take reasonable technical and organisational measures to protect
                information stored within the platform, including authenticated
                access, encrypted connections and restricted internal access.
            </p>

            <h2>Your choices</h2>

            <p>
                You can update your details, request a copy of the information we
                hold about you, or ask us to delete your account by contacting
                support@efarmer.co.ke.
            </p>

            <h2>Contact</h2>

            <p>
                For privacy questions, reach us at
                <strong>+254 712 345 678</strong> or
                <strong>support@efarmer.co.ke</strong>.
            </p>

        </div>

    </div>

</section>

@endsection
