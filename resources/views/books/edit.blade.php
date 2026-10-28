<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; }
        .btn-submit { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-submit:hover { background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%); }
    </style>
</head>
<body class="p-6">
    <div class="max-w-2xl mx-auto">
        <header class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-800">Edit Buku</h1>
            <p class="text-gray-600">Perbarui data koleksi buku</p>
        </header>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white"><i class="fas fa-edit mr-2"></i>Edit: {{ $book->title }}</h2>
            </div>
            <form method="POST" action="{{ route('books.update', $book->id) }}" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" name="author" value="{{ $book->author }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <input type="number" name="year" value="{{ $book->year }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('books.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                    <button type="submit" class="btn-submit text-white px-6 py-2 rounded-lg shadow-md"><i class="fas fa-save mr-2"></i>Update Buku</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>