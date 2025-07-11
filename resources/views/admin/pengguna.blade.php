@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
            <a href="{{ route('admin.pengguna.tambah') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
               + Tambah Pengguna
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Role</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($daftarPengguna as $pengguna)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pengguna->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pengguna->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $pengguna->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" 
                                   class="text-green-600 hover:text-green-800 mr-3">Edit</a>

                                <form action="{{ route('admin.pengguna.hapus', $pengguna->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin mau hapus user ini?')"
                                            class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
