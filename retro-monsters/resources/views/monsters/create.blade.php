@extends('templates.index')

@section('title', 'Ajouter un monstre')

@section('content')
<div class="container mx-auto flex justify-center items-center">
    <div class="w-full">
        <form method="POST" action="{{ route('monsters.store') }}" class="bg-gray-700 shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="name">
                    Nom
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name"
                    type="text"
                    placeholder=""
                    name="name"
                    required
                />
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="type">
                    Type
                </label>
                <select id="type" name="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="rarety">
                    Rareté
                </label>
                <select id="rarety" name="rarety" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($rarities as $rarity)
                        <option value="{{ $rarity->id }}">{{ $rarity->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="pv">
                    Points de vie
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="pv"
                    type="number"
                    placeholder=""
                    name="pv"
                    required
                />
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="attack">
                    Points d'attaque
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="attack"
                    type="number"
                    placeholder=""
                    name="attack"
                    required
                />
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="description"
                    type="description"
                    placeholder=""
                    name="description"
                />
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="defense">
                    Défense
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="defense"
                    type="number"
                    placeholder=""
                    name="defense"
                    required
                />
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="image">
                    Image
                </label>
                <input type="file" id="image" name="image" accept="*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>
@stop
