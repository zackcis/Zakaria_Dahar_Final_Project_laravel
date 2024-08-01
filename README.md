# Zakaria_Dahar_Final_Project_laravel
Follow these steps to set up and run the Laravel project on your local machine.

## Prerequisites

- [Composer](https://getcomposer.org/) installed on your machine
- [Node.js and npm](https://nodejs.org/) installed on your machine
- A local database setup (e.g., MySQL)

## Installation

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd <project-directory>
2. **instalcomposer**
composer install
3. **copy enviroment file**
cp .env.example .env
4. **generate application key**
php artisan key:generate
5. **Run database migration**
php artisan migrate
6. **install npm dependencies**
npm install
7. **create storage link**
php artisan storage:link
8. **compile assets**
npm run dev
9. **Run the development server**
php artisan server
