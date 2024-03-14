
@extends('templates.index')

@section('title')
    Liste des monstres
@stop

@section('content')
    <h2 class="text-2xl font-bold mb-4 creepster">Liste des monstres</h2>
    @include('monsters._index', ['monsters' => $monsters])

    <div class="m-3 self-center">{{ $monsters->links() }}</div>
@stop