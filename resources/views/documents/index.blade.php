@extends('layouts.app')

@section('content')
<div>
    <!-- Header Section -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">📁 Mes Documents</h1>
            <p class="text-gray-600">Gérez et organisez vos documents facilement</p>
        </div>
        <a href="{{ route('documents.create') }}" class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex items-center gap-2">
            <i class="fas fa-plus"></i> Ajouter Document
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-600 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold"><i class="fas fa-exclamation-circle mr-2"></i>Erreur</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-600 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold"><i class="fas fa-check-circle mr-2"></i>Succès</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Documents Grid/Table -->
    @forelse($documents as $document)
        @if($loop->first)
        <div class="grid grid-cols-1 gap-4">
        @endif
            <!-- Document Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden border border-gray-100">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $document->titre }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Ref: {{ $document->reference }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($document->statut === 'valide') bg-green-100 text-green-800
                            @elseif($document->statut === 'rejete') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($document->statut) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 py-4 border-y border-gray-200">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Type</p>
                            <p class="font-semibold text-gray-700">{{ ucfirst($document->type) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Montant</p>
                            <p class="font-semibold text-gray-700">{{ $document->montant ?? '0.00' }} €</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Date</p>
                            <p class="font-semibold text-gray-700">{{ $document->date_depot }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Actif</p>
                            <p class="font-semibold text-gray-700">
                                <i class="fas {{ $document->est_actif ? 'fa-check text-green-600' : 'fa-times text-red-600' }}"></i>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('documents.show', $document->id) }}" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-2 rounded-lg transition">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        <a href="{{ route('documents.edit', $document->id) }}" class="inline-flex items-center gap-1 bg-amber-50 hover:bg-amber-100 text-amber-700 px-4 py-2 rounded-lg transition">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-700 px-4 py-2 rounded-lg transition">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @if($loop->last)
        </div>
        @endif
    @empty
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-md p-12 text-center border border-gray-100">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun document</h3>
            <p class="text-gray-600 mb-6">Vous n'avez pas encore de document. Commencez par en créer un.</p>
            <a href="{{ route('documents.create') }}" class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white px-6 py-3 rounded-lg inline-flex items-center gap-2 shadow-lg hover:shadow-xl transition duration-300">
                <i class="fas fa-plus"></i> Créer un document
            </a>
        </div>
    @endforelse
</div>
@endsection
