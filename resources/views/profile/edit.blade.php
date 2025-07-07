@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-user-edit fa-fw me-2"></i>
                <span>{{ __('Edit Profile') }}</span>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=4e73df&color=fff&size=96" class="rounded-circle shadow" alt="Avatar">
                    <div class="mt-2 text-secondary small">{{ Auth::user()->email ?? '' }}</div>
                </div>
                <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                      <i class="fas fa-user"></i> {{ __('Profile') }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">
                      <i class="fas fa-key"></i> {{ __('Password') }}
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">
                      <i class="fas fa-user-times"></i> {{ __('Delete') }}
                    </a>
                  </li>
                </ul>
                <div class="tab-content" id="profileTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @if(session('status') && session('status') !== 'password-updated')
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                        @include('profile.partials.update-profile-information-form', ['user' => $user])
                  </div>
                  <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    @if(session('status') === 'password-updated')
                        <div class="alert alert-success">{{ __('Password updated successfully.') }}</div>
                    @endif
                    @include('profile.partials.update-password-form')
                  </div>
                  <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
                    <div class="alert alert-warning mb-3"><i class="fas fa-exclamation-triangle me-1"></i> {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</div>
                    @include('profile.partials.delete-user-form')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Cek versi Bootstrap di console
if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
    console.log('Bootstrap version:', bootstrap.Tab.VERSION);
} else {
    console.warn('Bootstrap JS tidak aktif atau bukan versi 5!');
}
</script>
@endsection
