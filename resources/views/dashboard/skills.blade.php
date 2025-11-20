<div id="skills-tab" class="tab-content">
    <div class="row">
        <div>
            <h3>Manage Skills</h3>
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
                    <h5 class="modal-title" id="userSkillsModalLabel">Add a New Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.skills.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                <label for="projectName" class="form-label">Skill Name</label>
                                <input type="text" class="form-control" name="name" id="projectName"
                                    placeholder="e.g.,HTML" required>
                                @error('name')
                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="projectDesc" class="form-label">Level</label>
                                <input type="number" class="form-control" name="level" placeholder="80"
                                    id="projectDesc" required />
                                @error('level')
                                    <p class="text-sm text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mt-1">Save</button>
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
                        {{-- Edit Skill Button --}}
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#userEditSkillModal--{{ $skill->id }}"><i
                                class="bi bi-pencil-square"></i></button>
                        <!-- Edit Skill Modal -->
                        <div class="modal fade" id="userEditSkillModal--{{ $skill->id }}" tabindex="-1"
                            aria-labelledby="userEditSkillModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userEditSkillModalLabel">Update Skill
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('dashboard.skills.update', ['id' => $skill->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                <div class="col-6">
                                                    <label for="projectName" class="form-label">Skill
                                                        Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="projectName" value="{{ $skill->name }}" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="projectDesc" class="form-label">Level</label>
                                                    <input type="number" class="form-control" name="level"
                                                        value="{{ $skill->level }}" id="projectDesc" required />
                                                </div>
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
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#userDeleteSkillModal-{{ $skill->id }}"><i
                                class="bi bi-file-earmark-x"></i></button>
                        <!-- Delete skill Modal -->
                        <div class="modal fade" id="userDeleteSkillModal-{{ $skill->id }}" tabindex="-1"
                            aria-labelledby="userDeleteSkillModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userDeleteSkillModalLabel">Delete
                                            skill
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('dashboard.skills.delete', ['id' => $skill->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <p>Are you sure you want to delete
                                                    <span>"{{ $skill->name }}"</span>
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
