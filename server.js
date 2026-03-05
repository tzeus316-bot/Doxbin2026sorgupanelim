const express = require('express');
const axios = require('axios');
const cors = require('cors');
const app = express();

// Tüm CORS'ları aç
app.use(cors({
    origin: '*',
    methods: ['GET', 'POST', 'OPTIONS'],
    allowedHeaders: ['*']
}));

// OPTIONS isteklerine yanıt ver
app.options('*', cors());

// User-Agent havuzu
const USER_AGENTS = [
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36',
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 Safari/605.1.15',
    'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Mobile/15E148 Safari/604.1',
    'Mozilla/5.0 (Linux; Android 13; SM-S918B) AppleWebKit/537.36 Chrome/120.0.6099.210 Mobile Safari/537.36'
];

// Ana proxy endpoint'i
app.get('/proxy', async (req, res) => {
    try {
        const { url } = req.query;
        if (!url) {
            return res.status(400).json({ error: 'URL gerekli' });
        }

        console.log(`🔄 İstek: ${decodeURIComponent(url)}`);

        // Rastgele User-Agent seç
        const userAgent = USER_AGENTS[Math.floor(Math.random() * USER_AGENTS.length)];

        // API'ye istek gönder
        const response = await axios.get(decodeURIComponent(url), {
            headers: {
                'User-Agent': userAgent,
                'Accept': 'application/json',
                'Accept-Language': 'tr-TR,tr;q=0.9,en;q=0.8',
                'Connection': 'keep-alive'
            },
            timeout: 15000
        });

        // Başarılı yanıt
        res.json(response.data);

    } catch (error) {
        console.error('❌ Hata:', error.message);

        // Detaylı hata mesajı
        res.status(500).json({
            error: 'API bağlantı hatası',
            details: error.message,
            status: error.response?.status || 500
        });
    }
});

// Sağlık kontrolü
app.get('/health', (req, res) => {
    res.json({ 
        status: 'OK', 
        time: new Date().toISOString(),
        message: 'Proxy sunucu çalışıyor'
    });
});

// Ana sayfa
app.get('/', (req, res) => {
    res.json({
        name: 'ULTRA PROXY SERVER',
        version: '2.0',
        endpoints: {
            proxy: '/proxy?url=ENCODE_URL',
            health: '/health'
        },
        status: 'active'
    });
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`🚀 Proxy sunucu ${PORT} portunda çalışıyor`);
});
