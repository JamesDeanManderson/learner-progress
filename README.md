# Learner Progress Dashboard - Coding Challenge

## Getting Started

### Prerequisites

Before you begin, ensure you have the following installed on your Linux machine:

- **PHP** >= 8.2 
- **Composer**
- **MySQL** or **PostgreSQL** or **SQLite**
- **npm**
- **Git**

### Installation Steps

1. **Clone or download the project**
   ```bash
   git clone https://github.com/JamesDeanManderson/learner-progress.git
   cd learner-progress
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Set up environment configuration**
   ```bash
   cp .env.example .env
   ```
5. **Configure database connection in `.env`**
   ```bash
   Use `sqlite`, `mysql`, or `pgsql` for `DB_CONNECTION`
   ```

6. **Generate application key**
   ```bash
   php artisan key:generate
   ```

7. **Run database migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```
   
   For development with hot reload:
   ```bash
   npm run dev
   ```

9. **Start the Laravel development server**
    
    In a new terminal window:
    ```bash
    php artisan serve
    ```
    
    The application will be available at: `http://localhost:8000`

### Accessing the Application

Once the server is running, open your browser and navigate to:

```
http://localhost:8000/learner-progress
```

You should see the Learner Progress Dashboard with sample data showing learners, their enrolled courses, and progress percentages.

### Features

- View all learners with their enrolled courses and progress
- Filter by specific course
- Sort learners by average progress (ascending/descending)
- Responsive design with dark mode support
- Server-side rendering (no JavaScript required)