<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme10.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>

<body class="{{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : '' }} theme-10">
    <!-- Slim left nav -->
    <header>
        <nav class="nav-slim">
            <ul class="nav flex-column">
                <div class="logo">{{ $user->name }}</div>
                <li class="nav-item"><a href="#about"><i
                            class="bi bi-file-person-fill"></i><span>{{ __('keywords.about') }}</span></a></li>
                <li class="nav-item"><a href="#skills"><i
                            class="bi bi-person-gear"></i><span>{{ __('keywords.skills') }}</span></a>
                </li>
                <li class="nav-item"><a href="#projects"><i
                            class="bi bi-clipboard2-check-fill"></i><span>{{ __('keywords.projects') }}</span></a></li>
                <li class="nav-item"><a href="#contact"><i
                            class="bi bi-chat-left-text-fill"></i><span>{{ __('keywords.contact') }}</span></a></li>
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if (LaravelLocalization::getCurrentLocale() !== $localeCode)
                        <li class="nav-item">
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <i class="bi bi-globe"></i>
                                <span>{{ $properties['native'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </header>

    <main class="layout-main">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>{{ __('keywords.selfIntroduction') }} {{ $user->name }}</h1>
                    <p>{{ __('keywords.passionate') }} {{ $user->professional_headline }}</p>
                </div>
                <div class="hero-avatar">
                    <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
                </div>
            </div>
        </section>

        @if ($settings->about)
            <section id="about">
                <h2>{{ __('keywords.about') }}</h2>
                <p>{{ $user->bio }}.</p>
            </section>
        @endif

        @if ($settings->skills)
            <section id="skills">
                <h2>{{ __('keywords.skills') }}</h2>
                <div class="skills-columns">
                    @foreach ($skills as $skill)
                        <div class="skill-line">
                            <span>{{ $skill->name }}</span>
                            <span>{{ $skill->level }}%</span>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($settings->projects)
            <section id="projects">
                <h2>{{ __('keywords.featured projects') }}</h2>
                <div class="projects-grid">
                    @foreach ($projects as $project)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>

                            <div class="timeline-content d-flex justify-content-between align-items-start gap-3">

                                <div class="project-text">
                                    <h3>{{ $project->title }}</h3>
                                    <p>{{ $project->description }}.</p>

                                    <div class="project-tags">
                                        @foreach ($project->skills as $skill)
                                            <span class="tag">{{ $skill->name }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="project-image-wrapper">
                                    <img style="border-radius: 10px" class="project-image"
                                        src="{{ getProjectImage($project) }}" alt="{{ $project->name }}">
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($settings->contact)
            <section id="contact">
                <h2>{{ __('keywords.get in touch') }}</h2>
                <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}" method="POST"
                    class="contact-form">
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
    </main>

    <footer>
        <p>&copy; 2025 {{ $user->name }}. All rights reserved.</p>
    </footer>
</body>

</html>
