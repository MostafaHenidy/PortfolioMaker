<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Portfolio Builder</title>
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --danger-color: #dc3545;
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
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 2rem 1.5rem;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all 0.3s ease;
            color: #ecf0f1;
            text-decoration: none;
            border: none;
            background: none;
            font-size: 1rem;
            font-family: inherit;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
        }

        .sidebar-footer {
            margin-top: auto;
            margin-bottom: 10px;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-view-portfolio {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-view-portfolio:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(13, 110, 253, 0.3);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            overflow-y: auto;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h2 {
            font-size: 2rem;
            color: #2c3e50;
        }

        .user-info {
            font-size: 0.9rem;
            color: #666;
        }

        .user-info span {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tab-content h3 {
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
            color: #2c3e50;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
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

        input[type="file"].form-control {
            padding: 0.5rem;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-family: inherit;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(13, 110, 253, 0.3);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .btn-success:hover {
            background: #157347;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .btn-edit {
            color: var(--primary-color);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            margin-right: 1rem;
        }

        .btn-delete {
            color: var(--danger-color);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        /* List Items */
        .item-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: var(--border-radius);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .list-item:hover {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .list-item-name {
            font-weight: 500;
            color: #2c3e50;
        }

        .list-item-actions {
            display: flex;
            gap: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1.5rem;
                display: none;
            }

            .sidebar.active {
                display: block;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
            }

            .header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</head>

<body>
    <div>
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                📊 Portfolio Builder
            </div>
            <nav class="sidebar-nav">
                <button class="nav-item active" data-tab="profile">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile & Bio
                </button>
                <button class="nav-item" data-tab="projects">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h2m4 0v.01M10 11h.01M5 15h.01">
                        </path>
                    </svg>
                    Projects
                </button>
                <button class="nav-item" data-tab="skills">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 15a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v6a2 2 0 01-2 2H5z">
                        </path>
                    </svg>
                    Skills & Tools
                </button>
                <button class="nav-item" data-tab="settings">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </button>
            </nav>
            <div class="sidebar-footer ">
                <a href="{{ route('dashboard.portfolio') }}" class="btn-view-portfolio" style="text-decoration: none">
                    View Live Portfolio</a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h2>Dashboard</h2>
                <div class="user-info">Logged in as: <span>{{ auth()->user()->email }}</span></div>
            </div>

            <!-- Profile Tab -->
            <div id="profile-tab" class="tab-content active">
                <h3>Edit Profile & Bio</h3>
                <form class="form-group" method="POST" action="{{ route('dashboard.update') }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Jane Doe" name="name"
                            value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="headline">Professional Headline</label>
                        <input type="text" id="headline" class="form-control"
                            placeholder="e.g., Full Stack Developer" name="professional_headline"
                            value="{{ auth()->user()->professional_headline }}">
                    </div>
                    <div class="form-group">
                        <label for="bio">About Me (Bio)</label>
                        <textarea id="bio" name="bio" class="form-control" placeholder="Tell us about yourself...">{{ auth()->user()->bio }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="experience">Years of Experience</label>
                        <input type="number" name="experience" id="experience" class="form-control"
                            value="{{ auth()->user()->experience }}">
                    </div>
                    <div class="form-group">
                        <label for="projects">Number of Projects Made</label>
                        <input type="number" id="projects" name="projects_made" class="form-control"
                            value="{{ auth()->user()->projects_made }}">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar Image</label>
                        <input type="file" id="avatar" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Profile Changes</button>
                </form>
            </div>

            <!-- Projects Tab -->
            <div id="projects-tab" class="tab-content">
                <h3>Manage Projects</h3>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#userProfileModal">
                    Add Projects
                </button>
                <!-- Modal -->
                <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="userProfileModalLabel">Add a New Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="projectForm" method="POST" action="{{ route('dashboard.projects.store') }}">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="projectName" class="form-label">Project Title</label>
                                        <input type="text" class="form-control" id="projectName"
                                            placeholder="e.g., E-commerce Platform Redesign" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="projectDesc" class="form-label">Description</label>
                                        <textarea class="form-control" id="projectDesc" rows="3" name="description"
                                            placeholder="Briefly describe the project, technologies used, and your contribution." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        @foreach ($skills as $skill)
                                            <div class="form-check">
                                                <input name="project-skill[]" class="form-check-input"
                                                    type="checkbox" value="{{ $skill->id }}" id="checkDefault">
                                                <label class="form-check-label" for="checkDefault">
                                                    {{ $skill->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary mt-1">Save Project</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="item-list">
                    @if (count($projects) > 0)
                        @foreach ($projects as $project)
                            <div class="list-item">
                                <span class="list-item-name">{{ $project->title }}</span>
                                <div class="list-item-actions">
                                    <button type="button" class="btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#userEditProjectModal-{{ $project->id }}">Edit</button>
                                    <div class="modal fade" id="userEditProjectModal-{{ $project->id }}"
                                        tabindex="-1" aria-labelledby="userEditProjectModalLabel"
                                        aria-hidden="true">
                                        <div
                                            class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="userEditProjectModalLabel">Update
                                                        Project
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ route('dashboard.project.update', ['id' => $project->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="projectName" class="form-label">Project
                                                                Name</label>
                                                            <input type="text" class="form-control" name="title"
                                                                id="projectName" value="{{ $project->title }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="projectDesc"
                                                                class="form-label">Description</label>
                                                            <textarea class="form-control" id="projectDesc" rows="3" name="description">{{ $project->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            @foreach ($skills as $skill)
                                                                <div class="form-check">
                                                                    <input name="project-skill[]"
                                                                        @if (checkSkill($project, $skill)) ? checked @endif
                                                                        class="form-check-input" type="checkbox"
                                                                        value="{{ $skill->id }}"
                                                                        id="checkDefault">
                                                                    <label class="form-check-label"
                                                                        for="checkDefault">
                                                                        {{ $skill->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary mt-1">Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-delete">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Skills Tab -->
            <div id="skills-tab" class="tab-content">
                <h3>Manage Skills</h3>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#userSkillsModal">
                    Add Skills
                </button>
                <!-- Modal -->
                <div class="modal fade" id="userSkillsModal" tabindex="-1" aria-labelledby="userSkillsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userSkillsModalLabel">Add a New Skill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('dashboard.skills.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="projectName" class="form-label">Skill Name</label>
                                        <input type="text" class="form-control" name="name" id="projectName"
                                            placeholder="e.g.,HTML" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="projectDesc" class="form-label">Level</label>
                                        <input type="number" class="form-control" name="level" placeholder="80"
                                            id="projectDesc" required />
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary mt-1">Save skill</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="item-list">
                    @if (count($skills) > 0)
                        @foreach ($skills as $skill)
                            <div class="list-item">
                                <span class="list-item-name">{{ $skill->name }} <span
                                        class="text-warning">({{ $skill->level }})</span></span>
                                <div class="list-item-actions">
                                    <button type="button" class="btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#userEditSkillModal--{{ $skill->id }}">Edit</button>
                                    <div class="modal fade" id="userEditSkillModal--{{ $skill->id }}"
                                        tabindex="-1" aria-labelledby="userEditSkillModalLabel" aria-hidden="true">
                                        <div
                                            class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="userEditSkillModalLabel">Update Skill
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ route('dashboard.skills.update', ['id' => $skill->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="projectName" class="form-label">Skill
                                                                Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                id="projectName" value="{{ $skill->name }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="projectDesc" class="form-label">Level</label>
                                                            <input type="number" class="form-control" name="level"
                                                                value="{{ $skill->level }}" id="projectDesc"
                                                                required />
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary mt-1">Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-delete">Delete</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Noting to show ...</p>
                    @endif
                </div>
            </div>

            <!-- Settings Tab -->
            <div id="settings-tab" class="tab-content">
                <h3>Account Settings</h3>
                <p style="color: #666; margin-bottom: 1.5rem;">Manage account preferences and security settings.</p>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control" value="jane@example.com">
                </div>
                <div class="form-group">
                    <label for="password">Change Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter new password">
                </div>
                <button class="btn btn-primary">Update Settings</button>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        const navItems = document.querySelectorAll('.nav-item');
        const tabContents = document.querySelectorAll('.tab-content');

        navItems.forEach(item => {
            item.addEventListener('click', () => {
                const tabName = item.getAttribute('data-tab');

                // Remove active class from all items and contents
                navItems.forEach(el => el.classList.remove('active'));
                tabContents.forEach(el => el.classList.remove('active'));

                // Add active class to clicked item and corresponding content
                item.classList.add('active');
                document.getElementById(`${tabName}-tab`).classList.add('active');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
