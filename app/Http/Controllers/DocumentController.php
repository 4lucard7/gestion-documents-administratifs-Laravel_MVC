<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private function validation(Request $request, $id = null)
    {
        return $request->validate([
            'reference'   => 'required|string|max:50|unique:documents,reference,' . $id,
            'titre'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'required|in:facture,contrat,rapport,autre',
            'fichier'     => 'required|string',
            'statut'      => 'required|in:en_attente,valide,rejete',
            'date_depot'  => 'required|date',
            'montant'     => 'nullable|numeric|min:0',
            'est_actif'   => 'boolean',
        ]);
    }

    public function index()
    {
        $documents = DocumentModel::all();
        return view('documents.index', compact('documents'));
    }

    public function show($id)
    {
        $document = DocumentModel::findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        DocumentModel::create($this->validation($request));
        return redirect()->route('documents.index');
    }

    public function edit($id)
    {
        $document = DocumentModel::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $document = DocumentModel::findOrFail($id);
        $document->update($this->validation($request, $id));
        return redirect()->route('documents.index');
    }

    public function destroy($id)
    {
        $document = DocumentModel::findOrFail($id);
        $document->delete();
        return redirect()->route('documents.index');
    }
}
