@extends('admin.layouts.app')

@section('title', 'Add Customer')

@section('page-title', 'Add Customer')

@section('content')

<div class="max-w-3xl">

<form
    method="POST"
    action="{{ route('admin.customers.store') }}"
    class="bg-white rounded-2xl border border-gray-100 p-6 md:p-8 space-y-5"
>

    @csrf

    <div class="grid md:grid-cols-2 gap-5">

        <div>
            <label class="form-label">
                Full Name *
            </label>

            <input
                name="name"
                required
                class="form-input"
            >
        </div>

        <div>
            <label class="form-label">
                Phone *
            </label>

            <input
                name="phone"
                required
                class="form-input"
                placeholder="07XXXXXXXX"
            >
        </div>

        <div>
            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-input"
            >
        </div>

        <div>
            <label class="form-label">
                Location
            </label>

            <input
                name="location"
                class="form-input"
                placeholder="County / Town"
            >
        </div>

        <div class="md:col-span-2">
            <label class="form-label">
                Address
            </label>

            <input
                name="address"
                class="form-input"
            >
        </div>

        <div class="md:col-span-2">
            <label class="form-label">
                Notes
            </label>

            <textarea
                name="notes"
                rows="4"
                class="form-input"
            ></textarea>
        </div>

    </div>

    <button class="w-full py-3 bg-green-700 text-white rounded-xl font-bold">
        Save Customer
    </button>

</form>

</div>

<style>

.form-label {
    display:block;
    font-size:.875rem;
    font-weight:700;
    margin-bottom:.5rem;
}

.form-input {
    width:100%;
    border:1px solid #e5e7eb;
    border-radius:.75rem;
    padding:.75rem 1rem;
}

</style>

@endsection