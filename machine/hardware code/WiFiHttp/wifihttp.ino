/*******************************************************************
    A sample project for making a HTTP/HTTPS GET request on an ESP8266

    It will connect to the given request and print the body to
    serial monitor

    Parts:
    D1 Mini ESP8266 * - http://s.click.aliexpress.com/e/uzFUnIe

 *  * = Affilate

    If you find what I do usefuland would like to support me,
    please consider becoming a sponsor on Github
    https://github.com/sponsors/witnessmenow/


    Written by Brian Lough
    YouTube: https://www.youtube.com/brianlough
    Tindie: https://www.tindie.com/stores/brianlough/
    Twitter: https://twitter.com/witnessmenow
 *******************************************************************/

// ----------------------------
// Standard Libraries
// ----------------------------

#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <ESP8266HTTPClient.h>

//------- Replace the following! ------
char ssid[] = "Free Data";         // your network SSID (name)
char password[] = "free dataxyz"; // your network key

// For Non-HTTPS requests
// WiFiClient client;

// For HTTPS requests
WiFiClientSecure client;


// Just the base of the URL you want to connect to
#define TEST_HOST "bitstarbtrade.site"

// OPTIONAL - The fingerprint of the site you want to connect to.
//#define TEST_HOST_FINGERPRINT "89 25 60 5D 50 44 FC C0 85 2B 98 D7 D3 66 52 28 68 4D E6 E2"
// The finger print will change every few months.

void setup()
{
  pinMode(LED_BUILTIN, OUTPUT);     // Initialize the LED_BUILTIN pin as an output

  HTTPClient https;
  Serial.begin(115200);

  // Connect to the WiFI
  WiFi.mode(WIFI_STA);
  WiFi.disconnect();
  delay(100);

  // Attempt to connect to Wifi network:
  Serial.print("Connecting Wifi: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    turnLedOff();
    Serial.print(".");
    delay(500);
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  IPAddress ip = WiFi.localIP();
  Serial.println(ip);

  //--------

  // If you don't need to check the fingerprint
  client.setInsecure();

  // If you want to check the fingerprint
  //  client.setFingerprint(TEST_HOST_FINGERPRINT);

  makeHTTPRequest();
}

void onLedThenOff(int duration) {
  digitalWrite(LED_BUILTIN, LOW);   // Turn the LED on (Note that LOW is the voltage level
  delay(duration);
  digitalWrite(LED_BUILTIN, HIGH);   // Turn the LED on (Note that LOW is the voltage level
}

void offLedThenOn(int duration) {
  digitalWrite(LED_BUILTIN, HIGH);   // Turn the LED on (Note that LOW is the voltage level
  delay(duration);
  digitalWrite(LED_BUILTIN, LOW);   // Turn the LED on (Note that LOW is the voltage level
}

void turnLedOn() {
  digitalWrite(LED_BUILTIN, LOW);   // Turn the LED on (Note that LOW is the voltage level
}

void turnLedOff() {
  digitalWrite(LED_BUILTIN, HIGH);   // Turn the LED off (Note that LOW is the voltage level
}

void makeHTTPRequest()
{
  turnLedOn();
  // Opening connection to server (Use 80 as port if HTTP)
  if (!client.connect(TEST_HOST, 443))
  {
    Serial.println(F("Connection failed"));
    return;
  }

  // give the esp a breather
  yield();

  // Send HTTP request
  client.print(F("GET "));
  // This is the second half of a request (everything that comes after the base URL)
  String machineId = "23jan1690515";
  String cardId = "22401507";
  String getQuery = "?machine_id=" + machineId + "&card_id=" + cardId;

  client.print("/mikes/ssiah/machine/index.php" + getQuery); // %2C == ,

  // HTTP 1.0 is ideal as the response wont be chunked
  // But some API will return 1.1 regardless, so we need
  // to handle both.
  client.println(F(" HTTP/1.1"));

  //Headers
  client.print(F("Host: "));
  client.println(TEST_HOST);

  client.println(F("Cache-Control: no-cache"));

  if (client.println() == 0)
  {
    Serial.println(F("Failed to send request"));
    return;
  }
  //delay(100);
  // Check HTTP status
  char status[32] = {0};
  client.readBytesUntil('\r', status, sizeof(status));

  // While the client is still availble read each
  // byte and print to the serial monitor
  while (client.available())
  {
    turnLedOff();
    String line = client.readStringUntil('\n');
    if (line == "\r") {
      Serial.println("Headers received.");
      String line2 = client.readStringUntil('\n');
      Serial.println("Reply was:");
      Serial.println(line2);
      turnLedOn();
      if (line2 == 0) {
        delay(2000);
        turnLedOff();
      }
      break;
    }


    String line2 = client.readStringUntil('\n');
    //  Serial.println("==========");
    //  Serial.println(line2);
    //  Serial.println("==========");
  }
}



void loop()
{
  // put your main code here, to run repeatedly:
  //  makeHTTPRequest();
}
