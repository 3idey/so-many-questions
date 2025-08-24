# So Many Questions

A community-driven Q&A platform for comic book fans to ask, answer, and discuss their favorite stories, characters, and fan theories.

Built with Laravel 12, Blade components, Tailwind CSS v4, and Vite.

---


## Features
- Authentication: register, login, logout, profile
- Ask questions with tags
- Answer questions and mark a best answer (by question owner)
- Threaded replies to answers (comments)
- Paginated questions feed on Home
- Polished UI with Tailwind; comic background on auth and profile pages

## Tech stack
- PHP 8.2+, Laravel 12
- Blade templating and Blade components
- Tailwind CSS v4 with Vite
- MySQL/PostgreSQL/SQLite (choose via .env)

## Getting started
1) Clone and install dependencies
- PHP dependencies
  ```bash
  composer install
  ```
- JS/CSS dependencies
  ```bash
  npm install
  ```

2) Create your environment file and app key
```bash
cp .env.example .env
php artisan key:generate
```

## Environment and database
1) Configure your DB in .env (example for MySQL)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=so_many_questions
DB_USERNAME=root
DB_PASSWORD=secret
```

2) Create the database (if needed)
```sql
CREATE DATABASE so_many_questions;
```

3) Run migrations (and optionally seed)
```bash
php artisan migrate
# optionally
php artisan db:seed
```

## Run the app
Option A: Use separate terminals
```bash
php artisan serve
npm run dev
```

Option B: One command with concurrency (uses scripts in composer.json)
```bash
composer run dev
```
This starts:
- Laravel dev server
- Queue listener
- Log viewer (pail)
- Vite dev server

Then open http://127.0.0.1:8000

## Project structure (high level)
- app/Http/Controllers
  - AnswerController.php
  - CommentController.php
  - QuestionController.php
  - RegisteredUserController.php
- app/Models
  - User.php, Question.php, Answer.php, Comment.php, Tag.php
- resources/views
  - Home.blade.php
  - auth/ (login, register, profile)
  - questions/ (create, show)
  - components/ (layout, header, footer, link, button, input-section)
- resources/css/app.css (Tailwind v4 entry)
- routes/web.php
- database/migrations (users, questions, answers, comments, tags, pivot)

## Routes overview
Note: In the current setup, question routes are inside auth middleware (sign-in required to view). You can move show/index outside auth if you want public visibility.

Auth
- GET /login – show login
- POST /login – authenticate
- GET /register – show register
- POST /register – create user
- DELETE /logout – log out

Profile
- GET /profile – profile page
- PATCH /profile – update profile (requires current_password)
- DELETE /profile – delete account (requires current_password)

Questions
- GET / – Home (questions index)
- GET /questions – questions index (same data as home)
- GET /questions/create – ask a question
- POST /questions – store question
- GET /questions/{question} – show a question (with answers and replies)
- PATCH /questions/{question} – update question (stub)
- DELETE /questions/{question} – delete question (stub)

Answers
- POST /questions/{question}/answers – add an answer
- POST /questions/{question}/answers/{answer}/best – mark answer as best (question owner only)

Replies (comments)
- POST /answers/{answer}/comments – add a reply to an answer

## Models and relationships
- User
  - hasMany Question, hasMany Answer
- Question
  - belongsTo User
  - hasMany Answer
  - belongsToMany Tag
- Answer
  - belongsTo User, belongsTo Question
  - hasMany Comment
  - boolean is_best
- Comment
  - belongsTo User, belongsTo Answer
- Tag
  - belongsToMany Question

## UI components
Reusable Blade components in resources/views/components:
- layout: page wrapper with optional bgImage prop
  - We pass bgImage="images/comic-bg.jpg" on login, register, and profile for a comic background
- header, footer: document shell (includes @vite)
- link: nav link styling
- button: primary button
- input-section: label + slot + validation error helper

Home page
- Inline question form for authenticated users
- Question cards with title, snippet, tags, author, time, answers count

Question page
- Full question view with tags and body
- Answer form (+ mark best button for owner)
- Replies per answer with reply form



## License
MIT

