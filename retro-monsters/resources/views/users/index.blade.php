@extends('templates.index')

@section('title')
    Liste des créateurs
@stop

@section('content')
    <h2 class="text-2xl font-bold mb-4 creepster">Liste des créateurs</h2>
    @include('users._index', ['users' => $users])

    <div class="m-3 self-center">{{ $users->links() }}</div>
@stop