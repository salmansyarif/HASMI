<footer
    class="bg-gradient-to-br from-blue-600 to-blue-700 text-white pt-20 pb-10 border-t border-blue-500 relative overflow-hidden">
    {{-- Decorative Elements --}}
<<<<<<< HEAD
    <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-blue-300 to-transparent opacity-60"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400/20 rounded-full blur-[100px] pointer-events-none hidden lg:block"></div>
=======
    <div
        class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-blue-300 to-transparent opacity-60">
    </div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400/20 rounded-full blur-[100px] pointer-events-none"></div>
>>>>>>> 8bd8799e1e720a3f90d4ea5f8a22ea30ee91e989

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            {{-- BRAND --}}
            <div data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-400/30">
                        <img src="{{ asset('img/hasmilogo.png') }}" alt="Logo HASMI" class="w-8 h-8 object-contain">
                    </div>
                    <span
                        class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-100 to-white">HASMI</span>
                </div>
                <p class="text-blue-100 leading-relaxed mb-6">Himpunan Ahlussunnah untuk Masyarakat Islami. Membangun
                    peradaban Islami melalui pendidikan, dakwah, dan aksi sosial.</p>

                {{-- Profil Video Embed --}}
<<<<<<< HEAD
                <div class="mb-6 rounded-xl overflow-hidden shadow-lg border border-white/20 group bg-blue-700/60">
                    <iframe class="w-full h-48 md:h-40 object-cover" src="https://www.youtube.com/embed/aqflN-aX-6U?controls=1&rel=0&origin={{ request()->getSchemeAndHttpHost() }}" title="Profil HASMI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
=======
                <div
                    class="mb-6 rounded-xl overflow-hidden shadow-lg border border-white/20 group bg-blue-700/60 aspect-video">
                    <x-lite-youtube videoId="ovpPnlSwpe4" title="Profil HASMI" />
>>>>>>> 8bd8799e1e720a3f90d4ea5f8a22ea30ee91e989
                </div>

                <div class="flex gap-4">
                    <a href="https://www.facebook.com/hasmipusat" target="_blank"
                        class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition-all duration-300 transform hover:-translate-y-1 group">
                        <i class="fab fa-facebook-f text-blue-100 group-hover:text-white"></i>
                    </a>
                    <a href="https://x.com/hasmipusat" target="_blank"
                        class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center hover:bg-black hover:text-white transition-all duration-300 transform hover:-translate-y-1 group border border-transparent hover:border-slate-700">
                        <i class="fab fa-twitter text-blue-100 group-hover:text-white"></i>
                    </a>
                    <a href="https://www.instagram.com/hasmipusat/" target="_blank"
                        class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center hover:bg-gradient-to-br from-[#833AB4] via-[#FD1D1D] to-[#FCAF45] hover:text-white transition-all duration-300 transform hover:-translate-y-1 group">
                        <i class="fab fa-instagram text-blue-100 group-hover:text-white"></i>
                    </a>
                    <a href="https://www.youtube.com/@HasmiTV/featured" target="_blank"
                        class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1 group">
                        <i class="fab fa-youtube text-blue-100 group-hover:text-white"></i>
                    </a>
                </div>
            </div>

            {{-- DOWNLOADS & LINKS --}}
            <div data-aos="fade-up" data-aos-delay="100">
                <h4 class="font-bold text-lg mb-6 text-blue-100">Unduhan & Berkas</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="https://www.hasmi.org/wp-content/uploads/2021/01/Profil.pdf" target="_blank"
                            class="flex items-center gap-3 text-blue-100 hover:text-white group transition-colors p-3 rounded-xl hover:bg-white/10 border border-transparent hover:border-white/20">
                            <i
                                class="fas fa-file-pdf text-red-400 text-xl group-hover:scale-110 transition-transform"></i>
                            <div>
                                <span class="block font-medium">Profil HASMI</span>
                                <span class="text-xs text-blue-200 group-hover:text-blue-100">PDF Document</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.hasmi.org/wp-content/uploads/2020/08/e-HDH.pdf" target="_blank"
                            class="flex items-center gap-3 text-blue-100 hover:text-white group transition-colors p-3 rounded-xl hover:bg-white/10 border border-transparent hover:border-white/20">
                            <i
                                class="fas fa-book-open text-blue-300 text-xl group-hover:scale-110 transition-transform"></i>
                            <div>
                                <span class="block font-medium">E-Book HDH</span>
                                <span class="text-xs text-blue-200 group-hover:text-blue-100">Himpunan Doa Hisnul
                                    Muslim</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- PRAYER TIMES WIDGET --}}
            <div class="lg:col-span-2" data-aos="fade-up" data-aos-delay="200">
<<<<<<< HEAD
                <div class="bg-gradient-to-br from-blue-700/50 to-blue-800/70 lg:backdrop-blur-md rounded-2xl p-6 border border-blue-400/30 relative overflow-hidden group hover:border-blue-300/50 transition-all duration-500">
=======
                <div
                    class="bg-gradient-to-br from-blue-700/50 to-blue-800/70 backdrop-blur-md rounded-2xl p-6 border border-blue-400/30 relative overflow-hidden group hover:border-blue-300/50 transition-all duration-500">
