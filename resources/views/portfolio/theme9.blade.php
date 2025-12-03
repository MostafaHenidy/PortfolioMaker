<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio (Theme 9)</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme1.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/css/themes/theme9.css') }}">
</head>

<body class="theme-9">
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">{{ $user->name }}</div>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Work</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero - cover letter style -->
    <section class="hero hero-letter">
        <div class="hero-text">
            <p class="eyebrow">Portfolio</p>
            <h1>Hello, I’m {{ $user->name }}.</h1>
            <p class="intro">
                I’m a {{ $user->professional_headline }} delivering thoughtful digital experiences and reliable
                solutions.
            </p>
        </div>
    </section>

    @if ($settings->about)
        <section id="about">
            <h2>About</h2>
            <p class="body-text">
                {{ $user->bio }}.
            </p>
        </section>
    @endif

    @if ($settings->skills)
        <section id="skills">
            <h2>Skills</h2>
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
            <h2>Selected Work</h2>
            <div class="projects-list">
                @foreach ($projects as $project)
                    <article class="project-row">
                        <div class="project-main">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->description }}.</p>
                        </div>
                        <div class="project-meta">
                            <div class="tags">
                                @foreach ($project->skills as $skill)
                                    <span class="tag">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if ($settings->contact)
        <section id="contact">
            <h2>Contact</h2>
            <p class="body-text">
                If you’d like to discuss a project or opportunity, feel free to reach out using the form below.
            </p>
            <form action="{{ route('dashboard.contact.sendMessage', ['userName' => $user->name]) }}" method="POST"
                class="contact-form-simple">
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
                <button type="submit" class="btn-primary">Send Message</button>
            </form>
        </section>
    @endif

    <footer>
        <p>&copy; 2025 {{ $user->name }}. All rights reserved.</p>
    </footer>
</body>

</html>


