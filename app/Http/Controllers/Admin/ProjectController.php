<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $tags = Tecnology::all();
        return view('admin.projects.create', compact('types', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->all());
        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $thumb_path = Storage::put('project_img', $request->thumbnail);
            $data['thumbnail'] = $thumb_path;
        }

        $project = new Project();
        $project->fill($data);
        $project->slug = Str::slug($project->title);
        $project->save();

        if ($request->has('tags')) {
            $project->tecnologies()->attach($request->tags);
        }

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tags = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'types', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::delete($project->thumbnail);
            }
            $image_path = Storage::put('project_img', $request->thumbnail);
            $data['thumbnail'] = $image_path;
        }
        
        $project->update($data);

        $project->tecnologies()->sync($request->tags);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->thumbnail) {
            Storage::delete($project->thumbnail);
        }

        $project->delete();
        $project->tecnologies()->detach();
        return redirect()->route('admin.projects.index')->with('message','Project ' . $project->title . ' has been removed succesfully!');
    }
}
