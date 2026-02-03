@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">✏️ Modifier le Document</h1>
        <p class="text-gray-600">Mettez à jour les informations du document ci-dessous</p>
    </div>

    {{-- Affichage des erreurs --}}
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-600 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Des erreurs ont été détectées</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-600 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8 border border-gray-100">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Référence -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Référence <span class="text-red-600">*</span></label>
                <input type="text" name="reference" value="{{ old('reference', $document->reference) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Titre -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Titre <span class="text-red-600">*</span></label>
                <input type="text" name="titre" value="{{ old('titre', $document->titre) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Type <span class="text-red-600">*</span></label>
                <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">-- Sélectionner --</option>
                    <option value="facture" {{ old('type', $document->type)=='facture'?'selected':'' }}>📄 Facture</option>
                    <option value="contrat" {{ old('type', $document->type)=='contrat'?'selected':'' }}>📋 Contrat</option>
                    <option value="rapport" {{ old('type', $document->type)=='rapport'?'selected':'' }}>📊 Rapport</option>
                    <option value="autre" {{ old('type', $document->type)=='autre'?'selected':'' }}>📎 Autre</option>
                </select>
            </div>

            <!-- Statut -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Statut <span class="text-red-600">*</span></label>
                <select name="statut" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="en_attente" {{ old('statut', $document->statut)=='en_attente'?'selected':'' }}>⏳ En attente</option>
                    <option value="valide" {{ old('statut', $document->statut)=='valide'?'selected':'' }}>✅ Validé</option>
                    <option value="rejete" {{ old('statut', $document->statut)=='rejete'?'selected':'' }}>❌ Rejeté</option>
                </select>
            </div>

            <!-- Montant -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Montant (€)</label>
                <input type="number" step="0.01" name="montant" value="{{ old('montant', $document->montant) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Date de dépôt -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Date de dépôt <span class="text-red-600">*</span></label>
                <input type="date" name="date_depot" value="{{ old('date_depot', $document->date_depot) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
        </div>

        <!-- Description (full width) -->
        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('description', $document->description) }}</textarea>
        </div>

        <!-- Fichier actuel -->
        @if($document->fichier)
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-700 font-semibold flex items-center gap-2">
                    <i class="fas fa-file"></i> Fichier actuel: <strong>{{ $document->fichier }}</strong>
                </p>
                <p class="text-xs text-blue-600 mt-1">Téléchargez un nouveau fichier pour le remplacer</p>
            </div>
        @endif

        <!-- Fichier (nouveau) -->
        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Nouveau Fichier</label>
            <div class="border-2 border-dashed border-indigo-300 rounded-lg p-8 text-center cursor-pointer hover:bg-indigo-50 transition">
                <input type="file" name="fichier" class="hidden" id="file-input">
                <label for="file-input" class="cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-4xl text-indigo-400 mb-2"></i>
                    <p class="text-gray-700 font-semibold">Glissez ou cliquez pour importer</p>
                    <p class="text-gray-500 text-sm">Laissez vide pour garder le fichier actuel</p>
                </label>
            </div>
        </div>

        <!-- Actif checkbox -->
        <div class="mt-6 flex items-center gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <input type="checkbox" id="est_actif" name="est_actif" value="1" {{ old('est_actif', $document->est_actif) ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-500">
            <label for="est_actif" class="text-gray-700 font-medium">Marquer ce document comme actif</label>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-8">
            <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
            <a href="{{ route('documents.show', $document->id) }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-3 rounded-lg transition duration-300 text-center flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </form>
</div>
@endsection
