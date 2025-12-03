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

        <div class="row mb-3">
            <div class="col-12">
                <label class="form-label d-block mb-2">
                    {{ __('Theme') }}
                </label>
                <div class="d-flex flex-wrap gap-2">
                    {{-- Theme 1 – base blue --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #f8fafc;">
                        <input type="radio" name="theme_id" value="1" class="form-check-input me-2"
                            @checked($settings->theme_id == 1)>
                        <span>
                            {{ __('Theme') }} 1
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#0d6efd,#764ba2);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 2 – warm sidebar --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #fff7ed;">
                        <input type="radio" name="theme_id" value="2" class="form-check-input me-2"
                            @checked($settings->theme_id == 2)>
                        <span>
                            {{ __('Theme') }} 2
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#f59e0b,#f97316);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 3 – dark --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #020617; color:#e5e7eb;">
                        <input type="radio" name="theme_id" value="3" class="form-check-input me-2"
                            @checked($settings->theme_id == 3)>
                        <span>
                            {{ __('Theme') }} 3
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#4dabf7,#51cf66);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 4 – minimal light --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #f9fafb;">
                        <input type="radio" name="theme_id" value="4" class="form-check-input me-2"
                            @checked($settings->theme_id == 4)>
                        <span>
                            {{ __('Theme') }} 4
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#0f172a,#38bdf8);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 5 – bold gradient --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #fdf2ff;">
                        <input type="radio" name="theme_id" value="5" class="form-check-input me-2"
                            @checked($settings->theme_id == 5)>
                        <span>
                            {{ __('Theme') }} 5
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#ec4899,#8b5cf6);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 6 --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #eff6ff;">
                        <input type="radio" name="theme_id" value="6" class="form-check-input me-2"
                            @checked($settings->theme_id == 6)>
                        <span>
                            {{ __('Theme') }} 6
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#3b82f6,#06b6d4);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 7 --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #ecfeff;">
                        <input type="radio" name="theme_id" value="7" class="form-check-input me-2"
                            @checked($settings->theme_id == 7)>
                        <span>
                            {{ __('Theme') }} 7
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#22c55e,#0ea5e9);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 8 --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #f5f3ff;">
                        <input type="radio" name="theme_id" value="8" class="form-check-input me-2"
                            @checked($settings->theme_id == 8)>
                        <span>
                            {{ __('Theme') }} 8
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#8b5cf6,#6366f1);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 9 --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #fef2f2;">
                        <input type="radio" name="theme_id" value="9" class="form-check-input me-2"
                            @checked($settings->theme_id == 9)>
                        <span>
                            {{ __('Theme') }} 9
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#f97316,#ef4444);">
                            </span>
                        </span>
                    </label>

                    {{-- Theme 10 --}}
                    <label class="border rounded-3 p-2 d-flex align-items-center"
                        style="cursor:pointer; min-width: 140px; background: #020617; color:#e5e7eb;">
                        <input type="radio" name="theme_id" value="10" class="form-check-input me-2"
                            @checked($settings->theme_id == 10)>
                        <span>
                            {{ __('Theme') }} 10
                            <span class="d-block mt-1"
                                style="width: 60px; height: 6px; border-radius: 999px; background: linear-gradient(90deg,#0ea5e9,#22d3ee);">
                            </span>
                        </span>
                    </label>
                </div>
                @error('theme_id')
                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button class="btn btn-primary float-end mb-3">
            {{ __('keywords.save') }}
        </button>
    </form>
</div>
