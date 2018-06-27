#!/usr/bin/python3
import schedule
import time
from subprocess import call

def ejecutaScript():
    print("---------------------------------------------------------------")
    print("Recibiendo datos...")
    retcode = call('python arduinobase.py')
    print("---------------------------------------------------------------")
    print("\n")

def job():
    ejecutaScript()

job()
schedule.every(10).seconds.do(job)
while True:
    schedule.run_pending()
