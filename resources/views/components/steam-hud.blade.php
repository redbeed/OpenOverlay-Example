<div id="steam-hud" class="bg-black text-white rounded-2xl fixed bottom-10 left-12 shadow-xl overflow-hidden border-{{ $mainColor }}-800 border-r-4">
    <div class="flex flex-row items-stretch min-w-96">
        <div class="w-16 px-3 flex justify-items-center bg-gray-800 flex-shrink-0">
            <img src="{{ asset('/assets/open-overlay/openoverlay-icon.svg') }}" title="openoverlay-logo">
        </div>
        <div class="px-6 pb-3 pt-4 my-auto flex-grow">
            <div id="steam-hud-title" class="text-{{ $mainColor }}-400 font-bold leading-snug">{{ $recent['title'] }}</div>
            <div id="steam-hud-username" class="font-extrabold text-3xl leading-tight"> {{ $recent['name'] }} </div>
        </div>
        <div class="pl-6 pr-2 py-3 text-xl grid gap-1 flex-grow-0 flex-shrink-0 content-center">
            @foreach($socials as $icon)
                <i class="{{ $icon }}"></i>
            @endforeach
        </div>
    </div>
</div>
