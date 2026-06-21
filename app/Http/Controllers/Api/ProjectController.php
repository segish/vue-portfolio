<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Project::query()->orderBy('sort_order')->orderBy('title');

        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        return response()->json($query->get());
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json($project);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validated($request);
        $data = $this->applyThumbnail($request, $data);

        $project = Project::create($data);

        return response()->json($project, 201);
    }

    public function update(Request $request, Project $project): JsonResponse
    {
        $data = $this->validated($request, $project);
        $data = $this->applyThumbnail($request, $data, $project);

        $project->update($data);

        return response()->json($project);
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json(null, 204);
    }

    private function validated(Request $request, ?Project $project = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('projects', 'slug')->ignore($project?->id),
            ],
            'tag' => ['required', 'string', 'max:100'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'featured' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'thumbnail_url' => ['nullable', 'url', 'max:500'],
            'remove_thumbnail' => ['sometimes', 'boolean'],
        ]);

        if (blank($data['slug'] ?? null)) {
            $data['slug'] = Str::slug($data['title']);
        }

        unset($data['thumbnail'], $data['thumbnail_url'], $data['remove_thumbnail']);

        return $data;
    }

    private function applyThumbnail(Request $request, array $data, ?Project $project = null): array
    {
        if ($request->boolean('remove_thumbnail')) {
            Project::deleteStoredThumbnail($project?->thumbnail);
            $data['thumbnail'] = null;

            return $data;
        }

        if ($request->hasFile('thumbnail')) {
            Project::deleteStoredThumbnail($project?->thumbnail);
            $path = $request->file('thumbnail')->store('projects', 'public');
            $data['thumbnail'] = '/storage/'.$path;

            return $data;
        }

        if ($request->filled('thumbnail_url')) {
            Project::deleteStoredThumbnail($project?->thumbnail);
            $data['thumbnail'] = $request->input('thumbnail_url');
        }

        return $data;
    }
}
