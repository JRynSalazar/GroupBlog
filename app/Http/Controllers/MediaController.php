<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->get();
        $latestMedia = Media::latest()->first();
        $moreMedia = Media::where('id', '!=', optional($latestMedia)->id)
                      ->latest()
                      ->limit(5)
                      ->get();
        return view('blog.article', compact('media', 'latestMedia', 'moreMedia')); // Use 'admin.addarticle'
    }

   public function showMedia()
    {
        $media = Media::all();
        
        return view('blog.article', compact('media'));
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|mimes:mp4,mov,avi,mkv,jpg,png,pdf,docx|max:204800',], 
            [
                'file.mimes' => 'Only MP4, JPG, PNG, PDF, and DOCX files are allowed.',
                'file.max' => 'The file size must not exceed 2 MB.',
            ]);

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
        $type = $file->getClientOriginalExtension() == 'mp4' ? 'video' : ($file->getClientOriginalExtension() == 'pdf' || $file->getClientOriginalExtension() == 'docx' ? 'file' : 'image');

        Media::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'file_type' => $type,
        ]);

        return redirect()->route('blog.news')->with('success', 'Media uploaded successfully!');
    }

    public function destroy($id)
    {
        $media = Media::find($id);
    
        if (!$media) {
            logger('Media not found in database.');
            return redirect()->route('media.index')->with('error', 'Media not found.');
        }
    
        logger('Deleting media ID: ' . $media->id);
    
        if (!empty($media->file_path) && Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }
    
        $deleted = $media->delete();
    
        if ($deleted) {
            logger('Media successfully deleted.');
        } else {
            logger('Media delete failed.');
        }
    
        return redirect()->route('blog.news')->with('success', 'Media deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $media = Media::findOrFail($id);

        $media->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->back()->with('success', 'Media updated successfully.');
    }
    
}
