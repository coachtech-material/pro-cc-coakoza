<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_progress_rate_is_100_when_all_published_lessons_are_completed_with_unpublished_lessons(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = $this->createCourseWithChapter();
        $publishedLessons = Lesson::factory()->count(2)->sequence(
            ['order' => 1],
            ['order' => 2],
        )->create(['chapter_id' => $course->chapters()->first()->id]);
        Lesson::factory()->unpublished()->create([
            'chapter_id' => $course->chapters()->first()->id,
            'order' => 3,
        ]);

        foreach ($publishedLessons as $lesson) {
            LessonProgress::factory()->create([
                'user_id' => $student->id,
                'lesson_id' => $lesson->id,
                'status' => 'completed',
            ]);
        }

        $this->assertSame(100, $course->getProgressRate($student->id));
    }

    public function test_progress_rate_is_correct_when_some_published_lessons_are_completed(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = $this->createCourseWithChapter();
        $publishedLessons = Lesson::factory()->count(4)->sequence(
            ['order' => 1],
            ['order' => 2],
            ['order' => 3],
            ['order' => 4],
        )->create(['chapter_id' => $course->chapters()->first()->id]);

        foreach ($publishedLessons->take(3) as $lesson) {
            LessonProgress::factory()->create([
                'user_id' => $student->id,
                'lesson_id' => $lesson->id,
                'status' => 'completed',
            ]);
        }

        $this->assertSame(75, $course->getProgressRate($student->id));
    }

    public function test_progress_rate_is_0_when_course_has_no_lessons(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = $this->createCourseWithChapter();

        $this->assertSame(0, $course->getProgressRate($student->id));
    }

    private function createCourseWithChapter(): Course
    {
        $course = Course::factory()->create([
            'user_id' => User::factory()->create(['role' => 'coach'])->id,
            'category_id' => Category::factory()->create()->id,
            'status' => 'published',
        ]);

        Chapter::factory()->create([
            'course_id' => $course->id,
            'order' => 1,
        ]);

        return $course;
    }
}
