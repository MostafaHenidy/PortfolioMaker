<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\SkillRequest;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $skills = Skill::all();
        $projects = Project::all();
        return view('dashboard', get_defined_vars());
    }
    public function updateUserInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'professional_headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $validated['name'],
            'professional_headline' => $validated['professional_headline'],
            'bio' => $validated['bio'],
            'experience' => $request->experience,
            'projects_made' => $request->projects_made,
        ]);

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return redirect()->back()->with('success', 'User info updated successfully');
    }
    public function portfolio()
    {
        return view('protfolio');
    }
    public function storeSkills(SkillRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();

        $skill = Skill::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'level' => $validated['level'],
        ]);

        return redirect()->back()->with('success', 'Skills create successfully');
    }
    public function storeProjects(ProjectRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $project = Project::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);
        if ($request->input('project-skill', [])) {
            $skillsIds = $request->input('project-skill', []);
            $project->skills()->sync($skillsIds);
        }

        return redirect()->back()->with('success', 'Project create successfully');
    }
    public function updateSkill(SkillRequest $request, $id)
    {
        $validated = $request->validated();
        $skill = Skill::findOrFail($id);

        $skill->update([
            'name' => $validated['name'],
            'level' => $validated['level'],
        ]);
        return redirect()->back()->with('success', 'Skill updated successfully');
    }
    public function updateProject(ProjectRequest $request, $id)
    {
        // dd('working');
        $validated = $request->validated();
        $project = Project::findOrFail($id);

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);
        if ($request->input('project-skill', [])) {
            $skillsIds = $request->input('project-skill', []);
            $project->skills()->sync($skillsIds);
        }
        return redirect()->back()->with('success', 'Project updated successfully');
    }
}
