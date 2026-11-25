@extends('layouts.app')

@section('title', 'About Cedarline Residential Painting')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <p class="font-display text-5xl font-extrabold text-pine">Cedarline</p>
    <h1 class="mt-3 text-2xl font-semibold text-ink/80">A residential painting company built for living homes</h1>
    <div class="mt-10 grid gap-10 md:grid-cols-2">
        <img src="https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?auto=format&fit=crop&w=1400&q=80"
             alt="Freshly finished suburban home exterior"
             class="h-80 w-full rounded-2xl object-cover">
        <div class="space-y-4 text-ink/80">
            <p>Cedarline started in Raleigh with a simple rule: never sell a coat of paint without owning the prep. Our crews are residential specialists — rooms, trim, exteriors, cabinets, and decks.</p>
            <p>We document color choices, protect flooring, and leave jobsites vacuumed. The ERP you see in /admin is the same system that schedules crews, tracks primer inventory, and invoices on completion.</p>
            <p>Service area: Raleigh, Durham, Cary, Chapel Hill, Apex, Wake Forest, and nearby Triangle neighborhoods.</p>
        </div>
    </div>
</section>
@endsection
