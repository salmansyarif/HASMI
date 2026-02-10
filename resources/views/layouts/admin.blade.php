<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - HASMI')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #EFF6FF;
            color: #2563EB;
            border-left: 4px solid #2563EB;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex flex-col">
            <!-- Logo -->
            <div class="p-6 hero-gradient">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                        <span class="text-blue-800 font-bold text-lg">H</span>
                    </div>
                    <div>
                        <h2 class="text-white font-bold text-lg">HASMI Admin</h2>
                        <p class="text-blue-200 text-xs">Dashboard</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-6">
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.articles.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Artikel Materi</span>
                </a>

                <a href="{{ route('admin.berita-terkini.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.berita-terkini.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Berita Terkini</span>
                </a>

                <a href="{{ route('admin.programs.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase w-5"></i>
                    <span>Program</span>
                </a>

                <a href="{{ route('admin.intisari.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.intisari.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt w-5"></i>
                    <span>Intisari HASMI</span>
                </a>

                <a href="{{ route('admin.kegiatan.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Kegiatan</span>
                </a>

                <a href="{{ route('admin.comments.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    <i class="fas fa-comments w-5"></i>
                    <span>Moderasi Komentar</span>
                </a>

                <a href="{{ route('admin.admins.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700 {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog w-5"></i>
                    <span>Kelola Admin</span>
                </a>

                <div class="border-t border-gray-200 my-4"></div>

                <a href="{{ route('home') }}" 
                   target="_blank" 
                   class="sidebar-link flex items-center gap-3 px-6 py-3 text-gray-700">
                    <i class="fas fa-external-link-alt w-5"></i>
                    <span>Lihat Website</span>
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="p-6 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 hero-gradient rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-gray-600 text-sm">@yield('page-subtitle', 'Kelola konten website HASMI')</p>
                </div>
            </header>

            <!-- Content -->
            <div class="p-8">
                <!-- Alert Messages -->
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')

</body>
</html>