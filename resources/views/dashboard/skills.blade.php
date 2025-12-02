<div id="skills-tab" class="tab-content">
    <div class="row">
        <div>
            <h3>{{ __('keywords.manage skills') }}</h3>
            <button type="button" class="btn btn-outline-primary btn-sm mb-3 float-end" data-bs-toggle="modal"
                data-bs-target="#userSkillsModal">
                <i class="bi bi-file-earmark-plus"></i>
            </button>
        </div>
    </div>

    <!-- Create Skill Modal -->
    <div class="modal fade" id="userSkillsModal" tabindex="-1" aria-labelledby="userSkillsModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" name="name" placeholder="e.g., HTML"
                                    required>
                                @error('name')
                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label class="form-label">{{ __('keywords.level') }}</label>
                                <input type="number" class="form-control" name="level" placeholder="80" required>
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

    <div class="item-list">
        @if (count($skills) > 0)
            @foreach ($skills as $skill)
                <div class="list-item">
                    <span class="list-item-name">
                        {{ $skill->name }} <span class="text-warning">({{ $skill->level }})</span>
                    </span>

                    <div class="list-item-actions">

                        {{-- Edit Skill --}}
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#userEditSkillModal--{{ $skill->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>

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
                                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

                                                <div class="col-6">
                                                    <label class="form-label">{{ __('keywords.skill name') }}</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $skill->name }}" required>
                                                </div>

                                                <div class="col-6">
                                                    <label class="form-label">{{ __('keywords.level') }}</label>
                                                    <input type="number" class="form-control" name="level"
                                                        value="{{ $skill->level }}" required>
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

                        {{-- Delete Skill --}}
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#userDeleteSkillModal-{{ $skill->id }}">
                            <i class="bi bi-file-earmark-x"></i>
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="userDeleteSkillModal-{{ $skill->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('keywords.delete skill') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="{{ __('keywords.close') }}"></button>
                                    </div>

                                    <form action="{{ route('dashboard.skills.delete', ['id' => $skill->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-body">
                                            <p>{{ __('keywords.delete confirmation skill') }}
                                                <span>"{{ $skill->name }}"</span>
                                            </p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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

                    </div> <!-- actions -->
                </div> <!-- list-item -->
            @endforeach
        @else
            <p class="text-muted text-center">{{ __('keywords.nothing to show') }} ...</p>
        @endif
    </div>
</div>
