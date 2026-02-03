@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Détails du Document</h1>

    <div class="bg-gray-100 p-4 rounded space-y-2">
        <p><strong>Référence:</strong> {{ $document->reference }}</p>
        <p><strong>Titre:</strong> {{ $document->titre }}</p>
        <p><strong>Description:</strong> {{ $document->description }}</p>
        <p><strong>Type:</strong> {{ $document->type }}</p>
        <p><strong>Fichier:</strong> {{ $document->fichier }}</p>
        <p><strong>Statut:</strong> {{ $document->statut }}</p>
        <p><strong>Date dépôt:</strong> {{ $document->date_depot }}</p>
        <p><strong>Montant:</strong> {{ $document->montant ?? '0.00' }}</p>
        <p><strong>Est actif:</strong> {{ $document->est_actif ? 'Oui' : 'Non' }}</p>
    </div>

    <div class="mt-4 flex gap-2">
        <a href="{{ route('documents.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Retour</a>
        <a href="{{ route('documents.edit', $document->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</div>
@endsection
