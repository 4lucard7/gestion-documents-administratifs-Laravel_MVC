@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Modifier Document</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.update', $document->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Référence</label>
            <input type="text" name="reference" value="{{ old('reference', $document->reference) }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $document->titre) }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Description</label>
            <textarea name="description" class="w-full border px-2 py-1 rounded">{{ old('description', $document->description) }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Type</label>
            <select name="type" class="w-full border px-2 py-1 rounded">
                <option value="facture" {{ old('type', $document->type)=='facture'?'selected':'' }}>Facture</option>
                <option value="contrat" {{ old('type', $document->type)=='contrat'?'selected':'' }}>Contrat</option>
                <option value="rapport" {{ old('type', $document->type)=='rapport'?'selected':'' }}>Rapport</option>
                <option value="autre" {{ old('type', $document->type)=='autre'?'selected':'' }}>Autre</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Fichier</label>
            <input type="text" name="fichier" value="{{ old('fichier', $document->fichier) }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Statut</label>
            <select name="statut" class="w-full border px-2 py-1 rounded">
                <option value="en_attente" {{ old('statut', $document->statut)=='en_attente'?'selected':'' }}>En attente</option>
                <option value="valide" {{ old('statut', $document->statut)=='valide'?'selected':'' }}>Valide</option>
                <option value="rejete" {{ old('statut', $document->statut)=='rejete'?'selected':'' }}>Rejeté</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Date de dépôt</label>
            <input type="date" name="date_depot" value="{{ old('date_depot', $document->date_depot) }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Montant</label>
            <input type="number" step="0.01" name="montant" value="{{ old('montant', $document->montant) }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="est_actif" value="1" {{ old('est_actif', $document->est_actif) ? 'checked' : '' }}>
            <label>Est actif</label>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
