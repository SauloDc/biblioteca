<?php

namespace App\Http\Controllers;

use App\Models\BookGenre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookGenreController extends Controller
{
    public function index()
    {
        return Inertia::render('BookGenre/Index', [
            'bookGenres' => BookGenre::query()->orderByDesc('updated_at')->paginate(),
        ]);
    }

    public function create()
    {
        return Inertia::render('BookGenre/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        BookGenre::create(
            $request->only('name', 'status')
        );

        return redirect()->route('generos.index');
    }

    public function edit(BookGenre $bookGenre)
    {
        return Inertia::render('BookGenre/Edit', [
            'genero' => $bookGenre,
        ]);
    }

    public function update(Request $request, BookGenre $bookGenre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $bookGenre->update(
            $request->only('name', 'status')
        );

        return redirect()->route('generos.index');
    }

    public function destroy(BookGenre $bookGenre)
    {
        $bookGenre->delete();

        return redirect()->route('generos.index');
    }

    public function toggleStatus(BookGenre $bookGenre)
    {
        $bookGenre->update([
            'status' => !$bookGenre->status,
        ]);

        return redirect()->route('generos.index');
    }
}
