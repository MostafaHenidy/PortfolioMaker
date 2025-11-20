<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    // Skill CRUD
    public function storeSkills(SkillRequest $request)
    {
        DB::beginTransaction();
        try {
            $skill = Skill::create($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Skills create successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('failure', 'Skills create failed due to' . $e->getMessage());
        }
    }
    public function updateSkill(SkillRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $skill = Skill::findOrFail($id);
            $skill->update($request->validated());
            DB::commit();
            return redirect()->back()->with('success', 'Skill updated successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('failure', 'Skills update failed due to' . $e->getMessage());
        }
    }

    public function deleteSkill($id)
    {
        DB::beginTransaction();
        try {
            $skill = Skill::findOrFail($id);
            if ($skill) {
                $skill->delete();
                DB::commit();
                return redirect()->back()->with('success', 'Project Deleted successfully');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('failure', 'Project delete failed due to' . $e->getMessage());
        }
    }
}
