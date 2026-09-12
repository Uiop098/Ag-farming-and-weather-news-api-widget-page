# Farming Information Technology (AgTech) Web Application

A responsive, modular, and secure web interface for managing agricultural technology, smart machinery, fertilizer scheduling, weather insights, and dynamic farming news.

---

## Features
- **Top Bar**: Search farm location, display dynamic weather quick-widget, and user auth modal.
- **Collapsible Sidebar**: Seamless navigation between functional tabs.
- **Dynamic Tabs**:
  - **Overview**: Key technology breakdowns with CSS hover effects.
  - **Machinery & Tools**: Drone and sensor technical skill metrics.
  - **Fertilizers & Soil**: Algorithm-based application insights.
  - **Weather & Climate**: Geolocation and API-integrated weather metrics.
  - **Quick Chat**: Dynamic AI assistant inspired by UB Dashboard.
  - **Management**: Profit/loss estimation & labor tracking.
- **Bottom Functional Bar**: Real-time news ticker with AgTech news.
- **Secure Backend**: PHP registration handler powered by PDO, input validation, and Argon2id password hashing.

---

## Installation & Setup Instructions

### 1. Database Setup (MySQL)
Run the following SQL in your MySQL database (e.g., via phpMyAdmin):

```sql
CREATE DATABASE IF NOT EXISTS farming_tech_db;
USE farming_tech_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Configure Credentials (`config.php`)
Open `config.php` and update your database credentials and optional API keys:
- `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`
- `WEATHER_API_KEY`: Get a free key from [OpenWeatherMap](https://openweathermap.org/api).
- `NEWS_API_KEY`: Get a free key from [NewsAPI](https://newsapi.org/).

*(Note: If no API keys are entered, the system automatically runs in high-quality fallback demo mode!)*

## Security Implementation
1. **SQL Injection Prevention**: Uses PDO Prepared Statements with emulation disabled.
2. **Password Security**: Stores passwords using modern `PASSWORD_ARGON2ID` hashing algorithms.
3. **API Key Isolation**: External API requests are proxied via `api.php` so secret keys are never exposed in client JavaScript code.
4. **XSS Protection**: Inputs are sanitized with `FILTER_SANITIZE_SPECIAL_CHARS` and HTML escaping.
5. **Security Headers**: Includes `X-Frame-Options`, `X-Content-Type-Options`, and `X-XSS-Protection` headers.
