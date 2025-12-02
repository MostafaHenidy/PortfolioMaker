<div id="profile-tab" class="tab-content active" @if (LaravelLocalization::getCurrentLocale() == 'ar') dir="rtl" @endif>
    <h3>{{ __('keywords.edit profile & bio') }}</h3>
    <form class="form-group pb-3" method="POST" action="{{ route('dashboard.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row mb-3">
            <div class="col-6">
                <label for="name">{{ __('keywords.name') }}</label>
                <input type="text" id="name" class="form-control" placeholder="Jane Doe" name="name"
                    value="{{ auth()->user()->name }}">
                @error('name')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="headline">{{ __('keywords.professional headline') }}</label>
                <input type="text" id="headline" class="form-control" placeholder="e.g., Full Stack Developer"
                    name="professional_headline" value="{{ auth()->user()->professional_headline }}">
                @error('professional_headline')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="bio">{{ __('keywords.bio') }}</label>
                <textarea id="bio" name="bio" class="form-control" placeholder="Tell us about yourself...">{{ auth()->user()->bio }}</textarea>
                @error('bio')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="experience">{{ __('keywords.years of experience') }}</label>
                <input type="number" name="experience" id="experience" class="form-control"
                    value="{{ auth()->user()->experience }}">
                @error('experience')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="projects">{{ __('keywords.completed projects') }}</label>
                <input type="number" id="projects" name="projects_made" class="form-control"
                    value="{{ auth()->user()->projects_made }}">
                @error('projects_made')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="avatar">{{ __('keywords.avatar image') }}</label>
            <input type="file" id="avatar" name="avatar" class="form-control">
        </div>
        <button class="btn btn-primary float-end ">{{ __('keywords.save') }}</button>
    </form>
</div>
