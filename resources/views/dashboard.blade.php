<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Koleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <!-- NAVBAR (Sama seperti sebelumnya) -->
    <nav class="bg-white border-b border-gray-200 w-full mb-8 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-indigo-700 font-bold text-xl">
                    <div class="bg-indigo-100 p-2 rounded-lg"><i class="fas fa-book text-indigo-600"></i></div>
                    <span>Book Manager</span>
                </a>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-indigo-600 border-b-2 border-indigo-600 pb-1"><i class="fas fa-chart-pie mr-1"></i> Katalog</a>
                    <a href="{{ route('books.index') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 pb-1"><i class="fas fa-book-open mr-1"></i> Koleksi Saya</a>
                    <a href="{{ route('categories.index') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 pb-1"><i class="fas fa-tags mr-1"></i> Kategori</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
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

    <!-- KONTEN DASHBOARD -->
    <div class="max-w-5xl mx-auto w-full flex-1 px-4 pb-10">
        
                    <header class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-800">
                @if(session('is_demo'))
                    Selamat Datang, Pengunjung 👋
                @else
                    Selamat Datang, {{ Auth::user()->name }} 👋
                @endif
            </h1>
            <p class="text-gray-500 mt-1">Berikut adalah ringkasan koleksi buku pribadi Anda.</p>
        </header>

        <!-- Kartu Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Buku -->
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500 flex items-center card-hover">
                <div class="bg-indigo-50 p-4 rounded-full mr-4">
                    <i class="fas fa-book text-indigo-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Buku</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalBooks }}</h2>
                </div>
            </div>
            
            <!-- Total Kategori -->
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center card-hover">
                <div class="bg-blue-50 p-4 rounded-full mr-4">
                    <i class="fas fa-tags text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Kategori</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalCategories }}</h2>
                </div>
            </div>

            <!-- Total Penulis -->
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 flex items-center card-hover">
                <div class="bg-purple-50 p-4 rounded-full mr-4">
                    <i class="fas fa-user-edit text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Penulis</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalAuthors }}</h2>
                </div>
            </div>
        </div>

        <!-- Baris Grafik & Buku Terbaru -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Kolom Grafik (Kiri) -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:col-span-1">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Genre Favorit</h3>
                <div class="relative w-full h-64 flex justify-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <!-- Kolom Buku Terbaru (Kanan) -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:col-span-2">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="text-lg font-bold text-gray-800">Baru Ditambahkan</h3>
                    <a href="{{ route('books.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($recentBooks as $book)
                        <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition border border-gray-100">
                            <div class="bg-indigo-100 text-indigo-600 w-10 h-12 rounded flex items-center justify-center mr-4 shadow-sm">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-800">{{ $book->title }}</h4>
                                <p class="text-xs text-gray-500">{{ $book->author }} • {{ $book->year }}</p>
                            </div>
                            @if($book->category)
                                <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded border border-blue-100 hidden md:block">
                                    {{ $book->category->name }}
                                </span>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada buku.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

        <!-- Footer -->
    <footer class="mt-auto pt-6 border-t border-gray-200 text-center pb-8 w-full bg-gray-50">
        <p class="text-xs text-gray-500">
            © <span id="current-year">2026</span> Dear Haens
        </p>
    </footer>

    <!-- SCRIPT CHART.JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('categoryChart').getContext('2d');
            
            // Data dari Controller
            const labels = {!! json_encode($chartLabels) !!};
            const data = {!! json_encode($chartData) !!};

            new Chart(ctx, {
                type: 'doughnut', // Tipe grafik donat
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            '#4f46e5', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#06b6d4', '#6366f1'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 11, family: 'Poppins' }
                            }
                        }
                    },
                    cutout: '65%' // Membuat lubang tengah grafik lebih besar (gaya donat modern)
                }
            });
        });
    </script>
</body>


</html>