<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ auth()->user()->name }} - Portfolio</title>
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --light-bg: #f8f9fa;
            --border-radius: 0.75rem;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--light-bg);
            color: #333;
            line-height: 1.6;
            scroll-behavior: smooth;
        }

        /* Header & Navigation */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        nav a {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            background: var(--gradient-primary);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
            border-radius: 0 0 2rem 2rem;
        }

        .hero-content {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 1.5rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .hero img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid white;
            margin-bottom: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .hero h2 {
            color: whitesmoke;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            /* text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); */
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            opacity: 0.95;
        }

        .btn-primary {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(13, 110, 253, 0.3);
        }

        /* Sections */
        section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        section h2 {
            font-size: 2rem;
            margin-bottom: 3rem;
            text-align: center;
            color: #2c3e50;
            border-bottom: none;
            display: block;
            width: fit-content;
            padding-bottom: 0.5rem;
            margin-inline: auto;
        }

        /* About Section */
        .about-content {
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            line-height: 1.8;
            font-size: 1.05rem;
            color: #555;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            text-align: center;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-weight: 500;
        }

        /* Skills Section */
        .skills-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .skill-item {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }

        .skill-item:hover {
            background: white;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .skill-name {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #2c3e50;
            display: flex;
            justify-content: space-between;
        }

        .skill-percentage {
            color: var(--primary-color);
            font-weight: 700;
        }

        .progress-bar {
            height: 8px;
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 10px;
            transition: width 1.5s ease-out;
            width: 0;
        }

        /* Projects Section */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .project-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .project-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            object-fit: cover;
        }

        .project-content {
            padding: 1.5rem;
        }

        .project-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .project-desc {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            display: inline-block;
            background: #e7f0ff;
            color: var(--primary-color);
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Contact Section */
        .contact-container {
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .contact-container p {
            text-align: center;
            color: #666;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .form-control::placeholder {
            color: #999;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 1.75rem;
            }

            .hero p {
                font-size: 1rem;
            }

            nav ul {
                gap: 1rem;
            }

            section {
                padding: 2rem 1rem;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .projects-grid {
                grid-template-columns: 1fr;
            }

            section h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body @if (LaravelLocalization::getCurrentLocale() == 'ar') dir="rtl" @endif>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">{{ auth()->user()->name }}</div>
            <ul>
                <li><a href="#about">{{ __('keywords.about') }}</a></li>
                <li><a href="#skills">{{ __('keywords.skills') }}</a></li>
                <li><a href="#projects">{{ __('keywords.projects') }}</a></li>
                <li><a href="#contact">{{ __('keywords.contact') }}</a></li>
                <ul>
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode !== LaravelLocalization::getCurrentLocale())
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="{{ getAvatar(auth()->user()) }}" alt="{{ auth()->user()->name }}">
            <h2> {{ __('keywords.selfIntroduction') }} <span>{{ auth()->user()->name }}</span></h2>
            <p>{{ __('keywords.passionate') }} <strong>{{ auth()->user()->professional_headline }}</strong> .</p>
            <a href="#projects" class="btn-primary">{{ __('keywords.view my work') }}</a>
        </div>
    </section>

    <!-- About Section -->
    @if ($settings->about)
        <section id="about">
            <h2 class="text-dark">{{ __('keywords.about') }}</h2>
            <div class="about-content">
                <p>{{ auth()->user()->bio }}.</p>
            </div>
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number">{{ auth()->user()->experience }}+</div>
                    <div class="stat-label">{{ __('keywords.years of experience') }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ auth()->user()->projects_made }}</div>
                    <div class="stat-label">{{ __('keywords.completed projects') }}</div>
                </div>
            </div>
        </section>
    @endif
    <!-- Skills Section -->
    @if ($settings->skills)
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
    <!-- Projects Section -->
    @if ($settings->projects)
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
    <!-- Contact Section -->
    @if ($settings->contact)
        <section id="contact">
            <h2>{{ __('keywords.get in touch') }}</h2>
            <div class="contact-container">
                <p>{{ __('keywords.project description') }}</p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder={{ __('keywords.your name') }} required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder={{ __('keywords.your email') }}
                            required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder={{ __('keywords.your message') }} required></textarea>
                    </div>
                    <button type="submit" class="btn-primary"
                        style="width: 100%;">{{ __('keywords.send message') }}</button>
                </form>
            </div>
        </section>
    @endif
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 {{ auth()->user()->name }}. Built with Laravel, Livewire, and love.</p>
    </footer>
</body>

</html>