>>>>>>> 8bd8799e1e720a3f90d4ea5f8a22ea30ee91e989
                    <div class="absolute inset-0 bg-blue-400/10 group-hover:bg-blue-400/15 transition-colors"></div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h4 class="font-bold text-xl text-white mb-1"><i
                                        class="fas fa-mosque text-blue-300 mr-2"></i>Jadwal Sholat</h4>
                                <p class="text-blue-100 text-sm" id="prayer-location">Menampilkan waktu untuk...</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold font-mono text-blue-100" id="current-clock">--:--</div>
                                <div class="text-xs text-green-300 font-medium mt-1 animate-pulse"
                                    id="next-prayer-countdown">Menghitung...</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-5 gap-2 text-center" id="prayer-times-grid">
                            <!-- JS will populate this -->
                            <div class="sholat-item bg-blue-700/60 rounded-lg p-2">
                                <span class="text-xs text-blue-200 block mb-1">Subuh</span>
                                <span class="font-bold text-white text-sm">--:--</span>
                            </div>
                            <div class="sholat-item bg-blue-700/60 rounded-lg p-2">
                                <span class="text-xs text-blue-200 block mb-1">Dzuhur</span>
                                <span class="font-bold text-white text-sm">--:--</span>
                            </div>
                            <div class="sholat-item bg-blue-700/60 rounded-lg p-2">
                                <span class="text-xs text-blue-200 block mb-1">Ashar</span>
                                <span class="font-bold text-white text-sm">--:--</span>
                            </div>
                            <div class="sholat-item bg-blue-700/60 rounded-lg p-2">
                                <span class="text-xs text-blue-200 block mb-1">Maghrib</span>
                                <span class="font-bold text-white text-sm">--:--</span>
                            </div>
                            <div class="sholat-item bg-blue-700/60 rounded-lg p-2">
                                <span class="text-xs text-blue-200 block mb-1">Isya</span>
                                <span class="font-bold text-white text-sm">--:--</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div
            class="border-t border-blue-500/40 pt-8 flex flex-col md:flex-row justify-between items-center text-blue-100 text-sm">
            <p>&copy; {{ date('Y') }} HASMI. All Rights Reserved.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Clock
        setInterval(() => {
            const now = new Date();
            document.getElementById('current-clock').textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }, 1000);

        // Prayer Times Logic
        async function fetchPrayerTimes() {
            try {
                // Default coordinates (Bogor)
                let lat = -6.5971;
                let long = 106.8060;
                let locationName = "Bogor, Indonesia";

                // Try geolocation
                if ("geolocation" in navigator) {
                    try {
                        const position = await new Promise((resolve, reject) => {
                            navigator.geolocation.getCurrentPosition(resolve, reject);
                        });
                        lat = position.coords.latitude;
                        long = position.coords.longitude;
                        locationName = "Lokasi Anda";
                    } catch (e) {
                        console.log("Geolocation denied, using default.");
                    }
                }

                document.getElementById('prayer-location').textContent = locationName;

                const date = new Date();
                const response = await fetch(
                    `https://api.aladhan.com/v1/timings/${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}?latitude=${lat}&longitude=${long}&method=20`
                ); // Method 20: Kemenag UI
                const data = await response.json();

                if (data.code === 200) {
                    const timings = data.data.timings;
                    const prayers = {
                        'Subuh': timings.Fajr,
                        'Dzuhur': timings.Dhuhr,
                        'Ashar': timings.Asr,
                        'Maghrib': timings.Maghrib,
                        'Isya': timings.Isha
                    };

                    const grid = document.getElementById('prayer-times-grid');
                    grid.innerHTML = '';

                    let nextPrayerName = '';
                    let nextPrayerTime = '';
                    let minDiff = Infinity;
                    const nowMinutes = date.getHours() * 60 + date.getMinutes();

                    for (const [name, time] of Object.entries(prayers)) {
                        const div = document.createElement('div');
                        const isNext = false; // Logic to highlight next prayer

                        // Parse time to minutes
                        const [hours, mins] = time.split(':').map(Number);
                        const prayerMinutes = hours * 60 + mins;
                        let diff = prayerMinutes - nowMinutes;

                        // Check if this prayer is the next one
                        if (diff > 0 && diff < minDiff) {
                            minDiff = diff;
                            nextPrayerName = name;
                            nextPrayerTime = time;
                        }

                        div.className =
                            `sholat-item rounded-xl p-3 flex flex-col items-center justify-center border transition-all duration-300 ${name === nextPrayerName ? 'bg-blue-500 border-blue-300 shadow-lg shadow-blue-700/50 scale-105 z-10' : 'bg-blue-700/50 border-blue-500/60 hover:bg-blue-600/60'}`;

                        div.innerHTML = `
                            <span class="text-xs ${name === nextPrayerName ? 'text-blue-50' : 'text-blue-200'} mb-1">${name}</span>
                            <span class="font-bold ${name === nextPrayerName ? 'text-white' : 'text-blue-50'} text-sm">${time}</span>
                        `;
                        grid.appendChild(div);
                    }

                    if (nextPrayerName) {
                        document.getElementById('next-prayer-countdown').textContent =
                            `Menuju ${nextPrayerName}: ${nextPrayerTime}`;
                        // Re-render to apply highlight correctly now that we know the next prayer
                        const children = grid.children;
                        Array.from(children).forEach(child => {
                            const nameSpan = child.querySelector('span:first-child');
                            if (nameSpan.textContent === nextPrayerName) {
                                child.className =
                                    'sholat-item rounded-xl p-3 flex flex-col items-center justify-center border transition-all duration-300 bg-blue-500 border-blue-300 shadow-lg shadow-blue-700/50 scale-105 z-10';
                                child.innerHTML = `
                                    <span class="text-xs text-blue-50 mb-1">${nextPrayerName}</span>
                                    <span class="font-bold text-white text-sm">${prayers[nextPrayerName]}</span>
                                `;
                            }
                        });
                    } else {
                        document.getElementById('next-prayer-countdown').textContent =
                            "Waktu Isya Telah Berlalu";
                    }

                }
            } catch (error) {
                console.error("Error fetching prayer times:", error);
                document.getElementById('prayer-location').textContent = "Gagal memuat jadwal";
            }
        }

        fetchPrayerTimes();
    });
</script>
