@extends('layouts.app')

@section('title', 'Register | Efarmer')

@section('content')

<section class="py-16 bg-gray-50">

    <div class="max-w-lg mx-auto px-5">

        <div class="bg-white border rounded-2xl p-8">

            <div class="text-center">

                <div class="text-4xl font-extrabold text-efarmer-800">
                    E<span class="text-efarmer-500">f</span>armer
                </div>

                <h1 class="text-2xl font-bold mt-5">
                    Create Your Account
                </h1>

                <p class="text-gray-500 mt-2">
                    Join thousands of farmers and buyers.
                </p>

            </div>


            <form class="mt-8 space-y-5">

                <div>

                    <label class="font-semibold">
                        Full Name
                    </label>

                    <input
                        type="text"
                        class="w-full border rounded-lg px-4 py-3 mt-2"
                        placeholder="John Kamau"
                    >

                </div>


                <div>

                    <label class="font-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        class="w-full border rounded-lg px-4 py-3 mt-2"
                        placeholder="john@example.com"
                    >

                </div>


                <div>

                    <label class="font-semibold">
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        class="w-full border rounded-lg px-4 py-3 mt-2"
                        placeholder="+254..."
                    >

                </div>


                <div>

                    <label class="font-semibold">
                        I want to
                    </label>

                    <select class="w-full border rounded-lg px-4 py-3 mt-2">

                        <option>Buy goats</option>
                        <option>Sell goats</option>
                        <option>Buy and sell goats</option>

                    </select>

                </div>


                <div>

                    <label class="font-semibold">
                        Password
                    </label>

                    <input
                        type="password"
                        class="w-full border rounded-lg px-4 py-3 mt-2"
                    >

                </div>


                <div>

                    <label class="font-semibold">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        class="w-full border rounded-lg px-4 py-3 mt-2"
                    >

                </div>


                <label class="flex gap-2 text-sm text-gray-600">

                    <input type="checkbox">

                    I agree to the
                    <a href="{{ route('terms') }}" class="text-efarmer-600">
                        Terms & Conditions
                    </a>

                </label>


                <button
                    class="w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-3 rounded-lg font-bold"
                >
                    Create Account
                </button>

            </form>


            <p class="text-center text-gray-500 mt-7">

                Already have an account?

                <a
                    href="{{ route('login') }}"
                    class="text-efarmer-600 font-semibold"
                >
                    Login
                </a>

            </p>

        </div>

    </div>

</section>

@endsection