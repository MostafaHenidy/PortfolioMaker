<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Portfolio Editor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body>

    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0 shadow-lg p-6">
            <div class="text-2xl font-bold mb-10 text-indigo-400">
                Portfolio Builder
            </div>
            <nav class="space-y-3">
                <a href="#"
                    class="nav-item flex items-center p-3 rounded-lg transition duration-200 bg-indigo-600/50 text-white shadow-md"
                    data-tab="profile">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile & Bio
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 rounded-lg transition duration-200 hover:bg-gray-700"
                    data-tab="projects">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h2m4 0v.01M10 11h.01M5 15h.01">
                        </path>
                    </svg>
                    Projects
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 rounded-lg transition duration-200 hover:bg-gray-700"
                    data-tab="skills">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 15a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v6a2 2 0 01-2 2H5z">
                        </path>
                    </svg>
                    Skills & Tools
                </a>
                <a href="#"
                    class="nav-item flex items-center p-3 rounded-lg transition duration-200 hover:bg-gray-700"
                    data-tab="settings">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>
            <div class="mt-12">
                <a href="#"
                    class="w-full inline-block text-center bg-green-500 text-white py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-300">
                    <span class="font-semibold">View Live Portfolio</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-y-auto p-6 lg:p-10">
            <header class="mb-8 flex justify-between items-center">
                <h2 class="text-3xl font-semibold text-gray-900">Dashboard</h2>
                <div class="text-sm text-gray-600">
                    Logged in as: <span class="font-medium text-indigo-600">{{ auth()->user()->email }}</span>
                </div>
            </header>
            @if (session('seccess'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Profile Tab Content -->
            <div id="profile-tab" class="tab-content active bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold mb-6 border-b pb-2">Edit Profile & Bio</h3>
                <form class="space-y-6" action="{{ route('dashboard.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="headline" class="block text-sm font-medium text-gray-700 mb-1">Professional
                            Headline</label>
                        <input type="text" id="headline" name="professional_headline"
                            value="{{ auth()->user()->professional_headline }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">About Me
                            (Bio)</label>
                        <textarea id="bio" rows="6" name="bio"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">{{ auth()->user()->bio }}</textarea>
                    </div>
                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Years of experience</label>
                        <input type="number" id="experience" name="experience" value="{{ auth()->user()->experience }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="projects" class="block text-sm font-medium text-gray-700 mb-1">Number of projects made</label>
                        <input type="number" id="projects" name="projects_made" value="{{ auth()->user()->projects_made }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Avatar Image</label>
                        <input type="file" id="avatar" name="avatar"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                    <button type="submit"
                        class="bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                        Save Profile Changes
                    </button>
                </form>
            </div>

            <!-- Projects Tab Content -->
            <div id="projects-tab" class="tab-content bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold mb-6 border-b pb-2">Manage Projects</h3>
                <button
                    class="mb-6 bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600 transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Add New Project
                </button>

                <!-- Project Item List (Placeholder) -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border">
                        <span class="font-medium">E-Commerce Platform</span>
                        <div>
                            <button class="text-sm text-indigo-600 hover:text-indigo-800 mr-3">Edit</button>
                            <button class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border">
                        <span class="font-medium">Realtime Chat Application</span>
                        <div>
                            <button class="text-sm text-indigo-600 hover:text-indigo-800 mr-3">Edit</button>
                            <button class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Tab Content -->
            <div id="skills-tab" class="tab-content bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold mb-6 border-b pb-2">Manage Skills</h3>
                <button
                    class="mb-6 bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600 transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Add New Skill
                </button>

                <!-- Skill Item List (Placeholder) -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border">
                        <span class="font-medium">Laravel (95%)</span>
                        <div>
                            <button class="text-sm text-indigo-600 hover:text-indigo-800 mr-3">Edit</button>
                            <button class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border">
                        <span class="font-medium">Livewire (90%)</span>
                        <div>
                            <button class="text-sm text-indigo-600 hover:text-indigo-800 mr-3">Edit</button>
                            <button class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab Content -->
            <div id="settings-tab" class="tab-content bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold mb-6 border-b pb-2">Account Settings</h3>
                <p class="text-gray-600">Manage account preferences and security settings.</p>
                <!-- Add setting forms here -->
            </div>

        </div>
    </div>

    <script>
        // Vanilla JS for Tab/Navigation Switching
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = document.querySelectorAll('.nav-item');
            const tabContents = document.querySelectorAll('.tab-content');

            function switchTab(targetTabId) {
                // Deactivate all nav items and hide all content
                navItems.forEach(item => {
                    item.classList.remove('bg-indigo-600/50', 'text-white', 'shadow-md');
                    item.classList.add('hover:bg-gray-700', 'text-gray-300');
                });
                tabContents.forEach(content => {
                    content.classList.remove('active');
                });

                // Activate the selected nav item
                const activeNavItem = document.querySelector(`[data-tab="${targetTabId}"]`);
                if (activeNavItem) {
                    activeNavItem.classList.add('bg-indigo-600/50', 'text-white', 'shadow-md');
                    activeNavItem.classList.remove('hover:bg-gray-700', 'text-gray-300');
                }

                // Show the target content
                const activeContent = document.getElementById(`${targetTabId}-tab`);
                if (activeContent) {
                    activeContent.classList.add('active');
                }
            }

            // Set up click listeners for navigation items
            navItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetTabId = item.getAttribute('data-tab');
                    switchTab(targetTabId);
                });
            });

            // Initialize the default tab
            switchTab('profile');
        });
    </script>
</body>

</html>
