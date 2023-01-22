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
#include <SPI.h>
#include <MFRC522.h>

#define RST_PIN D3 // Configurable, see typical pin layout above
#define SS_PIN D4  // Configurable, see typical pin layout above

#define YELLOW_LED D1
#define BLUE_LED D2
#define RED_LED D8
#define GREEN_LED D0
#define BUZZER A0

MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance

//------- Replace the following! ------
char ssid[] = "Free Data";        // your network SSID (name)
char password[] = "free dataxyz"; // your network key

// For Non-HTTPS requests
// WiFiClient client;

// For HTTPS requests
WiFiClientSecure client;

// Just the base of the URL you want to connect to
#define TEST_HOST "bitstarbtrade.site"

// OPTIONAL - The fingerprint of the site you want to connect to.
// #define TEST_HOST_FINGERPRINT "89 25 60 5D 50 44 FC C0 85 2B 98 D7 D3 66 52 28 68 4D E6 E2"
// The finger print will change every few months.

void setup()
{
  pinMode(YELLOW_LED, OUTPUT); // Initialize the pin as an output
  pinMode(BLUE_LED, OUTPUT);   // Initialize the pin as an output
  pinMode(RED_LED, OUTPUT);    // Initialize the pin as an output
  pinMode(GREEN_LED, OUTPUT);  // Initialize the pin as an output
//  pinMode(BUZZER, OUTPUT);     // Initialize the pin as an output

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
  turnItAllOff();
  while (WiFi.status() != WL_CONNECTED)
  {
    onLedThenOff(YELLOW_LED, 500);
    Serial.print(".");
    delay(500);
  }
  
  turnLedOn(YELLOW_LED);
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

  // RFID Sensor Setup
  while (!Serial)
    ;                                // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)
  SPI.begin();                       // Init SPI bus
  mfrc522.PCD_Init();                // Init MFRC522
  delay(4);                          // Optional delay. Some board do need more time after init to be ready, see Readme
  mfrc522.PCD_DumpVersionToSerial(); // Show details of PCD - MFRC522 Card Reader details
  // Serial.println(F("Scan PICC to see UID, SAK, type, and data blocks..."));

  //  makeHTTPRequest();
}

// ON and OFF
void onLedThenOff(int led, int duration)
{
  turnLedOn(led);
  delay(duration);
  turnLedOff(led);
}

// OFF and ON
void offLedThenOn(int led, int duration)
{
  turnLedOff(led);
  delay(duration);
  turnLedOn(led);
}

void turnLedOn(int led)
{
  digitalWrite(led, HIGH); // Turn the LED on (Note that LOW is the voltage level
}

void turnLedOff(int led)
{
  digitalWrite(led, LOW); // Turn the LED off (Note that LOW is the voltage level
}

void makeHTTPRequest(String cardId)
{
  turnLedOn(BLUE_LED);
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
  //  String cardId = "22401507";
  String getQuery = "?machine_id=" + machineId + "&card_id=" + cardId;

  client.print("/mikes/ssiah/machine/index.php" + getQuery); // %2C == ,

  // HTTP 1.0 is ideal as the response wont be chunked
  // But some API will return 1.1 regardless, so we need
  // to handle both.
  client.println(F(" HTTP/1.1"));

  // Headers
  client.print(F("Host: "));
  client.println(TEST_HOST);

  client.println(F("Cache-Control: no-cache"));

  if (client.println() == 0)
  {
    onLedThenOff(RED_LED, 1500);
    Serial.println(F("Failed to send request"));
    return;
  }
  // delay(100);
  //  Check HTTP status
  char status[32] = {0};
  client.readBytesUntil('\r', status, sizeof(status));

  // While the client is still availble read each
  // byte and print to the serial monitor
  while (client.available())
  {
    
    String line = client.readStringUntil('\n');
    if (line == "\r")
    {
      
      Serial.println("Headers received.");
      String line2 = client.readStringUntil('\n');
      Serial.println("Reply was:");
      Serial.println(line2);
      turnLedOff(BLUE_LED);
      if (line2 == "0")
      {
        onLedThenOff(RED_LED, 1500);
      }
      else
      {
        onLedThenOff(GREEN_LED, 1500);
      }
      return;
    }

    String line2 = client.readStringUntil('\n');
    //  Serial.println("==========");
    //  Serial.println(line2);
    //  Serial.println("==========");
  }
}

void loop()
{
  //check and make sure wifi is still connected
   while (WiFi.status() != WL_CONNECTED)
  {
    onLedThenOff(YELLOW_LED, 500);
    Serial.print(".");
    delay(500);
  }
  turnLedOn(YELLOW_LED);
  
  // put your main code here, to run repeatedly:
  // Reset the loop if no new card present on the sensor/reader. This saves the entire process when idle.
  if (!mfrc522.PICC_IsNewCardPresent())
  {
    return;
  }

  // Select one of the cards
  if (!mfrc522.PICC_ReadCardSerial())
  {
    return;
  }

  // Dump debug info about the card; PICC_HaltA() is automatically called
  //  mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
  String cardId;
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
    Serial.print(mfrc522.uid.uidByte[i], HEX);
    cardId += String(mfrc522.uid.uidByte[i], HEX);
  }
  Serial.print('card ID: ');
  Serial.println(cardId);
  makeHTTPRequest(cardId);

//testingCode();
}

void testingCode()
{
  turnLedOn(YELLOW_LED);
  delay(500);
  turnLedOn(BLUE_LED);
  delay(500);
  turnLedOn(RED_LED);
  delay(500);
  turnLedOn(GREEN_LED);
  delay(500);
  turnLedOn(BUZZER);

  delay(2000);
  turnLedOff(BUZZER);
  delay(500);
  turnLedOff(GREEN_LED);
  delay(500);
  turnLedOff(RED_LED);
  delay(500);
  turnLedOff(BLUE_LED);
  delay(500);
  turnLedOff(YELLOW_LED);
  delay(500);
}

void turnItAllOff() {
  turnLedOff(YELLOW_LED);
  turnLedOff(BLUE_LED);
  turnLedOff(RED_LED);
  turnLedOff(BUZZER);
  turnLedOff(GREEN_LED);
}

void turnItAllOn() {
  turnLedOn(YELLOW_LED);
  turnLedOn(BLUE_LED);
  turnLedOn(RED_LED);
  turnLedOn(BUZZER);
  turnLedOn(GREEN_LED);
}
