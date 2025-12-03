<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 2)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="theme-2">
    <!-- Header -->
    <header>
        <nav>
            <ul class="nav flex-column">
                <div class="logo">{{ $user->name }}</div>
                <li class="nav-item"><a href="#about">About</a></li>
                <li class="nav-item"><a href="#skills">Skills</a></li>
                <li class="nav-item"><a href="#projects">Projects</a></li>
                <li class="nav-item"><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="{{ getAvatar($user) }}" alt="{{ $user->name }}">
            <h1>Hello, I'm <span>{{ $user->name }}</span></h1>
            <p>A passionate <strong>{{ $user->professional_headline }}</strong> .</p>
            <a href="#projects" class="btn-primary">View My Work</a>
        </div>
    </section>

    <!-- About Section -->
    @if ($settings->about)
        <section id="about">
            <h2>About Me</h2>
            <div class="about-content">
                <p>{{ $user->bio }}.</p>
            </div>
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number">{{ $user->experience }}+</div>
                    <div class="stat-label">Years of Experience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $user->projects_made }}</div>
                    <div class="stat-label">Completed Projects</div>
                </div>
            </div>
        </section>
    @endif

    @if ($settings->skills)
        <!-- Skills Section -->
        <section id="skills">
            <h2>Skills & Expertise</h2>
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
            <h2>Featured Projects</h2>
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
            <h2>Get In Touch</h2>
            <div class="contact-container">
                <p>Have a project in mind or just want to say hello? Send me an email and I'll get back to you as soon
                    as
                    possible.</p>
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
                    <button type="submit" class="btn-primary" style="width: 100%;">Send Message</button>
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


