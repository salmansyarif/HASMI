@extends('layouts.app')

@section('title', 'Tentang Kami - HASMI')

@section('content')

<div class="bg-slate-950 min-h-screen">
    <div class="bg-gradient-to-b from-slate-900 via-blue-950 to-slate-950 pt-24 pb-20 text-center px-6">
        <h1 class="text-5xl md:text-6xl font-black text-white mb-6 tracking-tighter uppercase">
            Mengenal Lebih Dekat <br><span class="text-blue-500">HASMI</span>
        </h1>
        <div class="w-32 h-1.5 bg-blue-600 mx-auto rounded-full mb-8"></div>
        <p class="text-gray-400 text-lg max-w-3xl mx-auto font-light leading-relaxed">
            Menelusuri jati diri, filosofi, dan cita-cita luhur Himpunan Ahlussunnah untuk Masyarakat Islami dalam pengabdiannya kepada umat dan bangsa.
        </p>
    </div>

    <div class="container mx-auto px-6 pb-24">
        <div class="max-w-6xl mx-auto space-y-20">
            
            <section class="bg-slate-900/50 rounded-[2.5rem] border border-slate-800 overflow-hidden shadow-2xl">
                <div class="grid lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-5 bg-slate-900 p-12 flex flex-col justify-center items-center border-b lg:border-b-0 lg:border-r border-slate-800">
                        <div class="relative">
                            <div class="absolute -inset-10 bg-blue-600 rounded-full blur-[80px] opacity-20"></div>
                            <img src="{{ asset('img/hasmilogo.jpg') }}" alt="Logo HASMI" class="relative w-80 h-80 object-contain drop-shadow-2xl">
                        </div>
                    </div>
                    <div class="lg:col-span-7 p-12 md:p-16">
                        <h2 class="text-3xl font-bold text-white mb-8 flex items-center gap-4">
                            <span class="w-12 h-1 bg-blue-500"></span>
                            Profil Institusi
                        </h2>
                        <div class="space-y-6 text-gray-300 text-lg leading-relaxed text-justify">
                            <p>
                                <strong class="text-blue-400">Himpunan Ahlussunnah untuk Masyarakat Islami (HASMI)</strong> 
                            <p>
                                HASMI (Himpunan Ahlussunnah wal Jama’ah Indonesia) adalah organisasi dakwah Islam Ahlussunnah wal Jama’ah yang berlandaskan Al-Qur’an, Hadis, dan ijma’, serta bermazhab Syafi’i. Didirikan pada tahun 2005 dan berpusat di Kota Bogor, HASMI merupakan ormas murni Indonesia dan tidak berafiliasi dengan organisasi lintas negara mana pun.

Tujuan utama HASMI adalah mewujudkan masyarakat Islami di Indonesia. Misi pokoknya adalah mendakwahkan kaum muslimin agar terbentuk tatanan masyarakat yang Islami melalui strategi dakwah yang terarah dan berkelanjutan.

Dalam praktiknya, dakwah HASMI diwujudkan melalui berbagai program nyata, seperti pendirian sekolah-sekolah Islam, radio dakwah, kajian-kajian keislaman, penerbitan buku Islam, penerbitan majalah Islam, serta kegiatan dakwah lainnya.

