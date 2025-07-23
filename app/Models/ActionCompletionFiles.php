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
            return asset('assets/images/appreciation/default.png');
        }

        // Jika path sudah berupa URL lengkap, langsung kembalikan
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Untuk file action_evidence, selalu gunakan URL eksternal
        if (str_contains($path, 'action_evidence')) {
            $baseUrl = rtrim(env('APPRECIATION_IMAGE_BASE_URL', 'https://localhost:8080/uploads'), '/');
            $filePath = ltrim($path, '/');
            // Hapus 'uploads/' dari awal path jika ada
            $filePath = preg_replace('#^uploads/#', '', $filePath);
            return "{$baseUrl}/{$filePath}";
        }

        // Untuk file lokal lainnya (jika ada)
        if (str_starts_with($path, 'uploads/')) {
            return asset('storage/' . ltrim($path, '/'));
        }

        // Default: gunakan APPRECIATION_IMAGE_BASE_URL
        $baseUrl = rtrim(env('APPRECIATION_IMAGE_BASE_URL', 'https://localhost:8080/uploads'), '/');
        $filePath = ltrim($path, '/');
        return "{$baseUrl}/{$filePath}";
    }
}
