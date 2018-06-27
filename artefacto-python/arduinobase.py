#!/usr/bin/python3
import serial
import time
import pymysql
import schedule
#Capturar muestras
def capturar(muestras):
    rawdata = []
    count=0
    while count < muestras:
        rawdata.append(str(arduino.readline()))
        count+=1
    return rawdata

#Función para limpiar los datos capturados
def clean(L):
    newl = []
    for i in range(len(L)):
        temp=L[i][2:]
        newl.append(temp[:-5])
    return newl

#Formato a datos
def formato(cleandata):
    for i in range(len(cleandata)):
        #Insertar fecha a los datos
        day = time.strftime("%d")
        month = time.strftime("%m")
        year = time.strftime("%y")
        cleandata[i] = cleandata[i].split(";")
        cleandata[i].insert(0,year)
        cleandata[i].insert(0,month)
        cleandata[i].insert(0,day)
        #Comprobación de llenado Capacidad Maxima = 155 cm
        cap_max = 155
        distancia = int(cleandata[i][5])
        nivel = int((distancia/cap_max)*100)
        if nivel > 100:
            cleandata[i][5] = 100
        else:
            cleandata[i][5] = 100 - nivel
        #Comprobación de incendio
        if int(cleandata[i][6]) == 0:
            cleandata[i][6] = "NO"
        elif int(cleandata[i][6]) == 1:
            cleandata[i][6] = "SI"
        else:
            cleandata[i][6] = "ERROR"
        #Comprobación de gas
        if int(cleandata[i][7]) <= 400 and int(cleandata[i][5]) > 0:
            cleandata[i][7] = "NO"
        elif int(cleandata[i][7]) > 400:
            cleandata[i][7] = "SI"
        else:
            cleandata[i][7] = "ERROR"
    return cleandata

def data(muestras):
    catchdata = capturar(muestras)
    cleandata = clean(catchdata)
    data = formato(cleandata)
    return data

def envio_data(muestras):
    data2 = data(muestras)
    print(data2)
    print("Estableciendo conexión...")
    try:
        db = pymysql.connect("localhost","root","","base_sensores")
        print("Conexión exitosa...")
    except:
        print('Error al conectar a base de datos...')
    cursor = db.cursor()
    day = time.strftime("%d")
    month = time.strftime("%m")
    year = time.strftime("%y")
    rows = cursor.execute("""SELECT * FROM artefactos WHERE (DAY=%s AND MONTH=%s AND YEAR=%s AND UBICACION = "VERGARA 432" AND TIPO="ORGANICO")""",(day,month,year))
    rows2 = cursor.execute("""SELECT * FROM artefactos WHERE (DAY=%s AND MONTH=%s AND YEAR=%s AND UBICACION = "VERGARA 432" AND TIPO = "ORGANICO" AND INCENDIO="NO" AND GAS = "NO") """,(day,month,year))
    sql = """INSERT INTO artefactos(DAY,MONTH,YEAR,UBICACION,TIPO,NIVEL,INCENDIO,GAS,INCIDENTE) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"""
    sql2 = """UPDATE artefactos SET DAY = %s , MONTH = %s , YEAR = %s , UBICACION = %s , TIPO = %s , NIVEL = %s , INCENDIO=%s , GAS=%s, INCIDENTE=%s WHERE (DAY = %s AND MONTH = %s AND YEAR = %s AND UBICACION = "VERGARA 432" AND TIPO="ORGANICO")"""

    for i in range(len(data2)):
        if not rows:
            if not rows2:
                cursor.execute(sql,(data2[i][0],data2[i][1],data2[i][2],data2[i][3],data2[i][4],data2[i][5],data2[i][6],data2[i][7],"SI"))
            else:
                cursor.execute(sql,(data2[i][0],data2[i][1],data2[i][2],data2[i][3],data2[i][4],data2[i][5],data2[i][6],data2[i][7],"NO"))
        else:
            if not rows2:
                cursor.execute(sql2,(data2[i][0],data2[i][1],data2[i][2],data2[i][3],data2[i][4],data2[i][5],data2[i][6],data2[i][7],"SI",day,month,year))
            else:
                cursor.execute(sql2,(data2[i][0],data2[i][1],data2[i][2],data2[i][3],data2[i][4],data2[i][5],data2[i][6],data2[i][7],"NO",day,month,year))
    db.commit()
    db.close()

def job():
    muestras = 1
    envio_data(muestras)

if __name__ == "__main__":
    try:
        arduino = serial.Serial('COM6', 9600) #Conectarse a puerto serial
    except:
        print('Please check the port') #Comprobación de error
    muestras = 1 #Muestras a capturar
    envio_data(muestras) #envía la data con formato a la base de datos 
