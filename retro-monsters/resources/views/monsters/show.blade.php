@extends('templates.index')

@section('title')
    {{ $monster->name }}
@stop

@section('content')
<section class="w-full">
  @include('monsters._detail', ['monster' => $monster])
    <!-- Section d'évaluation -->
    <div class="mt-6">
      <h3 class="text-2xl font-bold mb-4">Évaluez ce Monstre</h3>
      <div id="rating-section" class="flex items-center">
        <span class="rating-star" data-value="1">&#9733;</span>
        <span class="rating-star" data-value="2">&#9733;</span>
        <span class="rating-star" data-value="3">&#9733;</span>
        <span class="rating-star" data-value="4">&#9733;</span>
        <span class="rating-star" data-value="5">&#9733;</span>
      </div>
    </div>
    <script>
      document.querySelectorAll(".rating-star").forEach((star) => {
        star.onclick = function () {
          let rating = this.getAttribute("data-value");
          document
            .querySelectorAll(".rating-star")
            .forEach((innerStar) => {
              if (innerStar.getAttribute("data-value") <= rating) {
                innerStar.classList.add("selected");
              } else {
                innerStar.classList.remove("selected");
              }
            });
          // Envoyer la valeur 'rating' au serveur ou la traiter comme nécessaire
        };
      });
    </script>

    <!-- Section commentaires -->
    <div class="mt-6">
      <h3 class="text-2xl font-bold mb-4">Commentaires</h3>
      <div id="commentaires-section">
        <!-- Commentaire -->
        @foreach ($monster->comments as $comment)
        <div class="mb-4 bg-gray-800 rounded p-4">
          <p class="font-bold text-red-400">{{$comment->user->name}}</p>
          <p class="text-sm text-gray-400">{{$comment->created_at}}</p>
          <p class="text-gray-300 mt-2">
            {{$comment->content}}
          </p>
        </div>
        @endforeach
      </div>
      <!-- Formulaire de commentaire -->
      <div class="bg-gray-800 rounded p-4">
        <h4 class="font-bold text-lg text-red-500 mb-2">
            Laissez un commentaire
        </h4>
        <form id="comment-form">
            @csrf
            <input type="hidden" name="monster_id" value="{{ $monster->id }}">
            <textarea
                name="content"
                id="comment-content"
                class="w-full p-2 bg-gray-900 rounded text-gray-300"
                rows="4"
                placeholder="Votre commentaire..."
            ></textarea>
            <button
                type="button"
                id="submit-comment"
                class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full w-full"
            >
                Envoyer
            </button>
        </form>
    </div>
  </section>
  @stop