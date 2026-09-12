<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Farming IT Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- TOP INFORMATION BAR -->
    <header class="top-bar">
        <div class="top-bar-left">
            <button id="sidebar-toggle" class="icon-btn"><i class="fas fa-bars"></i></button>
            <span class="brand-title"><i class="fas fa-leaf"></i> AgTech OS</span>
        </div>
        <div class="top-bar-center">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="city-search" placeholder="Search farm location weather...">
                <button id="search-btn">Search</button>
            </div>
        </div>
        <div class="top-bar-right">
            <div id="quick-weather-widget" class="quick-weather">
                <i class="fas fa-sun"></i> Loading weather...
            </div>
            <button class="btn-primary" onclick="openModal('register-modal')"><i class="fas fa-user-plus"></i> Register</button>
        </div>
    </header>

    <div class="app-container">
        <!-- SIDEBAR NAVIGATION -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3>Navigation</h3>
            </div>
            <ul class="nav-links">
                <li class="active" data-tab="overview"><i class="fas fa-chart-line"></i> <span>Overview</span></li>
                <li data-tab="machinery"><i class="fas fa-tractor"></i> <span>Machines & Tools</span></li>
                <li data-tab="fertilizer"><i class="fas fa-flask"></i> <span>Fertilizers & Soil</span></li>
                <li data-tab="weather-page"><i class="fas fa-cloud-sun-rain"></i> <span>Weather & Climate</span></li>
                <li data-tab="chat-page"><i class="fas fa-comments"></i> <span>Quick Chat AI</span></li>
                <li data-tab="management"><i class="fas fa-calculator"></i> <span>Profit/Loss & Workers</span></li>
            </ul>
            <div class="sidebar-widget">
                <h4>Season Status</h4>
                <p><i class="fas fa-calendar-alt"></i> Season: <strong>Kharif / Monsoon</strong></p>
                <p><i class="fas fa-clock"></i> Optimal Planting window open</p>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            
            <!-- TAB: OVERVIEW -->
            <section id="overview" class="tab-content active">
                <div class="page-title">
                    <h2>Farming Information Technology Overview</h2>
                    <p>Integrating modern IT systems, robotics, data analysis, and climate sensors for precision agriculture.</p>
                </div>

                <div class="grid-cards">
                    <div class="info-card hover-effect">
                        <div class="card-icon"><i class="fas fa-robot"></i></div>
                        <h3>1. Modern Machinery</h3>
                        <p>Autonomous tractors, GPS yield mapping, and automated harvesters configured for maximum efficiency.</p>
                    </div>
                    <div class="info-card hover-effect">
                        <div class="card-icon"><i class="fas fa-tools"></i></div>
                        <h3>2. Smart Tools</h3>
                        <p>IoT field sensors, handheld soil testers, and aerial drone sprayers connected directly to cloud dashboards.</p>
                    </div>
                    <div class="info-card hover-effect">
                        <div class="card-icon"><i class="fas fa-seedling"></i></div>
                        <h3>3. Fertilizer Optimization</h3>
                        <p>Variable rate technology (VRT) that applies precise nitrogen, phosphorus, and potassium based on soil data.</p>
                    </div>
                    <div class="info-card hover-effect">
                        <div class="card-icon"><i class="fas fa-microchip"></i></div>
                        <h3>4. Process Automation</h3>
                        <p>End-to-end management systems linking sowing schedules, irrigation cycles, and supply chain logistics.</p>
                    </div>
                </div>
            </section>

            <!-- TAB: MACHINERY & TOOLS -->
            <section id="machinery" class="tab-content">
                <h2>Machines & Smart Tools</h2>
                <div class="grid-cards">
                    <div class="info-card hover-effect">
                        <h3>Drone Crop Sprayers</h3>
                        <p><strong>Function:</strong> Targeted chemical/fertilizer spraying with 90% water saving.</p>
                        <p><strong>Tech Skill:</strong> Telemetry flight planning, remote sensing data analytics.</p>
                    </div>
                    <div class="info-card hover-effect">
                        <h3>IoT Soil Probes</h3>
                        <p><strong>Function:</strong> Real-time monitoring of moisture, pH, temperature, and electrical conductivity.</p>
                        <p><strong>Tech Skill:</strong> Wireless sensor network setup, micro-controller management.</p>
                    </div>
                </div>
            </section>

            <!-- TAB: FERTILIZER & PROCESS -->
            <section id="fertilizer" class="tab-content">
                <h2>Fertilizer & Soil Systems</h2>
                <div class="info-card hover-effect">
                    <h3>Soil Nutrition Algorithm</h3>
                    <p>Utilize algorithmic fertilizer planning to prevent over-fertilization, reduce cost, and protect soil biodiversity.</p>
                </div>
            </section>

            <!-- TAB: WEATHER & CLIMATE -->
            <section id="weather-page" class="tab-content">
                <h2>Weather & Climate Analytics</h2>
                <div class="weather-detail-grid">
                    <div class="info-card weather-main-card hover-effect">
                        <h3 id="w-city">Detecting Location...</h3>
                        <h1 id="w-temp">--°C</h1>
                        <p id="w-desc">Condition: --</p>
                        <div class="weather-metrics">
                            <span><i class="fas fa-tint"></i> Humidity: <strong id="w-humidity">--%</strong></span>
                            <span><i class="fas fa-wind"></i> Wind: <strong id="w-wind">-- m/s</strong></span>
                            <span><i class="fas fa-compress-arrows-alt"></i> Pressure: <strong id="w-pressure">-- hPa</strong></span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TAB: QUICK CHAT (UB DASHBOARD STYLE) -->
            <section id="chat-page" class="tab-content">
                <h2>AgTech Quick Assist Chat</h2>
                <div class="chat-container">
                    <div class="chat-messages" id="chat-messages">
                        <div class="message system">
                            <span>Welcome to Quick Assistant! Ask questions regarding weather forecasts, machinery maintenance, or crop scheduling.</span>
                        </div>
                    </div>
                    <div class="chat-input-area">
                        <input type="text" id="chat-input" placeholder="Ask a question (e.g., How to handle rain during harvest?)...">
                        <button id="send-btn"><i class="fas fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </section>

            <!-- TAB: MANAGEMENT -->
            <section id="management" class="tab-content">
                <h2>Farm Management & Profitability</h2>
                <div class="grid-cards">
                    <div class="info-card hover-effect">
                        <h3>Worker & Labor Allocation</h3>
                        <p>Track field hands, automated machine hours, and skill development programs.</p>
                    </div>
                    <div class="info-card hover-effect">
                        <h3>Profit & Loss Estimator</h3>
                        <p>Calculates expected yield return against fertilizer, fuel, seed, and IT maintenance overhead.</p>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- BOTTOM FUNCTIONAL NEWS BAR -->
    <footer class="bottom-bar">
        <div class="news-label"><i class="fas fa-newspaper"></i> Live Farming News:</div>
        <div class="news-ticker" id="news-ticker">
            <span>Loading latest agricultural technology news updates...</span>
        </div>
    </footer>

    <!-- REGISTRATION MODAL -->
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('register-modal')">&times;</span>
            <h2>Register for AgTech OS</h2>
            <form id="register-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required minlength="3">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required minlength="8">
                </div>
                <button type="submit" class="btn-primary">Complete Registration</button>
                <div id="register-response" class="form-msg"></div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
