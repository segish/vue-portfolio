<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'EIMS Invoice Integration',
                'slug' => 'eims',
                'tag' => 'INTEGRATION',
                'tech_stack' => 'Laravel · MySQL · Ministry of Revenue e-invoicing API',
                'excerpt' => 'Connecting a Laravel pharmacy and POS system to Ethiopia\'s e-invoicing platform.',
                'description' => 'A pharmacy and point-of-sale system built on Laravel, wired into Ethiopia\'s Electronic Invoice Management System so every sale reports correctly to the Ministry of Revenue. The hard part wasn\'t the API call, it was getting the architecture documented clearly enough that the rest of the team could work with it, which meant producing proper technical diagrams of how the zones of the system talk to each other.',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Clinic Patient Registry Migration',
                'slug' => 'registry',
                'tag' => 'DATA',
                'tech_stack' => 'PHP · MySQL · data cleaning',
                'excerpt' => 'Cleaning and converting roughly 9,400 patient records, calendar systems and all.',
                'description' => 'Processed close to 9,400 patient records for a specialized eye clinic. That meant converting dates between the Ethiopian and Gregorian calendars, computing birth dates from registration dates and recorded age, and handling the edge case where an infant\'s age is recorded in months rather than years.',
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Adaptive Traffic Light Control',
                'slug' => 'traffic',
                'tag' => 'ML / HARDWARE',
                'tech_stack' => 'Python · OpenCV · Arduino · ML',
                'excerpt' => 'Density-based signal timing using OpenCV vehicle counting and Arduino.',
                'description' => 'My graduation project. A real-time traffic light controller that adjusts signal timing based on actual vehicle density, using OpenCV to count vehicles from video and an Arduino to control the lights. Less about the algorithm, more about getting software and hardware to agree with each other in real time.',
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'E-Learning Platform Deployment',
                'slug' => 'elearning-deploy',
                'tag' => 'DEVOPS',
                'tech_stack' => 'VPS · Nginx · Jenkins · CI/CD',
                'excerpt' => 'Production VPS deployment with Jenkins CI/CD pipeline.',
                'description' => 'Took an e-learning site from local development to a VPS with a real CI/CD pipeline, automatic deploys on every push through Jenkins. It took a lot of trial and error to get the pipeline reliable, and the work ended up earning an NVIDIA Jetson Nano as recognition.',
                'featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Multi-Vendor E-Commerce Platform',
                'slug' => 'multivendor-ecommerce',
                'tag' => 'FULL-STACK',
                'tech_stack' => 'Laravel · MySQL · Blade',
                'excerpt' => 'Multi-vendor catalog with hierarchical product categories.',
                'description' => 'A Laravel e-commerce system supporting multiple vendors with hierarchical product categories, built so the catalog structure could grow without turning into a mess of one-off exceptions.',
                'featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Shebar Laundry Management System',
                'slug' => 'shebar-laundry',
                'tag' => 'FULL-STACK',
                'tech_stack' => 'Laravel · MySQL',
                'excerpt' => 'Order and customer tracking from drop-off through pickup.',
                'description' => 'A system for laundry businesses to track orders and customers from drop-off through to pickup, built with the same backend-first approach as the rest of my work, the data model comes first, the screens follow.',
                'featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'Kerat Event Management',
                'slug' => 'kerat-events',
                'tag' => 'FULL-STACK',
                'tech_stack' => 'Laravel · MySQL',
                'excerpt' => 'Event listings and bookings end to end.',
                'description' => 'A website for managing event listings and bookings end to end, another project where the backend does most of the heavy lifting and the frontend stays out of its way.',
                'featured' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }
    }
}