HASMI bersifat independen dan tidak berafiliasi dengan partai politik maupun ormas lainnya.
                            </p>
                            <div class="grid md:grid-cols-1 gap-4 mt-8">
                                <div class="flex items-start gap-4 p-5 bg-slate-800/50 rounded-2xl border border-slate-700">
                                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-landmark text-white"></i></div>
                                    <div>
                                        <h4 class="text-white font-bold mb-1">Eksistensi Hukum</h4>
                                        <p class="text-sm text-gray-400">Terdaftar secara resmi sebagai organisasi nasional dengan struktur kepengurusan yang tersebar secara masif di berbagai provinsi.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-slate-800/50 rounded-2xl border border-slate-700">
                                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-shield-alt text-white"></i></div>
                                    <div>
                                        <h4 class="text-white font-bold mb-1">Manhaj Pergerakan</h4>
                                        <p class="text-sm text-gray-400">Berpegang teguh pada pemahaman Salafush Shalih dalam berakidah, beribadah, dan berakhlak mulia di tengah kehidupan bermasyarakat.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-slate-800/50 rounded-2xl border border-slate-700">
                                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-sync text-white"></i></div>
                                    <div>
                                        <h4 class="text-white font-bold mb-1">Inovasi Dakwah</h4>
                                        <p class="text-sm text-gray-400">Mengintegrasikan teknologi informasi dan metode komunikasi kontemporer guna menjangkau seluruh lapisan generasi secara efektif.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid lg:grid-cols-2 gap-10">
                <div class="bg-blue-900/20 border border-blue-900/30 p-12 rounded-[2rem] relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 text-blue-500/10 text-[12rem] font-bold group-hover:text-blue-500/20 transition-all">HASMI</div>
                    <h3 class="text-3xl font-extrabold text-white mb-8">Makna Di Balik Nama</h3>
                    <div class="space-y-6 text-blue-100/80 text-lg leading-relaxed">
                        <p>
                            Pemilihan nama <span class="text-blue-400 font-bold">Himpunan Ahlussunnah</span> Organisasi ini menamakan dirinya Himpunan Ahlussunnah untuk Masyarakat Islami, yang disingkat dan dikenal dengan nama HASMI. Secara resmi, HASMI didirikan pada tanggal 18 November 2005 M berdasarkan Akte Notaris No. 20. Pemilihan nama tersebut bukan sekadar simbol, melainkan dirancang untuk mencerminkan dasar, sifat, serta arah perjuangan organisasi dakwah ini.

Kata “Himpunan” menggambarkan bahwa HASMI merupakan wadah yang terus bergerak aktif untuk menghimpun kaum muslimin dalam satu barisan dakwah yang dinamis. Istilah ini menegaskan bahwa HASMI bukan organisasi statis, melainkan harakah yang hidup, berenergi, dan berkesinambungan dalam upaya mencapai tujuan dakwahnya.

Kata “Ahlussunnah” menekankan bahwa seluruh gerak langkah HASMI berlandaskan sunnah Rasulullah ﷺ. Organisasi ini berkomitmen untuk menolak segala bentuk peribadatan dan praktik keagamaan yang tidak disyariatkan oleh Rasulullah ﷺ, karena setiap ibadah yang tidak memiliki landasan syariat dipandang sebagai kesesatan. Istilah Sunniyyah juga mencerminkan tujuan untuk menghidupkan sunnah dalam arti Islam yang murni sebagaimana diajarkan Rasulullah ﷺ, sekaligus mengikis praktik kesyirikan serta bentuk ibadah yang tidak disyariatkan dari kehidupan kaum muslimin. Dengan demikian, diharapkan keimanan dan peribadatan umat menjadi lurus, benar, dan diterima oleh Allah سبحانه وتعالى.

Adapun frasa “Masyarakat Islami” mencerminkan tujuan akhir dari seluruh aktivitas dakwah HASMI. Ini menunjukkan bahwa dakwah HASMI tidak berhenti pada perbaikan individu semata, tetapi diarahkan untuk membangun tatanan sosial yang Islami secara menyeluruh. Oleh karena itu, nama HASMI dianggap telah mewakili jati diri organisasi secara utuh: sebagai himpunan dakwah Ahlussunnah yang bergerak menuju terwujudnya masyarakat Islami.
                       
                    </div>
                </div>

                <div class="bg-slate-900 border border-slate-800 p-12 rounded-[2rem]">
                    <h3 class="text-3xl font-extrabold text-white mb-8">Tujuan Hasmi</h3>
                    <div class="space-y-6 text-gray-400 text-lg leading-relaxed">
                        <p>
                            Tujuan utama HASMI adalah terwujudnya masyarakat Islami yang berlandaskan tauhid, sunnah Rasulullah ﷺ, serta nilai-nilai Islam yang murni. HASMI berupaya membina kaum muslimin agar memiliki akidah yang lurus, ibadah yang benar, serta akhlak yang mulia, sehingga terbentuk individu-individu muslim yang kuat secara spiritual, intelektual, dan sosial.

Dalam rangka mencapai tujuan tersebut, HASMI menjadikan dakwah sebagai strategi utama perjuangannya. Dakwah ini dilakukan secara terarah, berkelanjutan, dan menyentuh berbagai lapisan masyarakat. HASMI memandang bahwa perubahan menuju masyarakat Islami harus dimulai dari pembinaan umat, penguatan pemahaman agama, serta penghidupan sunnah Rasulullah ﷺ dalam seluruh aspek kehidupan.

