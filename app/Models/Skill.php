<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $guarded = ['id'];

    /**
     * The user who originally created/owns this skill record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects(): BelongsToMany
    {
        // Use belongsToMany
        return $this->belongsToMany(Project::class, 'project_skills');
    }
}
