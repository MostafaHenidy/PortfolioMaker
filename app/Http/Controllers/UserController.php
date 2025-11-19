<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\SkillRequest;
use App\Mail\ContactFormMail;
use App\Models\PortfolioMessage;
use App\Models\Project;
use App\Models\Settings;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        $skills = Skill::where('user_id', Auth::user()->id)->get();
        $projects = Project::where('user_id', Auth::user()->id)->get();
        $settings = Settings::where('user_id', Auth::user()->id)->first();
        return view('dashboard', get_defined_vars());
    }
    // User Info
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
    public function updateUserSettings(Request $request)
    {
        $request->validate([
            'about'    => 'required|boolean',
            'skills'   => 'required|boolean',
            'projects' => 'required|boolean',
            'contact'  => 'required|boolean',
        ]);

        $settings = Settings::where('user_id', Auth::id())->firstOrFail();

        $settings->update([
            'about'    => $request->boolean('about'),
            'skills'   => $request->boolean('skills'),
            'projects' => $request->boolean('projects'),
            'contact'  => $request->boolean('contact'),
        ]);

        return back()->with('success', 'User settings updated successfully');
    }
    // Project CRUD
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
        if ($request->hasFile('projectImage')) {
            $project->clearMediaCollection('projectImage');
            $project->addMediaFromRequest('projectImage')->toMediaCollection('projectImage');
        }
        return redirect()->back()->with('success', 'Project create successfully');
    }

    public function updateProject(ProjectRequest $request, $id)
    {
        $validated = $request->validated();
        $project = Project::findOrFail($id);

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        $skillsIds = $request->input('project-skill', []);
        $project->skills()->sync($skillsIds);

        if ($request->hasFile('projectImage')) {
            $project->clearMediaCollection('projectImage');
            $project->addMediaFromRequest('projectImage')->toMediaCollection('projectImage');
        }
        return redirect()->back()->with('success', 'Project updated successfully');
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        if ($project) {
            $project->delete();
            return redirect()->back()->with('success', 'Project Deleted successfully');
        }
        return redirect()->back()->with('failure', 'Can not find Project');
    }
    // Skill CRUD
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

    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        if ($skill) {
            $skill->delete();
            return redirect()->back()->with('success', 'Project Deleted successfully');
        }
        return redirect()->back()->with('failure', 'Can not find Project');
    }
    // Portfolio 
    public function myPortfolio()
    {
        $skills = Skill::where('user_id', Auth::user()->id)->get();
        $projects = Project::where('user_id', Auth::user()->id)->get();
        $settings = Settings::where('user_id', Auth::user()->id)->firstOrFail();

        return view('myProtfolio', get_defined_vars());
    }
    public function sendMessage(Request $request, $userName)
    {
        $portfolioOwner = User::where('name', $userName)->firstOrFail();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        $messageRecord = PortfolioMessage::create([
            'recipient_user_id' => $portfolioOwner->id,
            'from_name' => $validated['name'],
            'from_email' => $validated['email'],
            'message' => $validated['message'],
        ]);
        Mail::to($portfolioOwner->email)->send(new ContactFormMail($validated));
        return back()->with('success', 'Your message has been sent to ' . $portfolioOwner->name . '!');
    }
    public function viewUserProtfolio($userName)
    {
        $user = User::where('name', 'like', '%' . $userName . '%')->firstOrFail();
        if ($user) {
            $skills = Skill::where('user_id', $user->id)->get();
            $projects = Project::where('user_id', $user->id)->get();
            $settings = Settings::where('user_id', $user->id)->firstOrFail();
        }
        return view('userProtfolio', get_defined_vars());
    }
}
