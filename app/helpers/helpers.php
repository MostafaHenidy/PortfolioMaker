<?php

use App\Models\User;
use Laravolt\Avatar\Facade as Avatar;

function checkSkill($project, $skill)
{
    if ($project->skills->contains($skill)) {
        return 'checked';
    }
    return '';
}
function getAvatar($user)
{

    if ($user && $user->getFirstMediaUrl('avatars')) {
        return $user->getFirstMediaUrl('avatars');
    }

    // Fallback: generate default avatar as base64
    return Avatar::create($user->name)->toBase64();
}
function getProjectImage($project)
{
    if ($project && $project->getFirstMediaUrl('projectImage')) {
        return $project->getFirstMediaUrl('projectImage');
    }
}
