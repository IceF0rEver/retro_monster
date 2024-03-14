<section class="mb-20">
    <div
      class="bg-gray-700 rounded-lg shadow-lg monster-card"
      data-monster-type="{{ strtolower($monster->type->name) }}"
    >
      <div class="md:flex">
        <!-- Image du monstre -->
        <div class="w-full md:w-1/2 relative">
          <img
            class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none"
            src="{{ asset('images/' . $monster->image_url) }}"
            alt="{{ $monster->name }}"
          />
          @if (auth()->check())
          <div class="absolute top-4 right-4">
            <button
              class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
              style="
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <i class="fa fa-bookmark"></i>
            </button>
          </div>
          @endif
        </div>

        <!-- Détails du monstre -->
        <div class="p-6 md:w-1/2">
          <h2 class="text-3xl font-bold mb-2 creepster">
            {{$monster->name}}
          </h2>
          <p class="text-gray-300 text-sm mb-4">
            {{$monster->description}}
          </p>
          <div class="mb-4">
            <strong class="text-white">Créateur:</strong>
            <span class="text-red-400">{{$monster->user->name}}</span>
          </div>
          <div class="mb-4">
            <div>
              <strong class="text-white">Type:</strong>
              <span class="text-gray-300">{{$monster->type->name}}</span>
            </div>
            <div>
              <strong class="text-white">PV:</strong>
              <span class="text-gray-300">{{$monster->pv}}</span>
            </div>
            <div>
              <strong class="text-white">Attaque:</strong>
              <span class="text-gray-300">{{$monster->attack}}</span>
            </div>
            <div>
              <strong class="text-white">Défense:</strong>
              <span class="text-gray-300">{{$monster->defense}}</span>
            </div>
          </div>
          <div class="mb-4">
            <span class="text-gray-300 text-sm">
                @if($monster->notations->isNotEmpty())
                    @php
                        $averageRating = $monster->notations->avg('notation');
                        $roundedRating = round($averageRating); // Arrondir à la cotation entière
                    @endphp
                    <span class="text-yellow-400">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $roundedRating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                    </span>          
                    ({{ number_format($averageRating, 1) }}/5.0)
                @else
                    (Pas de notation)
                @endif
            </span>
          </div>
          <div class="">
            @if (auth()->check() && auth()->user()->id === $monster->user->id)
                <form action="{{ route('monsters.destroy', ['monster' => $monster->id, 'slug' => $monster->name]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
                    >
                        Supprimer
                    </button>
                </form>
        
                <a
                  href="{{ route('monsters.edit', ['monster' => $monster->id, 'slug' => $monster->name]) }}"
                  class="inline-block text-white bg-blue-500 hover:bg-blue-700 rounded-full px-4 py-2 ml-2 transition-colors duration-300"
                >
                    Modifier
                </a>
            @endif
        </div>
        </div>
      </div>
    </div>
  </section>