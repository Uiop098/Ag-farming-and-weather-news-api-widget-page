# 🌾 AgTech OS — Smart Farming, Weather & News Dashboard

A modular, full-stack Agricultural Information Technology Dashboard integrating real-time weather analytics, live agricultural news feeds, smart machinery tracking, fertilizer scheduling, and an AI assistant.

![Stack](https://img.shields.io/badge/Stack-PHP%20%7C%20MySQL%20%7C%20Vanilla%20JS-blue)
![API](https://img.shields.io/badge/API-OpenWeather%20%7C%20NewsAPI-orange)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 🚜 System Modules

- **🌤️ Weather & Climate Widget:** Live geolocation weather metrics (temperature, humidity, precipitation, wind speed, UV index) with OpenWeatherMap API integration.
- **📰 Farming News Feed:** Real-time curated agricultural industry news, crop market trends, and policy updates.
- **🚜 Smart Machinery & IoT Tools:** Equipment status monitoring, drone telemetry, and sensor battery/health tracking.
- **🧪 Fertilizer & Soil Insights:** Data-driven crop application recommendations and soil nutrient balance calculators.
- **🤖 Quick Assistant:** Interactive agricultural assistant for instant farming guidance.
- **🔐 User Management:** Secure PHP & MySQL authentication with registration and session handling.

---

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.0+
- MySQL 5.7+ / MariaDB
- Apache / Nginx or PHP Built-in Server

### Database Configuration
1. Import `database_setup.sql` into your MySQL server:
   ```bash
   mysql -u root -p < database_setup.sql
   ```
2. Update database credentials in `config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_user');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'agtech_db');
   ```

### Running the Application
```bash
php -S localhost:8000
```
Open `http://localhost:8000` in your web browser.

---

## 📜 License

MIT License. Maintained by **Uiop098**.
