<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar simple -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="font-bold text-lg">Documents App</h1>
            <a href="{{ route('documents.index') }}" class="hover:underline">Documents</a>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-gray-700 p-4 text-center">
        &copy; 2026 Mon App
    </footer>

</body>
</html>
