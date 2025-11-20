<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    // Project CRUD
    public function storeProjects(ProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $project = Project::create($request->validated());

            if ($request->input('project-skill', [])) {
                $skillsIds = $request->input('project-skill', []);
                $project->skills()->sync($skillsIds);
            }
            if ($request->hasFile('projectImage')) {
                $project->clearMediaCollection('projectImage');
                $project->addMediaFromRequest('projectImage')->toMediaCollection('projectImage');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Project create successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failure', 'Project create failed due to ' . $e->getMessage());
        }
    }

    public function updateProject(ProjectRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $project = Project::findOrFail($id);
            $project->update($request->validated());

            $skillsIds = $request->input('project-skill', []);
            $project->skills()->sync($skillsIds);

            if ($request->hasFile('projectImage')) {
                $project->clearMediaCollection('projectImage');
                $project->addMediaFromRequest('projectImage')->toMediaCollection('projectImage');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Project updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('fail', 'Project update failed due to ' . $e->getMessage());
        }
    }

    public function deleteProject($id)
    {
        DB::beginTransaction();
        try {
            $project = Project::findOrFail($id);
            if ($project) {
                $project->delete();
                DB::commit();
                return redirect()->back()->with('success', 'Project Deleted successfully');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failure', 'Can not find Project');
        }
    }
}