Bentuk nyata dari usaha dakwah HASMI diwujudkan melalui berbagai program dan sarana, antara lain pendirian sekolah-sekolah Islam, pengelolaan radio-radio dakwah, penyelenggaraan kajian-kajian keislaman, penerbitan buku-buku Islam, penerbitan majalah Islam, serta berbagai kegiatan dakwah lainnya. Seluruh aktivitas tersebut diarahkan untuk membangun kesadaran keislaman umat, memperbaiki kualitas keimanan dan ibadah, serta membentuk lingkungan sosial yang Islami.

HASMI juga menegaskan dirinya sebagai organisasi yang independen, tidak berafiliasi dengan partai politik maupun ormas lainnya. Dengan sikap ini, HASMI ingin menjaga kemurnian dakwahnya agar tetap fokus pada pembinaan umat dan penyebaran nilai-nilai Islam tanpa terikat kepentingan politik atau kelompok tertentu.
                        </p>
                      
                    </div>
                </div>
            </section>

            <section class="relative">
                <div class="absolute inset-0 bg-blue-600 rounded-[3rem] blur-[120px] opacity-10"></div>
                <div class="relative bg-slate-900 rounded-[3rem] p-12 md:p-20 border border-slate-800 shadow-2xl">
                    <div class="grid lg:grid-cols-2 gap-20">
                        <div>
                            <div class="inline-block px-6 py-2 bg-blue-600 text-white font-bold text-sm tracking-widest uppercase rounded-full mb-8">Visi Utama</div>
                            <h2 class="text-4xl md:text-5xl font-black text-white mb-10 leading-tight">
                                Menjadi Mercusuar <br><span class="text-blue-500">Peradaban Islami</span> <br>di Nusantara.
                            </h2>
                            <p class="text-gray-400 text-xl font-light leading-relaxed">
                                "Menjadi organisasi massa Islam yang paling berpengaruh, terpercaya, dan profesional dalam mewujudkan masyarakat Indonesia yang bertauhid dan berakhlak mulia pada tahun 2030."
                            </p>
                            <div class="mt-8 border-l-4 border-blue-600 pl-6 text-gray-500 italic">
                                Visi ini bukan sekadar kalimat, melainkan komitmen setiap aktivis HASMI untuk bekerja keras setiap harinya.
                            </div>
                        </div>

                        <div class="space-y-10">
                            <div class="inline-block px-6 py-2 bg-slate-800 text-blue-400 font-bold text-sm tracking-widest uppercase rounded-full">Misi Strategis</div>
                            <div class="space-y-8">
                                <div class="flex gap-6 group">
                                    <span class="text-3xl font-black text-blue-900 group-hover:text-blue-600 transition-colors">01</span>
                                    <div>
                                        <h4 class="text-xl font-bold text-white mb-3 uppercase tracking-wide">Standardisasi Dakwah</h4>
                                        <p class="text-gray-400 leading-relaxed text-base">Mengembangkan sistem dakwah yang terstruktur melalui berbagai media, kajian tatap muka, dan distribusi literatur islami guna mencerahkan pemikiran umat dari segala bentuk paham radikal maupun liberal yang menyimpang.</p>
                                    </div>
                                </div>
                                <div class="flex gap-6 group">
                                    <span class="text-3xl font-black text-blue-900 group-hover:text-blue-600 transition-colors">02</span>
                                    <div>
                                        <h4 class="text-xl font-bold text-white mb-3 uppercase tracking-wide">Pusat Pendidikan Terpadu</h4>
                                        <p class="text-gray-400 leading-relaxed text-base">Membangun dan mengelola lembaga pendidikan formal maupun informal yang memadukan kurikulum nasional dengan nilai-nilai keislaman yang mendalam untuk mencetak pemimpin masa depan yang berwawasan luas.</p>
                                    </div>
                                </div>
                                <div class="flex gap-6 group">
                                    <span class="text-3xl font-black text-blue-900 group-hover:text-blue-600 transition-colors">03</span>
                                    <div>
                                        <h4 class="text-xl font-bold text-white mb-3 uppercase tracking-wide">Transformasi Sosial & Ekonomi</h4>
                                        <p class="text-gray-400 leading-relaxed text-base">Menggerakkan potensi ekonomi umat melalui lembaga Ziswaf yang dikelola secara amanah untuk membiayai program-program kemandirian sosial, santunan yatim, dan bantuan bencana alam secara berkesinambungan.</p>
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