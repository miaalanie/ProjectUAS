#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Wire.h>
#include <Adafruit_MLX90614.h>
#include <PulseSensorPlayground.h>

// =====================
// WiFi Configuration
// =====================
const char* ssid = "Kelompok";
const char* password = "12345678";

// =====================
// Sensor
// =====================
Adafruit_MLX90614 mlx = Adafruit_MLX90614();
PulseSensorPlayground pulseSensor;

const int PulsePin = A0;
int BPM = 0;
float suhuTubuh = 0;

// =====================
// Server Config
// =====================
const char* serverUrl = "http://192.168.28.251:8080/api/sensor-readings";

// =====================
// Timer
// =====================
unsigned long previousMillis = 0;
const unsigned long interval = 3000;  // 3 detik

// =====================
// Setup
// =====================
void setup() {
  Serial.begin(9600);
  delay(100);

  // WiFi connect
  Serial.print("Menghubungkan ke WiFi");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    yield(); // biar WDT tidak reset
  }
  Serial.println("\nWiFi connected");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  // Inisialisasi sensor
  Wire.begin(D2, D1);
  if (!mlx.begin()) {
    Serial.println("❌ Gagal inisialisasi MLX90614!");
    while (true) { yield(); } // loop aman dari WDT
  }

  pulseSensor.analogInput(PulsePin);
  pulseSensor.setThreshold(550);
  pulseSensor.begin();
}

// =====================
// Main Loop
// =====================
void loop() {
  yield(); // Hindari WDT reset

  // Baca suhu
  suhuTubuh = mlx.readObjectTempC();

  // Baca BPM
  if (pulseSensor.sawStartOfBeat()) {
    BPM = pulseSensor.getBeatsPerMinute();
    Serial.print("❤️ BPM: ");
    Serial.println(BPM);
  }

  // Tampilkan suhu di Serial
  Serial.print("🌡️ Suhu: ");
  Serial.println(suhuTubuh);

  // Kirim data ke server setiap 3 detik
  unsigned long currentMillis = millis();
  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;
    if (WiFi.status() == WL_CONNECTED && BPM > 30) {
      sendDataToServer(suhuTubuh, BPM);
    }
  }
}

// =====================
// Send Data
// =====================
void sendDataToServer(float suhu, int bpm) {
  WiFiClient client;
  HTTPClient http;

  http.setTimeout(1500);  // Batas waktu 1,5 detik
  if (http.begin(client, serverUrl)) {
    http.addHeader("Content-Type", "application/json");

    String postData = "{\"suhu\": " + String(suhu, 2) + ", \"detak_jantung\": " + String(bpm) + "}";
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("✅ Response: " + response);
    } else {
      Serial.println("❌ Gagal kirim data. Code: " + String(httpResponseCode));
    }
    http.end();
  } else {
    Serial.println("❌ Gagal mulai koneksi HTTP");
  }
}
