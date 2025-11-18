<div>
    <div>
        <div class="card-body p-4 p-md-5" id="uploadSection">
            <h3 class="card-title mb-4 text-center fw-bold">
                <i class="fas fa-cloud-upload-alt text-primary"></i> Upload Resume
            </h3>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="alert alert-success mb-3" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session()->has('error'))
                <div class="alert alert-danger mb-3" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            @if (auth()->user())

                <!-- Upload Form -->
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <!-- File Input -->
                    <div class="mb-4">
                        <div class="upload-input-wrapper">
                            <input type="file" wire:model="pdfFile" id="pdfInput"
                                class="form-control form-control-lg" accept="application/pdf">
                        </div>
                    </div>

                    <!-- File Name Display -->
                    @if ($pdfFile)
                        {{-- @dump($this->pdfFile)     --}}
                        <div class="alert alert-info mb-3" role="alert">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ $pdfFile->getClientOriginalName() }}</span>
                            <small class="d-block text-muted">Size: {{ number_format($pdfFile->getSize() / 1024, 2) }}
                                KB</small>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @error('pdfFile')
                        <div class="alert alert-danger mb-3" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror

                    <!-- Upload Button -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3 fw-semibold"
                        @if (!$pdfFile) disabled @endif wire:loading.attr="disabled"
                        wire:target="upload">
                        <span wire:loading.remove wire:target="upload">
                            <i class="fas fa-arrow-up"></i> Upload PDF
                        </span>
                        <span wire:loading wire:target="upload">
                            <i class="fas fa-spinner fa-spin"></i> Uploading...
                        </span>
                    </button>
                </form>

                <!-- Loading Spinner for File Selection -->
                <div wire:loading wire:target="pdfFile" class="text-center mb-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2 small">Preparing file...</p>
                </div>

                <!-- Loading Spinner for Upload -->
                <div wire:loading wire:target="upload" class="text-center mb-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2 small">Processing your PDF...</p>
                </div>
            @else
                <div class="text-center">
                    <h5>Please Sign in to start uploading</h5>
                </div>
            @endif
        </div>
        @if ($qrCode)
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div>
                    <h5 class="d-block">Your resume QR code</h5>
                </div>
                <div class="mb-3">
                    {!! $qrCode !!}
                </div>
            </div>
        @endif
    </div>
</div>
