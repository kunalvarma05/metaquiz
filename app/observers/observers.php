<?php

/**
 * All the observers will be registered here
 */

//User Model Observer
User::observe(new UserObserver);

//Organization Model Observer
Organization::observe(new OrganizationObserver);

//Course Model Observer
Course::observe(new CourseObserver);

//Subject Model Observer
Subject::observe(new SubjectObserver);

//Chapter Model Observer
Chapter::observe(new ChapterObserver);

//Faculty Model Observer
Faculty::observe(new FacultyObserver);