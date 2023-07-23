<?php

namespace App\Http\Controllers;

use App\Models\BookAuthor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookAuthorController extends Controller
{
    public function index()
    {
        return Inertia::render('BookAuthors/Index', [
            'bookAuthors' => BookAuthor::query()
                ->orderByDesc('updated_at')
                ->paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('BookAuthors/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        BookAuthor::create(
            $request->only('name', 'birth_date')
        );

        return redirect()->route('autores.index');
    }

    public function edit(BookAuthor $bookAuthor)
    {
        return Inertia::render('BookAuthors/Edit', [
            'autor' => $bookAuthor,
        ]);
    }

    public function update(Request $request, BookAuthor $bookAuthor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        $bookAuthor->update(
            $request->only('name', 'birth_date')
        );

        return redirect()->route('autores.index');
    }

    public function destroy(BookAuthor $bookAuthor)
    {
        $bookAuthor->delete();

        return redirect()->route('autores.index');
    }
}
