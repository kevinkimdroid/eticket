<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Something went wrong - eTicket KE</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
    <div class="text-center max-w-md">
        <p class="text-6xl mb-4">⚠️</p>
        <h1 class="text-2xl font-bold text-slate-800">Something went wrong</h1>
        <p class="text-slate-600 mt-2">We're sorry. Please try again later.</p>
        <a href="{{ route('events.index') }}" class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700">Back to Events</a>
    </div>
</body>
</html>
