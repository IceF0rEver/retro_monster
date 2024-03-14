<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Rarety;
use App\Models\Monster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class MonsterController extends Controller
{
    public function index()
    {
        $monsters = Monster::orderBy('created_at', 'DESC')->paginate(9);
        // $types = Type::all();
        // $rarities = Rarety::all();

        return view('monsters.index', compact('monsters'));
    }

    public function deck()
    {
        $user = auth()->user();

        $monsters = Monster::whereHas('favorites', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(9);

        return view('monsters.deck', ['monsters' => $monsters]);
    }

    public function create()
    {
        $types = Type::all();
        $rarities = Rarety::all();

        return view('monsters.create', compact('types', 'rarities'));
    }

    public function store(Request $request)
    {
        $monster = new Monster();
        $monster->name = $request->input('name');
        $monster->rarety_id = $request->input('rarety');
        $monster->type_id = $request->input('type');
        $monster->pv = $request->input('pv');
        $monster->attack = $request->input('attack');
        $monster->description = $request->input('description');
        $monster->defense = $request->input('defense');
        $monster->image_url = $request->input('image');
    
        $monster->user_id = auth()->id();

        if ($request->hasFile('image')) {    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $monster->image_url = $imageName;
        }

    
        $monster->save();
    
        return redirect()->route('monsters.index')->with('success', 'Monster ajouté avec succès!');
    }

    public function show(Monster $monster)
    {
        return view('monsters.show', compact('monster'));
    }


    public function edit(Monster $monster)
    {
        if (Auth::user()->id !== $monster->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $types = Type::all();
        $rarities = Rarety::all();

        return view('monsters.edit', compact('monster','types', 'rarities'));
    }

    public function update(Request $request, Monster $monster)
    {
        if (Auth::user()->id !== $monster->user_id) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->hasFile('image')) {
            Storage::delete($monster->image_url);
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $monster->image_url = $imageName;
        }
        $monster->update([
            'name' => $request->input('name'),
            'pv' => $request->input('pv'),
            'attack' => $request->input('attack'),
            'description' => $request->input('description'),
            'defense' => $request->input('defense'),
            'type_id' => $request->input('type'),
            'rarety_id' => $request->input('rarety'),
        ]);

        return redirect()->route('monsters.index')->with('success', 'Monster mis à jour avec succès!');
    }

    public function destroy(Monster $monster)
    {
        if (auth()->user()->id !== $monster->user_id) {
            abort(403, 'Unauthorized action.'); 
        }
    
        $monster->favorites()->delete();
    
        $monster->comments()->delete();
    
        Storage::delete($monster->image_url);
    
        $monster->delete();
    
        return redirect()->route('monsters.index')->with('success', 'Monster supprimé avec succès!');
    }
    
    public function searchByText(Request $request)
    {
        $texte = $request->input('texte');
        $monsters = Monster::where('name', 'like', "%$texte%")->paginate(9);

        return view('monsters.index', compact('monsters'));
    }

    public function searchByCriteria(Request $request)
    {
        $type = $request->input('type');
        $rarity = $request->input('rarete');
        $minPv = $request->input('min_pv');
        $maxPv = $request->input('max_pv');
        $minAttaque = $request->input('min_attaque');
        $maxAttaque = $request->input('max_attaque');
    
        $query = Monster::query();
    
        if ($type) {
            $query->where('type_id', $type);
        }
    
        if ($rarity) {
            $query->where('rarety_id', $rarity);
        }
    
        if ($minPv && $maxPv) {
            $query->whereBetween('pv', [$minPv, $maxPv]);
        }
    
        if ($minAttaque && $maxAttaque) {
            $query->whereBetween('attack', [$minAttaque, $maxAttaque]);
        }
    
        $monsters = $query->paginate(9);
        return view('monsters.index', compact('monsters'));
    }
    public function toggleFavorite(Monster $monster)
    {
        $user = auth()->user();

        if ($user->favorites->contains($monster)) {
            $user->favorites()->detach($monster);
        } else {
            $user->favorites()->attach($monster);
        }

        return back();
    }
    

}
