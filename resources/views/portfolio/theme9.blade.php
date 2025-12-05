<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 9)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme9.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="theme-9">
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">{{ $user->name }}</div>
            <ul class="mb-0">
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

    <!-- Hero - cover letter style -->
    <section class="hero hero-letter">
        <div class="hero-text">
            <p class="eyebrow">{{ __('keywords.portfolio') }}</p>
            <h1>{{ __('keywords.selfIntroduction') }} {{ $user->name }}.</h1>
            <p class="intro">
                {{ __('keywords.passionate') }} {{ $user->professional_headline }}
            </p>
        </div>
    </section>

    @if ($settings->about)
        <section id="about">
            <h2>{{ __('keywords.about') }}</h2>
            <p class="body-text">
                {{ $user->bio }}.
            </p>
        </section>
    @endif

    @if ($settings->skills)
        <section id="skills">
            <h2>{{ __('keywords.skills') }}</h2>
            <ul class="skills-list">
                @foreach ($skills as $skill)
                    <li>
                        <span class="skill-name">{{ $skill->name }}</span>
                        <span class="skill-level">{{ $skill->level }}%</span>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    @if ($settings->projects)
        <section id="projects">
            <h2>{{ __('keywords.featured projects') }}</h2>
            <div class="projects-list">
                @foreach ($projects as $project)
                    <article class="project-row">
                        <div class="project-main">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->description }}.</p>
                            <div class="tags">
                                @foreach ($project->skills as $skill)
                                    <span class="tag">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="project-meta">
                            <img style="border-radius: 10px" class="project-image"
                                src="{{ getProjectImage($project) }}" alt="{{ $project->name }}">
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->contact)
        <section id="contact">
            <h2>{{ __('keywords.get in touch') }}</h2>
            <p class="body-text">
                {{ __('keywords.project description') }}
            </p>
            <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}" method="POST"
                class="contact-form-simple">
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
        </section>
    @endif

    <footer>
        <p>&copy; 2025 {{ $user->name }}. All rights reserved.</p>
    </footer>
</body>

</html>
