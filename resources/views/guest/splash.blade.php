@extends('layouts.app')

@section('content')
<style>
  .splash-screen {
    background: linear-gradient(135deg, #42a5f5, #7e57c2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    flex-direction: column;
  }
  .splash-text {
    font-size: 2.5rem;
    font-weight: bold;
    margin-top: 20px;
    animation: fadeIn 1.5s ease-in-out infinite alternate;
  }
  .loader {
    border: 8px solid rgba(255, 255, 255, 0.2);
    border-top: 8px solid #fff;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    animation: spin 1s linear infinite;
  }
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
  @keyframes fadeIn {
    from { opacity: 0.5; }
    to { opacity: 1; }
  }
</style>

<div class="splash-screen">
    <div class="loader"></div>
    <div class="splash-text">Memuat Dashboard Guest...</div>
</div>

<script>
  setTimeout(() => {
    window.location.href = "{{ route('guest.dashboard') }}";
  }
