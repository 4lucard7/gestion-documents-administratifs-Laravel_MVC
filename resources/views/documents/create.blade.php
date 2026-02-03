@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">📄 Créer un Document</h1>
        <p class="text-gray-600">Remplissez le formulaire ci-dessous pour ajouter un nouveau document</p>
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
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8 border border-gray-100">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Référence -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Référence <span class="text-red-600">*</span></label>
                <input type="text" name="reference" value="{{ old('reference') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Ex: DOC-001">
            </div>

            <!-- Titre -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Titre <span class="text-red-600">*</span></label>
                <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Ex: Facture Janvier 2026">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Type <span class="text-red-600">*</span></label>
                <select name="type" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">-- Sélectionner --</option>
                    <option value="facture" {{ old('type')=='facture'?'selected':'' }}>📄 Facture</option>
                    <option value="contrat" {{ old('type')=='contrat'?'selected':'' }}>📋 Contrat</option>
                    <option value="rapport" {{ old('type')=='rapport'?'selected':'' }}>📊 Rapport</option>
                    <option value="autre" {{ old('type')=='autre'?'selected':'' }}>📎 Autre</option>
                </select>
            </div>

            <!-- Statut -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Statut <span class="text-red-600">*</span></label>
                <select name="statut" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="en_attente" {{ old('statut')=='en_attente'?'selected':'' }}>⏳ En attente</option>
                    <option value="valide" {{ old('statut')=='valide'?'selected':'' }}>✅ Validé</option>
                    <option value="rejete" {{ old('statut')=='rejete'?'selected':'' }}>❌ Rejeté</option>
                </select>
            </div>

            <!-- Montant -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Montant (€)</label>
                <input type="number" step="0.01" name="montant" value="{{ old('montant') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="0.00">
            </div>

            <!-- Date de dépôt -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Date de dépôt <span class="text-red-600">*</span></label>
                <input type="date" name="date_depot" value="{{ old('date_depot') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
        </div>

        <!-- Description (full width) -->
        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Entrez une description détaillée...">{{ old('description') }}</textarea>
        </div>

        <!-- Fichier -->
        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Fichier <span class="text-red-600">*</span></label>
            <div class="border-2 border-dashed border-indigo-300 rounded-lg p-8 text-center cursor-pointer hover:bg-indigo-50 transition">
                <input type="file" name="fichier" required class="hidden" id="file-input">
                <label for="file-input" class="cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-4xl text-indigo-400 mb-2"></i>
                    <p class="text-gray-700 font-semibold">Glissez ou cliquez pour importer</p>
                    <p class="text-gray-500 text-sm">PNG, JPG, PDF, DOC, DOCX</p>
                </label>
            </div>
        </div>

        <!-- Actif checkbox -->
        <div class="mt-6 flex items-center gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <input type="checkbox" id="est_actif" name="est_actif" value="1" {{ old('est_actif', true) ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-500">
            <label for="est_actif" class="text-gray-700 font-medium">Marquer ce document comme actif</label>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-8">
            <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-save"></i> Enregistrer le document
            </button>
            <a href="{{ route('documents.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-3 rounded-lg transition duration-300 text-center flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left"></i> Annuler
            </a>
        </div>
    </form>
</div>
@endsection
