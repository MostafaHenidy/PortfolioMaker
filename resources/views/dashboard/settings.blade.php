<div id="settings-tab" class="tab-content" @if (LaravelLocalization::getCurrentLocale() == 'ar') dir="rtl" @endif>
    <h3>{{ __('keywords.account settings') }}</h3>
    <p style="color: #666; margin-bottom: 1.5rem;">
        {{ __('keywords.manage account preferences') ?? 'Manage account preferences.' }}
    </p>

    <form class="pb-4" action="{{ route('dashboard.settings.update') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">

            <div class="col-12 col-md-6 col-lg-3 mb-2 form-switch">
                <input type="hidden" name="about" value="0">
                <input id="chk_about" class="form-check-input @if (LaravelLocalization::getCurrentLocale() == 'ar') ms-1 @endif" type="checkbox" name="about" value="1"
                    @checked($settings->about)>
                <label for="chk_about">{{ __('keywords.about') }}</label>
                @error('about')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2 form-switch">
                <input type="hidden" name="skills" value="0">
                <input id="chk_skills" class="form-check-input @if (LaravelLocalization::getCurrentLocale() == 'ar') ms-1 @endif" type="checkbox" name="skills" value="1"
                    @checked($settings->skills)>
                <label for="chk_skills">{{ __('keywords.skills') }}</label>
                @error('skills')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2 form-switch">
                <input type="hidden" name="projects" value="0">
                <input id="chk_projects" class="form-check-input @if (LaravelLocalization::getCurrentLocale() == 'ar') ms-1 @endif" type="checkbox" name="projects" value="1"
                    @checked($settings->projects)>
                <label for="chk_projects">{{ __('keywords.projects') }}</label>
                @error('projects')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12 col-md-6 col-lg-3 mb-2 form-switch">
                <input type="hidden" name="contact" value="0">
                <input id="chk_contact" class="form-check-input @if (LaravelLocalization::getCurrentLocale() == 'ar') ms-1 @endif" type="checkbox" name="contact" value="1"
                    @checked($settings->contact)>
                <label for="chk_contact">{{ __('keywords.contact') }}</label>
                @error('contact')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <button class="btn btn-primary float-end mb-3">
            {{ __('keywords.save') }}
        </button>
    </form>
</div>
