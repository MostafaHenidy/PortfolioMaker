@extends('dashboard.dashboard')
@section('skills-active', 'active')
@section('content')
    <div id="skills-tab" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">{{ __('keywords.manage skills') }}</h3>
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#userSkillsModal">
                <i class="bi bi-file-earmark-plus me-1"></i>
                {{ __('keywords.add a new skill') }}
            </button>
        </div>

        <div class="row g-4">
            {{-- Browse / copy skills from other users --}}
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('keywords.all skills') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse ($allSkills as $skill)
                                @php
                                    $alreadyCopied = auth()->user()->skills->where('name', $skill->name)->isNotEmpty();
                                @endphp

                                @if ($skill->user_id != auth()->id() && !$alreadyCopied)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold">{{ $skill->name }}</div>
                                            <p class="text-muted mb-0">{{ __('keywords.level') }}:
                                                <span class="text-warning fw-bold">{{ $skill->level }}%</span>
                                            </p>
                                            <small class="fw-semibold">
                                                {{ __('keywords.created by') }} <span>{{ $skill->user->name }}</span>
                                            </small>
                                        </div>
                                        <div>
                                            <form action="{{ route('dashboard.skill.copy', ['id' => $skill->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-copy me-1"></i>
                                                    {{ __('keywords.copy') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p class="text-muted text-center py-3 mb-0">
                                    {{ __('keywords.nothing to show') }} ...
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- User's own skills --}}
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('keywords.your skills') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        @if ($userSkills->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($userSkills as $skill)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold">{{ $skill->name }}</div>
                                            <small class="text-muted">{{ __('keywords.level') }}:
                                                <span class="text-warning fw-bold">{{ $skill->level }}%</span>
                                            </small>
                                        </div>

                                        <div class="d-flex gap-2">
                                            {{-- Edit Skill --}}
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#userEditSkillModal--{{ $skill->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            {{-- Delete Skill --}}
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#userDeleteSkillModal-{{ $skill->id }}">
                                                <i class="bi bi-file-earmark-x"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Edit Skill Modal -->
                                    <div class="modal fade" id="userEditSkillModal--{{ $skill->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('keywords.update skill') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="{{ __('keywords.close') }}"></button>
                                                </div>

                                                <form action="{{ route('dashboard.skills.update', ['id' => $skill->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <input type="hidden" value="{{ auth()->user()->id }}"
                                                                name="user_id">

                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label">{{ __('keywords.skill name') }}</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    placeholder="{{ __('keywords.skillName') }}"
                                                                    value="{{ $skill->name }}" required>
                                                                @error('name')
                                                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label">{{ __('keywords.level') }}</label>
                                                                <input type="range" class="form-range skill-range"
                                                                    name="level" min="0" max="100"
                                                                    value="{{ $skill->level }}" required>
                                                                <output class="skill-range-output"
                                                                    aria-hidden="true">{{ $skill->level }}</output>
                                                                @error('level')
                                                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('keywords.close') }}</button>

                                                        <button type="submit" class="btn btn-primary mt-1">
                                                            {{ __('keywords.save') }}
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="userDeleteSkillModal-{{ $skill->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('keywords.delete skill') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="{{ __('keywords.close') }}"></button>
                                                </div>

                                                <form
                                                    action="{{ route('dashboard.skills.delete', ['id' => $skill->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-body">
                                                        <p>{{ __('keywords.delete confirmation skill') }}
                                                            <span>"{{ $skill->name }}"</span>
                                                        </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('keywords.close') }}
                                                        </button>

                                                        <button type="submit" class="btn btn-danger mt-1">
                                                            {{ __('keywords.delete') }}
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center py-3 mb-0">
                                {{ __('keywords.nothing to show') }} ...
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Skill Modal -->
        <div class="modal fade" id="userSkillsModal" tabindex="-1" aria-labelledby="userSkillsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userSkillsModalLabel">{{ __('keywords.add a new skill') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="{{ __('keywords.close') }}"></button>
                    </div>

                    <form action="{{ route('dashboard.skills.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                    <label class="form-label">{{ __('keywords.skill name') }}</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="{{ __('keywords.skillName') }}" required>
                                    @error('name')
                                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">{{ __('keywords.level') }}</label>
                                    <input type="range" class="form-range skill-range" name="level" min="0"
                                        max="100" required>
                                    <output class="skill-range-output" aria-hidden="true"></output>
                                    @error('level')
                                        <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('keywords.close') }}
                            </button>
                            <button type="submit" class="btn btn-primary mt-1">
                                {{ __('keywords.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.skill-range').forEach(slider => {
            const output = slider.nextElementSibling; // assumes output is right after input
            output.textContent = slider.value;

            slider.addEventListener('input', function() {
                output.textContent = this.value;
            });
        });
    </script>
@endpush
