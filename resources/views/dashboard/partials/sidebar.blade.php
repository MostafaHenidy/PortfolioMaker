<aside class="sidebar">
    <div class="sidebar-brand">
        <a style="text-decoration: none" href="{{ url('/') }}"> Portfolio Builder</a>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ url('/dashboard') }}" class="nav-item @yield('profile-active')" data-tab="profile">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            {{ __('keywords.profile & bio') }}
        </a>
        <a href="{{ route('dashboard.projects') }}" class="nav-item @yield('projects-active')" data-tab="projects">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h2m4 0v.01M10 11h.01M5 15h.01">
                </path>
            </svg>
            {{ __('keywords.projects') }}
        </a>
        <a href="{{ route('dashboard.skills') }}" class="nav-item @yield('skills-active')" data-tab="skills">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 3v2m6-2v2M9 19v2m6-2v2M5 15a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v6a2 2 0 01-2 2H5z">
                </path>
            </svg>
            {{ __('keywords.skill & tools') }}
        </a>
        <a href="{{ route('dashboard.settings') }}" class="nav-item @yield('settings-active')" data-tab="settings">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            {{ __('keywords.account settings') }}
        </a>
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if ($localeCode !== LaravelLocalization::getCurrentLocale())
                <a class="nav-item d-flex align-items-center" style="text-decoration: none; color: white;"
                    rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                    <i class="bi bi-translate me-2"></i>
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
