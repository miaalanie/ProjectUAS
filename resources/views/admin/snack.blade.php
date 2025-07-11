@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Snack</h1>
            <a href="{{ route('admin.snack.tambah') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
               + Tambah Snack
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
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Kandungan Gizi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Foto</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($daftarSnack as $snack)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $snack->nama_snack }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $snack->kandungan_gizi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($snack->foto_snack)
                                    <img src="{{ asset('storage/' . $snack->foto_snack) }}" alt="Foto Snack" class="h-12">
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.snack.edit', $snack->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>

                                <form action="{{ route('admin.snack.hapus', $snack->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin mau hapus snack ini?')"
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
