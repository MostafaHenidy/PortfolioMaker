<?php

namespace App\Livewire;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UploadDocument extends Component
{
    use WithFileUploads;

    public $pdfFile;
    public $uploadedFile;
    public $document;
    public $url;
    protected $rules = [
        'pdfFile' => 'required|file|mimes:pdf|max:10240',
    ];

    public function save()
    {
        $this->validate();

        $previousDocuments = Document::where('user_id', Auth::user()->id)->get();
        if ($previousDocuments->isNotEmpty()) {
            foreach ($previousDocuments as $doc) {
                Storage::disk('public')->delete($doc->file_path);
            }
        }

        $fileName = $this->pdfFile->getClientOriginalName();
        $path = $this->pdfFile->storeAs('pdfs', $fileName, 'public');


        if ($this->pdfFile) {
            $this->pdfFile->delete();
        }

        $this->document = Document::create([
            'uuid' => Str::uuid()->toString(),
            'original_name' => $fileName,
            'file_path' => $path,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset('pdfFile');
    }

    public function render()
    {
        $qrCode = null;

        if (Auth::user()) {
            $this->uploadedFile = Document::where('user_id', Auth::user()->id)->latest()->first();
            if ($this->uploadedFile) {
                $this->url = Storage::url($this->uploadedFile->file_path);
                $qrCode = QrCode::size(100)->generate(request()->url() . $this->url);
            }
        }

        return view('livewire.upload-document', ['qrCode' => $qrCode]);
    }
}
