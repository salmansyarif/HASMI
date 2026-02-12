@extends('layouts.app')

@section('title', 'Tentang Kami - HASMI')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

{{-- HEADER SECTION --}}
<section class="relative bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 pt-32 pb-20 overflow-hidden">
    {{-- Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-40">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-300 rounded-full blur-3xl animate-blob animation-delay-2"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-200 rounded-full blur-3xl animate-blob animation-delay-4"></div>
    </div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-xl px-6 py-3 rounded-full border border-white/30 mb-8" data-aos="zoom-in">
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center animate-pulse-slow">
               <img src="{{ asset('img/hasmilogo.png') }}" alt="Logo HASMI" class="w-6 h-6 object-contain">
            </div>
            <span class="text-lg font-bold text-white">HASMI</span>
        </div>
        
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">
            Mengenal Lebih Dekat <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-100 to-cyan-100 animate-gradient">HASMI</span>
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-200 to-cyan-200 mx-auto rounded-full mb-8 animate-gradient" data-aos="fade" data-aos-delay="200"></div>
        <p class="text-blue-50 text-lg max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            Menelusuri jati diri, filosofi, dan cita-cita luhur Himpunan Ahlussunnah untuk Masyarakat Islami dalam pengabdiannya kepada umat dan bangsa.
        </p>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-blue-200 rounded-full flex justify-center p-2">
            <div class="w-1.5 h-3 bg-blue-200 rounded-full animate-scroll"></div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-500 py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto space-y-16">
            
            {{-- PROFILE SECTION --}}
            <section class="bg-blue-500/40 backdrop-blur-xl rounded-3xl border border-blue-300/40 overflow-hidden hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-400/60 transition-all duration-500" data-aos="fade-up">
                <div class="grid lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-5 bg-blue-600/40 p-12 flex flex-col justify-center items-center border-b lg:border-b-0 lg:border-r border-blue-300/40">
                        <div class="relative">
                            <div class="absolute -inset-10 bg-blue-300 rounded-full blur-3xl opacity-30 animate-pulse-glow"></div>
                            <img src="{{ asset('img/hasmilogo.jpg') }}" alt="Logo HASMI" class="relative w-72 h-72 object-contain drop-shadow-2xl animate-float-slow hover:scale-110 transition-transform duration-700">
                            
                            {{-- Decorative rings --}}
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="w-3/4 h-3/4 border-2 border-blue-200/30 rounded-full animate-pulse-slow"></div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7 p-12 md:p-16">
                        <h2 class="text-3xl font-bold text-white mb-8 flex items-center gap-4" data-aos="fade-right" data-aos-delay="100">
                            <span class="w-12 h-1 bg-gradient-to-r from-blue-200 to-cyan-200 animate-gradient"></span>
                            Profil Institusi
                        </h2>
                        <div class="space-y-6 text-blue-50 text-lg leading-relaxed text-justify">
                            <p data-aos="fade-up" data-aos-delay="200">
                                <strong class="text-blue-100">Himpunan Ahlussunnah untuk Masyarakat Islami (HASMI)</strong> 
                            </p>
                            <p data-aos="fade-up" data-aos-delay="300">
                                HASMI (Himpunan Ahlussunnah wal Jama'ah Indonesia) adalah organisasi dakwah Islam Ahlussunnah wal Jama'ah yang berlandaskan Al-Qur'an, Hadis, dan ijma', serta bermazhab Syafi'i. Didirikan pada tahun 2005 dan berpusat di Kota Bogor, HASMI merupakan ormas murni Indonesia dan tidak berafiliasi dengan organisasi lintas negara mana pun.
                            </p>
                            <p data-aos="fade-up" data-aos-delay="400">
                                Tujuan utama HASMI adalah mewujudkan masyarakat Islami di Indonesia. Misi pokoknya adalah mendakwahkan kaum muslimin agar terbentuk tatanan masyarakat yang Islami melalui strategi dakwah yang terarah dan berkelanjutan.
                            </p>
                            <p data-aos="fade-up" data-aos-delay="500">
                                Dalam praktiknya, dakwah HASMI diwujudkan melalui berbagai program nyata, seperti pendirian sekolah-sekolah Islam, radio dakwah, kajian-kajian keislaman, penerbitan buku Islam, penerbitan majalah Islam, serta kegiatan dakwah lainnya.
                            </p>
                            <p data-aos="fade-up" data-aos-delay="600">
                                HASMI bersifat independen dan tidak berafiliasi dengan partai politik maupun ormas lainnya.
                            </p>
                            <div class="grid md:grid-cols-1 gap-4 mt-8">
                                <div class="flex items-start gap-4 p-5 bg-blue-600/50 rounded-xl border border-blue-300/30 hover:border-blue-200 hover:bg-blue-500/60 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="700">
                                    <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-slow">
                                        <i class="fas fa-landmark text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold mb-1">Eksistensi Hukum</h4>
                                        <p class="text-sm text-blue-100">Terdaftar secara resmi sebagai organisasi nasional dengan struktur kepengurusan yang tersebar secara masif di berbagai provinsi.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-blue-600/50 rounded-xl border border-blue-300/30 hover:border-blue-200 hover:bg-blue-500/60 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="800">
                                    <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-slow animation-delay-1">
                                        <i class="fas fa-shield-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold mb-1">Manhaj Pergerakan</h4>
                                        <p class="text-sm text-blue-100">Berpegang teguh pada pemahaman Salafush Shalih dalam berakidah, beribadah, dan berakhlak mulia di tengah kehidupan bermasyarakat.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-blue-600/50 rounded-xl border border-blue-300/30 hover:border-blue-200 hover:bg-blue-500/60 hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="900">
                                    <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-slow animation-delay-2">
                                        <i class="fas fa-sync text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold mb-1">Inovasi Dakwah</h4>
                                        <p class="text-sm text-blue-100">Mengintegrasikan teknologi informasi dan metode komunikasi kontemporer guna menjangkau seluruh lapisan generasi secara efektif.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- NAMA & TUJUAN SECTION --}}
            <section class="grid lg:grid-cols-2 gap-8">
                <div class="bg-blue-500/40 backdrop-blur-xl border border-blue-300/40 p-12 rounded-2xl relative overflow-hidden group hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-400/60 hover:-translate-y-2 transition-all duration-500" data-aos="fade-up">
                    <div class="absolute -top-10 -right-10 text-blue-300/10 text-[10rem] font-bold group-hover:text-blue-300/20 group-hover:scale-110 transition-all duration-700">HASMI</div>
                    
                    {{-- Floating particles --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none">
                        <div class="absolute w-2 h-2 bg-blue-200/40 rounded-full animate-float-slow" style="top: 20%; left: 10%;"></div>
                        <div class="absolute w-2 h-2 bg-blue-200/40 rounded-full animate-float-slow animation-delay-1" style="top: 60%; left: 80%;"></div>
                        <div class="absolute w-2 h-2 bg-blue-200/40 rounded-full animate-float-slow animation-delay-2" style="top: 80%; left: 20%;"></div>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-white mb-8 relative z-10" data-aos="fade-right" data-aos-delay="100">Makna Di Balik Nama</h3>
                    <div class="space-y-6 text-blue-50 text-lg leading-relaxed relative z-10">
                        <p data-aos="fade-up" data-aos-delay="200">
                            Pemilihan nama <span class="text-blue-100 font-bold">Himpunan Ahlussunnah</span> Organisasi ini menamakan dirinya Himpunan Ahlussunnah untuk Masyarakat Islami, yang disingkat dan dikenal dengan nama HASMI. Secara resmi, HASMI didirikan pada tanggal 18 November 2005 M berdasarkan Akte Notaris No. 20. Pemilihan nama tersebut bukan sekadar simbol, melainkan dirancang untuk mencerminkan dasar, sifat, serta arah perjuangan organisasi dakwah ini.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="300">
                            Kata "Himpunan" menggambarkan bahwa HASMI merupakan wadah yang terus bergerak aktif untuk menghimpun kaum muslimin dalam satu barisan dakwah yang dinamis. Istilah ini menegaskan bahwa HASMI bukan organisasi statis, melainkan harakah yang hidup, berenergi, dan berkesinambungan dalam upaya mencapai tujuan dakwahnya.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="400">
                            Kata "Ahlussunnah" menekankan bahwa seluruh gerak langkah HASMI berlandaskan sunnah Rasulullah ﷺ. Organisasi ini berkomitmen untuk menolak segala bentuk peribadatan dan praktik keagamaan yang tidak disyariatkan oleh Rasulullah ﷺ, karena setiap ibadah yang tidak memiliki landasan syariat dipandang sebagai kesesatan. Istilah Sunniyyah juga mencerminkan tujuan untuk menghidupkan sunnah dalam arti Islam yang murni sebagaimana diajarkan Rasulullah ﷺ, sekaligus mengikis praktik kesyirikan serta bentuk ibadah yang tidak disyariatkan dari kehidupan kaum muslimin. Dengan demikian, diharapkan keimanan dan peribadatan umat menjadi lurus, benar, dan diterima oleh Allah سبحانه وتعالى.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="500">
                            Adapun frasa "Masyarakat Islami" mencerminkan tujuan akhir dari seluruh aktivitas dakwah HASMI. Ini menunjukkan bahwa dakwah HASMI tidak berhenti pada perbaikan individu semata, tetapi diarahkan untuk membangun tatanan sosial yang Islami secara menyeluruh. Oleh karena itu, nama HASMI dianggap telah mewakili jati diri organisasi secara utuh: sebagai himpunan dakwah Ahlussunnah yang bergerak menuju terwujudnya masyarakat Islami.
                        </p>
                    </div>
                </div>

                <div class="bg-blue-500/40 backdrop-blur-xl border border-blue-300/40 p-12 rounded-2xl hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-400/60 hover:-translate-y-2 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-3xl font-bold text-white mb-8" data-aos="fade-left" data-aos-delay="200">Tujuan HASMI</h3>
                    <div class="space-y-6 text-blue-50 text-lg leading-relaxed">
                        <p data-aos="fade-up" data-aos-delay="300">
                            Tujuan utama HASMI adalah terwujudnya masyarakat Islami yang berlandaskan tauhid, sunnah Rasulullah ﷺ, serta nilai-nilai Islam yang murni. HASMI berupaya membina kaum muslimin agar memiliki akidah yang lurus, ibadah yang benar, serta akhlak yang mulia, sehingga terbentuk individu-individu muslim yang kuat secara spiritual, intelektual, dan sosial.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="400">
                            Dalam rangka mencapai tujuan tersebut, HASMI menjadikan dakwah sebagai strategi utama perjuangannya. Dakwah ini dilakukan secara terarah, berkelanjutan, dan menyentuh berbagai lapisan masyarakat. HASMI memandang bahwa perubahan menuju masyarakat Islami harus dimulai dari pembinaan umat, penguatan pemahaman agama, serta penghidupan sunnah Rasulullah ﷺ dalam seluruh aspek kehidupan.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="500">
                            Bentuk nyata dari usaha dakwah HASMI diwujudkan melalui berbagai program dan sarana, antara lain pendirian sekolah-sekolah Islam, pengelolaan radio-radio dakwah, penyelenggaraan kajian-kajian keislaman, penerbitan buku-buku Islam, penerbitan majalah Islam, serta berbagai kegiatan dakwah lainnya. Seluruh aktivitas tersebut diarahkan untuk membangun kesadaran keislaman umat, memperbaiki kualitas keimanan dan ibadah, serta membentuk lingkungan sosial yang Islami.
                        </p>
                        <p data-aos="fade-up" data-aos-delay="600">
                            HASMI juga menegaskan dirinya sebagai organisasi yang independen, tidak berafiliasi dengan partai politik maupun ormas lainnya. Dengan sikap ini, HASMI ingin menjaga kemurnian dakwahnya agar tetap fokus pada pembinaan umat dan penyebaran nilai-nilai Islam tanpa terikat kepentingan politik atau kelompok tertentu.
                        </p>
                    </div>
                </div>
            </section>

            {{-- VISI MISI SECTION --}}
            <section class="relative" data-aos="fade-up">
                <div class="absolute inset-0 bg-blue-400 rounded-3xl blur-3xl opacity-15 animate-pulse-glow"></div>
                <div class="relative bg-blue-500/40 backdrop-blur-xl rounded-3xl p-12 md:p-16 border border-blue-300/40 hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-400/60 transition-all duration-500">
                    <div class="grid lg:grid-cols-2 gap-16">
                        <div>
                            <div class="inline-block px-6 py-2 bg-blue-400 text-white font-bold text-sm tracking-widest uppercase rounded-full mb-8 hover:scale-110 hover:bg-blue-500 transition-all duration-300" data-aos="zoom-in" data-aos-delay="100">Visi Utama</div>
                            <h2 class="text-4xl md:text-5xl font-bold text-white mb-8 leading-tight" data-aos="fade-right" data-aos-delay="200">
                                Menjadi Mercusuar <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-100 to-cyan-100 animate-gradient">Peradaban Islami</span> <br>di Nusantara.
                            </h2>
                            <div class="relative" data-aos="fade-up" data-aos-delay="300">
                                <div class="absolute -left-4 top-0 text-blue-300/30 text-6xl font-bold">"</div>
                                <p class="text-blue-50 text-xl leading-relaxed pl-8">
                                    Menjadi organisasi massa Islam yang paling berpengaruh, terpercaya, dan profesional dalam mewujudkan masyarakat Indonesia yang bertauhid dan berakhlak mulia pada tahun 2030.
                                </p>
                            </div>
                            <div class="mt-8 border-l-4 border-blue-300 pl-6 text-blue-100 italic hover:border-cyan-300 transition-colors duration-300" data-aos="fade-up" data-aos-delay="400">
                                Visi ini bukan sekadar kalimat, melainkan komitmen setiap aktivis HASMI untuk bekerja keras setiap harinya.
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="inline-block px-6 py-2 bg-blue-600/60 text-blue-100 font-bold text-sm tracking-widest uppercase rounded-full border border-blue-300/40 hover:bg-blue-500/70 hover:scale-110 transition-all duration-300" data-aos="zoom-in" data-aos-delay="100">Misi Strategis</div>
                            <div class="space-y-6">
                                <div class="flex gap-6 group" data-aos="fade-left" data-aos-delay="200">
                                    <div class="relative">
                                        <span class="text-3xl font-bold text-blue-200 group-hover:text-blue-100 group-hover:scale-125 transition-all duration-300 inline-block">01</span>
                                        <div class="absolute -inset-2 bg-blue-300/30 rounded-lg blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="flex-1 p-4 bg-blue-600/30 rounded-xl border border-blue-300/30 group-hover:border-blue-200 group-hover:bg-blue-500/40 group-hover:-translate-y-1 transition-all duration-300">
                                        <h4 class="text-xl font-bold text-white mb-2 uppercase tracking-wide">Standardisasi Dakwah</h4>
                                        <p class="text-blue-50 leading-relaxed">Mengembangkan sistem dakwah yang terstruktur melalui berbagai media, kajian tatap muka, dan distribusi literatur islami guna mencerahkan pemikiran umat dari segala bentuk paham radikal maupun liberal yang menyimpang.</p>
                                    </div>
                                </div>
                                <div class="flex gap-6 group" data-aos="fade-left" data-aos-delay="300">
                                    <div class="relative">
                                        <span class="text-3xl font-bold text-blue-200 group-hover:text-blue-100 group-hover:scale-125 transition-all duration-300 inline-block">02</span>
                                        <div class="absolute -inset-2 bg-blue-300/30 rounded-lg blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="flex-1 p-4 bg-blue-600/30 rounded-xl border border-blue-300/30 group-hover:border-blue-200 group-hover:bg-blue-500/40 group-hover:-translate-y-1 transition-all duration-300">
                                        <h4 class="text-xl font-bold text-white mb-2 uppercase tracking-wide">Pusat Pendidikan Terpadu</h4>
                                        <p class="text-blue-50 leading-relaxed">Membangun dan mengelola lembaga pendidikan formal maupun informal yang memadukan kurikulum nasional dengan nilai-nilai keislaman yang mendalam untuk mencetak pemimpin masa depan yang berwawasan luas.</p>
                                    </div>
                                </div>
                                <div class="flex gap-6 group" data-aos="fade-left" data-aos-delay="400">
                                    <div class="relative">
                                        <span class="text-3xl font-bold text-blue-200 group-hover:text-blue-100 group-hover:scale-125 transition-all duration-300 inline-block">03</span>
                                        <div class="absolute -inset-2 bg-blue-300/30 rounded-lg blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="flex-1 p-4 bg-blue-600/30 rounded-xl border border-blue-300/30 group-hover:border-blue-200 group-hover:bg-blue-500/40 group-hover:-translate-y-1 transition-all duration-300">
                                        <h4 class="text-xl font-bold text-white mb-2 uppercase tracking-wide">Transformasi Sosial & Ekonomi</h4>
                                        <p class="text-blue-50 leading-relaxed">Menggerakkan potensi ekonomi umat melalui lembaga Ziswaf yang dikelola secara amanah untuk membiayai program-program kemandirian sosial, santunan yatim, dan bantuan bencana alam secara berkesinambungan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection

{{-- STYLES --}}
<style>
/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Blob animation */
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(30px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(40px, 30px) scale(1.05); }
}

.animate-blob {
    animation: blob 15s infinite ease-in-out;
}

.animation-delay-2 {
    animation-delay: 5s;
}

.animation-delay-4 {
    animation-delay: 10s;
}

/* Gradient animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 5s ease infinite;
}

/* Pulse slow animation */
@keyframes pulse-slow {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
}

.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

.animation-delay-1 {
    animation-delay: 1s;
}

/* Pulse glow animation */
@keyframes pulse-glow {
    0%, 100% { opacity: 0.4; transform: scale(0.95); }
    50% { opacity: 0.7; transform: scale(1.1); }
}

.animate-pulse-glow {
    animation: pulse-glow 5s ease-in-out infinite;
}

/* Float slow animation */
@keyframes float-slow {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(3deg); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

/* Scroll animation */
@keyframes scroll {
    0% { transform: translateY(0); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateY(12px); opacity: 0; }
}

.animate-scroll {
    animation: scroll 2s ease-in-out infinite;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    background: #2563eb;
}

::-webkit-scrollbar-thumb {
    background: #3b82f6;
    border-radius: 6px;
}

::-webkit-scrollbar-thumb:hover {
    background: #60a5fa;
}

/* Loading fade-in */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

body {
    animation: fadeIn 0.5s ease-out;
}

/* Hide scroll indicator after scroll */
@media (max-width: 768px) {
    .animate-blob {
        opacity: 0.3;
    }
}
</style>

{{-- SCRIPTS --}}
<script data-cfasync="false" src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script data-cfasync="false">
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        once: true,
        offset: 100
    });

    // Smooth scroll for anchor links
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

    // Hide scroll indicator after scroll
    const scrollIndicator = document.querySelector('.animate-bounce');
    if (scrollIndicator) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                scrollIndicator.style.opacity = '0';
                scrollIndicator.style.pointerEvents = 'none';
            } else {
                scrollIndicator.style.opacity = '1';
                scrollIndicator.style.pointerEvents = 'auto';
            }
        });
    }

    // Add parallax effect on scroll
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const blobs = document.querySelectorAll('.animate-blob');
                
                blobs.forEach((blob, index) => {
                    const speed = 0.15 + (index * 0.05);
                    const yPos = -(scrolled * speed);
                    blob.style.transform = `translateY(${yPos}px)`;
                });

                ticking = false;
            });
            ticking = true;
        }
    });

    // Add hover effect to cards
    const cards = document.querySelectorAll('[data-aos]');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
});
</script>