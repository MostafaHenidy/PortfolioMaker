<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 8)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme8.css') }}">
</head>

<body class="theme-8">
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">{{ $user->name }}</div>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Timeline</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero -->
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
            <div class="about-timeline-card">
                <p>{{ $user->bio }}.</p>
            </div>
        </section>
    @endif

    @if ($settings->skills)
        <section id="skills">
            <h2>Skills</h2>
            <div class="skills-chips">
                @foreach ($skills as $skill)
                    <span class="chip">{{ $skill->name }} • {{ $skill->level }}%</span>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->projects)
        <section id="projects">
            <h2>Project Timeline</h2>
            <div class="timeline">
                @foreach ($projects as $project)
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->description }}.</p>
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
        <section id="contact">
            <h2>Contact</h2>
            <div class="contact-inline">
                <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}"
                    method="POST">
                    @csrf
                    <div class="form-row">
                        <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send</button>
                </form>
            </div>
        </section>
    @endif

    <footer>
        <p>&copy; 2025 {{ $user->name }}. Portfolio Timeline.</p>
    </footer>
</body>

</html>


