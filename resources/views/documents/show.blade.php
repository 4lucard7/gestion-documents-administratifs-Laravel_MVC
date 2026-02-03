@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header with Status Badge -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">📑 {{ $document->titre }}</h1>
            <p class="text-gray-600">Référence: <strong class="text-indigo-600">{{ $document->reference }}</strong></p>
        </div>
        <div class="text-right">
            @if($document->statut === 'valide')
                <span class="inline-block bg-green-100 border-l-4 border-green-600 text-green-700 px-4 py-2 rounded-r-lg font-semibold">
                    <i class="fas fa-check-circle mr-2"></i>Validé
                </span>
            @elseif($document->statut === 'en_attente')
                <span class="inline-block bg-yellow-100 border-l-4 border-yellow-600 text-yellow-700 px-4 py-2 rounded-r-lg font-semibold">
                    <i class="fas fa-clock mr-2"></i>En attente
                </span>
            @else
                <span class="inline-block bg-red-100 border-l-4 border-red-600 text-red-700 px-4 py-2 rounded-r-lg font-semibold">
                    <i class="fas fa-times-circle mr-2"></i>Rejeté
                </span>
            @endif
        </div>
    </div>

    <!-- Main Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Type Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-indigo-600">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-tags text-indigo-600 text-2xl"></i>
                <h3 class="text-sm font-bold text-gray-500 uppercase">Type</h3>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                @if($document->type === 'facture')
                    📄 Facture
                @elseif($document->type === 'contrat')
                    📋 Contrat
                @elseif($document->type === 'rapport')
                    📊 Rapport
                @else
                    📎 Autre
                @endif
            </p>
        </div>

        <!-- Amount Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-600">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-euro-sign text-green-600 text-2xl"></i>
                <h3 class="text-sm font-bold text-gray-500 uppercase">Montant</h3>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($document->montant ?? 0, 2, ',', ' ') }} €</p>
        </div>

        <!-- Date Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-calendar-alt text-blue-600 text-2xl"></i>
                <h3 class="text-sm font-bold text-gray-500 uppercase">Date de dépôt</h3>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ \Carbon\Carbon::parse($document->date_depot)->format('d/m/Y') }}</p>
        </div>

        <!-- Status Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-600">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-info-circle text-purple-600 text-2xl"></i>
                <h3 class="text-sm font-bold text-gray-500 uppercase">Actif</h3>
            </div>
            <p class="text-2xl font-bold">
                @if($document->est_actif)
                    <span class="text-green-600"><i class="fas fa-toggle-on"></i> Oui</span>
                @else
                    <span class="text-gray-500"><i class="fas fa-toggle-off"></i> Non</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Description Section -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-align-left text-indigo-600"></i>Description
        </h3>
        <p class="text-gray-700 leading-relaxed">
            {{ $document->description ?? 'Aucune description fournie' }}
        </p>
    </div>

    <!-- File Section -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-file-download text-blue-600"></i>Fichier attaché
        </h3>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fas fa-file text-blue-600 text-3xl"></i>
                <div>
                    <p class="font-bold text-gray-800">{{ $document->fichier }}</p>
                    <p class="text-sm text-gray-600">Fichier du document</p>
                </div>
            </div>
            <a href="/storage/documents/{{ $document->fichier }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                <i class="fas fa-download"></i>Télécharger
            </a>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 flex-col sm:flex-row">
        <a href="{{ route('documents.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-3 rounded-lg transition duration-300 text-center flex items-center justify-center gap-2">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
        <a href="{{ route('documents.edit', $document->id) }}" class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 text-center flex items-center justify-center gap-2">
            <i class="fas fa-edit"></i> Modifier le document
        </a>
        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')" class="w-full bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
