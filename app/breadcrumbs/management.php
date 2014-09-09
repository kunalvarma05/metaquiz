<?php
/**
 * Breadcrumbs for the management section
 */

//Dashboard
Breadcrumbs::register('management-dashboard', function($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('management.dashboard'));
});

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

//Subjects
Breadcrumbs::register('management-subjects', function($breadcrumbs, $course) {
    $breadcrumbs->parent('management-course', $course);
    $breadcrumbs->push('Subjects', route('management.courses.subjects.index', array($course->id)));
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

Breadcrumbs::register('management-chapters', function($breadcrumbs, $course, $subject) {
    $breadcrumbs->parent('management-subject', $course, $subject);
    $breadcrumbs->push('Chapters', route('management.courses.subjects.chapters.index', array($course->id, $subject->id)));
});

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

Breadcrumbs::register('management-questions', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-chapter', $course, $subject, $chapter);
    $breadcrumbs->push('Questions', route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id)));
});

Breadcrumbs::register('management-question', function($breadcrumbs, $course, $subject, $chapter, $question) {
    $breadcrumbs->parent('management-questions', $course, $subject, $chapter);
    $breadcrumbs->push($question->title, route('management.courses.subjects.chapters.show', $course->id, $subject->id, $chapter->id, $question->id));
});

//Create Question
Breadcrumbs::register('management-questions-create', function($breadcrumbs, $course, $subject, $chapter) {
    $breadcrumbs->parent('management-questions', $course, $subject, $chapter);
    $breadcrumbs->push('New', route('management.courses.subjects.chapters.questions.new', array($course->id, $subject->id, $chapter->id)));
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