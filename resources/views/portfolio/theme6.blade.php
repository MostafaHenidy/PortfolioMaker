<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 6)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme6.css') }}">
</head>

<body class="theme-6">
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

    <!-- Fullscreen Hero -->
    <section class="hero hero-full">
        <div class="hero-inner">
            <div class="hero-text">
                <p class="hero-kicker">{{ __('keywords.portfolio') }}</p>
                <h1>{{ __('keywords.selfIntroduction') }} {{ $user->name }}</h1>
                <p class="hero-subtitle">{{ __('keywords.passionate') }} {{ $user->professional_headline }}</p>
                <a href="#projects" class="btn-primary">{{ __('keywords.view my work') }}</a>
            </div>
            <div class="hero-avatar">
                <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
            </div>
        </div>
    </section>

    <!-- About Section -->
    @if ($settings->about)
        <section id="about" class="band band-light">
            <div class="band-inner">
                <h2>{{ __('keywords.about') }}</h2>
                <div class="about-grid">
                    <div class="about-text">
                        <p>{{ $user->bio }}.</p>
                    </div>
                    <div class="stats">
                        <div class="stat-card">
                            <div class="stat-number">{{ $user->experience }}+</div>
                            <div class="stat-label">{{ __('keywords.years of experience') }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $user->projects_made }}</div>
                            <div class="stat-label">{{ __('keywords.completed projects') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($settings->skills)
        <!-- Skills Section -->
        <section id="skills" class="band band-colored">
            <div class="band-inner">
                <h2>{{ __('keywords.skills') }}</h2>
                <div class="skills-row">
                    @foreach ($skills as $skill)
                        <div class="skill-chip">
                            <span class="skill-name">{{ $skill->name }}</span>
                            <span class="skill-level">{{ $skill->level }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($settings->projects)
        <!-- Projects Section -->
        <section id="projects" class="band band-light">
            <div class="band-inner">
                <h2>{{ __('keywords.featured projects') }}</h2>
                <div class="projects-grid">
                    @foreach ($projects as $project)
                        <article class="project-card">
                            <img style="border-radius: 10px" class="project-image"
                                src="{{ getProjectImage($project) }}" alt="{{ $project->name }}">
                            <div class="project-header">
                                <h3 class="project-title">{{ $project->title }}</h3>
                            </div>
                            <p class="project-desc">{{ $project->description }}.</p>
                            <div class="project-tags">
                                @foreach ($project->skills as $skill)
                                    <span class="tag">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($settings->contact)
        <!-- Contact Section -->
        <section id="contact" class="band band-colored">
            <div class="band-inner">
                <h2>{{ __('keywords.get in touch') }}</h2>
                <div class="contact-simple">
                    <p>{{ __('keywords.project description') }}</p>
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
