import os
import glob
import time
import datetime
import MySQLdb

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="root",         # your username
                     passwd="Nugget15",  # your password
                     db="temperature_1.0")        # name of the dat

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

os.system('modprobe w1-gpio')
os.system('modprobe w1-therm')

base_dir = '/sys/bus/w1/devices/'
device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'

def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines

while True:
        day_of_week = datetime.date.today().strftime("%A")
        year = datetime.datetime.now().strftime("%y")
        month = datetime.datetime.now().strftime("%m")
        day = datetime.datetime.now().strftime("%d")
        hour = datetime.datetime.now().strftime("%H")
        minute = datetime.datetime.now().strftime("%M")
        lines = read_temp_raw()
        while lines[0].strip()[-3:] != 'YES':
                time.sleep(0.2)
                lines = read_temp_raw()
        equals_pos = lines[1].find('t=')
        if equals_pos != -1:
                temp_string = lines[1][equals_pos+2:]
                temp_c = round(float(temp_string) / 1000.0, 2)
                temp_f = round(float(temp_c * 9.0 / 5.0 + 32.0),2)
        cur.execute("INSERT INTO temp(celsius, fahrenheit, day_of_week, day, month, year, hour, minute) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", (temp_c, temp_f, day_of_week, day, month, year, hour, minute))
        db.commit()

        delay = 3
        print temp_c, 'celsius', temp_f, 'fahrenheit'
        print day_of_week, day, '/', month, '/', year, '-', hour, ':', minute, ' | Status: working - next temp in ', delay/60, 'minutes'
        time.sleep(delay)