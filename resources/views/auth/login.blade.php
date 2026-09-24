@extends('layouts.app')

@section('title', 'Login | Efarmer')

@section('content')

<section class="min-h-[700px] bg-gray-50 flex items-center py-16">
<div class="max-w-md mx-auto w-full px-5">

    <div class="bg-white border rounded-2xl p-8 shadow-sm">

        <div class="text-center">

            <div class="text-4xl font-extrabold text-efarmer-800">
                E<span class="text-efarmer-500">f</span>armer
            </div>

            <h1 class="text-2xl font-bold mt-6">
                Welcome Back
            </h1>

            <p class="text-gray-500 mt-2">
                Login to your Efarmer account.
            </p>

        </div>


        {{-- Login Error --}}
        @if ($errors->any())

            <div class="mt-5 bg-red-50 border border-red-200 text-red-600 rounded-lg p-4">

                @foreach ($errors->all() as $error)

                    <p class="text-sm">
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- Login Form --}}
        <form
            action="{{ route('login.submit') }}"
            method="POST"
            class="mt-8 space-y-5"
        >

            @csrf


            {{-- Email --}}
            <div>

                <label
                    for="email"
                    class="font-semibold"
                >
                    Email Address
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full border rounded-lg px-4 py-3 mt-2"
                    placeholder="you@example.com"
                >

            </div>


            {{-- Password --}}
            <div>

                <label
                    for="password"
                    class="font-semibold"
                >
                    Password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="w-full border rounded-lg px-4 py-3 mt-2"
                    placeholder="••••••••"
                >

            </div>


            {{-- Remember Me --}}
            <div class="flex justify-between text-sm">

                <label class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Remember me

                </label>


                <a
                    href="#"
                    class="text-efarmer-600"
                >
                    Forgot password?
                </a>

            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-3 rounded-lg font-bold transition"
            >
                Login
            </button>

        </form>


        <p class="text-center text-gray-500 mt-7">

            Don't have an account?

            <a
                href="{{ route('register') }}"
                class="text-efarmer-600 font-semibold"
            >
                Register
            </a>

        </p>

    </div>

</div>

</section>

@endsection
