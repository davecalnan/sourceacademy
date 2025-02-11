<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Constructor function.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        $host = explode('.', parse_url(url()->current())['host']);
        $subdomain = $host[0];

        if ($subdomain == 'admin') {
            return view('admin.projects.index', compact('projects'));
        }
        return view('app.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'name' => 'required',
            'slug' => 'required|unique:projects'
        ]);

        Project::create($request->all());
        
        redirect('//redirect.' . env('APP_DOMAIN') . '/projects/' . $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $host = explode('.', parse_url(url()->current())['host']);
        $subdomain = $host[0];

        if ($subdomain == 'admin') {
            return view('admin.projects.single', compact('project', 'assets', 'resources'));
        }
        return view('app.projects.single', compact('project', 'assets', 'resources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        dd($request);

        $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'name' => 'required',
            'slug' => 'required'
        ]);

        $project->update($request->all());

        return redirect('//redirect.' . env('APP_DOMAIN') . '/projects/' . $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('//redirect.' . env('APP_DOMAIN') . '/projects/');
    }

    /**
     * If the user has projects, display a listing of their projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserProjects()
    {
        $user = Auth::user();
        $projects = $user->has('projects') ? $user->projects()->get() : [];

        if (count($user->projects) == 1) {
            return redirect('/projects/' . $user->projects()->first()->slug);
        }

        $title = 'Your Projects';

        return view('app.projects.index', compact('projects', 'title'));
    }
}
