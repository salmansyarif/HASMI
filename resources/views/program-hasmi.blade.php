@extends('layouts.app')

@section('title', 'Program HASMI')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

{{-- HERO SECTION --}}
<section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 pt-32 pb-24 overflow-hidden">
    {{-- Animated Background --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-30">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-400 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-xl px-6 py-3 rounded-full border border-white/20 mb-8" data-aos="zoom-in">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center animate-pulse-slow">
                    <i class="fas fa-star text-blue-600 text-xl"></i>
                </div>
                <span class="text-lg font-bold text-white">Program Kami</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                Program <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-300 to-cyan-200 animate-gradient">HASMI</span>
            </h1>
            <div class="w-32 h-1.5 bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 mx-auto rounded-full mb-8 animate-gradient" data-aos="fade" data-aos-delay="200"></div>
            <p class="text-xl md:text-2xl text-blue-100 leading-relaxed max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                Berbagai program dakwah dan pemberdayaan umat untuk kemajuan Islam di Indonesia
            </p>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-blue-300 rounded-full flex justify-center p-2">
            <div class="w-1.5 h-3 bg-blue-300 rounded-full animate-scroll"></div>
        </div>
    </div>
</section>

{{-- INTRO SECTION --}}
<section class="py-20 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800">
    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-blue-800/40 backdrop-blur-xl rounded-3xl border-2 border-blue-400/30 p-10 md:p-16 hover:border-blue-300 hover:shadow-2xl hover:shadow-blue-500/50 transition-all duration-500" data-aos="fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-info-circle text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Tentang Program HASMI</h2>
                </div>
                <div class="space-y-5 text-blue-100 text-lg leading-relaxed">
                    <p data-aos="fade-up" data-aos-delay="100">
                        Program HASMI merupakan berbagai kegiatan dakwah dan pemberdayaan umat yang dilaksanakan 
                        oleh Yayasan HASMI dalam rangka menyebarkan ajaran Islam yang rahmatan lil alamin.
                    </p>
                    <p data-aos="fade-up" data-aos-delay="200">
                        Melalui program-program yang terstruktur dan berkelanjutan, kami berupaya memberikan 
                        kontribusi nyata bagi kemajuan umat Islam di Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM DAKWAH SECTION --}}
<section class="py-20 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-green-500 opacity-5 rounded-l-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block bg-green-500/20 backdrop-blur-sm px-6 py-3 rounded-full border border-green-400/30 mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Program Dakwah</h2>
            </div>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto">Menyebarkan dakwah Islam yang rahmatan lil alamin</p>
        </div>

        {{-- Photo Gallery Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @php
            $dakwahPrograms = [
                ['title' => 'TABLIGH AKBAR HASMI', 'desc' => 'Kegiatan dakwah akbar dengan menghadirkan para ustadz dan dai kondang untuk memberikan pencerahan kepada masyarakat luas'],
                ['title' => 'KAJIAN UMUM', 'desc' => 'Sebuah program yang bertujuan untuk meningkatkan keilmuan, keimanan dan ketakwaan masyarakat terhadap islam. Program ini dilaksanakan rutin setiap pekannya di berbagai wilayah JABODETABEK, Bandung, Tasik, Jateng dan Jatim.'],
                ['title' => 'BEDAH BUKU', 'desc' => 'Yaitu program yang bertujuan meningkatkan keimanan masyarakat terhadap Islam melalui Pembahasan Buku-Buku yang diterbitkan oleh Lajnah Ilmiyah HASMI dengan pemateri dari para ustadz HASMI dan diselenggarakan di masjid-masjid yang siap untuk diadakan kajian bedah buku shirotul mustaqim gratis dan terbuka untuk umum.'],
                ['title' => 'SEBAR KARTU DAKWAH ATAU JAULAH DAKWAH', 'desc' => 'Menyebarkan kartu dakwah berupa materi-materi ilmu keIslaman yang sangat bermanfaat untuk kaum muslimin yang disebar secara gratis di tempat-tempat umum dan dilaksanakan oleh struktur, anggota dan simpatisan HASMI juga masyarakat pada umumnya.'],
                ['title' => 'SAFARI DAKWAH (SAFDA)', 'desc' => 'Yaitu program yang bertujuan meningkatkan keimanan dan kepedulian struktur, anggota dan simpatisan HASMI serta masyarakat terhadap masjid-masjid melalui program membersihkan masjid, sebar kartu dakwah, tausiyah setiap ba\'da sholat dan ukhuwah Islamiyah yang diselenggarakan selama satu hari satu malam gratis dan terbuka untuk umum.'],
                ['title' => 'SEMINAR', 'desc' => 'Sebuah program yang bertujuan untuk meningkatkan keilmuan, keimanan dan ketakwaan pelajar baik pelajar sekolah tingkat pertama maupun Mahasiswa. Program ini dilaksanakan bekerjasama dengan pihak-pihak sekolah ataupun kampus.'],
            ];
            @endphp
            
            @foreach($dakwahPrograms as $index => $program)
            <div onclick="openImageModal('{{ asset('dakwah_' . ($index + 1) . '.jpg') }}', '{{ $program['title'] }}', '{{ $program['desc'] }}', 'Dakwah')" 
                 class="group relative aspect-[4/3] rounded-2xl overflow-hidden border-2 border-green-400/30 hover:border-green-300 shadow-xl hover:shadow-2xl hover:shadow-green-500/50 transition-all duration-500 hover:-translate-y-2 cursor-pointer" 
                 data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                <img src="{{ asset('dakwah_' . ($index + 1) . '.jpg') }}" 
                     alt="{{ $program['title'] }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     onerror="this.src='https://via.placeholder.com/800x600/059669/ffffff?text={{ urlencode($program['title']) }}'">
                
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-green-950 via-green-900/60 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                
                {{-- Content --}}
                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full uppercase">Dakwah</span>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">{{ $program['title'] }}</h3>
                    <p class="text-green-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2">{{ $program['desc'] }}</p>
                </div>

                {{-- Click to view indicator --}}
                <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-lg">
                    <i class="fas fa-expand text-green-600"></i>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Details --}}
        <div class="bg-green-800/30 backdrop-blur-xl rounded-2xl border border-green-400/30 p-8 hover:border-green-300 transition-colors duration-500" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-mosque text-white"></i>
                </div>
                Detail Program Dakwah
            </h3>
            <div class="grid md:grid-cols-2 gap-4 text-blue-100">
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Tabligh akbar dengan ustadz kondang</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Kajian rutin berbagai wilayah</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Bedah buku Shirotul Mustaqim</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Safari dakwah ke masjid-masjid</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM PENDIDIKAN SECTION --}}
<section class="py-20 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-500 opacity-5 rounded-l-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block bg-blue-500/20 backdrop-blur-sm px-6 py-3 rounded-full border border-blue-400/30 mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Program Pendidikan</h2>
            </div>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto">Membangun generasi muslim yang berilmu dan berakhlak mulia</p>
        </div>

        {{-- Photo Gallery Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @php
            $pendidikanPrograms = [
                ['title' => 'MAHAD HUDA ISLAMI', 'desc' => 'Lembaga pendidikan Islam terpadu di Bogor yang fokus pada pembentukan karakter dan keilmuan Islam yang mendalam'],
                ['title' => 'MAHAD AL-GHOROWI', 'desc' => 'Lembaga pendidikan Islam terpadu di Bogor yang fokus pada pembentukan karakter dan keilmuan Islam yang mendalam'],
                ['title' => 'MAHAD ABU BAKAR', 'desc' => 'Program bantuan pendidikan untuk di tasikmalayasiswa dan mahasiswa berprestasi yang kurang mampu untuk melanjutkan pendidikan'],
                ['title' => 'MAHAD IMAM MUSLIM ', 'desc' => 'Bimbingan menghafal Al-Qur\'an di cirebon  dengan metode yang terstruktur dan didampingi oleh para pengajar yang berpengalaman'],
                ['title' => 'MA HAD MAKKAH ', 'desc' => 'Pelatihan intensif di cianjur dan untuk mencetak para da\'i yang kompeten dalam menyebarkan ajaran Islam dengan baik dan benar'],
                ['title' => 'MAHAD MUALIMAT AT TAUHID', 'desc' => 'Kajian Islam rutin di  bogor untuk berbagai kalangan dengan materi yang disesuaikan kebutuhan jamaah'],
            ];
            @endphp
            
            @foreach($pendidikanPrograms as $index => $program)
            <div onclick="openImageModal('{{ asset('pendidikan_' . ($index + 1) . '.jpg') }}', '{{ $program['title'] }}', '{{ $program['desc'] }}', 'Pendidikan')" 
                 class="group relative aspect-[4/3] rounded-2xl overflow-hidden border-2 border-blue-400/30 hover:border-blue-300 shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all duration-500 hover:-translate-y-2 cursor-pointer" 
                 data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                <img src="{{ asset('pendidikan_' . ($index + 1) . '.jpg') }}" 
                     alt="{{ $program['title'] }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     onerror="this.src='https://via.placeholder.com/800x600/1e40af/ffffff?text={{ urlencode($program['title']) }}'">
                
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-blue-900/60 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                
                {{-- Content --}}
                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full uppercase">Pendidikan</span>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">{{ $program['title'] }}</h3>
                    <p class="text-blue-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2">{{ $program['desc'] }}</p>
                </div>

                {{-- Click to view indicator --}}
                <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-lg">
                    <i class="fas fa-expand text-blue-600"></i>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Details --}}
        <div class="bg-blue-800/30 backdrop-blur-xl rounded-2xl border border-blue-400/30 p-8 hover:border-blue-300 transition-colors duration-500" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-book-open text-white"></i>
                </div>
                Detail Program Pendidikan
            </h3>
            <div class="grid md:grid-cols-2 gap-4 text-blue-100">
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Mahad Huda Islami Bogor</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Training untuk para da'i</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Beasiswa pendidikan Islam</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Pembinaan tahfidz Al-Qur'an</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM SOSIAL SECTION --}}
<section class="py-20 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block bg-red-500/20 backdrop-blur-sm px-6 py-3 rounded-full border border-red-400/30 mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Program Sosial</h2>
            </div>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto">Kepedulian nyata untuk kesejahteraan umat</p>
        </div>

        {{-- Photo Gallery Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @php
            $sosialPrograms = [
 ['title' => 'PEMBAGIAN SEMBAKO', 'desc' => 'Program distribusi sembako gratis kepada keluarga kurang mampu dan masyarakat yang membutuhkan untuk membantu memenuhi kebutuhan pangan sehari-hari'],
                ['title' => 'KERJA BAKTI', 'desc' => 'Kegiatan gotong royong membersihkan lingkungan, masjid, dan fasilitas umum bersama masyarakat untuk menciptakan lingkungan yang bersih dan sehat'],
                ['title' => 'PENGOBATAN MASSAL', 'desc' => 'Pelayanan kesehatan gratis dengan tim medis profesional untuk pemeriksaan dan pengobatan masyarakat kurang mampu di berbagai wilayah'],
                ['title' => 'BANTUAN BANJIR', 'desc' => 'Penggalangan dan penyaluran bantuan darurat berupa makanan, pakaian, dan kebutuhan pokok untuk korban banjir yang kehilangan tempat tinggal'],
                ['title' => 'BANTUAN MUSIBAH GUNUNG BROMO', 'desc' => 'Program bantuan kemanusiaan untuk masyarakat terdampak erupsi Gunung Bromo berupa logistik, tempat tinggal sementara, dan bantuan pemulihan'],
                ['title' => 'BANTUAN KEMANUSIAAN ROHINGYA', 'desc' => 'Penggalangan dana dan bantuan kemanusiaan untuk pengungsi Rohingya yang mengalami krisis kemanusiaan dan membutuhkan pertolongan'],
            ];
            @endphp
            
            @foreach($sosialPrograms as $index => $program)
            <div onclick="openImageModal('{{ asset('sosial_' . ($index + 1) . '.jpg') }}', '{{ $program['title'] }}', '{{ $program['desc'] }}', 'Sosial')" 
                 class="group relative aspect-[4/3] rounded-2xl overflow-hidden border-2 border-red-400/30 hover:border-red-300 shadow-xl hover:shadow-2xl hover:shadow-red-500/50 transition-all duration-500 hover:-translate-y-2 cursor-pointer" 
                 data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                <img src="{{ asset('sosial_' . ($index + 1) . '.jpg') }}" 
                     alt="{{ $program['title'] }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     onerror="this.src='https://via.placeholder.com/800x600/dc2626/ffffff?text={{ urlencode($program['title']) }}'">
                
                <div class="absolute inset-0 bg-gradient-to-t from-red-950 via-red-900/60 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                
                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full uppercase">Sosial</span>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">{{ $program['title'] }}</h3>
                    <p class="text-red-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2">{{ $program['desc'] }}</p>
                </div>

                <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-lg">
                    <i class="fas fa-expand text-red-600"></i>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Details --}}
        <div class="bg-red-800/30 backdrop-blur-xl rounded-2xl border border-red-400/30 p-8 hover:border-red-300 transition-colors duration-500" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hands-helping text-white"></i>
                </div>
                Detail Program Sosial
            </h3>
            <div class="grid md:grid-cols-2 gap-4 text-blue-100">
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Bakti sosial ke daerah terpencil</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Santunan anak yatim dan dhuafa</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Bantuan bencana alam</span>
                </div>
                <div class="flex items-start gap-3 hover:text-white transition-colors">
                    <i class="fas fa-check-circle text-green-400 mt-1 flex-shrink-0"></i>
                    <span>Pengobatan dan khitanan gratis</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-20 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800">
    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto relative" data-aos="fade-up">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-3xl blur-2xl opacity-30 animate-pulse-glow"></div>
            <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 rounded-3xl p-10 md:p-16 text-center text-white border-2 border-blue-400/30 overflow-hidden">
                {{-- Decorative Elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full -ml-32 -mb-32"></div>
                
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-8 animate-bounce-slow">
                        <i class="fas fa-heart text-4xl"></i>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-bold mb-6" data-aos="fade-up" data-aos-delay="100">
                        Mari Bergabung Bersama Kami
                    </h2>
                    <p class="text-xl md:text-2xl mb-10 text-white/90 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                        Jadilah bagian dari gerakan dakwah dan pemberdayaan umat untuk kemajuan Islam
                    </p>
                    <div class="flex flex-wrap gap-5 justify-center" data-aos="fade-up" data-aos-delay="300">
                        <a href="https://donasi.hasmi.org/" target="_blank" 
                           class="group bg-white text-blue-600 px-10 py-5 rounded-2xl font-bold hover:bg-gray-100 hover:scale-110 transition-all duration-500 inline-flex items-center gap-3 shadow-2xl">
                            <i class="fas fa-heart group-hover:scale-125 transition-transform text-xl"></i> 
                            <span>Donasi Sekarang</span>
                        </a>
                        <a href="{{ route('tentang') }}" 
                           class="group bg-white/10 backdrop-blur-xl text-white px-10 py-5 rounded-2xl font-bold hover:bg-white/20 hover:scale-110 transition-all duration-500 inline-flex items-center gap-3 border-2 border-white/30 hover:border-white/60 shadow-2xl">
                            <i class="fas fa-info-circle group-hover:scale-125 transition-transform text-xl"></i> 
                            <span>Pelajari Lebih Lanjut</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- IMAGE MODAL LIGHTBOX --}}
<div id="imageModal" class="fixed inset-0 z-[9999] hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/95 backdrop-blur-xl transition-opacity duration-500 opacity-0" id="modalBackdrop" onclick="closeImageModal()"></div>
    
    {{-- Modal Content --}}
    <div class="relative h-full flex items-center justify-center p-4">
        {{-- Close Button --}}
        <button onclick="closeImageModal()" class="fixed top-6 right-6 w-14 h-14 bg-white/10 hover:bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-90 z-[10001] group">
            <i class="fas fa-times text-white text-2xl group-hover:scale-110 transition-transform"></i>
        </button>

        {{-- Modal Container with Scroll --}}
        <div id="modalContainer" class="relative w-full max-w-6xl max-h-[95vh] overflow-y-auto custom-scrollbar">
            {{-- Modal Card --}}
            <div id="modalCard" class="bg-gradient-to-br from-slate-900/95 via-blue-900/95 to-slate-900/95 backdrop-blur-2xl rounded-3xl overflow-hidden border border-white/10 shadow-2xl transform scale-90 opacity-0 transition-all duration-500">
                {{-- Image Container --}}
                <div class="relative bg-black">
                    <img id="modalImage" src="" alt="" class="w-full h-auto object-contain">
                </div>

                {{-- Content Section --}}
                <div class="p-8 md:p-12">
                    {{-- Header --}}
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="fas fa-image text-white text-2xl"></i>
                        </div>
                        <span id="modalCategory" class="px-5 py-2 bg-blue-500/20 backdrop-blur-sm text-blue-200 text-sm font-bold rounded-full border border-blue-400/30 uppercase tracking-wide"></span>
                    </div>
                    
                    {{-- Title --}}
                    <h3 id="modalTitle" class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight"></h3>
                    
                    {{-- Description --}}
                    <p id="modalDescription" class="text-blue-100 text-lg md:text-xl leading-relaxed mb-8"></p>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap gap-4">
                        <a href="https://www.hasmi.org/program-hasmi/" target="_blank" 
                           class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-500/50 flex items-center gap-3">
                            <i class="fas fa-info-circle text-xl group-hover:scale-110 transition-transform"></i>
                            <span>Selengkapnya</span>
                        </a>
                        <button onclick="closeImageModal()" 
                                class="group bg-white/10 hover:bg-white/20 backdrop-blur-xl text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 border border-white/20 hover:border-white/40 flex items-center gap-3">
                            <i class="fas fa-times text-xl group-hover:scale-110 transition-transform"></i>
                            <span>Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- STYLES --}}
<style>
/* Base Styles */
html {
    scroll-behavior: smooth;
}

body {
    background: linear-gradient(to bottom, #1e3a8a, #1e40af);
}

/* Prevent scroll when modal is open */
body.modal-open {
    overflow: hidden;
}

/* Custom Scrollbar for Modal */
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(15, 23, 42, 0.3);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.5);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.7);
}

/* Blob Animation */
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(30px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(40px, 30px) scale(1.05); }
}

.animate-blob {
    animation: blob 15s infinite ease-in-out;
}

/* Gradient Animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 5s ease infinite;
}

/* Pulse Slow */
@keyframes pulse-slow {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
}

.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

/* Pulse Glow */
@keyframes pulse-glow {
    0%, 100% { opacity: 0.3; transform: scale(0.95); }
    50% { opacity: 0.6; transform: scale(1.1); }
}

.animate-pulse-glow {
    animation: pulse-glow 5s ease-in-out infinite;
}

/* Scroll Animation */
@keyframes scroll {
    0% { transform: translateY(0); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateY(12px); opacity: 0; }
}

.animate-scroll {
    animation: scroll 2s ease-in-out infinite;
}

/* Bounce Slow */
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.animate-bounce-slow {
    animation: bounce-slow 3s ease-in-out infinite;
}

