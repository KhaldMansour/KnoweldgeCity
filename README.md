 
# Backend API for Course and Category Management

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Database Setup](#database-setup)
- [Migrations](#migrations)
- [Seeding](#seeders)
- [API Endpoints](#api-endpoints)
- [Code Structure](#code-structure)
- [Contributing](#contributing)
- [License](#license)

---

## Introduction

This is the backend API for a course and category management system written in PHP native. The API is designed to handle course and category data, including retrieval, creation, and categorization of courses. The API follows **PSR-12** standards for code structure and formatting.

---

## Installation

Follow these steps to install and run the backend API.

### 1. Clone the repository:

```bash
git clone <repository-url>
cd <repository-directory>
```

###  2. Install dependencies:
Ensure you have PHP 8.x installed. Install dependencies using Composer:

```bash
composer install
```


###  3. Environment Configuration
Create a .env file in the root directory. Here's an example of what it should contain:

```bash
DB_HOST=127.0.0.1
DB_NAME=course_management
DB_USER=root
DB_PASSWORD=root
DB_PORT=3306
```

###  4. Database Setup
The application uses MySQL for data storage. Below are the tables for courses and categories, with a maximum category depth of 4.

Create the Database
Run the following command to create the database:
```bash
CREATE DATABASE course_management;
```

###  5. Migrations
The database migrations are stored in the /database/migrations folder. Each migration is a SQL file that modifies the database schema.

To run the migrations:

1. Make sure the database configuration in the .env file is correct.
2. Execute the migrations manually by running the following command: 

```bash
composer migrate;
```

###  6. Seeding
The database seeders are stored in the /database/seeders folder. Each seeder convert a kson file with its data to be stored in the database.

To run the seeders:

Execute the seeders manually by running the following command: 

```bash
composer seed;
```

###  7. API Endpoints
The following endpoints are available:

``` GET /api/categories ```
Retrieves a list of all categories, including nested child categories.

Response:

```
[
    {
        "id": "uuid",
        "name": "Technology",
        "parent": null,
        "course_count": 10
    },
    {
        "id": "uuid",
        "name": "Software Development",
        "parent": "uuid_of_parent_category",
        "course_count": 5
    }
]
```

``` GET /api/categories/{id} ```
Retrieves a list of all categories, including nested child categories.

Response:

```
[
    {
        "id": "uuid",
        "name": "Technology",
        "parent": null,
        "course_count": 10
    }
]
```

``` GET /api/courses ```
Retrieves a list of all courses.

Response:

```
[
    {
        "id": "uuid",
        "name": "Introduction to PHP",
        "category": "Technology"
    },
    {
        "id": "uuid",
        "name": "Advanced JavaScript",
        "category": "Software Development"
    }
]
```

``` GET /api/courses/{id} ```
Retrieves a list of all courses.

Response:

```
[
    {
        "id": "uuid",
        "name": "Introduction to PHP",
        "category": "Technology"
    }
]
```

###  8. Code Structure
The backend code is organized as follows:

```
/config
    database.php                      - Database configuration.
/data
    categories.json                   - Json data to categories to be seeded
    course_list.json                  - Json data to courses to be seeded
/routes
    api.php                   - Defines all the routes for the API.
/src/
    /Http
        /Controllers
            CourseController.php      - Handles course-related requests.
            CategoryController.php    - Handles category-related requests.
        /Services
            CourseService.php         - Business logic related to courses.
            CategoryService.php       - Business logic related to categories.
        /Support
            helpers.php               - App utility functions.
    /Database
        /Migrations
            categories.sql            - Sql file.
            courses.sql               - Sql file.
            MigrationRunner.php       - Prepares the sql files to be executed
        /Seeders
            CategoriesSeeder.php      - Seeds the courses
            CoursesSeeder.php         - Seeds the courses
        Connection.php                - Opens the connection to the database
```
###  9. Contributing

We welcome contributions to this project. If you'd like to contribute, please fork the repository and submit a pull request with your changes.

Ensure that all code adheres to PSR-12 coding standards and that any SQL queries are optimized for performance.

To ensure following PSR-12 coding standards run the following command:
```
composer cs-fix
```

###  10. License
This project is licensed under the MIT License.


