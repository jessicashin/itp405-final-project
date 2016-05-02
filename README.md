####Jessica Shin &nbsp;|&nbsp; [ITP-405 Final Project](http://itpweb.herokuapp.com/assignments/405-final-project)
# Laravel Student Records Database
[![Build Status](https://travis-ci.org/jessicashin/itp405-final-project.svg?branch=master)](https://travis-ci.org/jessicashin/itp405-final-project)

http://itp-srdb.herokuapp.com/search

This site manages the student records of a tutoring and test prep institution. These records include contact and billing information as well as courses and enrollment. The users are administrative staff (not students).

## Accounts

All users will need an account, which are divided into admin and staff. There will be a default admin account (username `admin`), from which other accounts can be added along with the appropriate permissions.

Admin privileges are required to:
+ view, add, edit, and delete users
+ add, edit, and delete instructors (regular users can only view instructors)
+ add and edit courses (regular users can only view courses and enroll students)

## API

The API used for this site is Flickr, used to grab and load images for the student profiles.

## Database

Tables: `users`, `students`, `parent1s`, `parent2s`, `addresses`, `instructors`, `courses`, `class_sections`, `enrollments`, `billings`, `payments`

Lookup tables: `states`, `titles`, `relationship_types`, `ethnicities`, `first_languages`, `course_sessions`, `schools`, `rooms`, `billing_types`, `payment_types`

## To be implemented
+ Auto-populate registration form when parent1 home phone and name matches one in database (parent1s with multiple students qualify for sibling discounts). Currently students can be saved to existing parent1s if the data matches, but the form does not auto-populate.
+ Create user interfaces for Courses and student Enrollment and Billing. Enrolling a student in a course should charge the tuition amount to that student's billing. From a student's billing, payments and other charges can be recorded and billing statements generated. Enrollment can be added from the student profile as well as from the course profile.
+ Maintain course sessions (e.g. Summer 2016) to easily manage current and upcoming courses
+ Class rosters/attendance, calendar for easier scheduling of courses/class sections, test/homework/quiz scores, integration with scantron OCR, student progress reports to send to parents
+ Synchronization to maintain data integrity while multiple users are active

<br><hr><br>

### Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
