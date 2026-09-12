<?php
require_once 'config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'weather':
        $lat = $_GET['lat'] ?? '18.1522';
        $lon = $_GET['lon'] ?? '74.5772';
        $city = $_GET['city'] ?? '';

        if (!empty($city)) {
            $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&units=metric&appid=" . WEATHER_API_KEY;
        } else {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid=" . WEATHER_API_KEY;
        }

        // Fallback demo weather if no API Key configured
        if (WEATHER_API_KEY === 'YOUR_OPENWEATHERMAP_API_KEY') {
            echo json_encode([
                'name' => $city ? ucfirst($city) : 'Baramati / Local Farm',
                'main' => ['temp' => 29.5, 'humidity' => 58, 'pressure' => 1010],
                'weather' => [['description' => 'Scattered Clouds', 'icon' => '03d']],
                'wind' => ['speed' => 4.2],
                'demo_mode' => true
            ]);
            exit;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        break;

    case 'news':
        // Fetch Agriculture & Farming Tech News
        if (NEWS_API_KEY === 'YOUR_NEWSAPI_KEY') {
            // High quality fallback farming tech news
            echo json_encode([
                'status' => 'ok',
                'articles' => [
                    ['title' => 'AI-Powered Precision Drones Boost Crop Yields by 25%', 'source' => ['name' => 'AgTech Daily'], 'url' => '#'],
                    ['title' => 'Smart IoT Irrigation Sensors Reduce Water Usage in Seasonal Crops', 'source' => ['name' => 'Farming Times'], 'url' => '#'],
                    ['title' => 'Next-Gen Organic Fertilizers Optimizing Soil Nitrogen Levels', 'source' => ['name' => 'EcoFarmer'], 'url' => '#']
                ],
                'demo_mode' => true
            ]);
            exit;
        }

        $newsUrl = "https://newsapi.org/v2/everything?q=agriculture+technology+farming&sortBy=publishedAt&pageSize=5&apiKey=" . NEWS_API_KEY;
        $ch = curl_init($newsUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'FarmingTechApp');
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        break;

    default:
        echo json_encode(['error' => 'Invalid API Action']);
        break;
}
?>