@extends('layouts.app')

@section('title', 'Efarmer Blog')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        <span class="text-green-300 font-semibold">
            EFARMER BLOG
        </span>

        <h1 class="text-4xl md:text-5xl font-extrabold mt-3">
            Farming Tips & Insights
        </h1>

        <p class="text-green-100 mt-5 max-w-2xl">
            Learn about goat farming, animal health,
            breeding, nutrition and livestock markets.
        </p>

    </div>

</section>


<section class="py-16 bg-gray-50">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">


            @foreach([
                [
                    'title' => 'How to Choose a Healthy Goat',
                    'category' => 'Goat Health',
                    'image' => 'https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'title' => 'Best Goat Breeds for Kenyan Farmers',
                    'category' => 'Breeding',
                    'image' => 'https://images.unsplash.com/photo-1516467508483-a7212febe31a?auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'title' => 'Goat Feeding and Nutrition Guide',
                    'category' => 'Nutrition',
                    'image' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=800&q=80'
                ]
            ] as $post)

                <article class="bg-white border rounded-xl overflow-hidden card-hover">

                    <img
                        src="{{ $post['image'] }}"
                        class="w-full h-56 object-cover"
                    >

                    <div class="p-6">

                        <span class="text-sm font-semibold text-efarmer-600">
                            {{ $post['category'] }}
                        </span>

                        <h2 class="text-xl font-bold mt-3">
                            {{ $post['title'] }}
                        </h2>

                        <p class="text-gray-500 mt-3">
                            Practical information to help farmers
                            improve goat production.
                        </p>

                        <a
                            href="{{ route('blog.show', 'goat-farming-guide') }}"
                            class="inline-flex items-center gap-2 text-efarmer-600 font-semibold mt-5"
                        >
                            Read Article
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    </div>

</section>

@endsection