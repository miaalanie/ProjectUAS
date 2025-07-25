@extends('layouts.app')

@section('content')
<style>
  body .edit-snack-outer {
    background: #fff !important;
    border-radius: 1.2rem !important;
    box-shadow: 0 6px 24px rgba(0, 122, 204, 0.10) !important;
    padding: 2.2rem 2rem 2rem 2rem !important;
    border: 1px solid #e0e7f0 !important;
    max-width: 480px !important;
    margin: 2rem auto !important;
    position: relative !important;
  }
  body .edit-snack-outer h2 {
    font-size: 2.1rem !important;
    font-weight: 700 !important;
    color: #007acc !important;
    margin-bottom: 1.7rem !important;
    text-align: center !important;
  }
  body .edit-snack-form label {
    font-weight: 600 !important;
    color: #005fa3 !important;
    margin-bottom: 0.4rem !important;
    display: block !important;
  }
  body .edit-snack-form input[type="text"],
  body .edit-snack-form textarea,
  body .edit-snack-form input[type="file"] {
    width: 100% !important;
    border: 1px solid #cfe3f4 !important;
    border-radius: 0.7rem !important;
    padding: 0.7rem 1rem !important;
    font-size: 1rem !important;
    margin-bottom: 0.2rem !important;
    background: #f8fbff !important;
    transition: border 0.2s, box-shadow 0.2s !important;
    box-shadow: 0 2px 8px rgba(0, 122, 204, 0.06) !important;
  }
  body .edit-snack-form input:focus,
  body .edit-snack-form textarea:focus {
    border-color: #007acc !important;
    box-shadow: 0 2px 12px rgba(0, 122, 204, 0.13) !important;
    outline: none !important;
  }
  body .edit-snack-form .text-red-600 {
    color: #e53935 !important;
    font-size: 0.95rem !important;
    margin-top: 0.2rem !important;
  }
  body .edit-snack-form .snack-img-preview {
    display: block !important;
    margin: 0 auto 1rem auto !important;
    border-radius: 0.7rem !important;
    box-shadow: 0 2px 8px rgba(0, 122, 204, 0.10) !important;
    border: 1px solid #cfe3f4 !important;
    max-width: 120px !important;
    max-height: 120px !important;
    object-fit: cover !important;
  }
  body .edit-snack-form .form-actions {
    display: flex !important;
    justify-content: flex-end !important;
    gap: 0.7rem !important;
    margin-top: 1.2rem !important;
  }
  body .edit-snack-form .btn-cancel {
    background: #b0b7c3 !important;
    color: #fff !important;
    padding: 0.7rem 1.3rem !important;
    border-radius: 0.7rem !important;
    font-weight: 600 !important;
    border: none !important;
    transition: background 0.2s !important;
    text-decoration: none !important;
  }
  body .edit-snack-form .btn-cancel:hover {
    background: #7a869a !important;
  }
  body .edit-snack-form .btn-save {
    background: #007acc !important;
    color: #fff !important;
    padding: 0.7rem 1.3rem !important;
    border-radius: 0.7rem !important;
    font-weight: 600 !important;
    border: none !important;
    transition: background 0.2s, transform 0.2s !important;
    box-shadow: 0 2px 8px rgba(0, 122, 204, 0.10) !important;
  }
  body .edit-snack-form .btn-save:hover {
    background: #005fa3 !important;
    transform: scale(1.04) !important;
  }
</style>

<div class="edit-snack-outer">
    <h2>Edit Snack</h2>
    <form action="{{ route('admin.snack.update', $snack->id) }}" method="POST" enctype="multipart/form-data" class="edit-snack-form">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Snack</label>
            <input type="text" name="nama_snack" value="{{ old('nama_snack', $snack->nama_snack) }}">
            @error('nama_snack')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Kandungan Gizi</label>
            <textarea name="kandungan_gizi" rows="4">{{ old('kandungan_gizi', $snack->kandungan_gizi) }}</textarea>
            @error('kandungan_gizi')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Foto Snack</label>
            @if($snack->foto_snack)
                <img src="{{ asset('storage/' . $snack->foto_snack) }}" alt="Foto Snack" class="snack-img-preview">
            @endif
            <input type="file" name="foto_snack">
            @error('foto_snack')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.snack') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
