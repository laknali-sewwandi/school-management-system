<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-900 via-slate-900 to-blue-900">

        <div class="w-full sm:max-w-4xl mt-6 flex flex-col md:flex-row bg-white/10 backdrop-blur-lg shadow-2xl rounded-2xl overflow-hidden border border-white/20">

            <div class="w-full md:w-1/2 bg-gradient-to-tr from-blue-600 to-indigo-700 p-10 flex flex-col justify-center items-center text-white text-center">
                <div class="bg-white/20 p-4 rounded-full mb-4 backdrop-blur-sm">
                    <svg class="w-16 h-16 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold tracking-wider mb-2">SCHOOL MANAGEMENT SYSTEM</h1>
                <p class="text-blue-100 text-sm max-w-xs">Welcome back! Please login to access your dashboard and manage school activities smoothly.</p>
            </div>

            <div class="w-full md:w-1/2 p-8 sm:p-10 bg-slate-900/40 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-white mb-6 text-center md:text-left">Account Login</h2>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                ✉️
                            </span>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                class="block w-full pl-10 pr-3 py-2.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="name@school.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                🔒
                            </span>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="block w-full pl-10 pr-3 py-2.5 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex flex-row items-center justify-between w-full text-sm pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded bg-slate-800 border-slate-700 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-slate-900">
                            <span class="ms-2 text-gray-400">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-blue-400 hover:text-blue-300 transition duration-150 underline decoration-dotted" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:-translate-y-0.5">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
