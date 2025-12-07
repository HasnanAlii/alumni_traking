<x-guest-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <div class="sm:max-w-md w-full mx-auto">
        
        {{-- HEADER LOGO & TEXT (Di luar Card) --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-600 text-white rounded-2xl shadow-lg shadow-blue-500/30 mb-4">
                <i data-feather="box" class="w-7 h-7"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang Kembali!</h2>
            <p class="text-sm text-slate-500 mt-2">Silakan masuk untuk mengakses akun Anda.</p>
        </div>

        {{-- FORM CONTAINER (Di dalam Card Putih) --}}
        <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
            <div class="p-8">
                
                {{-- SESSION STATUS --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="mail" class="w-5 h-5"></i>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 py-3 transition-all placeholder-slate-400"
                                placeholder="Email Anda">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi</label>
                        
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="lock" class="w-5 h-5"></i>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 py-3 transition-all placeholder-slate-400"
                                placeholder="Kata Sandi Anda">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- REMEMBER ME --}}
                    <div class="block">
                        <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                            <input id="remember_me" type="checkbox" 
                                class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 transition cursor-pointer" 
                                name="remember">
                            <span class="ms-2 text-sm text-slate-600 group-hover:text-slate-800 transition">{{ __('Ingat Saya') }}</span>
                        </label>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                        <i data-feather="log-in" class="w-4 h-4"></i>
                        Masuk Sekarang
                    </button>

                    {{-- REGISTER LINK --}}
                    <div class="text-center mt-6 pt-4 border-t border-slate-50">
                        <p class="text-sm text-slate-500">
                            Belum memiliki akun alumni? 
                            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition underline">
                                Daftar di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</x-guest-layout>