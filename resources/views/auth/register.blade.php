@extends('layouts.app')

@section('title', 'Register | Efarmer')
@section('content')

<section class="min-h-[700px] bg-gray-50 flex items-center py-16">
<div class="max-w-md mx-auto w-full px-5">

    <div class="bg-white border rounded-2xl p-8 shadow-sm">

        <div class="text-center">

            <div class="text-4xl font-extrabold text-efarmer-800">
                E<span class="text-efarmer-500">f</span>armer
            </div>

            <h1 class="text-2xl font-bold mt-6">
                Create Account
            </h1>

            <p class="text-gray-500 mt-2">
                Join Efarmer to buy and sell goats.
            </p>

        </div>

        @if ($errors->any())
            <div class="mt-5 bg-red-50 border border-red-200 text-red-600 rounded-lg p-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="mt-8 space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="first_name" class="font-semibold">First Name</label>
                    <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" required autofocus class="w-full border rounded-lg px-4 py-3 mt-2">
                </div>
                <div>
                    <label for="last_name" class="font-semibold">Last Name</label>
                    <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" required class="w-full border rounded-lg px-4 py-3 mt-2">
                </div>
            </div>

            <div>
                <label for="email" class="font-semibold">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full border rounded-lg px-4 py-3 mt-2" placeholder="you@example.com">
            </div>

            <div>
                <label for="phone" class="font-semibold">Phone Number</label>
                <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required class="w-full border rounded-lg px-4 py-3 mt-2" placeholder="0712345678">
            </div>

            <div>
                <label for="national_id" class="font-semibold">National ID</label>
                <input id="national_id" name="national_id" type="text" value="{{ old('national_id') }}" class="w-full border rounded-lg px-4 py-3 mt-2" placeholder="Optional">
            </div>

            <div>
                <label for="password" class="font-semibold">Password</label>
                <input id="password" name="password" type="password" required class="w-full border rounded-lg px-4 py-3 mt-2" placeholder="Min 8 characters">
            </div>

            <div>
                <label for="password_confirmation" class="font-semibold">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full border rounded-lg px-4 py-3 mt-2" placeholder="Repeat password">
            </div>

            <button type="submit" class="w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-3 rounded-lg font-bold transition">
                Create Account
            </button>

        </form>

        <p class="text-center text-gray-500 mt-7">
            Already have an account?
            <a href="{{ route('login') }}" class="text-efarmer-600 font-semibold">
                Login
            </a>
        </p>

    </div>

</div>

</section>

@endsection