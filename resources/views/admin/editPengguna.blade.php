@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Edit Pengguna</h1>

        <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $pengguna->name) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $pengguna->email) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                    <option value="admin" {{ $pengguna->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $pengguna->role === 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak diubah)</label>
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
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
