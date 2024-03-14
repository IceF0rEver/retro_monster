@extends('templates.index')

@section('title')
    Mon deck
@stop

@section('content')
    <div class="container mx-auto pt-4 pb-12">
        <h1 class="text-4xl font-bold creepster text-center mb-8">
          Mon Deck
        </h1>
    @include('monsters._index', ['monsters' => $monsters])

    <div class="m-3 self-center">{{ $monsters->links() }}</div>
    </div>
@stop