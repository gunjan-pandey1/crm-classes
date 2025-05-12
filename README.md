# BeUnique Classes CRM

A modern CRM system built with Laravel and React, specifically designed for managing educational classes and student interactions.

# Security Measures in Loan Management System (Laravel & React)

This document outlines the key security measures implemented in this loan management system built with Laravel 12 (backend) and React (frontend).

## 1. SQL Injection Prevention (Laravel Backend)

This application leverages Laravel's built-in Eloquent ORM and query builder for all database interactions. These tools inherently protect against SQL injection by using parameterized queries and automatically escaping user-provided input.

**Implementation:**

* **Eloquent ORM and Query Builder:** All database queries are constructed using Laravel's secure database abstraction layers.
* **Avoidance of Raw SQL:** Raw SQL queries using `DB::raw()` are minimized. When necessary, query bindings (`?`) are used to pass user input, allowing PDO to handle proper escaping.

## 2. CSRF (Cross-Site Request Forgery) Protection (Laravel Backend & React Frontend)

CSRF protection prevents attackers from tricking authenticated users into performing unintended actions.

**Implementation:**

* **Laravel Backend:** The `\App\Http\Middleware\VerifyCsrfToken` middleware is enabled to generate and validate CSRF tokens for each session.
* **React Frontend:**
    * The CSRF token is obtained from the Laravel backend (either via a meta tag in the initial HTML or a dedicated API endpoint).
    * For every non-GET request (POST, PUT, DELETE, etc.) sent to the Laravel API, the CSRF token is included in the request headers (as `X-CSRF-TOKEN`) using an HTTP client like `axios`.

## 3. Session Management (Laravel Backend)

Secure session management ensures that user authentication is maintained safely.

**Implementation:**

* **Laravel's Built-in Session Handling:** Laravel's default session management, which uses secure, encrypted cookies, is utilized.
* **Session Configuration (`config/session.php`):** The session configuration is reviewed and set with security in mind:
    * `driver`: Set to a secure driver (default `cookie` is suitable).
    * `lifetime`: Configured for an appropriate session duration.
    * `expire_on_close`: Set based on the desired session behavior.
    * `encrypt`: Always enabled to encrypt session data.
    * `same_site`: Configured (e.g., `lax`, `strict`) to mitigate CSRF-like attacks.
    * `http_only`: Enabled to prevent client-side JavaScript access to session cookies (mitigating XSS).
    * `secure`: Enabled to ensure cookies are only transmitted over HTTPS.
* **API Authentication (Laravel Sanctum):** Laravel Sanctum is used for authenticating API requests from the React frontend after the initial login. Sanctum provides a lightweight token-based authentication system.

## 4. Input Validation and Sanitization (Laravel Backend)

Robust input validation prevents unexpected or malicious data from being processed.

**Implementation:**

* **Laravel Validation:** Laravel's powerful validation system is used extensively in request classes and controllers to define and enforce validation rules for all user inputs.
* **Output Encoding (Blade):** When displaying dynamic data in any server-rendered Blade views (if applicable), the `{{ }}` syntax is used for automatic output escaping to prevent XSS.
* **React Security:** In the React frontend, care is taken to avoid using `dangerouslySetInnerHTML` with untrusted data.

## 5. Error Handling and Logging (Laravel Backend)

Preventing information disclosure through error messages and maintaining a record of important events.

**Implementation:**

* Detailed error messages are disabled in the production environment to prevent the exposure of sensitive information.
* Errors and security-related events (e.g., failed login attempts, authorization failures) are logged securely for debugging and auditing purposes.

## Features

- **User Authentication & Authorization**
  - Secure login/registration system
  - Password reset functionality
  - Email verification
  - Profile management

- **Dashboard**
  - Interactive dashboard with date range filters
  - Overview of key metrics and activities

- **Core CRM Features**
  - Lead Management
  - Contact Management
  - Course Management
  - Activity Tracking
  - Email Communication
  - Quote Generation

- **Settings & Configuration**
  - Profile Settings
  - Password Management
  - Appearance Customization (Light/Dark/System Theme)
  - System Configuration

## Tech Stack

- **Frontend**
  - React
  - TypeScript
  - Tailwind CSS
  - Headless UI Components
  - Lucide Icons
  - Inertia.js

- **Backend**
  - Laravel
  - MySQL/PostgreSQL

## Getting Started

1. Clone the repository
2. Install dependencies:
```bash
npm install
composer install