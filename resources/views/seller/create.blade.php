@extends('layouts.app')

@section('title', 'Sell Your Goat | Efarmer')
@section('description', 'List your goat for sale on Efarmer marketplace')

@section('content')

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-5">

        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-efarmer-900">Sell Your Goat</h1>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto">
                Reach thousands of buyers across Kenya. Fill in the details below to list your goat.
            </p>
        </div>

        <div class="bg-white rounded-2xl border shadow-sm p-8">

            <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-8">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-info text-green-600 mt-1"></i>
                    <div>
                        <p class="font-semibold text-green-800">How it works</p>
                        <p class="text-sm text-green-700 mt-1">
                            Submit your goat details and our team will review and list it on the marketplace.
                            You'll be contacted to confirm the listing.
                        </p>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block font-semibold mb-2">Your Name <span class="text-red-500">*</span></label>
                        <input type="text" name="seller_name" required class="w-full border rounded-lg px-4 py-3" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="seller_phone" required class="w-full border rounded-lg px-4 py-3" placeholder="0712345678">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Goat Name/Tag</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-4 py-3" placeholder="e.g. Boer Buck #001">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Breed <span class="text-red-500">*</span></label>
                        <select name="breed" required class="w-full border rounded-lg px-4 py-3">
                            <option value="">Select Breed</option>
                            <option>Boer</option>
                            <option>Galla</option>
                            <option>Alpine</option>
                            <option>Saanen</option>
                            <option>Toggenburg</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" required class="w-full border rounded-lg px-4 py-3">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Weight (kg)</label>
                        <input type="number" step="0.1" name="weight" class="w-full border rounded-lg px-4 py-3" placeholder="45">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Location <span class="text-red-500">*</span></label>
                        <input type="text" name="location" required class="w-full border rounded-lg px-4 py-3" placeholder="e.g. Nakuru">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Asking Price (KES) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" required class="w-full border rounded-lg px-4 py-3" placeholder="18000">
                    </div>

                </div>

                <div>
                    <label class="block font-semibold mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-3" placeholder="Describe your goat - health, age, vaccination status, etc."></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Photos</label>
                    <input type="file" name="photos[]" multiple accept="image/*" class="w-full border rounded-lg px-4 py-3">
                    <p class="text-xs text-gray-500 mt-1">Upload clear photos of your goat.</p>
                </div>

                <button type="submit" class="w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-4 rounded-xl font-bold text-lg transition">
                    <i class="fa-solid fa-paper-plane mr-2"></i>
                    Submit Listing
                </button>

            </form>

        </div>

    </div>
</section>

@endsection