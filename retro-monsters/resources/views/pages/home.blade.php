@extends('templates.index')

@section('title')
    Accueil
@stop

@section('content')
    @include('monsters._random', [
        'monster' => \App\Models\Monster::inRandomOrder()->first(),
    ])

    @if (auth()->check())
        @php
            $followedUsersIds = auth()->user()->follows()->pluck('id');
            $latestMonstersByFollowedUsers = \App\Models\Monster::whereIn('user_id', $followedUsersIds)->orderBy('created_at', 'DESC')->limit(3)->get();
        @endphp

        @if ($latestMonstersByFollowedUsers->count() > 0)
            <h2 class="text-2xl font-bold mb-4 m-4 creepster">Derniers monstres ajoutés par les utilisateurs que vous suivez</h2>
            @include('monsters._index', [
                'monsters' => $latestMonstersByFollowedUsers,
            ])
        @endif
    @endif

    <h2 class="text-2xl font-bold mb-4 m-4 creepster">Derniers monstres ajoutés</h2>
    @include('monsters._index', [
        'monsters' => \App\Models\Monster::orderBy('created_at', 'DESC')->limit(3)->get(),
    ])
@stop
