document.addEventListener('DOMContentLoaded', () => {

    // 1. Sidebar Toggle Logic
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });

    // 2. Tab Navigation System
    const navItems = document.querySelectorAll('.nav-links li');
    const tabContents = document.querySelectorAll('.tab-content');

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navItems.forEach(i => i.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            item.classList.add('active');
            const targetTab = item.getAttribute('data-tab');
            document.getElementById(targetTab).classList.add('active');
        });
    });

    // 3. Weather Fetching
    function loadWeather(city = '') {
        let url = 'api.php?action=weather';
        if (city) {
            url += `&city=${encodeURIComponent(city)}`;
        }

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (data.main) {
                    const temp = Math.round(data.main.temp);
                    const desc = data.weather[0].description;
                    const cityText = data.name;

                    // Update Topbar Widget
                    document.getElementById('quick-weather-widget').innerHTML = 
                        `<i class="fas fa-cloud-sun"></i> ${cityText}: <strong>${temp}°C</strong> (${desc})`;

                    // Update Detailed Weather Tab
                    document.getElementById('w-city').innerText = cityText;
                    document.getElementById('w-temp').innerText = `${temp}°C`;
                    document.getElementById('w-desc').innerText = `Condition: ${desc}`;
                    document.getElementById('w-humidity').innerText = `${data.main.humidity}%`;
                    document.getElementById('w-wind').innerText = `${data.wind.speed} m/s`;
                    document.getElementById('w-pressure').innerText = `${data.main.pressure} hPa`;
                }
            })
            .catch(err => console.error('Weather fetch error:', err));
    }

    // Geolocation fallback
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;
                fetch(`api.php?action=weather&lat=${lat}&lon=${lon}`)
                    .then(r => r.json())
                    .then(data => loadWeather(data.name || ''));
            },
            () => loadWeather() // Default search fallback
        );
    } else {
        loadWeather();
    }

    document.getElementById('search-btn').addEventListener('click', () => {
        const city = document.getElementById('city-search').value;
        if (city) loadWeather(city);
    });

    // 4. Live News Fetching
    fetch('api.php?action=news')
        .then(res => res.json())
        .then(data => {
            if (data.articles && data.articles.length > 0) {
                const newsText = data.articles.map(a => `• ${a.title} (${a.source.name})`).join(' &nbsp;&nbsp;&nbsp;&nbsp; ');
                document.getElementById('news-ticker').innerHTML = newsText;
            }
        })
        .catch(err => console.error('News fetch error:', err));

    // 5. Quick Chat UI
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');
    const chatMessages = document.getElementById('chat-messages');

    function appendMessage(text, type) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${type}`;
        msgDiv.innerHTML = `<span>${text}</span>`;
        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function handleSendMessage() {
        const text = chatInput.value.trim();
        if (!text) return;

        appendMessage(text, 'user');
        chatInput.value = '';

        // Simulated AI Bot response tailored to AgTech
        setTimeout(() => {
            let botReply = "Thanks for asking. Our precision farming system recommends monitoring soil moisture sensors before proceeding.";
            if (text.toLowerCase().includes('rain') || text.toLowerCase().includes('weather')) {
                botReply = "Please check the 'Weather & Climate' tab for live precipitation indicators before scheduling harvesting machinery.";
            } else if (text.toLowerCase().includes('fertilizer')) {
                botReply = "Variable Rate Technology recommends an N-P-K mix based on your last soil test data.";
            }
            appendMessage(botReply, 'bot');
        }, 700);
    }

    sendBtn.addEventListener('click', handleSendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSendMessage();
    });

    // 6. User Registration Form Submission
    const regForm = document.getElementById('register-form');
    regForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(regForm);
        const msgBox = document.getElementById('register-response');

        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            msgBox.style.color = data.status === 'success' ? '#2ecc71' : '#e74c3c';
            msgBox.innerText = data.message;
            if (data.status === 'success') regForm.reset();
        })
        .catch(() => {
            msgBox.style.color = '#e74c3c';
            msgBox.innerText = 'Server error occurred.';
        });
    });
});

// Modal helpers
function openModal(id) { document.getElementById(id).style.display = 'flex'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }
