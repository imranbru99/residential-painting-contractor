<div id="cedar-chat" class="fixed bottom-24 right-5 z-50 w-[min(100vw-2rem,22rem)]">
    <button type="button" id="cedar-chat-toggle"
            class="ml-auto mb-2 block rounded-full bg-teal px-4 py-2 text-sm font-semibold text-white shadow-lg">
        Ask Cedarline AI
    </button>
    <div id="cedar-chat-panel" class="hidden overflow-hidden rounded-2xl border border-pine/10 bg-white shadow-2xl">
        <div class="bg-pine px-4 py-3 text-sm font-semibold text-white">Cedarline painting assistant</div>
        <div id="cedar-chat-log" class="h-64 space-y-2 overflow-y-auto bg-foam p-3 text-sm"></div>
        <form id="cedar-chat-form" class="flex gap-2 border-t border-pine/10 p-3">
            <input id="cedar-chat-input" type="text" placeholder="Ask about prep, cost, schedule..."
                   class="flex-1 rounded-lg border border-pine/15 px-3 py-2 text-sm outline-none focus:border-teal" required>
            <button class="rounded-lg bg-teal px-3 py-2 text-sm font-semibold text-white">Send</button>
        </form>
    </div>
</div>
<script>
(() => {
    const toggle = document.getElementById('cedar-chat-toggle');
    const panel = document.getElementById('cedar-chat-panel');
    const form = document.getElementById('cedar-chat-form');
    const input = document.getElementById('cedar-chat-input');
    const log = document.getElementById('cedar-chat-log');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const add = (who, text) => {
        const row = document.createElement('div');
        row.className = who === 'you' ? 'text-right' : '';
        row.innerHTML = `<span class="inline-block max-w-[90%] rounded-xl px-3 py-2 ${who === 'you' ? 'bg-teal text-white' : 'bg-white border border-pine/10 text-ink'}">${text}</span>`;
        log.appendChild(row);
        log.scrollTop = log.scrollHeight;
    };

    toggle.addEventListener('click', () => panel.classList.toggle('hidden'));
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        add('you', message);
        input.value = '';
        try {
            const res = await fetch('{{ route('ai.chat') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message }),
            });
            const data = await res.json();
            add('bot', data.reply || 'Sorry, try again.');
        } catch {
            add('bot', 'Connection issue. Please call (919) 555-0148.');
        }
    });
})();
</script>
