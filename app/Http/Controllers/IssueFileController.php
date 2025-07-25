<?php

namespace App\Http\Controllers;

use App\Models\IssueFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Termwind\Components\Raw;

class IssueFileController extends Controller
{
    public function create(Request $request)
    {
        try {

            $request->validate([
                'issue_id' => "required",
                'files.*' => "file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ]);

            foreach ($request->file('files', []) as $file) {
                // Name Obfuscate
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
    
                // Storing
                $path = $file->storeAs('uploads/issue/' . (string) $request->issue_id . '/', $filename, 'public');
    
                // Save the record
                $mime = $file->getMimeType();
                IssueFiles::create([
                    'issue_id' => $request->issue_id,
                    'user_id' => Auth::user()->id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);
            }
    
            Alert::toast('File pendukung berhasil ditambahkan', 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();

        } catch (\Exception $e) {
            Log::error('Failed to add Issue Files', ['error' => $e->getMessage()]);
            
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
        
        
    }

    public function create_api(Request $request)
    {
        try {

            $request->validate([
                'issue_id' => "required",
                'user_id' => "required",
                'files.*' => "required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ],
            [
                "issue_id.required" => "Please attach issue_id",
                "user_id.required" => "Please attach user_id",
                "files.*.file" => "File not found",
            ]);

            $createdFiles = [];

            foreach ($request->file('files', []) as $file) {

                // Generate unique file name
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Store file
                $path = $file->storeAs(
                    'uploads/issue/' . (string) $request->issue_id . '/',
                    $filename,
                    'public'
                );

                // Determine type
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO";

                // Create record
                $issueFile = IssueFiles::create([
                    'issue_id' => $request->issue_id,
                    'user_id' => $request->user_id,
                    'type' => $type,
                    'path' => $path,
                ]);

                $createdFiles[] = $issueFile;
            }

            return response()->json([
                'status' => '200',
                'message' => 'Issue Files were succesfully uploaded',
                'data' => [
                    'files' => $createdFiles,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to add Issue Files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get_api($issue_id)
    {
        try {

            if (!$issue_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach issue_id ',
                    'data' => []
                ]);
            }

            $files = [];

            $records = IssueFiles::where('issue_id', $issue_id)->get();

            foreach ($records as $record) {
                $files[] = [
                    'id' => $record->id,
                    'user_id' => $record->user_id,
                    'type' => $record->type,
                    'path' => $record->path,
                ];
            }

            return response()->json([
                'status' => '200',
                'message' => 'Issue File list fetched successfully',
                'data' => [
                    'issue_id' => $issue_id,
                    'files' => $files,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch issue files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete_api($file_id)
    {
        try {

            if (!$file_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach file_id of the file',
                    'data' => []
                ]);
            }

            $record = IssueFiles::find($file_id);

            if ($record) {
                $record->delete();
                return response()->json([
                    'status' => '200',
                    'message' => 'Issue File has been deleted',
                    'data' => []
                ]);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => 'Issue File not found',
                    'data' => []
                ]);
            }
            

        } catch (\Exception $e) {
            Log::error('Failed to delete issue files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
