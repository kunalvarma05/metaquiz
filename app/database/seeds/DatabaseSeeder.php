<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();

		//Admin
		$admin = new Role;
		$admin -> name = 'Admin';
		$admin -> save();

		//Manager
		$manager = new Role;
		$manager -> name = 'Manager';
		$manager -> save();

		//Faculty
		$faculty = new Role;
		$faculty -> name = 'Faculty';
		$faculty -> save();

		//Student
		$student = new Role;
		$student -> name = 'Student';
		$student -> save();

		//Attach the role of the Admin to CreationMachine
		$user = User::where('username', '=', 'kunalvarma05') -> first();
		$user -> attachRole($admin);

		//Manage Organization
		$manageOrganization = new Permission;
		$manageOrganization -> name = 'manage_organization';
		$manageOrganization -> display_name = 'Manage Organization';
		$manageOrganization -> save();

		//Manage Students
		$manageStudents = new Permission;
		$manageStudents -> name = 'manage_students';
		$manageStudents -> display_name = 'Manage Students';
		$manageStudents -> save();

		//Manage Courses
		$manageCourses = new Permission;
		$manageCourses -> name = 'manage_courses';
		$manageCourses -> display_name = 'Manage Courses';
		$manageCourses -> save();

		//Manage Subjects
		$manageSubjects = new Permission;
		$manageSubjects -> name = 'manage_subjects';
		$manageSubjects -> display_name = 'Manage Subjects';
		$manageSubjects -> save();

		//Manage Chapters
		$manageChapters = new Permission;
		$manageChapters -> name = 'manage_chapters';
		$manageChapters -> display_name = 'Manage Chapters';
		$manageChapters -> save();

		//Manager
		$manager -> perms() -> sync(array($manageOrganization -> id, $manageStudents -> id, $manageCourses -> id, $manageSubjects -> id));

		//Faculty
		$faculty -> perms() -> sync(array($manageChapters -> id));
	}

}
