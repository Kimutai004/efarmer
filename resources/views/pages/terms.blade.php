@extends('layouts.app')

@section('title', 'Terms & Conditions | Efarmer')
@section('description', 'The terms that govern buying and selling goats on the Efarmer marketplace.')

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'The fine print',
    'title' => 'Terms & Conditions',
    'subtitle' => 'Last updated ' . date('F Y') . '. By using Efarmer you agree to the terms below.',
    'crumb' => 'Terms',
])

<section class="py-16 lg:py-20">

    <div class="max-w-4xl mx-auto px-5 lg:px-8">

        <div class="card-soft p-8 lg:p-12 article-prose">

            <h2>1. The marketplace</h2>

            <p>
                Efarmer sells its own goats online to buyers across Kenya. Efarmer
                lists and describes each goat, processes payments through M-Pesa and
                coordinates delivery from order to drop-off.
            </p>

            <h2>2. Our listings</h2>

            <p>Efarmer commits to:</p>

            <ul>
                <li>Provide accurate information about breed, age, weight, health and location.</li>
                <li>Publish real photos and health records for every goat listed.</li>
                <li>Make goats available for inspection and collection after a confirmed order.</li>
                <li>Honour the confirmed sale price once payment is received.</li>
            </ul>

            <h2>3. Buyer responsibilities</h2>

            <p>Buyers must:</p>

            <ul>
                <li>Confirm the details of a goat before completing checkout.</li>
                <li>Provide correct contact and delivery information.</li>
                <li>Inspect animals on arrival and report issues immediately.</li>
            </ul>

            <h2>4. Payments</h2>

            <p>
                Payments are settled through M-Pesa. Each confirmed payment issues
                a digital receipt with a unique reference. Transport fees shown at
                checkout are charged together with the goat price.
            </p>

            <h2>5. Delivery</h2>

            <p>
                Delivery is arranged after payment confirmation. Our team
                agrees a drop-off point with the buyer, and livestock is transported
                using suitable vehicles. Efarmer is not liable for delays caused by
                road conditions, weather or events outside its control.
            </p>

            <h2>6. Cancellations &amp; refunds</h2>

            <p>
                Orders may be cancelled before transport is arranged. Where an
                animal is misrepresented, Efarmer will investigate and may refund
                or replace the animal. To raise a dispute, contact
                support@efarmer.co.ke with your payment reference.
            </p>

            <h2>7. Contact</h2>

            <p>
                For questions about these terms, reach us at
                <strong>+254 712 345 678</strong> or
                <strong>support@efarmer.co.ke</strong>.
            </p>

        </div>

    </div>

</section>

@endsection
