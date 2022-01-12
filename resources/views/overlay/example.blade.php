@extends('layouts.overlay')

@section('content')
    <div class="relative h-screen w-screen">
        @if(request()->has('fake'))
            <img src="{{ asset('assets/overlay/population-one.png') }}" class="h-full w-auto">
        @endif

        <x-steam-HUD :twitchUserId="$twitchUserId"
                     :socialIcons="['fab fa-twitter', 'fab fa-youtube']"
                     :mainColor="'flamingo'">

        </x-steam-HUD>
    </div>
@endsection
