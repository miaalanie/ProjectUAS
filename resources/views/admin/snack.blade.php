@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Snack</h1>
        <a href="{{ route('admin.snack_tambah') }}" class="btn btn-success">
            <i class="fas fa-plus mr-1"></i> Tambah Snack
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

<style>
  body {
    background: #f5faff;
    font-family: 'Nunito', 'Segoe UI', Arial, sans-serif;
  }

  .snack-outer {
    background: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 4px 16px rgba(0, 122, 204, 0.06);
    padding: 1.5rem;
    border: 1px solid #e0e7f0;
    margin-bottom: 2rem;
  }

  .snack-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.97rem;
    color: #333;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 122, 204, 0.08);
  }

  .snack-table thead th {
    background: #007acc;
    color: #fff;
    font-weight: 700;
    text-align: left;
    padding: 0.9rem;
    border-top: 1px solid #007acc;
  }

  .snack-table tbody tr:nth-child(even) td {
    background: #f0f7ff;
  }

  .snack-table tbody tr:nth-child(odd) td {
    background: #ffffff;
  }

  .snack-table td {
    padding: 0.8rem;
    vertical-align: middle;
    border-bottom: 1px solid #e0e7f0;
  }

  .snack-table tr:hover td {
    background: #d8edff;
  }

  .snack-table img {
    border-radius: 0.4rem;
    border: 1px solid #cfe3f4;
    max-height: 50px;
    object-fit: cover;
  }

  .text-right {
    text-align: right;
  }

  /* Tombol Aksi */
  .icon-snack {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: #007acc;
    color: #fff;
    font-size: 1rem;
    margin-left: 5px;
    border: none;
    transition: 0.2s;
    cursor: pointer;
  }

  .icon-snack:hover {
    background: #005fa3;
    transform: scale(1.05);
  }

  .icon-snack-delete {
    background: #e53935;
  }

  .icon-snack-delete:hover {
    background: #b71c1c;
  }
</style>



<div class="snack-outer">
  <div class="table-responsive">
    <table class="table snack-table" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Kandungan Gizi</th>
          <th>Foto</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($daftarSnack as $snack)
          <tr>
            <td>{{ $snack->nama_snack }}</td>
            <td>{{ $snack->kandungan_gizi }}</td>
            <td>
              @if ($snack->foto_snack)
                <img src="{{ asset('storage/' . $snack->foto_snack) }}" alt="Foto Snack" style="height:48px;max-width:80px;object-fit:cover;">
              @else
                <span class="text-muted">-</span>
              @endif
            </td>
            <td class="text-right">
              <a href="{{ route('admin.snack.edit', $snack->id) }}" class="icon-snack" data-tooltip="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('admin.snack.hapus', $snack->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="icon-snack icon-snack-delete" data-tooltip="Hapus" onclick="return confirm('Yakin mau hapus snack ini?')">
                  <i class="fas fa-trash-alt"></i>
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
