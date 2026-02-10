<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function index()
    {
        $files = File::orderByDesc('uploaded_at')->paginate(15);

        return view('files.index', compact('files'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $uploadedFile = $validated['file'];

        $storedPath = $uploadedFile->store('files', 'public');
        $storedName = basename($storedPath);

        File::create([
            'original_name' => $uploadedFile->getClientOriginalName(),
            'stored_name'   => $storedName,
            'file_path'     => $storedPath,
            'file_size'     => $uploadedFile->getSize(),
            'mime_type'     => $uploadedFile->getClientMimeType(),
            'uploaded_at'   => now(),
        ]);

        $route = app()->getLocale() === 'es' ? 'files.index.es' : 'files.index';
        return redirect()->route($route)
            ->with('status', __('messages.file_uploaded'));
    }

    public function download(File $file): StreamedResponse
    {
        if (! Storage::disk('public')->exists($file->file_path)) {
            $route = app()->getLocale() === 'es' ? 'files.index.es' : 'files.index';
            return redirect()->route($route)
                ->with('error', __('messages.file_not_found'));
        }

        return Storage::disk('public')->download(
            $file->file_path,
            $file->original_name
        );
    }

    public function destroy(File $file)
    {
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }

        $file->delete();

        $route = app()->getLocale() === 'es' ? 'files.index.es' : 'files.index';
        return redirect()->route($route)
            ->with('status', __('messages.file_deleted'));
    }
}


