import Adafruit_DHT;
import MySQLdb as mysql;
import datetime;
import time;
ts = time.time();
sensor = Adafruit_DHT.DHT22;
pin = 4;
umidade, temperatura = Adafruit_DHT.read_retry(sensor, pin);
db = mysql.connect("localhost","root","","colddev");
while(1):
    ts = time.time();
    sensor = Adafruit_DHT.DHT22;
    pin = 4;
    umidade, temperatura = Adafruit_DHT.read_retry(sensor, pin);
    curs = db.cursor();
    if umidade is not None and temperatura is not None:
     try:
      dataHora = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S');
      sql = ("""Insert into log_temperatura VALUES(null,'{2}','{0:0.1f}','{1:0.1f}')""").format(temperatura,umidade,dataHora);
      curs.execute(sql);
      db.commit();
      print "Data e Hora: ",dataHora;
      print "Temperatura: {0:0.1f}".format(temperatura),"°C";
      print "Umidade: {0:0.1f}".format(umidade),"%";
      print "Gravando no banco de dados ...";
      print "Dados gravados com sucesso!";
      print "============================";
     except:
            print "Erro: impossivel gravar no banco de dados";
            db.rollback();
    else:
      print 'Nao foi possivel fazer a leitura, verifique o pino de conexao!';
    time.sleep(3)
    
