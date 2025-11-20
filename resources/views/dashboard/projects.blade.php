<div id="projects-tab" class="tab-content">
    <div class="row">
        <div>
            <h3>Manage Projects</h3>
            <button type="button" class="btn btn-outline-primary btn-sm float-end mb-3" data-bs-toggle="modal"
                data-bs-target="#userProfileModal">
                <i class="bi bi-file-earmark-plus"></i>
            </button>
        </div>
    </div>
    <!-- Create Project Modal -->
    <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userProfileModalLabel">Add a New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="projectForm" method="POST" action="{{ route('dashboard.projects.store') }}"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            <div class="col-6">
                                <label for="projectName" class="form-label">Project Title</label>
                                <input type="text" class="form-control" id="projectName"
                                    placeholder="e.g., E-commerce Platform Redesign" name="title" required>
                                @error('title')
                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="projectDesc" class="form-label">Description</label>
                                <textarea class="form-control" id="projectDesc" rows="3" name="description"
                                    placeholder="Briefly describe the project, technologies used, and your contribution." required></textarea>
                                @error('description')
                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="projectImage">Project Image</label>
                                <input type="file" id="projectImage" name="projectImage" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($skills as $skill)
                                <div class="col-3">
                                    <div class="form-check">
                                        <input name="project-skill[]" class="form-check-input" type="checkbox"
                                            value="{{ $skill->id }}" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            {{ $skill->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        {{-- Edit Project Button --}}
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#userEditProjectModal-{{ $project->id }}"><i
                                class="bi bi-pencil-square"></i></button>

                        {{-- Edit Project modal --}}
                        <div class="modal fade" id="userEditProjectModal-{{ $project->id }}" tabindex="-1"
                            aria-labelledby="userEditProjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userEditProjectModalLabel">Update
                                            Project
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('dashboard.project.update', ['id' => $project->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" value="{{ auth()->user()->id }}"
                                                    name="user_id">
                                                <div class="col-6">
                                                    <label for="projectName" class="form-label">Project
                                                        Name</label>
                                                    <input type="text" class="form-control" name="title"
                                                        id="projectName" value="{{ $project->title }}">
                                                    @error('title')
                                                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="projectDesc" class="form-label">Description</label>
                                                    <textarea class="form-control" id="projectDesc" rows="3" name="description">{{ $project->description }}</textarea>
                                                    @error('description')
                                                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="projectImage">Project Image</label>
                                                    <input type="file" id="projectImage" name="projectImage"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach ($skills as $skill)
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input name="project-skill[]"
                                                                {{ checkSkill($project, $skill) }}
                                                                class="form-check-input" type="checkbox"
                                                                value="{{ $skill->id }}" id="checkDefault">
                                                            <label class="form-check-label" for="checkDefault">
                                                                {{ $skill->name }}
                                                            </label>
                                                        </div>
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

                        {{-- Edit Project Button --}}
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#userDeleteProjectModal-{{ $project->id }}"><i
                                class="bi bi-file-earmark-x"></i></button>

                        <!-- Delete Project Modal -->
                        <div class="modal fade" id="userDeleteProjectModal-{{ $project->id }}" tabindex="-1"
                            aria-labelledby="userDeleteProjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userDeleteProjectModalLabel">Delete
                                            Project
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('dashboard.project.delete', ['id' => $project->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="text-center text-muted">
                                                <p>Are you sure you want to delete
                                                    <span>"{{ $project->title }}"</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger mt-1">Delete
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted text-center">Nothing to show ...</p>
        @endif
    </div>
</div>
