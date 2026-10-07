<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pembeli | ZiFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang Pembeli!</h1>
        <p class="text-gray-500">Halaman pesanan kamu sedang dalam pengembangan.</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="text-red-500 font-bold underline">Logout</button>
        </form>
    </div>
</body>
</html>