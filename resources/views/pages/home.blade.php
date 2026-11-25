@extends('layouts.app')

@section('title', 'Cedarline Residential Painting | Raleigh–Durham')
@section('meta_description', 'Cedarline Residential Painting delivers prep-first interior and exterior painting for Triangle homes.')

@section('content')
<section class="relative min-h-[88vh] overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1562259949-e8e7689d7828?auto=format&fit=crop&w=2000&q=80"
             alt="Painter rolling fresh color on an interior wall"
             class="hero-pan h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pine/90 via-pine/70 to-pine/25"></div>
    </div>
    <div class="relative mx-auto flex min-h-[88vh] max-w-6xl flex-col justify-center px-4 py-20 text-white">
        <p class="fade-up font-display text-5xl font-extrabold tracking-tight sm:text-7xl">Cedarline</p>
        <h1 class="fade-up mt-4 max-w-xl text-2xl font-semibold text-mist sm:text-3xl" style="animation-delay:.12s">
            Precision color for Triangle homes.
        </h1>
        <p class="fade-up mt-4 max-w-lg text-base text-mist/85 sm:text-lg" style="animation-delay:.22s">
            Interior, exterior, cabinets, and decks — scheduled cleanly, finished lasting.
        </p>
        <div class="fade-up mt-8 flex flex-wrap gap-3" style="animation-delay:.32s">
            <a href="{{ route('contact') }}" class="rounded-md bg-gold px-5 py-3 text-sm font-bold text-ink">Book free estimate</a>
            <a href="{{ route('services.index') }}" class="rounded-md border border-white/40 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10">View services</a>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-pine sm:text-4xl">Services built around lasting finish</h2>
        <p class="mt-3 text-ink/70">One job at a time, one clear crew lead, zero rushed prep.</p>
    </div>
    <div class="mt-10 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services->take(6) as $service)
            <a href="{{ route('services.show', $service) }}" class="group block">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105">
                </div>
                <h3 class="mt-4 font-display text-xl font-bold text-pine">{{ $service->name }}</h3>
                <p class="mt-1 text-sm text-ink/70">{{ $service->tagline }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-pine text-mist">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-20 md:grid-cols-2">
        <div>
            <h2 class="font-display text-3xl font-bold text-white sm:text-4xl">About Cedarline</h2>
            <p class="mt-4 text-mist/80">
                We are a Raleigh-based residential painting team focused on homes — not warehouses.
                Moisture-aware prep, low-VOC options for families, and schedules that respect your living space.
            </p>
            <a href="{{ route('about') }}" class="mt-6 inline-block rounded-md bg-teal px-4 py-2 text-sm font-semibold text-white">Our story</a>
        </div>
        <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=1200&q=80"
             alt="Paint brushes and color samples ready for a residential project"
             class="h-80 w-full rounded-2xl object-cover">
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-pine">Operations dashboard preview</h2>
        <p class="mt-3 text-ink/70">Staff run jobs, inventory, invoices, and AI assistants from the Cedarline ERP.</p>
    </div>
    <div class="mt-8 overflow-hidden rounded-3xl border border-pine/10 bg-white shadow-xl">
        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85f82e?auto=format&fit=crop&w=1600&q=80"
             alt="Paint supplies organized for residential job staging"
             class="h-72 w-full object-cover md:h-96">
        <div class="grid gap-4 p-6 sm:grid-cols-3">
            <div>
                <p class="text-xs uppercase tracking-wide text-teal">Active jobs</p>
                <p class="font-display text-3xl font-bold text-pine">24</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-teal">Crews today</p>
                <p class="font-display text-3xl font-bold text-pine">6</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-teal">Estimates booked</p>
                <p class="font-display text-3xl font-bold text-pine">11</p>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 pb-20">
    <div class="flex items-end justify-between gap-4">
        <h2 class="font-display text-3xl font-bold text-pine">From the knowledge bench</h2>
        <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-teal">All posts</a>
    </div>
    <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block">
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-44 w-full rounded-xl object-cover">
                <h3 class="mt-3 font-display text-lg font-bold text-pine">{{ $post->title }}</h3>
                <p class="mt-1 text-sm text-ink/65">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="border-t border-pine/10 bg-mist/60">
    <div class="mx-auto flex max-w-6xl flex-col items-start justify-between gap-6 px-4 py-16 md:flex-row md:items-center">
        <div>
            <h2 class="font-display text-3xl font-bold text-pine">Ready for a cleaner paint day?</h2>
            <p class="mt-2 text-ink/70">Free estimates across Raleigh–Durham. WhatsApp or form — your choice.</p>
        </div>
        <a href="{{ route('contact') }}" class="rounded-md bg-pine px-5 py-3 text-sm font-bold text-white">Contact Cedarline</a>
    </div>
</section>
@endsection
