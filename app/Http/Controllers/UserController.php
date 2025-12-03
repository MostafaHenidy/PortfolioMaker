<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserInfoRequest;
use App\Http\Requests\UpdateUserSettingsRequest;
use App\Mail\ContactFormMail;
use App\Models\PortfolioMessage;
use App\Models\Project;
use App\Models\Settings;
use App\Models\Skill;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        $skills = Skill::where('user_id', Auth::user()->id)->get();
        $projects = Project::where('user_id', Auth::user()->id)->get();
        $settings = Settings::where('user_id', Auth::user()->id)->first();
        return view('dashboard.dashboard', get_defined_vars());
    }
    // User Info
    public function updateUserInfo(UpdateUserInfoRequest $request)
    {
        DB::beginTransaction();
        try {
            Auth::user()->update($request->validated());
            if ($request->hasFile('avatar')) {
                $user->clearMediaCollection('avatars');
                $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
            }
            DB::commit();
            return redirect()->back()->with('success', 'User info updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failure', 'User info update failed due to' . $e->getMessage());
        }
    }
    public function updateUserSettings(UpdateUserSettingsRequest $request)
    {
        DB::beginTransaction();
        try {
            $settings = Settings::where('user_id', Auth::id())->firstOrFail();
            $settings->update($request->validated());
            DB::commit();
            return back()->with('success', 'User settings updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('failure', 'User settings update failed due to' . $e->getMessage());
        }
    }
    // Portfolio 
    public function myPortfolio()
    {
        $skills = Skill::where('user_id', Auth::user()->id)->get();
        $projects = Project::where('user_id', Auth::user()->id)->get();
        $settings = Settings::where('user_id', Auth::user()->id)->firstOrFail();

        return view('myPortfolio', get_defined_vars());
    }
    public function sendMessage(Request $request, $userName)
    {
        DB::beginTransaction();
        try {
            $portfolioOwner = User::where('name', $userName)->firstOrFail();
            $validated = $request->validated();
            $messageRecord = PortfolioMessage::create([
                'recipient_user_id' => $portfolioOwner->id,
                'from_name' => $validated['name'],
                'from_email' => $validated['email'],
                'message' => $validated['message'],
            ]);
            Mail::to($portfolioOwner->email)->send(new ContactFormMail($validated));
            DB::commit();
            return back()->with('success', 'Your message has been sent to ' . $portfolioOwner->name . '!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('failure', 'Something went wrong' . $e->getMessage());
        }
    }
    public function viewUserProtfolio($userName)
    {
        $user = User::where('name', 'like', '%' . $userName . '%')->firstOrFail();
        if ($user) {
            $skills = Skill::where('user_id', $user->id)->get();
            $projects = Project::where('user_id', $user->id)->get();
            $settings = Settings::where('user_id', $user->id)->firstOrFail();

            // Determine portfolio theme ID (1–10)
            $themeId = $settings->theme_id ?? 1;

            // Choose view based on theme
            switch ($themeId) {
                case 2:
                    $viewName = 'portfolio.theme2';
                    break;
                case 3:
                    $viewName = 'portfolio.theme3';
                    break;
                case 4:
                    $viewName = 'portfolio.theme4';
                    break;
                case 5:
                    $viewName = 'portfolio.theme5';
                    break;
                case 6:
                    $viewName = 'portfolio.theme6';
                    break;
                case 7:
                    $viewName = 'portfolio.theme7';
                    break;
                case 8:
                    $viewName = 'portfolio.theme8';
                    break;
                case 9:
                    $viewName = 'portfolio.theme9';
                    break;
                case 10:
                    $viewName = 'portfolio.theme10';
                    break;
                case 1:
                default:
                    $viewName = 'portfolio.theme1';
                    break;
            }
        }

        return view($viewName, get_defined_vars());
    }
}
