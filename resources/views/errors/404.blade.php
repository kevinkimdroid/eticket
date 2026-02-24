<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - eTicket KE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
    <div class="text-center">
        <p class="text-8xl font-bold text-indigo-100">404</p>
        <h1 class="text-2xl font-bold text-slate-800 mt-4">Page not found</h1>
        <p class="text-slate-600 mt-2">The page you're looking for doesn't exist.</p>
        <a href="{{ route('events.index') }}" class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700">Back to Events</a>
    </div>
</body>
</html>
