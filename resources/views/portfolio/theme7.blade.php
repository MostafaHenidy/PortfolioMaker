<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 7)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme7.css') }}">
</head>

<body class="theme-7">
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">{{ $user->name }}</div>
            <ul>
                <li><a href="#about">{{ __('keywords.about') }}</a></li>
                <li><a href="#skills">{{ __('keywords.skills') }}</a></li>
                <li><a href="#projects">{{ __('keywords.projects') }}</a></li>
                <li><a href="#contact">{{ __('keywords.contact') }}</a></li>
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if (LaravelLocalization::getCurrentLocale() !== $localeCode)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </header>

    <!-- Hero as card deck intro -->
    <section class="hero hero-tiles">
        <div class="tiles-grid">
            <div class="tile main">
                <h1>{{ __('keywords.selfIntroduction') }} {{ $user->name }}</h1>
                <p>{{ __('keywords.passionate') }} {{ $user->professional_headline }}</p>
            </div>
            <div class="tile">
                <span class="label">{{ __('keywords.years of experience') }}</span>
                <span class="value">{{ $user->experience }}+</span>
            </div>
            <div class="tile">
                <span class="label">{{ __('keywords.completed projects') }}</span>
                <span class="value">{{ $user->projects_made }}</span>
            </div>
            <div class="tile avatar-tile">
                <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
            </div>
        </div>
    </section>

    @if ($settings->about)
        <section id="about">
            <h2>{{ __('keywords.about') }}</h2>
            <div class="about-card">
                <p>{{ $user->bio }}.</p>
            </div>
        </section>
    @endif

    @if ($settings->skills)
        <section id="skills">
            <h2>{{ __('keywords.skills') }}</h2>
            <div class="skills-grid">
                @foreach ($skills as $skill)
                    <div class="skill-card">
                        <div class="skill-name">{{ $skill->name }}</div>
                        <div class="skill-meter">
                            <span style="width: {{ $skill->level }}%;"></span>
                        </div>
                        <div class="skill-level">{{ $skill->level }}%</div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->projects)
        <section id="projects">
            <h2>{{ __('keywords.featured projects') }}</h2>
            <div class="projects-masonry">
                @foreach ($projects as $project)
                    <article class="project-tile">
                        <img style="border-radius: 10px;" class="project-image" src="{{ getProjectImage($project) }}"
                            alt="{{ $project->name }}">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->description }}.</p>
                        <div class="project-tags">
                            @foreach ($project->skills as $skill)
                                <span class="tag">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->contact)
        <section id="contact">
            <h2>{{ __('keywords.get in touch') }}</h2>
            <div class="contact-row">
                <div class="contact-text">
                    <p>{{ __('keywords.project description') }}</p>
                </div>
                <div class="contact-form-card">
                    <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name"
                                placeholder="{{ __('keywords.your name') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email"
                                placeholder="{{ __('keywords.your email') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="{{ __('keywords.your message') }}" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary">{{ __('keywords.send message') }}</button>
                    </form>
                </div>
            </div>
        </section>
    @endif

    <footer>
        <p>&copy; 2025 {{ $user->name }}. All rights reserved.</p>
    </footer>
</body>

</html>
