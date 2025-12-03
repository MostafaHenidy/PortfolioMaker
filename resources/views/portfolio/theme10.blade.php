<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 10)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme10.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="theme-10">
    <!-- Slim left nav -->
    <header>
        <nav class="nav-slim">
            <ul class="nav flex-column">
                <div class="logo">{{ $user->name }}</div>
                <li class="nav-item"><a href="#about">About</a></li>
                <li class="nav-item"><a href="#skills">Skills</a></li>
                <li class="nav-item"><a href="#projects">Work</a></li>
                <li class="nav-item"><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="layout-main">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->professional_headline }}</p>
                </div>
                <div class="hero-avatar">
                    <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
                </div>
            </div>
        </section>

        @if ($settings->about)
            <section id="about">
                <h2>About</h2>
                <p>{{ $user->bio }}.</p>
            </section>
        @endif

        @if ($settings->skills)
            <section id="skills">
                <h2>Skills</h2>
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
                <h2>Work</h2>
                <div class="projects-grid">
                    @foreach ($projects as $project)
                        <article class="project-card">
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
                <h2>Contact</h2>
                <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}" method="POST"
                    class="contact-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send</button>
                </form>
            </section>
        @endif
    </main>

    <footer>
        <p>&copy; 2025 {{ $user->name }}. All rights reserved.</p>
    </footer>
</body>

</html>


