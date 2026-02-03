<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <!-- Modern Navbar -->
    <nav class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fas fa-file-alt text-2xl"></i>
                    <h1 class="font-bold text-xl">DocManager</h1>
                </div>
                <a href="{{ route('documents.index') }}" class="hover:bg-white/20 px-4 py-2 rounded-lg transition duration-300">Mes Documents</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </main>

    <!-- Modern Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-2">&copy; 2026 DocManager - Gestion de Documents</p>
            <p class="text-sm text-gray-500">Système de gestion documentaire moderne et sécurisé</p>
        </div>
    </footer>
</body>
</html>
