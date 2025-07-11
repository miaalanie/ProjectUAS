@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
            SnackMood
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <div class="text-gray-400 uppercase text-xs">Dashboard</div>
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>

            <div class="text-gray-400 uppercase text-xs mt-4">Master Data</div>
            <a href="{{ route('admin.pengguna') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Data Pengguna</a>
            <a href="{{ route('admin.snack') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Data Snack</a>
            <a href="{{ route('admin.rules') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Rules Fuzzy</a>

            <div class="text-gray-400 uppercase text-xs mt-4">Transaksi</div>
            <a href="{{ route('admin.log-mood') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Log Mood</a>
            <a href="{{ route('admin.riwayat-snack') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Riwayat Snack</a>
            <a href="{{ route('admin.statistik-konsumsi') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Statistik Konsumsi</a>

            <div class="text-gray-400 uppercase text-xs mt-4">Monitoring</div>
            <a href="{{ route('admin.bad-mood') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Bad Mood Alert</a>
            <a href="{{ route('admin.frekuensi-snack') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Frekuensi Snack</a>

            <div class="text-gray-400 uppercase text-xs mt-4">Laporan</div>
            <a href="{{ route('admin.laporan-user') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Per User</a>
            <a href="{{ route('admin.laporan-akumulasi') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Akumulatif</a>
        </nav>
        <div class="p-4 border-t border-gray-700 text-sm text-center">
            © SnackMood 2025
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Tambah Pengguna</h1>
            <div class="flex items-center space-x-4">
                <div class="text-gray-600">Maya Nurhaliza</div>
                <img src="https://ui-avatars.com/api/?name=Maya+Nurhaliza" alt="Avatar" class="w-8 h-8 rounded-full">
                <div class="relative">
                    <button class="focus:outline-none">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="max-w-xl bg-white p-6 rounded-lg shadow">
                <form action="{{ route('admin.pengguna.simpan') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        @error('role')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.pengguna') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
