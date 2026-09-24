<?php

/*
|--------------------------------------------------------------------------
| Efarmer Blog Content
|--------------------------------------------------------------------------
| Lightweight, file-based content store for the blog. Images referenced here
| live in /public/images and are resolved with asset() inside the views.
|
| Each post supports:
|   title, category, excerpt, image, read_time, author, role, date, tags
|   sections[] -> ['id', 'title', 'kicker', 'paragraphs'[], 'checklist', 'tiles', 'table', 'figure', 'quote']
|   highlights[] -> quick summary used when a post has no long-form sections
|
*/

return [

    'posts' => [

    'goat-farming-guide' => [

        'title' => 'Complete Guide to Goat Farming in Kenya',

        'category' => 'Goat Farming',

        'excerpt' => 'Everything you need to know about starting and managing a profitable goat farming business in Kenya — from breed selection and housing to feeding, health and selling.',

        'image' => 'WhatsApp Image 2026-08-27 at 13.12.15.jpeg',

        'read_time' => '9 min read',

        'author' => 'Efarmer Livestock Team',

        'role' => 'Farm advisory desk',

        'date' => 'August 27, 2026',

        'tags' => ['Goat farming', 'Breeds', 'Feeding', 'Animal health', 'Business'],

        'sections' => [
            [
                'id' => 'planning',
                'title' => 'Plan Before You Buy',
                'kicker' => 'Set a clear goal — meat, milk or breeding',
                'paragraphs' => [
                    'Goat farming in Kenya can be a profitable business when it is run as a business. Before buying your first animal, decide what you are producing: meat for the butcher and local markets, milk for households and dairy buyers, or breeding stock for other farmers. Each goal needs a different breed, different feeding and a different timetable.',
                    'Write down your start-up budget too. Account for the animals, a simple shelter, water storage, feeds, veterinary costs and transport. Farmers who cost everything from day one rarely get caught by surprise in the dry season.',
                ],
                'checklist' => [
                    'title' => 'Your planning checklist',
                    'icon' => 'fa-clipboard-check',
                    'items' => [
                        'Choose meat, milk or breeding as your main goal',
                        'Confirm where you will sell — local market, butcher, hotel or online',
                        'Budget for feed, water, shelter and veterinary care',
                        'Check county livestock regulations for movement permits',
                    ],
                ],
            ],

            [
                'id' => 'choose-breed',
                'title' => 'Choose the Right Goat Breed',
                'kicker' => 'Match genetics to your environment and market',
                'paragraphs' => [
                    'The breed you choose determines how fast your goats grow, how much milk they produce and how well they cope with your climate. Large dairy or meat breeds do well where there is plenty of quality feed and water, while the local Small East African goat remains the hardiest option for dry, low-input areas.',
                    'Buy breeding stock from a trusted breeder or a marketplace such as Efarmer, where the breed, age, weight and health records are stated on every listing. Avoid animals with no records simply because they are cheap — unexplained losses cost far more than the price difference.',
                ],
                'table' => [
                    'head' => ['Breed', 'Best for', 'Notes'],
                    'rows' => [
                        ['Boer', 'Meat', 'Fast growth and heavy frame, needs good feed'],
                        ['Galla', 'Meat & milk', 'Thrives in arid and semi-arid counties'],
                        ['Alpine', 'Milk', 'High yields in cool highlands'],
                        ['Saanen', 'Milk', 'Excellent yields, requires good management'],
                        ['Toggenburg', 'Milk', 'Hardy, adaptable, steady producer'],
                        ['Small East African', 'Meat', 'Very hardy, low input, ideal for beginners'],
                    ],
                ],
                'figure' => [
                    'image' => 'WhatsApp Image 2026-08-27 at 13.12.19 (2).jpeg',
                    'caption' => 'Goats grazing natural browse — the cheapest feed you will ever grow.',
                ],
            ],
            [
                'id' => 'housing',
                'title' => 'Housing and Shelter',
                'kicker' => 'Dry, well ventilated and predator safe',
                'paragraphs' => [
                    'Goats need clean, dry and well-ventilated housing. A good house protects your animals from heavy rain, cold nights and predators, and it keeps them off muddy, disease-prone ground.',
                    'Raise the floor or build the pen on a well-drained slope, and allow at least 1.5 square metres per adult goat so the herd is never overcrowded. Add a feed trough and a shaded resting area next to the pen.',
                ],
                'tiles' => [
                    ['icon' => 'fa-wind', 'label' => 'Good ventilation'],
                    ['icon' => 'fa-layer-group', 'label' => 'Dry flooring'],
                    ['icon' => 'fa-arrows-left-right', 'label' => 'Space per goat'],
                    ['icon' => 'fa-glass-water', 'label' => 'Clean water'],
                ],
            ],

            [
                'id' => 'feeding',
                'title' => 'Feeding Your Goats',
                'kicker' => 'Build a balanced feeding routine',
                'paragraphs' => [
                    'Nutrition is one of the most important parts of goat farming. Goats need a balanced diet of forage, minerals and plenty of clean water. Underfed animals grow slowly, produce less milk and are far more likely to fall sick.',
                    'Use pasture and browse as the foundation of the diet, then add hay and a measured protein supplement — especially for pregnant and lactating does and for fast-growing kids. Keep a mineral block available at all times and change drinking water daily.',
                ],
                'checklist' => [
                    'title' => 'A balanced ration includes',
                    'icon' => 'fa-leaf',
                    'items' => [
                        'Pasture and browse for bulk fibre',
                        'Hay or silage for the dry season',
                        'Protein supplement for does in milk and growing kids',
                        'Mineral block and constant clean water',
                    ],
                ],
            ],

            [
                'id' => 'health',
                'title' => 'Health Management',
                'kicker' => 'Prevent before you treat',
                'paragraphs' => [
                    'A simple herd health routine keeps losses low. Deworm on a schedule recommended for your area, vaccinate against common diseases such as CCPP and enterotoxaemia, and trim hooves regularly so animals can walk and graze comfortably.',
                    'Isolate every new animal for at least two weeks before mixing it with the herd, and keep a written record of each treatment. Records help you catch problems early and they add real value when you sell breeding stock.',
                ],
                'figure' => [
                    'image' => 'WhatsApp Image 2026-08-27 at 13.11.41.jpeg',
                    'caption' => 'A well-kept boma keeps the herd dry, clean and easy to inspect.',
                ],
            ],

            [
                'id' => 'buying-well',
                'title' => 'Buying Well on Efarmer',
                'kicker' => 'A healthy goat, fairly priced, delivered safely',
                'paragraphs' => [
                    'A good purchase starts with records. Check the listed breed, age and live weight, study the photos in daylight, and ask our team about vaccination and deworming history — a goat with nothing to hide will have nothing to hide.',
                    'On Efarmer every goat is vet-checked and listed by our team with full records attached. Buyers pay through M-Pesa and delivery is arranged after the order — no long journeys to market and no middlemen between you and the animal you chose.',
                ],
                'quote' => 'Compare price per kilogram, insist on health records, and never skip the inspection — that is how a cheap goat stays cheap.',
            ],

        ],
    ],

    'choosing-a-healthy-goat' => [

        'title' => 'How to Choose a Healthy Goat',

        'category' => 'Goat Health',

        'excerpt' => 'Five quick checks that help you avoid buying a sick animal — eyes, coat, movement, body condition and records.',

        'image' => 'WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg',

        'read_time' => '5 min read',

        'author' => 'Efarmer Livestock Team',

        'role' => 'Farm advisory desk',

        'date' => 'August 27, 2026',

        'tags' => ['Goat health', 'Buying', 'Checklist'],

        'highlights' => [
            'Bright, clear eyes with no discharge or cloudiness',
            'Smooth coat with no bald patches, wounds or ticks',
            'Walks easily and stands on all four legs without stiffness',
            'Firm body condition — not too thin, not bloated',
            'Ask for vaccination and deworming records before you pay',
        ],

        'sections' => [

            [
                'id' => 'inspect',
                'title' => 'Inspect Before You Buy',
                'kicker' => 'Ten minutes now saves months of treatment later',
                'paragraphs' => [
                    'A healthy goat is alert, curious and moves without effort. Take your time with the animal: watch it walk, check its eyes and gums, run your hand along the coat and look closely at the hooves and under the tail.',
                ],
                'checklist' => [
                    'title' => 'Red flags to walk away from',
                    'icon' => 'fa-triangle-exclamation',
                    'items' => [
                        'Runny nose, coughing or laboured breathing',
                        'Cloudy eyes or pale gums',
                        'Limping, swollen joints or overgrown hooves',
                        'Severe diarrhoea or a dirty, soiled coat',
                        'No vaccination or treatment records at all',
                    ],
                ],
                'figure' => [
                    'image' => 'WhatsApp Image 2026-08-27 at 13.12.15.jpeg',
                    'caption' => 'Healthy goats move freely and graze steadily through the day.',
                ],
            ],

        ],
    ],
    'best-goat-breeds-kenya' => [

        'title' => 'Best Goat Breeds for Kenyan Farmers',

        'category' => 'Breeding',

        'excerpt' => 'Boer, Galla, Alpine, Saanen, Toggenburg or the local Small East African — which breed fits your farm and your market?',

        'image' => 'WhatsApp Image 2026-08-27 at 13.11.41.jpeg',

        'read_time' => '6 min read',

        'author' => 'Efarmer Livestock Team',

        'role' => 'Farm advisory desk',

        'date' => 'August 27, 2026',

        'tags' => ['Breeds', 'Breeding', 'Meat', 'Milk'],

        'highlights' => [
            'Boer — the leading meat breed, fast growth and a heavy frame',
            'Galla — excellent for arid and semi-arid counties',
            'Alpine and Saanen — top dairy choices for the highlands',
            'Toggenburg — hardy, adaptable and a steady milk producer',
            'Small East African — the hardiest option for low-input farms',
        ],

        'sections' => [

            [
                'id' => 'match',
                'title' => 'Match the Breed to Your Farm',
                'kicker' => 'Climate, feed and market decide',
                'paragraphs' => [
                    'There is no single best breed. A dairy breed will disappoint you in a dry area with limited water, and a hardy local breed will not give you the fast growth a meat contract demands.',
                    'Start with the breed your climate and feed can support, then improve it gradually through crossbreeding with a recorded buck from a reputable breeder.',
                ],
                'table' => [
                    'head' => ['Breed', 'Best for', 'Notes'],
                    'rows' => [
                        ['Boer', 'Meat', 'Fast growth, heavy frame, good feed required'],
                        ['Galla', 'Meat & milk', 'Suited to dry and semi-arid counties'],
                        ['Alpine', 'Milk', 'Strong yields in cool, high-altitude areas'],
                        ['Saanen', 'Milk', 'Highest yields, needs careful management'],
                        ['Toggenburg', 'Milk', 'Hardy and consistent producer'],
                        ['Small East African', 'Meat', 'Very hardy, low input, great for beginners'],
                    ],
                ],
            ],

        ],
    ],

    'goat-feeding-nutrition-guide' => [

        'title' => 'Goat Feeding and Nutrition Guide',

        'category' => 'Nutrition',

        'excerpt' => 'How to build a low-cost ration with pasture, browse, hay, minerals and just enough supplement to hit your production goals.',

        'image' => 'WhatsApp Image 2026-08-27 at 13.12.19 (2).jpeg',

        'read_time' => '6 min read',

        'author' => 'Efarmer Livestock Team',

        'role' => 'Farm advisory desk',

        'date' => 'August 27, 2026',

        'tags' => ['Nutrition', 'Feeding', 'Costs'],

        'highlights' => [
            'Feed forage first — pasture and browse are your cheapest option',
            'Store hay for the dry season, not after it starts',
            'Supplement protein for lactating does and growing kids',
            'Keep a mineral block available at all times',
            'Clean, fresh water increases intake and milk yield',
        ],

        'sections' => [

            [
                'id' => 'ration',
                'title' => 'Build a Low-Cost Ration',
                'kicker' => 'Forage first, supplement second',
                'paragraphs' => [
                    'Feed cost is where most goat farms make or lose money. Grass, browse and well-made hay should carry your herd through most of the year; supplements are there to fill gaps, not to replace forage.',
                    'Group your animals — kids, dry does, pregnant does and lactating does all need different amounts. Feeding the whole herd one ration wastes money on animals that do not need it.',
                ],
                'tiles' => [
                    ['icon' => 'fa-leaf', 'label' => 'Pasture'],
                    ['icon' => 'fa-seedling', 'label' => 'Browse'],
                    ['icon' => 'fa-wheat-awn', 'label' => 'Hay'],
                    ['icon' => 'fa-droplet', 'label' => 'Clean water'],
                ],
            ],

        ],
    ],

    ],
];

