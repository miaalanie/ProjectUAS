@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-6 text-black-700">📋 Daftar Pengguna</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded relative mb-4 shadow">
            <strong class="font-semibold">✅ Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Tombol Export --}}
    <div class="flex justify-end gap-3 mb-5">
        <a href="{{ route('admin.pengguna.export.excel') }}" class="inline-flex items-center bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded-lg shadow transition duration-200">
            <i class="fas fa-file-excel mr-2"></i> Export Excel
        </a>
        <a href="{{ route('admin.pengguna.export.pdf') }}" class="inline-flex items-center bg-red-500 hover:bg-red-600 text-black px-4 py-2 rounded-lg shadow transition duration-200">
            <i class="fas fa-file-pdf mr-2"></i> Export PDF
        </a>
    </div>

    {{-- Tabel Pengguna --}}
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-blue-100 text-gray-800">
                <tr class="text-left text-sm font-semibold uppercase tracking-wide">
                    <th class="px-5 py-3 border">ID</th>
                    <th class="px-5 py-3 border">Nama</th>
                    <th class="px-5 py-3 border">Email</th>
                    <th class="px-5 py-3 border">Role</th>
                    <th class="px-5 py-3 border">Tanggal Daftar</th>
                    <th class="px-5 py-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($daftarPengguna as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 border">{{ $user->id }}</td>
                    <td class="px-5 py-3 border font-medium">{{ $user->name }}</td>
                    <td class="px-5 py-3 border">{{ $user->email }}</td>
                    <td class="px-5 py-3 border capitalize">{{ $user->role }}</td>
                    <td class="px-5 py-3 border">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="px-5 py-3 border text-center space-x-2">
                        <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.pengguna.hapus', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-black px-3 py-1 rounded-lg transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-5">Belum ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
