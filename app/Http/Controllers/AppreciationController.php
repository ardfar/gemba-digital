<?php

namespace App\Http\Controllers;

use App\Livewire\Modal\View\AppreciationNote;
use App\Models\AppreciationNoteFiles;
use App\Models\AppreciationNotes;
use App\Models\PointHistories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AppreciationController extends Controller
{
    public function index()
    {
        // Get top 3 
        $topUsers = User::orderByDesc('points')->take(3)->get();
        $topUserIds = $topUsers->pluck('id')->toArray();

        // Get the rest users and remove the top 3 
        $otherUsers = User::whereNotIn('id', $topUserIds)
                          ->orderByDesc('points') 
                          ->get();

        $data = [
            "users" => $otherUsers, 
            "top" => $topUsers      
        ];

        return view('appreciation', $data);
    }
    
    public function create(Request $request)
    {

        try {

            $request->validate([
                "session_id" => "required",
                "line" => "required",
                "receiver_id" => "required",
                "receiver_name" => "required",
                "description" => "required",
            ]);

            // Create Appreciation Notes
            $record = AppreciationNotes::create([
                'session_id' => $request->session_id,
                'by' => Auth::user()->id,
                'receivers_id' => $request->receiver_id,
                'receivers_name' => $request->receiver_name,
                'line' => $request->line,
                'description' => $request->description,
            ]);

            // Check if appreciation has photos 
            if ($request->hasFile('photos'))
            {
                foreach ($request->file('photos', []) as $file) {

                    // Generate unique file name
                    $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
    
                    // Store file
                    $path = $file->storeAs(
                        'uploads/appreciation/note' . (string) $request->action_id,
                        $filename,
                        'public'
                    );
    
                    // Determine type
                    $mime = $file->getMimeType();
                    $type = str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO";
    
                    // Create record
                    AppreciationNoteFiles::create([
                        'appreciation_note_id' => $record->id,
                        'user_id' => Auth::user()->id,
                        'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                        'path' => $path,
                    ]);
    
                }
            } 

            Alert::toast('Berhasil Menambahkan Catatan Apresiasi', 'success')->position('top-end')->timerProgressBar();

            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create Appreciation Notes', ['error' => $e->getMessage()]);
    
            Alert::toast('Gagal: ' . $e->getMessage(), 'error')
            ->position('top-end')
            ->timerProgressBar();
    
            return redirect()->back()->withInput();
        } 

    }
}
