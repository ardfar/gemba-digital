<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActionCompletionFiles extends Model
{
    protected $fillable = [
        "action_id",
        "user_id",
        "type",
        "path",
    ];

    // Relationships
    public function action()
    {
        return $this->belongsTo(Actions::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImageUrlAttribute()
    {
        $path = $this->path;

        if (!$path) {
            return asset('assets/images/appreciation/default.png'); // Return a default placeholder
        }

        // Check if it's a new, locally stored file
        if (Str::startsWith($path, 'uploads/')) {
            return asset('storage/' . $path);
        }

        // Otherwise, assume it's an old file on the external server
        $baseUrl = rtrim(env('APPRECIATION_IMAGE_BASE_URL'), '/');
        $filePath = ltrim($path, '/');

        return "{$baseUrl}/{$filePath}";
    }
}
