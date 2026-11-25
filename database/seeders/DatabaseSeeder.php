<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\KbArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Cedarline Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(919) 555-0148',
            ]
        );
        $admin->syncRoles(['admin']);

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@cedarline.example'],
            [
                'name' => 'Jordan Hale',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(919) 555-0152',
            ]
        );
        $manager->syncRoles(['manager']);

        $staff = User::query()->updateOrCreate(
            ['email' => 'crew@cedarline.example'],
            [
                'name' => 'Sam Ortega',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(919) 555-0166',
            ]
        );
        $staff->syncRoles(['staff']);

        $settings = [
            'company_name' => 'Cedarline Residential Painting',
            'phone' => '(919) 555-0148',
            'email' => 'hello@cedarlinepainting.example',
            'address' => '2148 Glenwood Ave, Raleigh, NC 27608',
            'whatsapp' => '+19195550148',
            'service_area' => 'Raleigh–Durham, Cary, Chapel Hill, Wake Forest',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $services = [
            [
                'name' => 'Interior Room Painting',
                'slug' => 'interior-room-painting',
                'tagline' => 'Clean lines, low-VOC comfort',
                'summary' => 'Bedrooms, living rooms, and hallways with careful masking and furniture protection.',
                'description' => "We wash walls, fill nail holes, sand glossy spots, and cut crisp lines at ceilings and trim.\nLow-VOC paints keep rooms livable sooner. Typical turnaround: 1–3 days per zone.",
                'image_url' => 'https://images.unsplash.com/photo-1615529182904-14819c35d72b?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 850,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Exterior Home Painting',
                'slug' => 'exterior-home-painting',
                'tagline' => 'Weather-ready color for Piedmont humidity',
                'summary' => 'Power-wash, scrape, prime, and coat siding, trim, and fascia with durable acrylics.',
                'description' => "Exterior longevity starts with washing and moisture checks. We prime bare wood, seal gaps, and choose sheens that shed Triangle storms.\nScaffolding and ladder plans are shared before day one.",
                'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 4200,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Cabinet Refinishing',
                'slug' => 'cabinet-refinishing',
                'tagline' => 'Kitchen refresh without a full remodel',
                'summary' => 'Degloss, repair, and spray or brush cabinets for a furniture-grade finish.',
                'description' => "Cedarline stages kitchens carefully: label doors, sand methodically, and apply conversion or waterborne enamels.\nExpect 4–8 days depending on door count and cure time.",
                'image_url' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 2800,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Deck & Fence Staining',
                'slug' => 'deck-fence-staining',
                'tagline' => 'UV protection for outdoor wood',
                'summary' => 'Clean, brighten, and stain decks and fences with breathable outdoor finishes.',
                'description' => "We mill-glaze checks, treat mildew, and apply penetrating or film-forming stains suited to sun exposure.\nIdeal seasons: late spring and early fall.",
                'image_url' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 1600,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'Trim & Door Enameling',
                'slug' => 'trim-door-enameling',
                'tagline' => 'Crisp millwork that frames every room',
                'summary' => 'Doors, baseboards, and casing finished with smooth enamel systems.',
                'description' => "High-touch trim needs slow, level coats. We sand between coats and keep dust low with HEPA vacs.",
                'image_url' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 1200,
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'name' => 'Color Consultation',
                'slug' => 'color-consultation',
                'tagline' => 'Samples that respect your light',
                'summary' => 'On-site color guidance with sample boards tuned to north/south light.',
                'description' => "Bring Pinterest boards or start fresh. We leave large samples and recommend undertones that survive fluorescent kitchens and warm LED living rooms.",
                'image_url' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1200&q=80',
                'base_price' => 175,
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service);
        }

        $products = [
            ['name' => 'Interior Eggshell - Soft Linen', 'sku' => 'PNT-INT-LIN-5', 'category' => 'Paint', 'unit_cost' => 28, 'unit_price' => 46, 'stock_qty' => 42, 'unit' => 'gallon', 'reorder_level' => 10],
            ['name' => 'Exterior Acrylic - Harbor Sage', 'sku' => 'PNT-EXT-SAG-5', 'category' => 'Paint', 'unit_cost' => 34, 'unit_price' => 58, 'stock_qty' => 28, 'unit' => 'gallon', 'reorder_level' => 8],
            ['name' => 'Stain-Blocking Primer', 'sku' => 'PRM-STN-1', 'category' => 'Primer', 'unit_cost' => 18, 'unit_price' => 32, 'stock_qty' => 36, 'unit' => 'gallon', 'reorder_level' => 12],
            ['name' => 'Painters Caulk White', 'sku' => 'CLK-WHT-10', 'category' => 'Caulk', 'unit_cost' => 2.4, 'unit_price' => 5.5, 'stock_qty' => 120, 'unit' => 'tube', 'reorder_level' => 30],
            ['name' => 'Blue Masking Tape 1.5in', 'sku' => 'TAP-BLU-15', 'category' => 'Tape', 'unit_cost' => 3.1, 'unit_price' => 6.9, 'stock_qty' => 80, 'unit' => 'roll', 'reorder_level' => 20],
            ['name' => '9in Microfiber Roller Cover', 'sku' => 'TOL-ROL-9', 'category' => 'Tools', 'unit_cost' => 4.5, 'unit_price' => 9.5, 'stock_qty' => 64, 'unit' => 'each', 'reorder_level' => 15],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product);
        }

        $customers = [
            ['name' => 'Elena Brooks', 'email' => 'elena.brooks@example.com', 'phone' => '(919) 555-2201', 'address' => '88 Birchwood Ln', 'city' => 'Raleigh', 'state' => 'NC', 'zip' => '27607'],
            ['name' => 'Marcus Chen', 'email' => 'marcus.chen@example.com', 'phone' => '(919) 555-2208', 'address' => '412 Oakmont Dr', 'city' => 'Cary', 'state' => 'NC', 'zip' => '27513'],
            ['name' => 'Priya Nair', 'email' => 'priya.nair@example.com', 'phone' => '(919) 555-2215', 'address' => '19 Hollow Creek Rd', 'city' => 'Chapel Hill', 'state' => 'NC', 'zip' => '27514'],
            ['name' => 'The Rivera Household', 'email' => 'rivera.home@example.com', 'phone' => '(919) 555-2220', 'address' => '701 Lakeview Ct', 'city' => 'Durham', 'state' => 'NC', 'zip' => '27707'],
        ];
        $customerModels = [];
        foreach ($customers as $customer) {
            $customerModels[] = Customer::query()->updateOrCreate(['email' => $customer['email']], $customer);
        }

        $interior = Service::query()->where('slug', 'interior-room-painting')->first();
        $exterior = Service::query()->where('slug', 'exterior-home-painting')->first();

        $jobs = [
            [
                'job_number' => 'CL-2401',
                'customer_id' => $customerModels[0]->id,
                'service_id' => $interior?->id,
                'assigned_to' => $staff->id,
                'title' => 'Brooks living + dining refresh',
                'status' => 'completed',
                'priority' => 'normal',
                'property_address' => '88 Birchwood Ln, Raleigh',
                'scheduled_start' => now()->subDays(20)->toDateString(),
                'scheduled_end' => now()->subDays(17)->toDateString(),
                'estimated_amount' => 2400,
                'final_amount' => 2550,
            ],
            [
                'job_number' => 'CL-2408',
                'customer_id' => $customerModels[1]->id,
                'service_id' => $exterior?->id,
                'assigned_to' => $staff->id,
                'title' => 'Chen exterior body & trim',
                'status' => 'in_progress',
                'priority' => 'high',
                'property_address' => '412 Oakmont Dr, Cary',
                'scheduled_start' => now()->subDays(2)->toDateString(),
                'scheduled_end' => now()->addDays(3)->toDateString(),
                'estimated_amount' => 7800,
                'final_amount' => null,
            ],
            [
                'job_number' => 'CL-2412',
                'customer_id' => $customerModels[2]->id,
                'service_id' => $interior?->id,
                'assigned_to' => $manager->id,
                'title' => 'Nair nursery + hallway',
                'status' => 'scheduled',
                'priority' => 'normal',
                'property_address' => '19 Hollow Creek Rd, Chapel Hill',
                'scheduled_start' => now()->addDays(5)->toDateString(),
                'scheduled_end' => now()->addDays(7)->toDateString(),
                'estimated_amount' => 1650,
                'final_amount' => null,
            ],
        ];

        $jobModels = [];
        foreach ($jobs as $job) {
            $jobModels[] = Job::query()->updateOrCreate(['job_number' => $job['job_number']], $job);
        }

        $invoice = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2401'],
            [
                'customer_id' => $customerModels[0]->id,
                'job_id' => $jobModels[0]->id,
                'issue_date' => now()->subDays(16)->toDateString(),
                'due_date' => now()->subDays(2)->toDateString(),
                'status' => 'paid',
                'subtotal' => 2550,
                'tax' => 178.5,
                'total' => 2728.5,
                'amount_paid' => 2728.5,
                'notes' => 'Thank you for choosing Cedarline.',
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'ACH-88421'],
            [
                'invoice_id' => $invoice->id,
                'amount' => 2728.5,
                'paid_at' => now()->subDays(10)->toDateString(),
                'method' => 'ach',
                'notes' => 'Final payment',
            ]
        );

        Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-2408'],
            [
                'customer_id' => $customerModels[1]->id,
                'job_id' => $jobModels[1]->id,
                'issue_date' => now()->subDay()->toDateString(),
                'due_date' => now()->addDays(14)->toDateString(),
                'status' => 'sent',
                'subtotal' => 2500,
                'tax' => 175,
                'total' => 2675,
                'amount_paid' => 1000,
                'notes' => 'Deposit invoice for exterior project',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Nair estimate walkthrough'],
            [
                'customer_id' => $customerModels[2]->id,
                'job_id' => $jobModels[2]->id,
                'assigned_to' => $manager->id,
                'type' => 'estimate',
                'status' => 'confirmed',
                'starts_at' => now()->addDays(2)->setTime(10, 0),
                'ends_at' => now()->addDays(2)->setTime(11, 0),
                'location' => '19 Hollow Creek Rd, Chapel Hill',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Chen mid-job walkthrough'],
            [
                'customer_id' => $customerModels[1]->id,
                'job_id' => $jobModels[1]->id,
                'assigned_to' => $staff->id,
                'type' => 'walkthrough',
                'status' => 'scheduled',
                'starts_at' => now()->addDay()->setTime(15, 0),
                'ends_at' => now()->addDay()->setTime(15, 45),
                'location' => '412 Oakmont Dr, Cary',
            ]
        );

        $posts = [
            [
                'title' => 'Why north-facing rooms need warmer undertones',
                'slug' => 'north-facing-room-undertones',
                'excerpt' => 'Cool daylight can make grays look blue. Here is how Cedarline samples for Triangle light.',
                'body' => "North light is soft and cool. Paint chips that look balanced in a store aisle can read chilly on a bedroom wall.\n\nWe recommend sampling large boards and checking them morning and evening. Warm greige, soft clay, and muted sand often behave better than blue-leaning grays.\n\nCedarline leaves samples in place for 48 hours so you can live with the undertone before we order gallons.",
                'cover_image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1200&q=80',
                'category' => 'color',
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Exterior prep checklist for Piedmont humidity',
                'slug' => 'exterior-prep-piedmont-humidity',
                'excerpt' => 'Wash, dry, scrape, prime — the sequence that keeps peeling away.',
                'body' => "Humidity is the enemy of rushed exterior coats. Cedarline power-washes, then waits for moisture meters to clear before priming.\n\nBare wood gets oil or acrylic primer matched to the finish system. Caulk only after primers set. Skipping those steps is how flakes return by year two.",
                'cover_image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80',
                'category' => 'prep',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'author_id' => $manager->id,
            ],
            [
                'title' => 'How long before you can move furniture back?',
                'slug' => 'furniture-return-after-painting',
                'excerpt' => 'Dry to touch is not the same as cured. Plan your room reset with cure times in mind.',
                'body' => "Most interiors are dry to touch in a few hours, but full cure can take 7–30 days depending on product and humidity.\n\nWe advise felt pads and gentle placement after 24–48 hours, then avoiding scrubbing for two weeks. Ask your crew lead for the data sheet on your specific paint line.",
                'cover_image' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1200&q=80',
                'category' => 'tips',
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'author_id' => $admin->id,
            ],
        ];
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(['slug' => $post['slug']], $post);
        }

        $articles = [
            [
                'title' => 'Peeling exterior paint near bathroom vents',
                'slug' => 'peeling-near-bathroom-vents',
                'category' => 'common-issues',
                'summary' => 'Moisture from exhaust can blister siding if vents dump onto walls.',
                'body' => "1. Confirm the exhaust terminates outdoors, not into soffits.\n2. Wash and scrape failed film.\n3. Spot-prime with bonding primer.\n4. Recoat and consider extending the vent away from the wall plane.\nCedarline flags this during estimates whenever we see chalky rings below vents.",
                'sort_order' => 1,
            ],
            [
                'title' => 'Step-by-step: preparing a bedroom for paint day',
                'slug' => 'prep-bedroom-paint-day',
                'category' => 'guides',
                'summary' => 'What homeowners can do the night before our crew arrives.',
                'body' => "1. Clear wall surfaces and small furniture.\n2. Bag closet floors if painting closets.\n3. Decide on color lock-in.\n4. Secure pets.\n5. Reserve parking for the van.\nWe handle masking, drop cloths, and fixture removal for standard interiors.",
                'sort_order' => 2,
            ],
            [
                'title' => 'Admin manual: creating a painting job in ERP',
                'slug' => 'admin-manual-create-job',
                'category' => 'admin-manual',
                'summary' => 'How staff open jobs, assign crews, and link invoices.',
                'body' => "1. Create or select the customer.\n2. Open Painting Jobs → Create.\n3. Assign service type and crew.\n4. Set status to scheduled once deposit is logged.\n5. Add appointments for estimate or paint days.\n6. When complete, create invoice and record payment.\nManagers can override priority; staff should not void invoices.",
                'sort_order' => 3,
            ],
            [
                'title' => 'Troubleshooting: inventory shows negative primer stock',
                'slug' => 'troubleshoot-negative-primer-stock',
                'category' => 'troubleshooting',
                'summary' => 'Usually a missed receiving entry or double job pull.',
                'body' => "1. Check recent job material notes.\n2. Confirm purchase receipts were entered.\n3. Adjust stock with a counted physical inventory.\n4. Raise reorder_level if crews routinely stage extra gallons.\nUse AI Assistants → Troubleshooting for suggested automation rules.",
                'sort_order' => 4,
            ],
            [
                'title' => 'Lead-safe work on pre-1978 homes',
                'slug' => 'lead-safe-pre-1978',
                'category' => 'guides',
                'summary' => 'EPA RRP practices Cedarline follows when disturbing old coatings.',
                'body' => "Homes built before 1978 may contain lead paint. Our certified renovators contain dust, use HEPA vacuums, and follow RRP rules when scraping or sanding.\nAsk during estimates if your home qualifies — we will note it on the job ticket.",
                'sort_order' => 5,
            ],
            [
                'title' => 'Admin manual: AI content & chatbot modes',
                'slug' => 'admin-manual-ai-tools',
                'category' => 'admin-manual',
                'summary' => 'How demo FAQ mode and live API keys work.',
                'body' => "Public chatbot uses FAQ fallbacks when OPENAI_API_KEY and GEMINI_API_KEY are empty.\nIn /admin → AI Assistants you can generate blog drafts, service copy, automation ideas, and troubleshooting notes.\nNever paste customer secrets into prompts.",
                'sort_order' => 6,
            ],
        ];
        foreach ($articles as $article) {
            KbArticle::query()->updateOrCreate(
                ['slug' => $article['slug']],
                $article + ['is_published' => true]
            );
        }
    }
}
