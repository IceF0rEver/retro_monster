<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- User Item -->
    @foreach ($users as $user)
    <article
      class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card"
    >
      <div class="p-4">
        <h3 class="text-xl font-bold">{{$user->name}}</h3>
        <div class="text-center">
          <a
            href="{{ route('users.show', [
              'user' => $user->id, 
              'slug' => \Illuminate\Support\Str::slug($user->name, '-'),
            ]) }}"
            class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
            >Plus de détails</a
          >
        </div>
      </div>
    </article>
    @endforeach
</div>