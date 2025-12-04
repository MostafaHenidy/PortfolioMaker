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

    if ($user && $user->getLastMediaUrl('avatars')) {
        return $user->getLastMediaUrl('avatars');
    }

    // Fallback: generate default avatar as base64
    return Avatar::create($user->name)->toBase64();
}
function getProjectImage($project)
{
    if ($project && $project->getLastMediaUrl('projectImages')) {
        return $project->getLastMediaUrl('projectImages');
    }
}
