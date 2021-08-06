<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $category;
    private $lesson;
    private $user;

    public function __construct(
        Category $category,
        Lesson $lesson,
        User $user
    )

    {
        $this->category = $category;
        $this->lesson = $lesson;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today_lessons = $this->lesson->getTodays();
        $popular_lessons = $this->lesson->getPopular();
        $highly_rated_lessons = $this->lesson->getHighlyRated();
        $new_arrival_lessons = $this->lesson->getNewArrival();
        $popular_teachers = $this->user->getPopularTeachers();
        $new_arrival_teachers = $this->user->getNewArrivalTeachers();
        $categories = $this->category->getAll();
        return view('home',
            compact('today_lessons',
                'popular_lessons',
                'highly_rated_lessons',
                'new_arrival_lessons',
                'popular_teachers',
                'new_arrival_teachers',
                'categories')
            );
    }
}
