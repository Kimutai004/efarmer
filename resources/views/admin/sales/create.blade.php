@extends('admin.layouts.app')

@section('title', 'New Sale')

@section('page-title', 'New Sale')

@section('content')

<form
    method="POST"
    action="{{ route('admin.sales.store') }}"
    id="saleForm"
>

    @csrf

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Goat Selection -->

        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100">

            <div class="p-6 border-b border-gray-100">

                <h2 class="text-xl font-extrabold">
                    Select Goats
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Only available goats can be sold.
                </p>

            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @forelse($goats as $goat)

                        <label
                            class="goat-card border border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-green-500 transition"
                        >

                            <input
                                type="checkbox"
                                class="goat-checkbox hidden"
                                data-id="{{ $goat->id }}"
                                data-price="{{ $goat->selling_price }}"
                                data-tag="{{ $goat->tag_number }}"
                            >

                            <div class="flex items-center gap-4">

                                <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden">

                                    @if($goat->primary_photo)

                                        <img
                                            src="{{ asset('storage/'.$goat->primary_photo->path) }}"
                                            class="w-full h-full object-cover"
                                        >

                                    @else

                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fa-solid fa-cow"></i>
                                        </div>

                                    @endif

                                </div>

                                <div class="flex-1">

                                    <p class="font-extrabold">
                                        {{ $goat->tag_number }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $goat->breed->name }}
                                        ·
                                        {{ ucfirst($goat->gender) }}
                                    </p>

                                    <p class="font-bold text-green-700 mt-1">
                                        KES {{ number_format($goat->selling_price, 2) }}
                                    </p>

                                </div>

                                <div class="check-icon w-7 h-7 rounded-full border-2 border-gray-300 flex items-center justify-center">

                                    <i class="fa-solid fa-check text-white text-xs hidden"></i>

                                </div>

                            </div>

                        </label>

                    @empty

                        <div class="md:col-span-2 p-10 text-center text-gray-500">

                            <i class="fa-solid fa-cow text-4xl text-gray-300"></i>

                            <p class="font-bold mt-3">
                                No goats available for sale.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        <!-- Sale Summary -->

        <div>

            <div class="bg-white rounded-2xl border border-gray-100 sticky top-24">

                <div class="p-6 border-b border-gray-100">

                    <h2 class="font-extrabold text-lg">
                        Sale Summary
                    </h2>

                </div>

                <div class="p-6 space-y-5">

                    <div>

                        <label class="form-label">
                            Customer
                        </label>

                        <select
                            name="customer_id"
                            required
                            class="form-input"
                        >

                            <option value="">
                                Select customer
                            </option>

                            @foreach($customers as $customer)

                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                    — {{ $customer->phone }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div>

                        <label class="form-label">
                            Sale Date
                        </label>

                        <input
                            type="date"
                            name="sale_date"
                            value="{{ now()->format('Y-m-d') }}"
                            required
                            class="form-input"
                        >

                    </div>


                    <div>

                        <p class="form-label">
                            Selected Goats
                        </p>

                        <div
                            id="selectedGoats"
                            class="space-y-2"
                        >

                            <p class="text-sm text-gray-400">
                                No goats selected.
                            </p>

                        </div>

                    </div>


                    <div class="border-t border-gray-100 pt-5 space-y-3">

                        <div class="flex justify-between">

                            <span class="text-gray-500">
                                Subtotal
                            </span>

                            <strong id="subtotal">
                                KES 0.00
                            </strong>

                        </div>

                        <div>

                            <label class="form-label">
                                Discount
                            </label>

                            <input
                                type="number"
                                name="discount"
                                id="discount"
                                value="0"
                                min="0"
                                step="0.01"
                                class="form-input"
                            >

                        </div>

                        <div class="flex justify-between text-lg">

                            <span class="font-bold">
                                Total
                            </span>

                            <strong
                                id="total"
                                class="text-green-700"
                            >
                                KES 0.00
                            </strong>

                        </div>

                    </div>


                    <div>

                        <label class="form-label">
                            Amount Paid
                        </label>

                        <input
                            type="number"
                            name="amount_paid"
                            id="amountPaid"
                            value="0"
                            min="0"
                            step="0.01"
                            class="form-input"
                        >

                    </div>


                    <div>

                        <label class="form-label">
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            class="form-input"
                        >

                            <option value="cash">
                                Cash
                            </option>

                            <option value="mpesa">
                                M-Pesa
                            </option>

                            <option value="bank">
                                Bank
                            </option>

                            <option value="card">
                                Card
                            </option>

                        </select>

                    </div>


                    <div>

                        <label class="form-label">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="3"
                            class="form-input"
                        ></textarea>

                    </div>


                    <button
                        type="submit"
                        class="w-full py-4 rounded-xl bg-green-700 text-white font-extrabold hover:bg-green-800"
                    >

                        <i class="fa-solid fa-check mr-2"></i>

                        Complete Sale

                    </button>

                </div>

            </div>

        </div>

    </div>

</form>


<style>

.form-label {
    display:block;
    font-size:.875rem;
    font-weight:700;
    color:#374151;
    margin-bottom:.5rem;
}

.form-input {
    width:100%;
    border:1px solid #e5e7eb;
    border-radius:.75rem;
    padding:.75rem 1rem;
}

.goat-card.selected {
    border-color:#16a34a;
    background:#f0fdf4;
}

.goat-card.selected .check-icon {
    background:#16a34a;
    border-color:#16a34a;
}

.goat-card.selected .check-icon i {
    display:block;
}

</style>


<script>

const cards =
    document.querySelectorAll('.goat-card');

const selected =
    document.getElementById('selectedGoats');

const subtotalElement =
    document.getElementById('subtotal');

const totalElement =
    document.getElementById('total');

const discountElement =
    document.getElementById('discount');

const amountPaid =
    document.getElementById('amountPaid');


function money(value)
{
    return 'KES ' + Number(value)
        .toLocaleString(
            'en-KE',
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );
}


function updateSale()
{
    let subtotal = 0;

    selected.innerHTML = '';

    const checked =
        document.querySelectorAll(
            '.goat-checkbox:checked'
        );

    if (!checked.length) {

        selected.innerHTML =
            '<p class="text-sm text-gray-400">No goats selected.</p>';

    }

    checked.forEach((checkbox, index) => {

        const id =
            checkbox.dataset.id;

        const price =
            Number(checkbox.dataset.price);

        const tag =
            checkbox.dataset.tag;

        subtotal += price;

        const input =
            document.createElement('input');

        input.type = 'hidden';

        input.name =
            `goats[${index}][id]`;

        input.value = id;

        selected.appendChild(input);


        const priceInput =
            document.createElement('input');

        priceInput.type = 'hidden';

        priceInput.name =
            `goats[${index}][price]`;

        priceInput.value = price;

        selected.appendChild(priceInput);


        const row =
            document.createElement('div');

        row.className =
            'flex justify-between items-center bg-gray-50 rounded-lg p-3';

        row.innerHTML = `
            <span class="font-semibold">${tag}</span>
            <span class="font-bold">${money(price)}</span>
        `;

        selected.appendChild(row);

    });


    const discount =
        Math.min(
            Number(discountElement.value || 0),
            subtotal
        );

    const total =
        subtotal - discount;

    subtotalElement.innerText =
        money(subtotal);

    totalElement.innerText =
        money(total);

    amountPaid.max = total;
}


cards.forEach(card => {

    const checkbox =
        card.querySelector(
            '.goat-checkbox'
        );

    card.addEventListener(
        'click',
        () => {

            checkbox.checked =
                !checkbox.checked;

            card.classList.toggle(
                'selected',
                checkbox.checked
            );

            updateSale();

        }
    );

});


discountElement.addEventListener(
    'input',
    updateSale
);

amountPaid.addEventListener(
    'input',
    updateSale
);

</script>

@endsection