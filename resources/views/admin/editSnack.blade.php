@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Snack</h2>

        <form action="{{ route('admin.snack.update', $snack->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Snack</label>
                <input type="text" name="nama_snack" value="{{ old('nama_snack', $snack->nama_snack) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('nama_snack')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Kandungan Gizi</label>
                <textarea name="kandungan_gizi" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">{{ old('kandungan_gizi', $snack->kandungan_gizi) }}</textarea>
                @error('kandungan_gizi')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Snack</label>
                @if($snack->foto_snack)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $snack->foto_snack) }}" alt="Foto Snack" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="foto_snack"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('foto_snack')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.snack') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
