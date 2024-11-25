```mermaid
flowchart TD
    subgraph Hardware
        ESP32
        SensorFlow[Sensor Flow Meter]
        LEDDisplay[LED Display]
    end

    subgraph Software
        FirmwareESP32[ESP32 Firmware]
        ServerPHP[Server PHP]
        DatabaseMySQL[Database MySQL]
        WebsiteHTMLPHP[Website HTML/PHP]
    end

    SensorFlow --> ESP32
    ESP32 -->|Baca data flow| FirmwareESP32
    FirmwareESP32 -->|Kirim data| ServerPHP
    ServerPHP -->|Simpan data| DatabaseMySQL
    WebsiteHTMLPHP -->|Ambil data| DatabaseMySQL
    WebsiteHTMLPHP -->|Tampilkan data| Browser
    WebsiteHTMLPHP -->|Animasi turbin| Browser

    subgraph Browser
        Website[Website Display]
        Turbine[SVG Turbine]
    end

    Website --> Turbine
