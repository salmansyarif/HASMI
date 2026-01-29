@extends('layouts.app')

@section('title', 'Program HASMI')

@section('content')

<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
        margin-top: 80px;
    }
    
    .content-section {
        padding: 60px 0;
    }
    
    .program-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container mx-auto px-6 text-center text-white">
        <div class="max-w-3xl mx-auto">
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-heart text-4xl text-white"></i>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Program HASMI</h1>
            <p class="text-xl md:text-2xl text-white/90">
                Berbagai program dakwah dan pemberdayaan umat
            </p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="content-section bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Intro Text -->
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Tentang Program HASMI</h2>
                <div class="prose prose-lg max-w-none text-gray-600">
                    <p class="mb-4">
                        Program HASMI merupakan berbagai kegiatan dakwah dan pemberdayaan umat yang dilaksanakan 
                        oleh Yayasan HASMI dalam rangka menyebarkan ajaran Islam yang rahmatan lil alamin.
                    </p>
                    <p>
                        Melalui program-program yang terstruktur dan berkelanjutan, kami berupaya memberikan 
                        kontribusi nyata bagi kemajuan umat Islam di Indonesia.
                    </p>
                </div>
            </div>

            <!-- Program Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                
                <!-- Program Card 1 -->
                <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-book-open text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Pendidikan Islam</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">
                            Program pengembangan pendidikan Islam melalui berbagai metode pembelajaran yang inovatif.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Kajian rutin untuk berbagai kalangan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Training untuk para da'i</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Beasiswa pendidikan Islam</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Program Card 2 -->
                <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-hands-helping text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Sosial & Dakwah</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">
                            Kegiatan sosial kemasyarakatan dan dakwah untuk kesejahteraan umat.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Bakti sosial ke daerah terpencil</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Santunan anak yatim dan dhuafa</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Dakwah keliling ke berbagai daerah</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Program Card 3 -->
                <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-mosque text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Pembangunan</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">
                            Program pembangunan sarana dan prasarana keagamaan untuk umat.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Pembangunan masjid dan mushola</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Renovasi tempat ibadah</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Pembangunan lembaga pendidikan</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Program Card 4 -->
                <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-heartbeat text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Kesehatan</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">
                            Program layanan kesehatan gratis untuk masyarakat kurang mampu.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Pengobatan gratis keliling</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Bantuan alat kesehatan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Edukasi kesehatan islami</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Program Card 5 -->
                <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-briefcase text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Ekonomi Umat</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">
                            Pemberdayaan ekonomi umat melalui pelatihan dan pendampingan usaha.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Pelatihan kewirausahaan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Bantuan modal usaha</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Pendampingan UMKM</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Program Card 6 -->
                <div class="program-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-8 text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-users text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Pembinaan Remaja</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">
                            Program khusus untuk pembinaan generasi muda muslim.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Mentoring remaja muslim</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Pelatihan leadership islami</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                                <span>Kegiatan positif remaja</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>

            <!-- Call to Action -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 md:p-12 text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Mari Bergabung Bersama Kami</h2>
                <p class="text-xl mb-8 text-white/90">
                    Jadilah bagian dari gerakan dakwah dan pemberdayaan umat
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="https://donasi.hasmi.org/" target="_blank" 
                       class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-colors inline-flex items-center gap-2">
                        <i class="fas fa-heart"></i> Donasi Sekarang
                    </a>
                    <a href="{{ route('tentang') }}" 
                       class="bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-xl font-bold hover:bg-white/20 transition-colors inline-flex items-center gap-2 border-2 border-white/30">
                        <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection