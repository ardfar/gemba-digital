<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $fillable = [
        'issue_id',
        'root_cause_id',
        'type',
        'description',
        'pic_id',
        'due_date',
        'done_at',
        'status',
        'evidence_files',
        'completion_description',
        'created_by',
    ];

    // Relationships
    public function issue()
    {
        return $this->belongsTo(Issues::class);
    }

    public function rootCause()
    {
        return $this->belongsTo(RootCauses::class, 'root_cause_id');
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function completionFiles()
    {
        return $this->hasMany(ActionCompletionFiles::class, 'action_id');
    }
}
