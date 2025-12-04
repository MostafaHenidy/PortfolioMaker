@extends('dashboard.dashboard')
@section('projects-active', 'active')
@section('content')
    <div id="projects-tab" class="tab-content">
        <div class="row">
            <div>
                <h3>{{ __('keywords.manage projects') }}</h3>
                <button type="button" class="btn btn-outline-primary btn-sm float-end mb-3" data-bs-toggle="modal"
                    data-bs-target="#userProfileModal">
                    <i class="bi bi-file-earmark-plus"></i>
                    {{ __('keywords.create project') }}
                </button>
            </div>
        </div>
        <!-- Create Project Modal -->
        <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userProfileModalLabel">{{ __('keywords.add a new project') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="projectForm" method="POST" action="{{ route('dashboard.projects.store') }}"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                <div class="col-6">
                                    <label for="projectName" class="form-label">{{ __('keywords.project title') }}</label>
                                    <input type="text" class="form-control" id="projectName"
                                        placeholder="{{ __('keywords.projectName') }}" name="title" required>
                                    @error('title')
                                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="projectDesc" class="form-label">{{ __('keywords.description') }}</label>
                                    <textarea class="form-control" id="projectDesc" rows="3" name="description"
                                        placeholder="{{ __('keywords.projectDescription') }}" required></textarea>
                                    @error('description')
                                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="projectImage">{{ __('keywords.project image') }}</label>
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
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('keywords.close') }}</button>
                            <button type="submit" class="btn btn-primary mt-1">{{ __('keywords.save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="item-list">
            @if (count($projects) > 0)
                @foreach ($projects as $project)
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="row g-0">

                            {{-- Project Image --}}
                            <div class="col-md-4">
                                @if (getProjectImage($project))
                                    <img src="{{ getProjectImage($project) }}"
                                        class="img-fluid rounded-start h-100 object-fit-cover" style="max-height: 220px;">
                                @else
                                    <div class="d-flex justify-content-center align-items-center bg-light h-100"
                                        style="min-height: 180px;">
                                        <i class="bi bi-image text-muted display-4"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Project Details --}}
                            <div class="col-md-8">
                                <div class="card-body">

                                    <h5 class="card-title fw-bold">{{ $project->title }}</h5>

                                    <p class="card-text text-muted" style="max-height: 60px; overflow: hidden;">
                                        {{ Str::limit($project->description, 120) }}
                                    </p>

                                    {{-- Skills as tags --}}
                                    <div class="mb-2">
                                        @foreach ($project->skills as $skill)
                                            <span class="badge bg-primary me-1">{{ $skill->name }}</span>
                                        @endforeach
                                    </div>

                                    <p class="card-text">
                                        <small class="text-muted">
                                            {{ $project->created_at->diffForHumans() }}
                                        </small>
                                    </p>

                                    {{-- Buttons --}}
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#userEditProjectModal-{{ $project->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                            {{ __('keywords.update project') }}
                                        </button>

                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#userDeleteProjectModal-{{ $project->id }}">
                                            <i class="bi bi-file-earmark-x"></i>
                                            {{ __('keywords.delete project') }}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Edit Project modal --}}
                    <div class="modal fade" id="userEditProjectModal-{{ $project->id }}" tabindex="-1"
                        aria-labelledby="userEditProjectModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userEditProjectModalLabel">
                                        {{ __('keywords.update project') }}
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
                                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                            <div class="col-6">
                                                <label for="projectName"
                                                    class="form-label">{{ __('keywords.project title') }}</label>
                                                <input type="text" class="form-control" name="title"
                                                    id="projectName" value="{{ $project->title }}"
                                                    placeholder="{{ __('keywords.projectName') }}">
                                                @error('title')
                                                    <p class="text-sm text-danger mt-1">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="projectDesc"
                                                    class="form-label">{{ __('keywords.description') }}</label>
                                                <textarea class="form-control" id="projectDesc" rows="3" name="description"
                                                    placeholder="{{ __('keywords.projectDescription') }}">{{ $project->description }}</textarea>
                                                @error('description')
                                                    <p class="text-sm text-danger mt-1">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="projectImage">{{ __('keywords.project image') }}
                                                </label>
                                                <input type="file" id="projectImage" name="projectImage"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach ($skills as $skill)
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input name="project-skill[]" {{ checkSkill($project, $skill) }}
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
                                            data-bs-dismiss="modal">{{ __('keywords.close') }}</button>
                                        <button type="submit" class="btn btn-primary mt-1">{{ __('keywords.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Project Modal -->
                    <div class="modal fade" id="userDeleteProjectModal-{{ $project->id }}" tabindex="-1"
                        aria-labelledby="userDeleteProjectModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userDeleteProjectModalLabel">
                                        {{ __('keywords.delete project') }}

                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form
                                    action="{{ route('dashboard.project.delete', ['id' => $project->id, 'user_id' => auth()->user()->name]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <div class="text-center text-muted">
                                            <p>{{ __('keywords.delete confirmation') }}
                                                <span>"{{ $project->title }}"</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger mt-1">{{ __('keywords.delete') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted text-center">{{ __('keywords.nothing to show') }} ...</p>
            @endif
        </div>
    </div>
@endsection
