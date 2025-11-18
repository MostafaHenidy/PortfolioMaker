<?php
function checkSkill($project, $skill)
{
    if ($project->skills->contains($skill)) {
        return true;
    }
    return false;
}
