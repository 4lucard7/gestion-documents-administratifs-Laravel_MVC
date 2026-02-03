@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Documents</h1>
        <a href="{{ route('documents.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Ajouter Document</a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-2 py-1">Référence</th>
                <th class="border px-2 py-1">Titre</th>
                <th class="border px-2 py-1">Type</th>
                <th class="border px-2 py-1">Statut</th>
                <th class="border px-2 py-1">Montant</th>
                <th class="border px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($documents as $document)
            <tr>
                <td class="border px-2 py-1">{{ $document->reference }}</td>
                <td class="border px-2 py-1">{{ $document->titre }}</td>
                <td class="border px-2 py-1">{{ $document->type }}</td>
                <td class="border px-2 py-1">{{ $document->statut }}</td>
                <td class="border px-2 py-1">{{ $document->montant ?? '0.00' }}</td>
                <td class="border px-2 py-1 flex gap-2">
                    <a href="{{ route('documents.show', $document->id) }}" class="text-blue-500 hover:underline">Voir</a>
                    <a href="{{ route('documents.edit', $document->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="border px-2 py-1 text-center">Aucun document trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
