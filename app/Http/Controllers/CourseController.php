<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\StoreCourse;
use App\Http\Requests\UpdateCourse;
use App\Lecturer;
use App\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::with(['students', 'lecturers'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse $request)
    {
        return Course::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course->load('students', 'lecturers');

        return $course;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourse $request, Course $course)
    {
        $course->update($request->all());
        $course->load('students', 'lecturers');

        return $course;
    }

    public function addStudent(Course $course, Student $student)
    {
        $course->students()->syncWithoutDetaching($student);
        $course->load('students', 'lecturers');

        return $course;
    }

    public function removeStudent(Course $course, Student $student)
    {
        $course->students()->detach($student);
        $course->load('students', 'lecturers');

        return $course;
    }

    public function addLecturer(Course $course, Lecturer $lecturer)
    {
        $course->lecturers()->syncWithoutDetaching($lecturer);
        $course->load('students', 'lecturers');

        return $course;
    }

    public function removeLecturer(Course $course, Lecturer $lecturer)
    {
        $course->lecturers()->detach($lecturer);
        $course->load('students', 'lecturers');

        return $course;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $courseId = $course->id;

        $course->delete();

        return "The course with ID of $courseId has been deleted.";
    }
}
