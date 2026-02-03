<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    private function validation(Request $request, $id = null)
    {
        return $request->validate([
            'reference'   => 'required|string|max:50|unique:documents,reference,' . $id,
            'titre'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'required|in:facture,contrat,rapport,autre',
            'fichier' => $id
                ? 'nullable|file'   // Update: fichier optionnel
                : 'required|file',  // Create: fichier obligatoire
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
        //Validation des données
        $data = $this->validation($request);

        //Vérifier si un fichier a été uploadé
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('documents', $filename, 'public');

            $data['fichier'] = $filename;
        }

        DocumentModel::create($data);

        return redirect()->route('documents.index')->with('success', 'Document ajouté avec succès');
    }


    public function edit($id)
    {
        $document = DocumentModel::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $document = DocumentModel::findOrFail($id);
        $data = $this->validation($request, $id);

        // Handle file upload
        if ($request->hasFile('fichier')) {
            // Delete old file if exists
            if ($document->fichier && Storage::disk('public')->exists('documents/' . $document->fichier)) {
                Storage::disk('public')->delete('documents/' . $document->fichier);
            }

            $file = $request->file('fichier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            $data['fichier'] = $filename;
        }

        $document->update($data);
        return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès');
    }

    public function destroy($id)
    {
        $document = DocumentModel::findOrFail($id);
        
        // Delete file if exists
        if ($document->fichier && Storage::disk('public')->exists('documents/' . $document->fichier)) {
            Storage::disk('public')->delete('documents/' . $document->fichier);
        }
        
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès');
    }
}
