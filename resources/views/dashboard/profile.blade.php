@extends('dashboard.dashboard')
@section('profile-active', 'active')
@section('content')
    <div id="profile-tab" class="tab-content active" @if (LaravelLocalization::getCurrentLocale() == 'ar') dir="rtl" @endif>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">{{ __('keywords.edit profile & bio') }}</h3>
            <img class="rounded-circle" + style="width: 56px; height: 56px; object-fit: cover;"
                src="{{ getAvatar(auth()->user()) }}" + alt="{{ auth()->user()->name }}">
        </div>
        <form class="form-group pb-3" method="POST" action="{{ route('dashboard.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row mb-3">
                <div class="col-6">
                    <label for="name">{{ __('keywords.name') }}</label>
                    <input type="text" id="name" class="form-control" placeholder="{{ __('keywords.Jane Doe') }}"
                        name="name" value="{{ auth()->user()->name }}">
                    @error('name')
                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="headline">{{ __('keywords.professional headline') }}</label>
                    <input type="text" id="headline" class="form-control" placeholder="{{ __('keywords.engineer') }}"
                        name="professional_headline" value="{{ auth()->user()->professional_headline }}">
                    @error('professional_headline')
                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="bio">{{ __('keywords.bio') }}</label>
                    <textarea id="bio" name="bio" class="form-control" placeholder="{{ __('keywords.bioPlaceholder') }}">{{ auth()->user()->bio }}</textarea>
                    @error('bio')
                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="experience">{{ __('keywords.years of experience') }}</label>
                    <input type="range" name="experience" id="experience" class="form-range" min="0" max="50"
                        value="{{ auth()->user()->experience }}">
                    <output for="experience" id="experienceValue" aria-hidden="true"></output>

                    @error('experience')
                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-8 pb-4">
                    <label for="avatar">{{ __('keywords.avatar image') }}</label>
                    <input type="file" id="avatar" name="avatar" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary float-end ">{{ __('keywords.save') }}</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        const experienceInput = document.getElementById('experience');
        const experienceOutput = document.getElementById('experienceValue');
        experienceOutput.textContent = experienceInput.value;
        experienceInput.addEventListener('input', function() {
            experienceOutput.textContent = this.value;
        });

        const projectsInput = document.getElementById('projects');
        const projectsOutput = document.getElementById('projectsValue');
        projectsOutput.textContent = projectsInput.value;
        projectsInput.addEventListener('input', function() {
            projectsOutput.textContent = this.value;
        });
    </script>
@endpush
