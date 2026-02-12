<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - HASMI</title>

    <!-- Tailwind -->
    @vite(['resources/css/app.css'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            background: radial-gradient(circle at top, #1e3a8a, #020617 70%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .glow {
            box-shadow: 0 0 40px rgba(59, 130, 246, 0.35);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-20 h-20 rounded-2xl bg-white flex items-center justify-center glow">
                <img src="{{ asset('img/hasmilogo.png') }}" alt="HASMI Logo" class="w-12 h-12 object-contain">
            </div>
            <h1 class="mt-5 text-3xl font-bold text-white tracking-wide">HASMI Admin</h1>
            <p class="mt-2 text-blue-300 text-sm">Masuk ke dashboard administrator</p>
        </div>

        <!-- Card -->
        <div class="glass rounded-2xl p-8">

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-500/40 bg-red-500/15 px-4 py-3 text-sm text-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm text-blue-200">Email</label>
                    <div class="relative mt-1">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-blue-300"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-lg bg-white/10 border border-white/20 py-3 pl-10 pr-4 text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="admin@hasmi.org" />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm text-blue-200">Password</label>
                    <div class="relative mt-1">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-blue-300"></i>
                        <input type="password" name="password" required
                            class="w-full rounded-lg bg-white/10 border border-white/20 py-3 pl-10 pr-4 text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="••••••••" />
                    </div>
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-blue-200">
                        <input type="checkbox" name="remember" class="accent-blue-500" />
                        Ingat saya
                    </label>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 py-3 font-semibold text-white transition hover:brightness-110">
                    <i class="fas fa-right-to-bracket mr-2"></i> Login
                </button>
            </form>

            <!-- Back -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-blue-300 hover:text-white transition">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-xs text-blue-400">© HASMI • Admin Panel</p>

    </div>

</body>

</html>
