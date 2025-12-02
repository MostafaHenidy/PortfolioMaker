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
    public $qrCodeSvg = null;
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

    public function downloadQrCode()
    {
        if (!$this->qrCodeSvg) {
            return;
        }

        $fileName = 'qrcode.svg';
        $svgContent = $this->qrCodeSvg;
        $utf8Content = $svgContent;

        return response()->streamDownload(function () use ($utf8Content) {
            // Echo the guaranteed UTF-8 content
            echo $utf8Content;
        }, $fileName, [
            // Keep the explicit UTF-8 header for the browser
            'Content-Type' => 'image/svg+xml; charset=utf-8',
        ]);
    }
    public function render()
    {

        if (Auth::user()) {
            $this->uploadedFile = Document::where('user_id', Auth::user()->id)->latest()->first();
            if ($this->uploadedFile) {
                $baseUrl = request()->url();
                $filePath = $this->uploadedFile->file_path;
                $encodedFilePath = rawurlencode($filePath);
                $this->url = '/storage/' . $encodedFilePath;
                $fullUrl = $baseUrl . $this->url;
                $encodedUrl = mb_convert_encoding($fullUrl, 'UTF-8', 'auto');
                $qrCode = QrCode::size(100)->generate($encodedUrl);
                $this->qrCodeSvg = (string) $qrCode;
            }
        }

        return view('livewire.upload-document', [
            'qrCode' => $this->qrCodeSvg,
        ]);
    }
}
