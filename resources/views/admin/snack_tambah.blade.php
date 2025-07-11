@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Snack</h2>
        <form action="{{ route('admin.snack.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nama Snack</label>
                <input type="text" name="nama_snack" value="{{ old('nama_snack') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium">Kandungan Gizi</label>
                <textarea name="kandungan_gizi" class="w-full border rounded px-3 py-2" required></textarea>
            </div>
            <div>
                <label class="block font-medium">Foto Snack</label>
                <input type="file" name="foto_snack" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.snack') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
