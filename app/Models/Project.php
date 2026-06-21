<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tag',
        'thumbnail',
        'tech_stack',
        'excerpt',
        'description',
        'featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (blank($project->slug) && filled($project->title)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::deleting(function (Project $project) {
            static::deleteStoredThumbnail($project->thumbnail);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function deleteStoredThumbnail(?string $thumbnail): void
    {
        if (blank($thumbnail) || str_starts_with($thumbnail, 'http')) {
            return;
        }

        $path = str_replace('/storage/', '', $thumbnail);

        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
