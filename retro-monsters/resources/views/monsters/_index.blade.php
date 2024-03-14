<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Monster Item -->
    @foreach ($monsters as $monster)
    <article
      class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card"
      data-monster-type="{{ strtolower($monster->type->name) }}"
    >
      <img
        class="w-full h-48 object-cover rounded-t-lg"
        src="{{ asset('images/' . $monster->image_url) }}"
        alt="{{ $monster->name }}"
      />

      <div class="p-4">
        <h3 class="text-xl font-bold">{{$monster->name}}</h3>
        <h4 class="mb-2">
          <a href="#" class="text-red-400 hover:underline"
            >{{$monster->user->name}}</a
          >
        </h4>
        <p class="text-gray-300 text-sm mb-2">
          {{$monster->description}}
        </p>
        <div class="flex justify-between items-center mb-2">
          <div>
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
          <span class="text-sm text-gray-300">Type: {{$monster->type->name}}</span>
        </div>
        <div class="flex justify-between items-center mb-4">
          <span class="text-sm text-gray-300">PV: {{$monster->pv}}</span>
          <span class="text-sm text-gray-300">Attaque: {{$monster->attack}}</span>
        </div>
        <div class="text-center">
          <a
            href="{{ route('monsters.show', [
              'monster' => $monster->id, 
              'slug' => \Illuminate\Support\Str::slug($monster->name, '-'),
            ]) }}"
            class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
            >Plus de détails</a
          >
        </div>
      </div>
      @if (auth()->check())
          <div class="absolute top-4 right-4">
              <form action="{{ route('toggle.favorite', ['monster' => $monster->id]) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button
                      type="submit"
                      class="text-white {{ auth()->user()->favorites->contains($monster) ? 'bg-red-700' : 'bg-gray-400' }} hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
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
              </form>
          </div>
      @endif
    </article>
    @endforeach
</div>