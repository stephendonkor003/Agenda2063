<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KnowledgeDownloadController extends Controller
{
    public function show(Request $request, $slug)
    {
        $document = KnowledgeDocument::where('slug', $slug)->firstOrFail();
        $document->increment('downloads');

        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            return Storage::disk('public')->download($document->file_path, $document->title . '.' . $this->extensionFromMime($document->mime));
        }

        if ($document->source_url) {
            return redirect()->away($document->source_url);
        }

        abort(404);
    }

    protected function extensionFromMime(?string $mime): string
    {
        if (! $mime) return 'file';
        return match($mime) {
            'application/pdf' => 'pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword' => 'docx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel' => 'xlsx',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            default => 'file',
        };
    }
}
