@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Ajouter Document</h1>

    {{-- Affichage des erreurs --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Référence</label>
            <input type="text" name="reference" value="{{ old('reference') }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Titre</label>
            <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Description</label>
            <textarea name="description" class="w-full border px-2 py-1 rounded">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Type</label>
            <select name="type" class="w-full border px-2 py-1 rounded">
                <option value="">-- Choisir Type --</option>
                <option value="facture" {{ old('type')=='facture'?'selected':'' }}>Facture</option>
                <option value="contrat" {{ old('type')=='contrat'?'selected':'' }}>Contrat</option>
                <option value="rapport" {{ old('type')=='rapport'?'selected':'' }}>Rapport</option>
                <option value="autre" {{ old('type')=='autre'?'selected':'' }}>Autre</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Fichier</label>
            <input type="file" name="fichier" required class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Statut</label>
            <select name="statut" class="w-full border px-2 py-1 rounded">
                <option value="en_attente" {{ old('statut')=='en_attente'?'selected':'' }}>En attente</option>
                <option value="valide" {{ old('statut')=='valide'?'selected':'' }}>Valide</option>
                <option value="rejete" {{ old('statut')=='rejete'?'selected':'' }}>Rejeté</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Date de dépôt</label>
            <input type="date" name="date_depot" value="{{ old('date_depot') }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div>
            <label class="block font-medium">Montant</label>
            <input type="number" step="0.01" name="montant" value="{{ old('montant') }}" class="w-full border px-2 py-1 rounded">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="est_actif" value="1" {{ old('est_actif', true) ? 'checked' : '' }}>
            <label>Est actif</label>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection
