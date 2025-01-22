# Project Report: Library Management System (LMS)

---

## Table of Contents

1. [Introduction](#1-introduction)
   - [1.1 Project Overview](#11-project-overview)
   - [1.2 Objectives](#12-objectives)
   - [1.3 Scope](#13-scope)

2. [System Architecture](#2-system-architecture)
   - [2.1 Frontend](#21-frontend)
   - [2.2 Backend](#22-backend)
   - [2.3 Database Design](#23-database-design)

3. [Technologies Used](#3-technologies-used)
   - [3.1 Frontend Technologies](#31-frontend-technologies)
   - [3.2 Backend Technologies](#32-backend-technologies)
   - [3.3 Database Technologies](#33-database-technologies)

4. [Implementation Details](#4-implementation-details)
   - [4.1 Frontend Implementation](#41-frontend-implementation)
   - [4.2 Backend Implementation](#42-backend-implementation)
   - [4.3 API Endpoints](#43-api-endpoints)
   - [4.4 Database Implementation](#44-database-implementation)

5. [Features](#5-features)
   - [5.1 User Authentication](#51-user-authentication)
   - [5.2 Book Management](#52-book-management)
   - [5.3 Author Management](#53-author-management)
   - [5.4 Category Management](#54-category-management)
   - [5.5 Loan Management](#55-loan-management)
   - [5.6 User Management](#56-user-management)

6. [Challenges Faced](#6-challenges-faced)
   - [6.1 Technical Challenges](#61-technical-challenges)
   - [6.2 Non-Technical Challenges](#62-non-technical-challenges)

7. [Future Enhancements](#7-future-enhancements)
   - [7.1 Additional Features](#71-additional-features)
   - [7.2 Scalability](#72-scalability)

8. [Conclusion](#8-conclusion)
   - [8.1 Summary](#81-summary)
   - [8.2 Learning Outcomes](#82-learning-outcomes)

9. [References](#9-references)

---

## 1. Introduction

### 1.1 Project Overview
The Library Management System (LMS) is a web-based application designed to manage the operations of a library efficiently. The system allows librarians to manage books, authors, categories, and loans, while providing users with the ability to borrow and return books. The project is divided into two main components: the frontend, built using HTML, TailwindCSS, and Vanilla JavaScript, and the backend, developed using Laravel.

### 1.2 Objectives
- To create a user-friendly interface for managing library operations.
- To implement a secure authentication system for users and administrators.
- To provide RESTful API endpoints for CRUD operations on books, authors, categories, and loans.
- To ensure the system is scalable and maintainable.

### 1.3 Scope
The scope of this project includes:
- User authentication and authorization.
- Management of books, authors, and categories.
- Handling book loans and returns.
- Providing an admin dashboard for managing users and library resources.

---

## 2. System Architecture

### 2.1 Frontend
The frontend of the LMS is built using HTML for structure, TailwindCSS for styling, and Vanilla JavaScript for interactivity. The frontend communicates with the backend via RESTful APIs.

#### Frontend Structure:
- **HTML**: The structure of the web pages is defined using HTML. Each page (e.g., books, authors, categories) has its own HTML file.
- **TailwindCSS**: TailwindCSS is used for styling the application. It provides utility classes for responsive design, making the application look good on all devices.
- **JavaScript**: Vanilla JavaScript is used for client-side interactivity. It handles form submissions, API calls, and dynamic content updates.

### 2.2 Backend
The backend is developed using Laravel, a PHP framework. It handles business logic, database interactions, and API endpoints. The backend is responsible for user authentication, data validation, and serving data to the frontend.

#### Backend Structure:
- **Controllers**: Controllers handle incoming HTTP requests and return responses. For example, the `BookController` handles requests related to books.
- **Models**: Models represent the data structures and interact with the database. For example, the `Book` model represents the `books` table in the database.
- **Middleware**: Middleware is used for authentication and authorization. For example, the `auth:sanctum` middleware ensures that only authenticated users can access certain routes.
- **Routes**: Routes define the API endpoints and map them to controllers. For example, the route `/books` maps to the `index` method in the `BookController`.

### 2.3 Database Design
The database is designed using MySQL and includes the following tables:
- **users**: Stores user information, including name, email, and password.
- **books**: Stores book details, including title, author, category, and availability status.
- **authors**: Stores author information, including name and biography.
- **categories**: Stores book categories, including name and description.
- **loans**: Stores loan records, including user ID, book ID, loan date, and return date.
- **personal_access_tokens**: Manages user authentication tokens for API access.

#### Database Schema:
```sql
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Admin','Borrower') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
);

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `author` varchar(512) DEFAULT NULL,
  `publishedYear` int(11) DEFAULT NULL,
  `genre` varchar(512) DEFAULT NULL,
  `totalCopies` int(11) DEFAULT NULL,
  `availableCopies` int(11) DEFAULT NULL,
  `coverUrl` varchar(512) DEFAULT NULL
);

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `books` varchar(512) DEFAULT NULL
);

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `books` varchar(512) DEFAULT NULL
);

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrowed_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(255) NOT NULL
);

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);
```

## 3. Technologies Used

### 3.1 Frontend Technologies
- **HTML**: For structuring the web pages.
- **TailwindCSS**: For styling and responsive design.
- **Vanilla JavaScript**: For client-side interactivity and API calls.

### 3.2 Backend Technologies
- **Laravel**: A PHP framework for backend development.
- **PHP**: Server-side scripting language.
- **MySQL**: Relational database management system.

### 3.3 Database Technologies
- **MySQL**: For storing and managing data.
- **Eloquent ORM**: For database interactions in Laravel.

---
## 4. Implementation Details

### 4.1 Frontend Implementation
The frontend is implemented using a modular approach. Each component (e.g., books, authors, categories) has its own JavaScript module, making the codebase maintainable and scalable. The frontend communicates with the backend using the Fetch API to make HTTP requests.

#### Example: Fetching Books
```javascript


export async function getBooks() {
  const response = await api.get('/books');
  return response.data;
}
```

### 4.2 Backend Implementation
The backend is implemented using Laravel's MVC architecture. Controllers handle incoming requests, models manage data logic, and views are used for rendering (though in this case, the frontend is separate). Middleware is used for authentication and authorization.

#### Example: BookController
```php
class BookController extends Controller
{
    // retunr all the books in json format
    public function index()
    {
        Log::info('Showing all books');
        $books = Book::all();
        return response()->json($books);
    }
    #This fuction return a particular book selected
    public function show(Book $book)
    {
        return response()->json($book);
    }
    #This fuction store newly added or created books in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publishedYear' => 'required|integer',
            'genre' => 'required|string|max:255',
            'totalCopies' => 'required|integer',
            'availableCopies' => 'required|integer',
            'coverUrl' => 'nullable|url',
    ]);
        $author = Author::firstOrCreate(
            ['name' => $request->input('author')],
            ['bio' => $request->input('bio', null), 'birthdate' => $request->input('birthdate', null)]
        );

        $validated['author_id'] = $author->id;

        $book = Book::create($validated);
        return response()->json($book, 201);
    }
    #This fuction update a particular selected book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'publishedYear' => 'sometimes|required|integer',
            'genre' => 'sometimes|required|string|max:255',
            'totalCopies' => 'sometimes|required|integer',
            'availableCopies' => 'sometimes|required|integer',
            'coverUrl' => 'sometimes|url',
        ]);

        $book->update($validated);
        return response()->json($book);
    }
     #This fuction deletes a selected book
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
    #This fuction is use to borrow a book if it's available (for members only)
    public function borrow(Request $request, Book $book)
    {
        $user = $request->user();

        if ($user->cannot('borrow-books')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($book->availableCopies < 1) {
            return response()->json(['message' => 'Book is not available for borrowing'], 400);
        }

        $existingLoan = Loan::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->where('status', '!=', 'Returned')
            ->first();

        if ($existingLoan) {
            return response()->json(['message' => 'You already have this book borrowed'], 400);
        }

        $book->availableCopies -= 1;
        $book->save();

        $loan = Loan::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'borrowed_date' => now(),
            'due_date' => now()->addDays(14), // 2 weeks borrowing period
            'status' => 'Borrowed',
        ]);

        return response()->json($loan, 201);
    }

    #This fuction is use to return a book (for members only)
    public function returnBook(Request $request, Book $book)
    {
        $user = $request->user();

        if ($user->cannot('return-books')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $loan = Loan::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['Borrowed', 'Overdue'])
            ->orderBy('borrowed_date', 'desc')
            ->first();

        if (is_null($loan)) {
            return response()->json(['message' => 'Book is not borrowed'], 400);
        }

        $book->availableCopies += 1;
        $book->save();

        $loan->status = 'Returned';
        // $loan->returned_date = now();
        $loan->save();

        return response()->json($loan);
    }
    
}
```
### 4.3 API Endpoints
The backend provides the following API endpoints:
- **Authentication**: `/register`, `/login`, `/logout`
- **Books**: `/books`, `/books/{book}`, `/books/{book}/borrow`, `/books/{book}/return`
- **Authors**: `/authors`, `/authors/{author}`
- **Categories**: `/categories`, `/categories/{category}`
- **Users**: `/users`, `/users/{user}`
- **Loans**: `/loans`, `/loans/{loan}`, `/loans/overdue`

### 4.4 Database Implementation
The database is implemented using MySQL. Laravel's migration system is used to create and manage database tables. Seeders are used to populate the database with initial data for testing.

#### Example: Book Migration
```php
public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->foreignId('author_id')->constrained();
        $table->foreignId('category_id')->constrained();
        $table->boolean('is_available')->default(true);
        $table->timestamps();
    });
}
```

## 5. Features

### 5.1 User Authentication
- Users can register, login, and logout.
- Authentication is handled using Laravel Sanctum for token-based authentication.

### 5.2 Book Management
- Admins can add, update, and delete books.
- Users can view available books and borrow/return them.

### 5.3 Author Management
- Admins can manage authors, including adding, updating, and deleting authors.

### 5.4 Category Management
- Admins can manage book categories, including adding and deleting categories.

### 5.5 Loan Management
- Admins can view all loans and delete loan records.
- Users can borrow and return books, and the system tracks overdue loans.

### 5.6 User Management
- Admins can manage users, including adding, updating, and deleting users.

---

## 6. Challenges Faced

### 6.1 Technical Challenges
- **API Integration**: Ensuring smooth communication between the frontend and backend was challenging, especially with error handling and data validation.
- **Authentication**: Implementing token-based authentication with Laravel Sanctum required a deep understanding of middleware and security practices.

### 6.2 Non-Technical Challenges
- **Time Management**: Balancing the project with other academic responsibilities was difficult.
- **Team Coordination**: Ensuring all team members were on the same page and meeting deadlines required effective communication.

---

## 7. Future Enhancements

### 7.1 Additional Features
- **Search and Filtering**: Implement advanced search and filtering options for books.
- **Notifications**: Add email notifications for overdue books.
- **Reports**: Generate reports on library usage and book availability.

### 7.2 Scalability
- **Microservices**: Break down the backend into microservices for better scalability.
- **Cloud Integration**: Deploy the application on cloud platforms like AWS or Azure for better performance and scalability.

---

## 8. Conclusion

### 8.1 Summary
The Library Management System (LMS) is a comprehensive solution for managing library operations. It provides a user-friendly interface for both librarians and users, with robust backend support for data management and security.

### 8.2 Learning Outcomes
- Gained hands-on experience with Laravel and RESTful API development.
- Improved skills in frontend development using TailwindCSS and Vanilla JavaScript.
- Learned the importance of proper planning and team coordination in software development.

---

