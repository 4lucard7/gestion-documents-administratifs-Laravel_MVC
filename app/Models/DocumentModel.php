<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $table = "documents";
    protected $fillable = [
        'reference',
        'titre',
        'description',
        'type',
        'fichier',
        'statut',
        'date_depot',
        'montant',
        'est_actif'
    ];
}
