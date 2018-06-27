#define trigPin 10
#define echoPin 12
#define PINDIGITAL 7

int s_analogica_mq135=A0;

int F_Digital(int pin){
  int valdig = digitalRead(pin);
  return !valdig;
}

void setup() {
  Serial.begin(9600);
  pinMode(trigPin,OUTPUT);
  pinMode(echoPin,INPUT);
  pinMode(PINDIGITAL,INPUT);
}

void loop() {
  long duration,distance;
  int valDigital = F_Digital(PINDIGITAL);
  s_analogica_mq135=analogRead(0);
  digitalWrite(trigPin,LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin,HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin,LOW);
  duration = pulseIn(echoPin,HIGH);
  distance = (duration/2)/29.1;
  Serial.println(String("VERGARA 432")+";"+String("ORGANICO")+";"+String(distance)+";"+String(valDigital)+";"+String(s_analogica_mq135));
  delay(500);
}
