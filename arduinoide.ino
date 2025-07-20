#include <Wire.h>                // Buat komunikasi I2C (MLX)
#include <Adafruit_MLX90614.h>  // Buat sensor suhu
#include <PulseSensorPlayground.h>  // Buat sensor detak jantung

Adafruit_MLX90614 mlx = Adafruit_MLX90614();
PulseSensorPlayground pulseSensor;

const int PulsePin = A0;  // Pin analog buat pulse sensor
int BPM;

void setup() {
  Serial.begin(9600);
  
  // Inisialisasi sensor suhu
  mlx.begin();
  
  // Konfigurasi pulse sensor
  pulseSensor.analogInput(PulsePin);
  pulseSensor.setThreshold(550);
  pulseSensor.begin();
}

void loop() {
  // Baca suhu
  float suhuTubuh = mlx.readObjectTempC();
  Serial.print("Suhu Tubuh: ");
  Serial.print(suhuTubuh);
  Serial.println(" °C");

  // Baca detak jantung
  if (pulseSensor.sawStartOfBeat()) {
    BPM = pulseSensor.getBeatsPerMinute();

    // Tampilkan di Serial Monitor
    Serial.print("❤️ Detak Jantung: ");
    Serial.print(BPM);
    Serial.println(" BPM");
  }

  

  delay(500);  // jeda biar bacaan gak terlalu cepat
}



// =====================
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h> 
#include <Wire.h>
#include <Adafruit_MLX90614.h>
#include <PulseSensorPlayground.h>

const char* ssid = "cipp";
const char* password = "12345678";

Adafruit_MLX90614 mlx = Adafruit_MLX90614();
PulseSensorPlayground pulseSensor;

const int PulsePin = A0;
int BPM = 0;

const char* serverUrl = "http://10.157.33.251:8080/api/sensor-readings";

void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi connected");

  Wire.begin(D2, D1);  // <- WAJIB untuk MLX90614
  if (!mlx.begin()) {
    Serial.println("❌ Gagal inisialisasi MLX90614!");
    while (true);
  }

  pulseSensor.analogInput(PulsePin);
  pulseSensor.setThreshold(550);
  pulseSensor.begin();
}


void loop() {
  float suhuTubuh = mlx.readObjectTempC();

  if (pulseSensor.sawStartOfBeat()) {
    BPM = pulseSensor.getBeatsPerMinute();
    Serial.print("❤️ BPM: ");
    Serial.println(BPM);
  }

  Serial.print("🌡️ Suhu: ");
  Serial.println(suhuTubuh);

  if (WiFi.status() == WL_CONNECTED && BPM > 30) {
    WiFiClient client;
    HTTPClient http;

    http.begin(client, serverUrl);
    http.setTimeout(2000);
    http.addHeader("Content-Type", "application/json");

    String postData = "{\"suhu\": " + String(suhuTubuh, 2) + ", \"detak_jantung\": " + String(BPM) + "}";
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("✅ Response: " + response);
    } else {
      Serial.println("❌ Gagal kirim data. Code: " + String(httpResponseCode));
    }

    http.end();
  }

  delay(3000);
}


//------------------------------------
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h> // Untuk bikin web server kecil

const char* ssid = "Wildan";
const char* password = "12345678";

// Gunakan WebServer di port 80 (default HTTP)
ESP8266WebServer server(80);

// Pin D1–D8, sesuai urutan LED
int ledPins[] = {D1, D2, D3, D4, D5, D6, D7, D8};
const int jumlahLED = 8;

void setup() {
  Serial.begin(115200);

  // Inisialisasi semua pin LED sebagai output
  for (int i = 0; i < jumlahLED; i++) {
    pinMode(ledPins[i], OUTPUT);
    digitalWrite(ledPins[i], LOW); // Semua LED mati dulu
  }

  // Connect ke WiFi
  WiFi.begin(ssid, password);
  Serial.print("Menghubungkan ke WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nWiFi terhubung!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());  // <<< CATAT IP INI BUAT AKSES DARI FRONTEND

  // Handle request ke /led?id=...
  server.on("/led", handleLedRequest);

  server.begin();
  Serial.println("Server dimulai...");
}

void loop() {
  server.handleClient(); // Tunggu request dari browser/frontend
}

void handleLedRequest() {
  // Cek apakah ada parameter ?id=...
  if (server.hasArg("id")) {
    int id = server.arg("id").toInt();

    // Reset semua LED
    for (int i = 0; i < jumlahLED; i++) {
      digitalWrite(ledPins[i], LOW);
    }

    // Nyalakan LED sesuai ID
    if (id >= 1 && id <= jumlahLED) {
      digitalWrite(ledPins[id - 1], HIGH); // index dimulai dari 0
      Serial.print("LED ID ");
      Serial.print(id);
      Serial.println(" dinyalakan!");
      server.send(200, "text/plain", "LED dinyalakan!");
    } else {
      server.send(400, "text/plain", "ID tidak valid (1–8)");
    }
  } else {
    server.send(400, "text/plain", "Parameter 'id' tidak ditemukan");
  }
}
