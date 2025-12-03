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
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero as card deck intro -->
    <section class="hero hero-tiles">
        <div class="tiles-grid">
            <div class="tile main">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->professional_headline }}</p>
            </div>
            <div class="tile">
                <span class="label">Experience</span>
                <span class="value">{{ $user->experience }}+ yrs</span>
            </div>
            <div class="tile">
                <span class="label">Projects</span>
                <span class="value">{{ $user->projects_made }}</span>
            </div>
            <div class="tile avatar-tile">
                <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
            </div>
        </div>
    </section>

    @if ($settings->about)
        <section id="about">
            <h2>About</h2>
            <div class="about-card">
                <p>{{ $user->bio }}.</p>
            </div>
        </section>
    @endif

    @if ($settings->skills)
        <section id="skills">
            <h2>Skills</h2>
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
            <h2>Projects</h2>
            <div class="projects-masonry">
                @foreach ($projects as $project)
                    <article class="project-tile">
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
            <div class="contact-row">
                <div class="contact-text">
                    <p>Let’s collaborate on your next idea. Drop me a message and I’ll respond as soon as I can.</p>
                </div>
                <div class="contact-form-card">
                    <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}"
                        method="POST">
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
                </div>
            </div>
        </section>
    @endif

    <footer>
        <p>&copy; 2025 {{ $user->name }}. All rights reserved.</p>
    </footer>
</body>

</html>


