## File Management Application with Laravel

This is a simple Laravel application for managing files:

- Top area for uploading files.
- List of previously uploaded files with options to **download** and **delete**.
- Built with **Laravel** framework and **MySQL** database.

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js and NPM (for frontend assets, if needed)

### Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>
   cd files
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Copy the environment file:

   ```bash
   cp .env.example .env
   ```

4. Generate application key:

   ```bash
   php artisan key:generate
   ```

5. Configure your database in `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. Run database migrations:

   ```bash
   php artisan migrate
   ```

7. Create symbolic link for storage:

   ```bash
   php artisan storage:link
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

9. Access the application in your browser:

   - `http://localhost:8000`

### Language Support

The application supports two languages:

- **English** (default): Access at the root URL
- **Spanish**: Access at `/es` route

Language files are located in:
- `resources/lang/en/messages.php`: English translations
- `resources/lang/es/messages.php`: Spanish translations

You can switch languages using the language selector in the navigation bar.

### Features

- File upload with validation
- File listing with pagination
- File download functionality
- File deletion with confirmation
- Multi-language support (English/Spanish)
- Responsive design with Bootstrap 5

### Relevant Structure

- `app/Models/File.php`: Eloquent model for files.
- `app/Http/Controllers/FileController.php`: Controller with upload, download, and delete logic.
- `database/migrations/*create_files_table.php`: Migration for the `files` table.
- `routes/web.php`: Main application routes.
- `resources/views/layouts/app.blade.php`: Base layout.
- `resources/views/files/index.blade.php`: Main view with upload form and file listing.


