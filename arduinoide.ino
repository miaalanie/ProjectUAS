// #include <ESP8266WiFi.h>
// #include <ESP8266HTTPClient.h>
// #include <WiFiClient.h>
// #include <Adafruit_MLX90640.h>

// const char* ssid = "mia";
// const char* password = "gaadapassword";

// const char* serverName = "http://192.168.43.251:8000/api/sensor-readings"; // Laravel API
// const int pulsePin = 34; // analog pin untuk pulse (A0 di ESP32)

// Adafruit_MLX90640 mlx;

// void setup() {
//   Serial.begin(115200);

//   WiFi.begin(ssid, password);
//   while (WiFi.status() != WL_CONNECTED) {
//     delay(500);
//     Serial.print(".");
//   }
//   Serial.println("WiFi Connected");

//   Wire.begin();
//   if (!mlx.begin()) {
//     Serial.println("MLX90640 not found!");
//     while (1);
//   }
//   mlx.setMode(MLX90640_CHESS);
//   mlx.setResolution(MLX90640_ADC_18BIT);
//   mlx.setRefreshRate(MLX90640_4_HZ);
// }

// void loop() {
//   // 1. Baca suhu dari MLX90641
//   float frame[32 * 24]; // 768
//   float suhu = 0;
//   if (mlx.getFrame(frame) != 0) {
//     Serial.println("Failed to read from MLX90641");
//   } else {
//     float total = 0;
//     for (int i = 0; i < 768; i++) {
//       total += frame[i];
//     }
//     suhu = total / 768.0; // ambil rata-rata suhu seluruh area
//   }

//   // 2. Baca detak jantung dari pulse sensor analog
//   int detakAnalog = analogRead(pulsePin);
//   int detak_jantung = map(detakAnalog, 0, 4095, 60, 120); // kira2 konversi ke bpm kasar

//   Serial.print("Suhu: "); Serial.print(suhu);
//   Serial.print(" | Detak: "); Serial.println(detak_jantung);

//   // 3. Kirim ke Laravel API
//   if (WiFi.status() == WL_CONNECTED) {
//     HTTPClient http;
//     http.begin(serverName);
//     http.addHeader("Content-Type", "application/json");

//     String jsonData = "{\"user_id\":1, \"suhu\":" + String(suhu, 2) + ", \"detak_jantung\":" + String(detak_jantung) + "}";
//     int httpResponseCode = http.POST(jsonData);

//     Serial.print("Response Code: ");
//     Serial.println(httpResponseCode);
//     if (httpResponseCode > 0) {
//       String response = http.getString();
//       Serial.println(response);
//     }

//     http.end();
//   }

//   delay(10000); // kirim setiap 10 detik
// }

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid = "mia";
const char* password = "gadaadapassword";

const int potPin = A0;      // Simulasi suhu
const int pulsePin = D1;    // Simulasi detak jantung

const char* serverUrl = "http://192.168.43.251:8000/api/sensor-readings";

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    int potValue = analogRead(potPin);
    float suhu = map(potValue, 0, 1023, 30, 42);  // konversi nilai ke suhu

    int pulseValue = analogRead(pulsePin);
    int detak = map(pulseValue, 0, 1023, 60, 120); // konversi ke bpm

    Serial.print("Suhu: "); Serial.print(suhu);
    Serial.print(" | Detak: "); Serial.println(detak);

    WiFiClient client;
    HTTPClient http;

    http.begin(client, serverUrl);
    http.addHeader("Content-Type", "application/json");
    http.addHeader("Accept", "application/json");

    // Buat format JSON yang sesuai dengan Laravel
    String httpRequestData = "{\"user_id\":1, \"suhu\":" + String(suhu, 2) +
                             ", \"detak_jantung\":" + String(detak) + "}";

    int httpResponseCode = http.POST(httpRequestData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.print("Error on sending POST: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  }

  delay(5000); // kirim tiap 5 detik
}
