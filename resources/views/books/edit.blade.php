<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Book Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .btn-submit { transition: all 0.3s ease; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-submit:hover { background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%); transform: translateY(-1px); }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- NAVBAR PROFESIONAL (Sama seperti halaman lain) -->
    <nav class="bg-white border-b border-gray-200 w-full mb-8 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-indigo-700 font-bold text-xl hover:text-indigo-800 transition">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <i class="fas fa-book text-indigo-600"></i>
                    </div>
                    <span>Book Manager</span>
                </a>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 pb-1"><i class="fas fa-chart-pie mr-1"></i> Katalog</a>
                    <a href="{{ route('books.index') }}" class="text-sm font-medium transition {{ request()->routeIs('books.*') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-600 hover:text-indigo-600 pb-1' }}"><i class="fas fa-book-open mr-1"></i> Koleksi Saya</a>
                    <a href="{{ route('categories.index') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 pb-1"><i class="fas fa-tags mr-1"></i> Kategori</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2 text-sm font-medium text-gray-700 bg-gray-50 py-1.5 px-3 rounded-full border border-gray-200">
                    <i class="fas fa-user-circle text-indigo-500 text-lg"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <div class="h-6 w-px bg-gray-300"></div> 
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium transition flex items-center bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="max-w-2xl mx-auto w-full flex-1 px-4 pb-10">
        
        <!-- Header Halaman -->
        <header class="mb-6 mt-2">
            <h1 class="text-2xl font-bold text-gray-800">Edit Data Buku</h1>
            <p class="text-gray-500 text-sm mt-1">Perbarui informasi detail koleksi buku Anda.</p>
        </header>

        <!-- Flash Message (Jika ada error validasi) -->
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card Form Edit -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-indigo-600">
            <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-100">
                <h2 class="text-lg font-semibold text-indigo-800 truncate">
                    <i class="fas fa-edit mr-2"></i>{{ $book->title }}
                </h2>
            </div>
            
            <form method="POST" action="{{ route('books.update', $book->id) }}" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-5">
                    <!-- Judul -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    
                    <!-- Penulis -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" name="author" value="{{ old('author', $book->author) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    
                    <!-- Tahun & Kategori (Dibuat Sejajar) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                            <input type="number" name="year" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="mt-8 flex justify-between items-center border-t border-gray-100 pt-6">
                    <a href="{{ route('books.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn-submit text-white px-6 py-2 rounded-lg shadow-md flex items-center">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>