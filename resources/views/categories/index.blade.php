<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📚</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .card-hover { transition: transform 0.2s, box-shadow 0.2s; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="flex flex-col min-h-screen">
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

    <!-- KONTEN UTAMA -->
    <div class="max-w-4xl mx-auto w-full flex-1 px-4 pb-10">
        
        <!-- Flash Message -->
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

        <!-- Header Halaman -->
        <header class="mb-8 mt-4">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola kategori (genre) untuk mengelompokkan buku Anda.</p>
        </header>

        <!-- Form Tambah Kategori -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border-t-4 border-indigo-600">
            <form action="{{ route('categories.store') }}" method="POST" class="p-6 flex flex-col md:flex-row gap-4 items-end">
                @csrf
                <div class="flex-1 w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori Baru</label>
                    <input type="text" name="name" required placeholder="Contoh: Fiksi, Teknologi, Sejarah..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-md transition w-full md:w-auto flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Kategori
                </button>
            </form>
        </div>

        <!-- Daftar Kategori -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-lg font-semibold text-white">
                    <i class="fas fa-list mr-2"></i>Daftar Kategori
                </h2>
            </div>
            
            <ul class="divide-y divide-gray-200">
                @forelse($categories as $category)
                    <li class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                        <div class="flex items-center">
                            <div class="bg-indigo-50 p-2 rounded-lg mr-4">
                                <i class="fas fa-tag text-indigo-500"></i>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-800 block">{{ $category->name }}</span>
                                <span class="text-xs text-gray-500">{{ $category->books_count }} Buku terdaftar</span>
                            </div>
                        </div>
                        
                                                    <!-- Tombol Aksi (Disamakan dengan halaman Buku) -->
                        <div class="flex space-x-2 flex-shrink-0">
                            <!-- Tombol Edit -->
                            <button type="button" onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')" 
                                    class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-200 flex items-center transition">
                                <i class="fas fa-edit mr-2"></i>
                                <span>Edit</span>
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus kategori ini? Semua buku di dalamnya juga akan terhapus!')" 
                                        class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 flex items-center transition">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="p-8 text-center text-gray-500 flex flex-col items-center">
                        <i class="fas fa-tags text-gray-300 text-5xl mb-4"></i>
                        <p class="font-medium">Belum ada kategori yang dibuat.</p>
                        <p class="text-sm text-gray-400 mt-1">Silakan tambahkan kategori melalui form di atas.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

        <!-- Footer -->
    <footer class="mt-auto pt-6 border-t border-gray-200 text-center pb-8 w-full bg-gray-50">
        <p class="text-xs text-gray-500">
            © <span id="current-year">2026</span> Dear Haens
        </p>
    </footer>

        <!-- MODAL EDIT KATEGORI -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-md mx-4">
            <!-- Header Modal -->
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-bold text-gray-800"><i class="fas fa-edit text-indigo-600 mr-2"></i>Edit Kategori</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Form Edit -->
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="editName" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    
        document.getElementById('current-year').textContent = new Date().getFullYear();

                // Fungsi untuk membuka modal edit
        function openEditModal(id, name) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const inputName = document.getElementById('editName');

            // Set value input ke nama kategori yang dipilih
            inputName.value = name;
            
            // Set action URL form ke route update dengan ID yang sesuai
            form.action = `/categories/${id}`;

            // Tampilkan modal
            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }

        // Tutup modal jika area luar (background) diklik
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>