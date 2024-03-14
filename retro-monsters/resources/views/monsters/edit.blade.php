    @extends('templates.index')

    @section('title', 'Modifier un monstre')

    @section('content')
    <div class="container mx-auto flex justify-center items-center">
        <div class="w-full">
            <form method="POST" action="{{ route('monsters.update', ['monster' => $monster->id, 'slug' => $monster->name]) }}" class="bg-gray-700 shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="name">
                        Nom
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name"
                        type="text"
                        placeholder=""
                        name="name"
                        value="{{ old('name', $monster->name) }}"
                        required
                    />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="type">
                        Type
                    </label>
                    <select id="type" name="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == $monster->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="rarety">
                        Rareté
                    </label>
                    <select id="rarety" name="rarety" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($rarities as $rarity)
                            <option value="{{ $rarity->id }}" {{ $rarity->id == $monster->rarety_id ? 'selected' : '' }}>{{ $rarity->name }}</option>
                        @endforeach
                    </select>
                </div>

                 <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="pv">
                    Points de vie
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="pv"
                    type="text"
                    placeholder=""
                    name="pv"
                    value="{{ old('pv', $monster->pv) }}"
                    required
                />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="attack">
                        Points d'attaque
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="attack"
                        type="text"
                        placeholder=""
                        name="attack"
                        value="{{ old('attack', $monster->attack) }}"
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
                        value="{{ old('description', $monster->description) }}"
                    />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="defense">
                        Défense
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="defense"
                        type="text"
                        placeholder=""
                        name="defense"
                        value="{{ old('defense', $monster->defense) }}"
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
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>
    @stop
