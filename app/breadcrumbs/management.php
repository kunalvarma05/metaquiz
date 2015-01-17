<?php
/**
 * Breadcrumbs for the management section
 */

/***********************
* Dashboard
************************/
//Dashboard
Breadcrumbs::register('management-dashboard', function($breadcrumbs) {
    $breadcrumbs->push(Auth::user()->organization->name, route('management.dashboard'));
});

/***********************
* Courses
************************/
//Courses
Breadcrumbs::register('management-courses', function($breadcrumbs) {
    $breadcrumbs->parent('management-dashboard');
    $breadcrumbs->push('Courses', route('management.courses.index'));
});

//Course
Breadcrumbs::register('management-course', function($breadcrumbs, $course) {
    $breadcrumbs->parent('management-courses');
    $breadcrumbs->push($course->name, route('management.courses.show', $course->id));
});

//Create Course
Breadcrumbs::register('management-courses-create', function($breadcrumbs) {
    $breadcrumbs->parent('management-courses');
    $breadcrumbs->push('New', route('management.courses.create'));
});

//Edit Course
Breadcrumbs::register('management-course-edit', function($breadcrumbs, $course) {
    $breadcrumbs->parent('management-course', $course);
    $breadcrumbs->push('Edit', route('management.courses.edit'));
});

/***********************
* Subjects
************************/
//Subjects
Breadcrumbs::register('management-subjects', function($breadcrumbs, $course) {
    $breadcrumbs->parent('management-course', $course);
    $breadcrumbs->push('Subjects', route('management.courses.subjects.index', $course->id));
});

//Subject
Breadcrumbs::register('management-subject', function($breadcrumbs, $course, $subject) {
    $breadcrumbs->parent('management-subjects', $course);
    $breadcrumbs->push($subject->name, route('management.courses.subjects.show', array($course->id, $subject->id)));
});

//Create Subject
Breadcrumbs::register('management-subjects-create', function($breadcrumbs, $course) {
    $breadcrumbs->parent('management-subjects', $course);
    $breadcrumbs->push('New', route('management.courses.subjects.create', array($course->id)));
});

//Edit Subject
Breadcrumbs::register('management-subject-edit', function($breadcrumbs, $course, $subject) {
    $breadcrumbs->parent('management-subject', $course, $subject);
    $breadcrumbs->push('Edit', route('management.courses.subjects.edit', array($course->id, $subject->id)));
});

/***********************
* Chapters
************************/
//Chapters
Breadcrumbs::register('management-chapters', function($breadcrumbs, $course, $subject) {
    $breadcrumbs->parent('management-subject', $course, $subject);
    $breadcrumbs->push('Chapters', route('management.courses.subjects.chapters.index', array($course->id, $subject->id)));
});

//Chapter
Breadcrumbs::register('management-chapter', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-chapters', $course, $subject);
    $breadcrumbs->push($chapter->name, route('management.courses.subjects.chapters.show', array($course->id, $subject->id, $chapter->id)));
});

//Create Chapter
Breadcrumbs::register('management-chapters-create', function($breadcrumbs, $course, $subject) {
    $breadcrumbs->parent('management-chapters', $course, $subject);
    $breadcrumbs->push('New', route('management.courses.subjects.chapters.create', array($course->id, $subject->id)));
});

//Edit Chapter
Breadcrumbs::register('management-chapter-edit', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-chapter', $course, $subject, $chapter);
    $breadcrumbs->push('Edit', route('management.courses.subjects.chapters.edit', array($course->id, $subject->id, $chapter->id)));
});

/***********************
* Questions
************************/
//Questions
Breadcrumbs::register('management-questions', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-chapter', $course, $subject, $chapter);
    $breadcrumbs->push('Questions', route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id)));
});

/***********************
* Question
************************/
//Question
Breadcrumbs::register('management-question', function($breadcrumbs, $course, $subject, $chapter, $question) {
    $breadcrumbs->parent('management-questions', $course, $subject, $chapter);
    $breadcrumbs->push($question->title, route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter->id, $question->id)));
});

//Create Question
Breadcrumbs::register('management-questions-create', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-questions', $course, $subject, $chapter);
    $breadcrumbs->push('New', route('management.courses.subjects.chapters.questions.create', array($course->id, $subject->id, $chapter->id)));
});

//Edit Question
Breadcrumbs::register('management-question-edit', function($breadcrumbs, $course, $subject, $chapter, $question) {
    $breadcrumbs->parent('management-question', $course, $subject, $chapter, $question);
    $breadcrumbs->push('Edit', route('management.courses.subjects.chapters.questions.edit', array($course->id, $subject->id, $chapter->id, $question->id)));
});

//Import Question
Breadcrumbs::register('management-questions-import', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-questions', $course, $subject, $chapter);
    $breadcrumbs->push('Import', route('management.courses.subjects.chapters.questions.import', array($course->id, $subject->id, $chapter->id)));
});

/***********************
* faculties
************************/
//faculties
Breadcrumbs::register('management-faculties', function($breadcrumbs) {
    $breadcrumbs->parent('management-dashboard');
    $breadcrumbs->push('Faculties', route('management.faculties.index'));
});

//faculty
Breadcrumbs::register('management-faculty', function($breadcrumbs, $faculty) {
    $breadcrumbs->parent('management-faculties');
    $breadcrumbs->push($faculty->name, route('management.faculties.show', $faculty->id));
});

//Create faculty
Breadcrumbs::register('management-faculties-create', function($breadcrumbs) {
    $breadcrumbs->parent('management-faculties');
    $breadcrumbs->push('New', route('management.faculties.create'));
});

//Edit faculty
Breadcrumbs::register('management-faculty-edit', function($breadcrumbs, $faculty) {
    $breadcrumbs->parent('management-faculty', $faculty);
    $breadcrumbs->push('Edit', route('management.faculties.edit'));
});

/***********************
* students
************************/
//students
Breadcrumbs::register('management-students', function($breadcrumbs) {
    $breadcrumbs->parent('management-dashboard');
    $breadcrumbs->push('students', route('management.students.index'));
});

//faculty
Breadcrumbs::register('management-student', function($breadcrumbs, $student) {
    $breadcrumbs->parent('management-students');
    $breadcrumbs->push($student->name, route('management.students.show', $student->id));
});

//Create student
Breadcrumbs::register('management-students-create', function($breadcrumbs) {
    $breadcrumbs->parent('management-students');
    $breadcrumbs->push('New', route('management.students.create'));
});

//Edit student
Breadcrumbs::register('management-student-edit', function($breadcrumbs, $student) {
    $breadcrumbs->parent('management-student', $student);
    $breadcrumbs->push('Edit', route('management.students.edit'));
});