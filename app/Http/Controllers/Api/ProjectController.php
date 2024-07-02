<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with(['type'])->get();
        $data = [
            'projects' => $projects,
            'success' => true,
        ];
        return response()->json($data);
    }

    public function show(string $slug) {
        $project = Project::where('slug', $slug)->with(['tecnology', 'type'])->first();
        $data = [
            'project' => $project,
            'success' => true,
        ];
        return response()->json($data);
    }
}