<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Collection Manager</title>
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
        }
        .btn-submit {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
        }
        .btn-delete, .btn-edit {
            transition: all 0.2s ease;
        }
        .btn-delete:hover, .btn-edit:hover {
            transform: scale(1.05);
        }
        .loading-icon {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .creator-info {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-indigo-800 mb-2">Book Collection Manager</h1>
            <p class="text-gray-600">Kelola koleksi buku Anda dengan mudah</p>
            
            <!-- Creator Information -->
            <div class="creator-info inline-block mt-4">
                <p class="text-sm text-gray-700">
                    <i class="fas fa-user-graduate text-indigo-600 mr-1"></i>
                    <strong>Dear Haens</strong> | 
                    <i class="fas fa-id-card text-indigo-600 mr-1"></i>
                    NPM: 1101221168 | 
                    <i class="fas fa-laptop-code text-indigo-600 mr-1"></i>
                    Prodi: Teknik Informatika
                </p>
            </div>
        </header>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Form Tambah Buku -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10">
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Buku Baru
                </h2>
            </div>
            <form method="POST" action="{{ route('books.store') }}" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" id="title" name="title" placeholder="Masukkan judul buku"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" id="author" name="author" placeholder="Nama penulis"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <input type="number" id="year" name="year" placeholder="Tahun terbit" min="1900" max="{{ date('Y') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" id="submit-btn" class="btn-submit text-white px-6 py-2 rounded-lg shadow-md flex items-center justify-center space-x-2 mx-auto md:mx-0 md:ml-auto">
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
            <div class="bg-indigo-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-book-open mr-2"></i>
                    <span>Daftar Koleksi Buku</span>
                    <span class="ml-auto bg-indigo-800 text-white text-sm px-3 py-1 rounded-full">
                        {{ count($books) }} buku
                    </span>
                </h2>
            </div>

            @if(count($books) > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($books as $book)
                    <li class="book-card p-6 hover:bg-gray-50">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $book->title }}</h3>
                                <p class="text-gray-600 mt-1">
                                    <i class="fas fa-user-edit text-indigo-500 mr-1"></i>
                                    {{ $book->author }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-calendar-alt text-indigo-500 mr-1"></i>
                                    {{ $book->year }}
                                </p>
                            </div>
                            <div class="flex space-x-2 flex-shrink-0">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn-edit bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-200 flex items-center">
                                    <i class="fas fa-edit mr-2"></i>
                                    <span>Edit</span>
                                </a>
                                <form method="POST" action="{{ route('books.destroy', $book->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin mau hapus buku ini?')" class="btn-delete bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 flex items-center">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center">
                    <i class="fas fa-book text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Belum ada buku yang ditambahkan</p>
                    <p class="text-gray-400 text-sm mt-2">Tambahkan buku pertama Anda menggunakan form di atas</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const btnText = document.getElementById('btn-text');
            const loadingIcon = document.getElementById('loading-icon');
            if(btnText){
                btnText.textContent = 'Memproses...';
            }
            if(loadingIcon){
                loadingIcon.classList.remove('hidden');
            }
            const submitBtn = document.getElementById('submit-btn');
            if(submitBtn) submitBtn.disabled = true;
        });
    </script>
</body>
</html>