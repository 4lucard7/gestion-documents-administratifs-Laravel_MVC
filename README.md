# 📄 Gestion des Documents Administratifs - Laravel MVC

Une application web moderne pour la gestion centralisée des documents administratifs avec interface utilisateur intuitive et design professionnel.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=flat-square&logo=tailwind-css)

## ✨ Fonctionnalités

- 📋 **Gestion CRUD complète** - Créer, lire, modifier et supprimer des documents
- 📁 **Gestion des fichiers** - Téléchargement et stockage sécurisé des documents
- 🏷️ **Catégorisation** - Classification par type (Facture, Contrat, Rapport, etc.)
- 📊 **Statuts** - Suivi des statuts (En attente, Validé, Rejeté)
- 💰 **Montants** - Enregistrement des montants financiers
- 🎨 **Interface moderne** - Design responsive avec Tailwind CSS et Font Awesome
- ✅ **Validation robuste** - Validation complète des données côté serveur
- 🔔 **Messages flash** - Retours utilisateur instantanés

## 🛠️ Prérequis

- **PHP** >= 8.1
- **Composer**
- **MySQL** ou **MariaDB**
- **Node.js** et **npm** (pour les assets)

## 📦 Installation

### 1. Cloner le repository
```bash
git clone https://github.com/4lucard7/gestion-documents-administratifs-Laravel_MVC.git
cd gestion-documents-administratifs-Laravel_MVC
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Copier le fichier d'environnement
```bash
cp .env.example .env
```

### 4. Générer la clé de l'application
```bash
php artisan key:generate
```

### 5. Configurer la base de données
Éditer le fichier `.env` et configurer les paramètres de base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestiondocuments
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Exécuter les migrations
```bash
php artisan migrate
```

### 7. Installer les dépendances npm
```bash
npm install
npm run dev
```

### 8. Démarrer le serveur
```bash
php artisan serve
```

L'application sera accessible à `http://localhost:8000`

## 🎯 Utilisation

### Accueil
- Accédez à la page d'accueil pour voir la liste de tous les documents
- Bouton flottant pour ajouter rapidement un nouveau document

### Créer un document
1. Cliquez sur "➕ Ajouter un Document"
2. Remplissez les informations du document :
   - Référence (identifiant unique)
   - Titre
   - Description
   - Type de document
   - Fichier à télécharger
   - Statut
   - Date de dépôt
   - Montant (optionnel)
   - Marquer comme actif
3. Cliquez sur "Enregistrer"

### Voir les détails
- Cliquez sur l'icône 👁️ pour voir les détails complets d'un document
- Consultez tous les métadonnées et le fichier attaché

### Modifier un document
- Cliquez sur l'icône ✏️ pour modifier
- Changez les informations
- Téléchargez un nouveau fichier si nécessaire
- Cliquez sur "Mettre à jour"

### Supprimer un document
- Cliquez sur l'icône 🗑️ pour supprimer
- Confirmez la suppression
- Le document et son fichier seront supprimés définitivement

## 📁 Structure du projet

```
tp4/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── DocumentController.php     # Contrôleur principal
│   └── Models/
│       ├── DocumentModel.php              # Modèle Eloquent
│       └── User.php
├── database/
│   ├── migrations/
│   │   └── 2026_02_03_134131_create_documents_table.php
│   └── seeders/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php              # Mise en page principale
│       └── documents/
│           ├── index.blade.php            # Liste des documents
│           ├── create.blade.php           # Formulaire création
│           ├── edit.blade.php             # Formulaire modification
│           └── show.blade.php             # Détails d'un document
├── routes/
│   └── web.php                            # Routes de l'application
├── storage/
│   └── app/
│       └── documents/                     # Dossier de stockage des fichiers
└── public/
    └── index.php
```

## 💾 Schéma de base de données

### Table: documents

| Colonne | Type | Description |
|---------|------|-------------|
| id | BIGINT | Clé primaire |
| reference | VARCHAR(255) | Référence unique |
| titre | VARCHAR(255) | Titre du document |
| description | LONGTEXT | Description détaillée |
| type | ENUM | Type (facture, contrat, rapport, autre) |
| fichier | VARCHAR(255) | Nom du fichier stocké |
| statut | ENUM | Statut (en_attente, valide, rejete) |
| date_depot | DATE | Date du dépôt |
| montant | DECIMAL(10,2) | Montant financier |
| est_actif | BOOLEAN | État actif/inactif |
| created_at | TIMESTAMP | Date de création |
| updated_at | TIMESTAMP | Date de modification |

## 🎨 Technologies utilisées

- **Backend**: Laravel 11
- **Frontend**: Blade templating + Tailwind CSS
- **Icons**: Font Awesome 6.4.0
- **Database**: MySQL
- **Storage**: Système de fichiers Laravel

## 🔒 Validation et sécurité

Tous les formulaires incluent :
- ✅ Validation côté serveur
- 🛡️ Protection CSRF
- 📝 Gestion des erreurs
- 💾 Suppression sécurisée des fichiers lors de modifications

## 📋 Routes disponibles

| Méthode | Route | Contrôleur | Description |
|---------|-------|-----------|-------------|
| GET | /documents | index | Afficher tous les documents |
| GET | /documents/create | create | Afficher le formulaire de création |
| POST | /documents | store | Enregistrer un nouveau document |
| GET | /documents/{id} | show | Afficher les détails d'un document |
| GET | /documents/{id}/edit | edit | Afficher le formulaire de modification |
| PUT | /documents/{id} | update | Mettre à jour un document |
| DELETE | /documents/{id} | destroy | Supprimer un document |

## 🐛 Corrections apportées

- ✅ Création de la table `sessions` manquante
- ✅ Correction du type de champ fichier dans le formulaire d'édition
- ✅ Implémentation de la suppression sécurisée des fichiers
- ✅ Ajout des messages de succès/erreur flash
- ✅ Amélioration complète de l'interface utilisateur avec design moderne


## 👨‍💻 Auteur

Créé avec ❤️ pour la gestion efficace des documents administratifs.

---

**Note**: Cette application utilise des technologies modernes et suit les bonnes pratiques Laravel. Pour toute question ou suggestion, n'hésitez pas à ouvrir une issue.
