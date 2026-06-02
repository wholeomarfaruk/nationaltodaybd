<?php

namespace App\Http\Controllers\Admin;

use App\Models\PhotoCardTemplate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Routing\Controller;

class PhotoCardController extends Controller
{
    public function fieldMap($templateId)
    {
        $template = PhotoCardTemplate::findOrFail($templateId);

        return view('admin.photo-card-field-map', ['template' => $template]);
    }

    public function download(Request $request): BinaryFileResponse
    {
        $filename = basename($request->query('file', ''));

        if (empty($filename) || strpos($filename, '..') !== false || strpos($filename, '/') !== false) {
            abort(400, 'Invalid filename');
        }

        $path = public_path("photocards/{$filename}");

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path)->deleteFileAfterSend(true);
    }
}
