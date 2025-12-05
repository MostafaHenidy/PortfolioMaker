<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 5)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme5.css') }}">
</head>

<body class="{{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : '' }} theme-5">
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
            <h1>{{ __('keywords.selfIntroduction') }} <span>{{ $user->name }}</span></h1>
            <p>{{ __('keywords.passionate') }} <strong>{{ $user->professional_headline }}</strong> .</p>
            <a href="#projects" class="btn-primary">{{ __('keywords.view my work') }}</a>
        </div>
    </section>

    <!-- About Section -->
    @if ($settings->about)
        <section id="about">
            <h2>{{ __('keywords.about') }}</h2>
            <div class="about-content">
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
        </section>
    @endif

    @if ($settings->skills)
        <!-- Skills Section -->
        <section id="skills">
            <h2>{{ __('keywords.skills') }}</h2>
            <div class="skills-container">
                @foreach ($skills as $skill)
                    <div class="skill-item">
                        <div class="skill-name">
                            <span>{{ $skill->name }}</span>
                            <span class="skill-percentage">{{ $skill->level }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $skill->level }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->projects)
        <!-- Projects Section -->
        <section id="projects">
            <h2>{{ __('keywords.featured projects') }}</h2>
            <div class="projects-grid">
                @foreach ($projects as $project)
                    <div class="project-card">
                        <img class="project-image" src="{{ getProjectImage($project) }}" alt="{{ $project->name }}">
                        <div class="project-content">
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <p class="project-desc">{{ $project->description }}.</p>
                            <div class="project-tags">
                                @foreach ($project->skills as $skill)
                                    <span class="tag">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->contact)
        <!-- Contact Section -->
        <section id="contact">
            <h2>{{ __('keywords.get in touch') }}</h2>
            <div class="contact-container">
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
                    <button type="submit" class="btn-primary"
                        style="width: 100%;">{{ __('keywords.send message') }}</button>
                </form>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 {{ $user->name }}. Built with Laravel, Livewire, and love.</p>
    </footer>
</body>

</html>
