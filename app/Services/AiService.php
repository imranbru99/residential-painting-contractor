<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'estimate' => 'Cedarline provides free on-site estimates across the Raleigh–Durham metro. Most visits take 30–45 minutes. Call (919) 555-0148 or use the contact form to book.',
        'interior' => 'Interior painting typically runs 1–4 days depending on room count, prep needs, and sheen. We use low-VOC paints and protect floors and furniture.',
        'exterior' => 'Exterior jobs usually need dry weather and 2–7 days. We power-wash, scrape, prime bare wood, and apply premium acrylics rated for Piedmont humidity.',
        'warranty' => 'Labor is warranted for 2 years on interiors and 3 years on exteriors when recommended prep and products are used. Manufacturer paint warranties still apply.',
        'prep' => 'Proper prep is 60% of a lasting paint job: washing, sanding, caulking, priming stains, and masking. We never skip prep to cut corners.',
        'color' => 'Bring inspiration photos or we can sample 2–3 colors on your wall. North-facing rooms often need warmer undertones; south-facing rooms handle cooler neutrals well.',
        'cost' => 'Typical Raleigh-area interiors start around $3–$6 per sq ft of wall, exteriors $4–$8 depending on height, surface, and access. Exact quotes follow a site visit.',
        'lead' => 'Homes built before 1978 may require EPA RRP-compliant lead-safe practices. Our crews are certified for lead-safe work when needed.',
        'schedule' => 'Busy seasons are spring and early fall. Book 2–4 weeks ahead for interiors, 3–6 weeks for exteriors in peak months.',
        'payment' => 'We accept card, ACH, and check. A deposit may be required to hold the schedule; balance is due on completion.',
    ];

    public function chat(string $message, string $context = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask us anything about residential painting, estimates, prep, or scheduling.';
        }

        if ($reply = $this->callProvider($message, $context)) {
            return $reply;
        }

        return $this->demoReply($message, $context);
    }

    public function generateContent(string $prompt, string $type = 'blog'): string
    {
        $system = match ($type) {
            'service' => 'Write a concise residential painting service description for Cedarline Residential Painting in Raleigh, NC.',
            'automation' => 'Suggest practical ERP automation ideas for a residential painting contractor.',
            'troubleshoot' => 'Help a painting company admin troubleshoot operations, scheduling, or inventory.',
            default => 'Write helpful blog content for homeowners about residential painting.',
        };

        if ($reply = $this->callProvider($prompt, $type, $system)) {
            return $reply;
        }

        return $this->demoContent($prompt, $type);
    }

    protected function callProvider(string $message, string $context, ?string $system = null): ?string
    {
        $system ??= 'You are the helpful assistant for Cedarline Residential Painting, a Raleigh NC residential painting contractor. Be concise, practical, and friendly. Never invent fake certifications.';

        $openaiKey = config('services.openai.key') ?: env('OPENAI_API_KEY');
        if ($openaiKey) {
            try {
                $response = Http::withToken($openaiKey)
                    ->timeout(25)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
                        'messages' => [
                            ['role' => 'system', 'content' => $system],
                            ['role' => 'user', 'content' => $message],
                        ],
                        'temperature' => 0.5,
                    ]);

                if ($response->successful()) {
                    return trim((string) data_get($response->json(), 'choices.0.message.content'));
                }
            } catch (\Throwable) {
                // fall through
            }
        }

        $geminiKey = config('services.gemini.key') ?: env('GEMINI_API_KEY');
        if ($geminiKey) {
            try {
                $response = Http::timeout(25)
                    ->post('https://generativelanguage.googleapis.com/v1beta/models/'.env('GEMINI_MODEL', 'gemini-1.5-flash').':generateContent?key='.$geminiKey, [
                        'contents' => [
                            ['parts' => [['text' => $system."\n\nUser: ".$message]]],
                        ],
                    ]);

                if ($response->successful()) {
                    return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));
                }
            } catch (\Throwable) {
                // fall through
            }
        }

        return null;
    }

    protected function demoReply(string $message, string $context): string
    {
        $lower = Str::lower($message);

        foreach ($this->faq as $key => $answer) {
            if (Str::contains($lower, $key) || Str::contains($lower, Str::plural($key))) {
                return $answer.' (Demo FAQ mode — add OPENAI_API_KEY or GEMINI_API_KEY for live AI.)';
            }
        }

        if (Str::contains($lower, ['price', 'cost', 'how much', 'quote'])) {
            return $this->faq['cost'].' (Demo FAQ mode.)';
        }

        if (Str::contains($lower, ['book', 'appoint', 'when', 'avail'])) {
            return $this->faq['schedule'].' (Demo FAQ mode.)';
        }

        if ($context === 'troubleshoot') {
            return "Check job status, crew assignment, and weather hold flags first. Confirm paint SKUs on the job ticket match inventory, then re-sync the appointment calendar. (Demo mode.)";
        }

        return 'Thanks for reaching out to Cedarline. We handle interior, exterior, cabinets, and deck staining across Raleigh–Durham. Ask about estimates, prep, warranties, lead-safe work, or scheduling — or call (919) 555-0148. (Demo FAQ mode.)';
    }

    protected function demoContent(string $prompt, string $type): string
    {
        return match ($type) {
            'service' => "## Crafted for {$prompt}\n\nCedarline crews prep thoroughly, protect living spaces, and finish with low-VOC coatings built for North Carolina humidity. Expect clear timelines, daily walkthroughs, and a tidy jobsite.",
            'automation' => "1. Auto-create estimate appointments from web leads.\n2. Low-stock alerts for primers and caulk.\n3. Weather-based exterior job reschedule suggestions.\n4. Invoice draft when job status hits completed.\n5. Follow-up SMS 7 days after project closeout.\n\nPrompt: {$prompt}",
            'troubleshoot' => "Likely causes for \"{$prompt}\": calendar overlap, missing material reservation, or unpaid deposit blocking schedule lock. Verify the job record, inventory pulls, and invoice status before reassigning crews.",
            default => "# {$prompt}\n\nHomeowners often underestimate prep. Wash, scrape, prime, then paint. Cedarline documents each stage so your finish lasts through Piedmont summers and damp winters.\n\n(Demo generator — configure API keys for live content.)",
        };
    }
}
