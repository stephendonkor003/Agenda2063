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

        if ($document->file_path) {
            foreach (['local', 'public'] as $disk) {
                if (Storage::disk($disk)->exists($document->file_path)) {
                    $document->increment('downloads');

                    return Storage::disk($disk)->download(
                        $document->file_path,
                        $document->title . '.' . $this->extensionFromMime($document->mime),
                        ['X-Content-Type-Options' => 'nosniff']
                    );
                }
            }
        }

        if ($document->source_url) {
            $document->increment('downloads');

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
