<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book Collection Manager - Kelola koleksi buku Anda dengan mudah, rapi, dan terorganisir.">
    <meta name="author" content="Dear Haens">
    <meta name="theme-color" content="#4f46e5">
        <title>Koleksi Saya</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📚</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .book-card {
            transition: all 0.3s ease;
            border-left: 4px solid #4f46e5;
        }
        .book-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            background-color: #f9fafb;
        }
        .btn-submit {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
        }
        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        .loading-icon {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
            @if(session('is_demo'))
        <div class="bg-yellow-100 border-b border-yellow-300 text-yellow-800 text-center py-3 px-4 shadow-sm sticky top-0 z-[60]">
            <p class="text-sm font-medium flex items-center justify-center flex-wrap gap-2">
                <span class="bg-yellow-300 text-yellow-900 px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wide">
                    <i class="fas fa-lock mr-1"></i> Mode Demo
                </span>
                <span>Anda hanya dapat melihat data (Read-Only).</span>
                <a href="{{ route('login') }}" class="text-yellow-900 underline font-bold hover:text-yellow-950 transition ml-1">
                    Daftar di sini untuk mencoba fitur penuh &rarr;
                </a>
            </p>
        </div>
    @endif
    
    <!-- NAVBAR PROFESIONAL -->
<nav class="bg-white border-b border-gray-200 w-full mb-8 sticky top-0 z-50">
    <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <!-- KIRI: Logo/Brand & Menu Navigasi -->
        <div class="flex items-center space-x-8">
            <!-- Logo -->
            <a href="{{ route('books.index') }}" class="flex items-center space-x-2 text-indigo-700 font-bold text-xl hover:text-indigo-800 transition">
                <div class="bg-indigo-100 p-2 rounded-lg">
                    <i class="fas fa-book text-indigo-600"></i>
                </div>
                <span>Book Manager</span>
            </a>

                            <!-- Menu Navigasi -->
                <div class="hidden md:flex space-x-6">
                    <!-- Menu Dashboard/Katalog Baru -->
                    <a href="{{ route('dashboard') }}" 
                       class="text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-600 hover:text-indigo-600 pb-1' }}">
                        <i class="fas fa-chart-pie mr-1"></i> Katalog
                    </a>

                    <!-- Menu Buku -->
                    <a href="{{ route('books.index') }}" 
                       class="text-sm font-medium transition {{ request()->routeIs('books.*') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-600 hover:text-indigo-600 pb-1' }}">
                        <i class="fas fa-book-open mr-1"></i> Koleksi Saya
                    </a>
                    
                    <!-- Menu Kategori -->
                    <a href="{{ route('categories.index') }}" 
                       class="text-sm font-medium transition {{ request()->routeIs('categories.*') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-gray-600 hover:text-indigo-600 pb-1' }}">
                        <i class="fas fa-tags mr-1"></i> Kategori
                    </a>
                </div>
        </div>
        
        <!-- KANAN: User Info & Logout -->
        <div class="flex items-center space-x-4">
            <!-- Profil User -->
            <div class="flex items-center space-x-2 text-sm font-medium text-gray-700 bg-gray-50 py-1.5 px-3 rounded-full border border-gray-200">
                <i class="fas fa-user-circle text-indigo-500 text-lg"></i>
                                    <span>
                        @if(session('is_demo'))
                            Guest (Demo)
                        @else
                            {{ Auth::user()->name }}
                        @endif
                    </span>
            </div>
            
            <!-- Garis Pemisah -->
            <div class="h-6 w-px bg-gray-300"></div> 
            
            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium transition flex items-center bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

    <!-- Konten Utama -->
    <div class="max-w-4xl mx-auto w-full flex-1 px-4"> <!-- Tambah px-4 agar di HP tidak mepet -->
        
                <!-- Header (Diubah agar tidak redundan) -->
                <header class="mb-8 mt-4">
            <h1 class="text-2xl font-bold text-gray-800">Koleksi Buku Saya</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola daftar koleksi buku Anda di sini.</p>
        </header>   

        <!-- Flash Message & Error Validation -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Buku (Kembali Full Width) -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-lg font-semibold text-white">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Buku Baru
                </h2>
            </div>
            <form id="add-book-form" method="POST" action="{{ route('books.store') }}" class="p-6">
                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4"> <!-- Diubah jadi 4 kolom -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" id="title" name="title" placeholder="Masukkan judul buku" value="{{ old('title') }}" autocomplete="off"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" id="author" name="author" placeholder="Nama penulis" value="{{ old('author') }}" autocomplete="off"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <input type="number" id="year" name="year" placeholder="Tahun terbit" value="{{ old('year') }}" min="1900" max="{{ date('Y') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    <!-- DROPDOWN KATEGORI BARU -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-white">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" id="submit-btn" class="btn-submit text-white px-6 py-2 rounded-lg shadow-md flex items-center justify-center space-x-2 ml-auto">
                        <span id="btn-text">Tambah Buku</span>
                        <span id="loading-icon" class="hidden loading-icon">
                            <i class="fas fa-spinner"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Daftar Buku -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Daftar Buku -->
            <div class="bg-indigo-700 px-6 py-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-book-open mr-2"></i>
                    <span>Daftar Koleksi Buku</span>
                </h2>
                <span class="bg-indigo-800 text-white text-sm px-3 py-1 rounded-full">
                    {{ count($books) }} buku
                </span>
            </div>

            <!-- Fitur Pencarian (Menyatu di atas daftar) -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <form action="{{ route('books.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis buku..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-sm transition duration-150">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('books.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Reset
                        </a>
                    @endif
                </form>
            </div>

                        <!-- List Buku -->
            @if(count($books) > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($books as $book)
                    <li class="book-card p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $book->title }}</h3>
                                <p class="text-gray-600 mt-1 flex items-center flex-wrap gap-2">
                                    <span><i class="fas fa-user-edit text-indigo-500 mr-1"></i>{{ $book->author }}</span>
                                    <span>•</span>
                                    <span><i class="fas fa-calendar-alt text-indigo-500 mr-1"></i>{{ $book->year }}</span>
                                    
                                    <!-- BADGE KATEGORI BARU -->
                                    @if($book->category)
                                        <span>•</span>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-blue-200">
                                            <i class="fas fa-tag mr-1"></i>{{ $book->category->name }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="flex space-x-2 flex-shrink-0">
                                <!-- GANTI TOMBOL EDIT LAMA MENJADI INI -->
<button type="button" onclick="openEditModal({{ $book->id }}, '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}', '{{ $book->year }}', '{{ $book->category_id }}')" 
        class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-200 flex items-center transition">
    <i class="fas fa-edit mr-2"></i>
    <span>Edit</span>
</button>
                                <form method="POST" action="{{ route('books.destroy', $book->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin mau hapus buku ini?')" class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 flex items-center transition">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- PAGINATION DIPINDAHKAN KE SINI (DI LUAR UL) -->
                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    {{ $books->links() }}
                </div>

            @else
                <div class="p-8 text-center">
                    <i class="fas fa-book text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 font-medium">
                        @if(request('search'))
                            Buku dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                        @else
                            Belum ada buku yang ditambahkan.
                        @endif
                    </p>
                    <p class="text-gray-400 text-sm mt-2">
                        @if(request('search'))
                            Coba gunakan kata kunci lain.
                        @else
                            Tambahkan buku pertama Anda menggunakan form di atas.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

        <!-- Footer -->
    <footer class="mt-auto pt-6 border-t border-gray-200 text-center pb-8 w-full bg-gray-50">
        <p class="text-xs text-gray-500">
            © <span id="current-year">2026</span> Dear Haens
        </p>
    </footer>

        <!-- MODAL EDIT BUKU -->
    <div id="editBookModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4">
            <div class="flex justify-between items-center p-4 border-b bg-indigo-50 rounded-t-xl">
                <h3 class="text-lg font-bold text-indigo-800"><i class="fas fa-edit mr-2"></i>Edit Buku</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form id="editBookForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="title" id="edit_title" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" name="author" id="edit_author" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                            <input type="number" name="year" id="edit_year" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" id="edit_category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 bg-white">
                                <option value="">-- Pilih --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();

        function openEditModal(id, title, author, year, categoryId) {
            document.getElementById('editBookForm').action = `/books/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_author').value = author;
            document.getElementById('edit_year').value = year;
            document.getElementById('edit_category_id').value = categoryId;
            document.getElementById('editBookModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editBookModal').classList.add('hidden');
        }

        const addBookForm = document.getElementById('add-book-form');
        if (addBookForm) {
            addBookForm.addEventListener('submit', function() {
                const btnText = document.getElementById('btn-text');
                const loadingIcon = document.getElementById('loading-icon');
                const submitBtn = document.getElementById('submit-btn');

                if (btnText) btnText.textContent = 'Memproses...';
                if (loadingIcon) loadingIcon.classList.remove('hidden');
                if (submitBtn) submitBtn.disabled = true;
            });
        }
    </script>
</body>
</html>