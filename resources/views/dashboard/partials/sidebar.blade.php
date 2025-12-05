<aside class="sidebar">
    <div class="sidebar-brand">
        <a style="text-decoration: none" href="{{ url('/') }}"> Portfolio Builder</a>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ url('/dashboard') }}" class="nav-item @yield('profile-active')" data-tab="profile">
            <i class="bi bi-person-fill"></i>
            {{ __('keywords.profile & bio') }}
        </a>
        <a href="{{ route('dashboard.projects') }}" class="nav-item @yield('projects-active')" data-tab="projects">
            <i class="bi bi-clipboard2-fill"></i>
            {{ __('keywords.projects') }}
        </a>
        <a href="{{ route('dashboard.skills') }}" class="nav-item @yield('skills-active')" data-tab="skills">
            <i class="bi bi-person-fill-gear"></i>
            {{ __('keywords.skill & tools') }}
        </a>
        <a href="{{ route('dashboard.settings') }}" class="nav-item @yield('settings-active')" data-tab="settings">
            <i class="bi bi-gear-fill"></i>
            {{ __('keywords.account settings') }}
        </a>
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if ($localeCode !== LaravelLocalization::getCurrentLocale())
                <a class="nav-item d-flex align-items-center" style="text-decoration: none; color: white;"
                    rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <i class="bi bi-globe"></i>
                    {{ $properties['native'] }}
                </a>
            @endif
        @endforeach
    </nav>
    <div class="sidebar-footer ">
        <a href="{{ route('dashboard.viewUserProtfolio', auth()->user()->name) }}" class="btn-view-portfolio"
            style="text-decoration: none">
            {{ __('keywords.view live portfolio') }}
        </a>
    </div>
</aside>
