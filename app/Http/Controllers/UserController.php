<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCoverPhoto;
use App\Models\UserProfilePhoto;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class UserController extends Controller
{   
    public function index()
    {
        $data = [
            'users' => User::all(),
        ];

        $title = 'Hapus Pengguna!';
        $text = "Apakah kamu yakin untuk menghapus pengguna?";
        confirmDelete($title, $text);

        return view('users', $data);
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);
    
            // Create user 
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'department' => $request->department,
                'password' => bcrypt($request->password),
            ]);
    
            // Check if user attached profile photo 
            if ($request->hasFile('profile_photo')) {
                $profileFile = $request->file('profile_photo');
                $profileFilename = uniqid() . '_' . Str::random(10) . '.' . $profileFile->getClientOriginalExtension();
                $profilePath = $profileFile->storeAs('uploads/user/profile/' . $user->id, $profileFilename, 'public');
            
                UserProfilePhoto::create([
                    'user_id' => $user->id,
                    'path' => $profilePath,
                ]);
            }
            
            // Check if user attached cover photo 
            if ($request->hasFile('cover_photo')) {
                $coverFile = $request->file('cover_photo');
                $coverFilename = uniqid() . '_' . Str::random(10) . '.' . $coverFile->getClientOriginalExtension();
                $coverPath = $coverFile->storeAs('uploads/user/cover/' . $user->id, $coverFilename, 'public');
            
                UserCoverPhoto::create([
                    'user_id' => $user->id,
                    'path' => $coverPath,
                ]);
            }

            Alert::toast("Berhasil menambahkan pengguna", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to create User', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);
    
            // Update related User 
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'department' => $request->department,
            ]);
    
            // Check if user attached profile photo 
            if ($request->hasFile('profile_photo')) {
                $profileFile = $request->file('profile_photo');
                $profileFilename = uniqid() . '_' . Str::random(10) . '.' . $profileFile->getClientOriginalExtension();
                $profilePath = $profileFile->storeAs('uploads/user/profile/' . $request->id, $profileFilename, 'public');
            
                UserProfilePhoto::where('user_id', $request->id)->update([
                    'path' => $profilePath,
                ]);
            }
            
            // Check if user attached cover photo 
            if ($request->hasFile('cover_photo')) {
                $coverFile = $request->file('cover_photo');
                $coverFilename = uniqid() . '_' . Str::random(10) . '.' . $coverFile->getClientOriginalExtension();
                $coverPath = $coverFile->storeAs('uploads/user/cover/' . $request->id, $coverFilename, 'public');
            
                UserCoverPhoto::where('user_id', $request->id)->update([
                    'path' => $coverPath,
                ]);
            }
    
            // Check if user inputed new password 
            if (!$request->password)
            {
                User::where('id', $request->id)->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            Alert::toast("Berhasil memperbaharui detail pengguna", 'success')->position('top-end')->timerProgressBar();
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Failed to update User', ['error' => $e->getMessage()]);
    
            Alert::toast('Error: ' . $e->getMessage(), 'error')
                ->position('top-end')
                ->timerProgressBar();
    
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Alert::toast('Pengguna Berhasil Dihapus!', 'success')->position('top-end')->timerProgressBar();
        } else {
            Alert::toast('Pengguna Tidak Ditemukan', 'error')->position('top-end')->timerProgressBar();
        }

        return redirect()->back();
    }
}
