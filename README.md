# Workout Tracker

Workout Tracker is a web application created as a university project using the Laravel framework. The main goal of the application is to allow users to plan, manage and analyze their workouts. The system is available only for authenticated users, and each user can manage only their own workout data.

## Project Description

The application allows users to create workout plans, assign exercises to workouts, define training parameters and register completed workout sessions. It also includes basic progress tracking through workout history.

The project was built with a clear MVC-based structure and an additional service layer to separate business logic from controllers.

## Main Features

### Authentication

* User registration
* User login
* Password hashing
* Logout
* Access to the application only for logged-in users
* Account activation status using `is_active`

### Muscle Groups Management

* Displaying muscle groups
* Adding new muscle groups
* Editing existing muscle groups
* Deactivating muscle groups instead of deleting them permanently

### Exercises Management

* Displaying exercises
* Adding new exercises
* Editing exercises
* Assigning exercises to muscle groups
* Searching exercises by name
* Filtering exercises by muscle group
* Deactivating exercises

### Workouts Management

* Creating workouts
* Editing workouts
* Displaying only workouts of the currently logged-in user
* Searching workouts by name
* Filtering workouts by date
* Deactivating workouts

### Assigning Exercises to Workouts

* Many-to-many relationship between workouts and exercises
* Adding exercises from the global exercise list to a user's workout
* Defining planned parameters:

  * sets
  * repetitions
  * weight
  * order number
  * notes
* Editing assigned exercise parameters
* Removing exercises from a workout

### Workout History and Progress Tracking

* Registering completed workouts
* Saving actual exercise results:

  * actual sets
  * actual repetitions
  * actual weight
  * notes
* Displaying workout history
* Filtering workout history by workout name and date
* Viewing details of completed workouts

### Dashboard

* Summary of active workouts
* Summary of completed workouts
* Number of available exercises
* List of recently added workouts
* List of recently completed workouts

## Technologies Used

* PHP
* Laravel
* MySQL
* XAMPP
* Blade templates
* Bootstrap
* HTML
* CSS

## Database Structure

The application uses the default Laravel tables for authentication and sessions:

* `users`
* `sessions`
* `password_reset_tokens`

Additional project tables:

* `muscle_groups`
* `exercises`
* `workouts`
* `workout_exercises`
* `workout_logs`
* `workout_log_exercises`

## Database Relationships

### Users and Workouts

One user can have many workouts.

```text
users 1 --- * workouts
```

### Muscle Groups and Exercises

One muscle group can have many exercises.

```text
muscle_groups 1 --- * exercises
```

### Workouts and Exercises

A workout can contain many exercises, and one exercise can be used in many workouts.

This relationship is handled by the `workout_exercises` table.

```text
workouts * --- * exercises
```

### Workouts and Workout Logs

One workout can have many completed workout logs.

```text
workouts 1 --- * workout_logs
```

### Workout Logs and Exercise Results

One workout log can contain many exercise results.

```text
workout_logs 1 --- * workout_log_exercises
```

## Application Structure

The project uses a service layer to keep controllers clean and readable.

Example structure:

```text
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php
│       ├── DashboardController.php
│       ├── ExerciseController.php
│       ├── MuscleGroupController.php
│       ├── WorkoutController.php
│       ├── WorkoutExerciseController.php
│       └── WorkoutLogController.php
│
├── Models/
│   ├── Exercise.php
│   ├── MuscleGroup.php
│   ├── User.php
│   ├── Workout.php
│   ├── WorkoutExercise.php
│   ├── WorkoutLog.php
│   └── WorkoutLogExercise.php
│
└── Services/
    ├── AuthService.php
    ├── DashboardService.php
    ├── ExerciseService.php
    ├── MuscleGroupService.php
    ├── WorkoutService.php
    ├── WorkoutExerciseService.php
    └── WorkoutLogService.php
```

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/workout-tracker.git
```

### 2. Go to the project directory

```bash
cd WorkoutTracker
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Create the `.env` file

Copy the example environment file:

```bash
copy .env.example .env
```

On Linux/macOS:

```bash
cp .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure database connection

In the `.env` file, set your database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=WorkoutTracker
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
```

### 7. Create the database

Create a MySQL database named:

```text
WorkoutTracker
```

You can do this in phpMyAdmin or by using SQL:

```sql
CREATE DATABASE WorkoutTracker CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

### 8. Import database structure

Import the provided SQL file into the `WorkoutTracker` database using phpMyAdmin.

### 9. Clear configuration cache

```bash
php artisan optimize:clear
```

### 10. Run the application

```bash
php artisan serve
```

The application should be available at:

```text
http://127.0.0.1:8000
```

## Usage

After starting the application:

1. Open the application in the browser.
2. Register a new user account.
3. Log in.
4. Add muscle groups.
5. Add exercises and assign them to muscle groups.
6. Create a workout.
7. Add exercises to the workout.
8. Register completed workouts.
9. View workout history and progress.

## Security and Validation

The application includes:

* Password hashing
* Authentication middleware
* Form validation
* Access control based on the currently logged-in user
* Protection against viewing or modifying another user's workouts
* CSRF protection in forms

## Soft Deactivation

The project uses the `is_active` column in selected tables to deactivate records instead of deleting them permanently.

This applies to:

* users
* muscle groups
* exercises
* workouts
* workout logs

The `workout_exercises` table is an exception. Removing an exercise from a workout deletes the relation from the database because it only represents the current assignment of an exercise to a workout.

## Project Purpose

This project was created for educational purposes as part of university coursework. Its main goal is to demonstrate basic Laravel application development, including authentication, CRUD operations, relational database design, validation, Blade views and service-based application logic.

## Author

Created as a university project by Maciej Kordalski.
