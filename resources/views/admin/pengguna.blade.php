@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pengguna</h1>
        <div class="d-flex">
            {{-- Tombol Export Excel --}}
            <a href="{{ route('admin.pengguna.export.excel') }}" class="btn btn-success mr-2">
                <i class="fas fa-file-excel mr-1"></i> Export Excel
            </a>

            {{-- Tombol Export PDF --}}
            <a href="{{ route('admin.pengguna.export.pdf') }}" class="btn btn-danger mr-2">
                <i class="fas fa-file-pdf mr-1"></i> Export PDF
            </a>

            {{-- Tombol Tambah User --}}
            <a href="{{ route('admin.pengguna.tambah') }}" class="btn btn-primary">
                <i class="fas fa-user-plus mr-1"></i> Tambah Pengguna
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPengguna as $pengguna)
                            <tr>
                                <td>{{ $pengguna->name }}</td>
                                <td>{{ $pengguna->email }}</td>
                                <td class="text-capitalize">{{ $pengguna->role }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pengguna.edit', $pengguna->id) }}" class="btn btn-sm btn-primary mr-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pengguna.hapus', $pengguna->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus user ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
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
</div>
@endsection