/* Animation Delays */
.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Line Clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 14px;
}

::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #1e3a8a, #1e40af);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #3b82f6, #2563eb);
    border-radius: 7px;
    border: 3px solid #1e40af;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #60a5fa, #3b82f6);
}

/* Loading Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

body {
    animation: fadeIn 0.6s ease-out;
}

/* Modal Animations */
.modal-show #modalBackdrop {
    opacity: 1 !important;
}

.modal-show #modalCard {
    opacity: 1 !important;
    transform: scale(1) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .animate-blob {
        opacity: 0.2;
    }
    
    #modalContainer {
        max-h: [90vh];
    }
}
</style>

{{-- SCRIPTS --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        easing: 'ease-out-cubic',
        once: false,
        offset: 100,
        mirror: true,
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Hide scroll indicator
    const scrollIndicator = document.querySelector('.animate-bounce');
    if (scrollIndicator) {
        window.addEventListener('scroll', () => {
            scrollIndicator.style.opacity = window.scrollY > 100 ? '0' : '1';
            scrollIndicator.style.pointerEvents = window.scrollY > 100 ? 'none' : 'auto';
        });
    }

    // Parallax effect
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const blobs = document.querySelectorAll('.animate-blob');
                
                blobs.forEach((blob, index) => {
                    const speed = 0.15 + (index * 0.05);
                    blob.style.transform = `translateY(${-(scrolled * speed)}px)`;
                });

                ticking = false;
            });
            ticking = true;
        }
    });

    // Image lazy load error handling
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            this.style.opacity = '0.5';
        });
    });

    // ESC key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
});

// Image Modal Functions
function openImageModal(imageSrc, title, description, category) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalCategory = document.getElementById('modalCategory');
    const modalContainer = document.getElementById('modalContainer');
    
    // Set content
    modalImage.src = imageSrc;
    modalImage.alt = title;
    modalTitle.textContent = title;
    modalDescription.textContent = description;
    modalCategory.textContent = category;
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.classList.add('modal-open');
    
    // Reset scroll position
    modalContainer.scrollTop = 0;
    
    // Trigger animations
    setTimeout(() => {
        modal.classList.add('modal-show');
        document.getElementById('modalBackdrop').style.opacity = '1';
        const modalCard = document.getElementById('modalCard');
        modalCard.style.opacity = '1';
        modalCard.style.transform = 'scale(1)';
    }, 10);
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const modalCard = document.getElementById('modalCard');
    
    // Animate out
    modal.classList.remove('modal-show');
    modalBackdrop.style.opacity = '0';
    modalCard.style.opacity = '0';
    modalCard.style.transform = 'scale(0.9)';
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.classList.remove('modal-open');
    }, 300);
}
</script>