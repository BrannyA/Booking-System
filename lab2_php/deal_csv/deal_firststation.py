# encoding=utf-8

import csv
import pandas as pd
import time
import datetime


csvfile=open('D:/PycharmProjects/BP/ticket-data.csv', encoding='utf-8')
csvreader = csv.reader(csvfile)
lines = csvfile.readlines()

NumhardT = []
NumhardM = []
NumhardB = []
NumsoftT = []
NumsoftB = []
Numsoftseat = []
Numhardseat = []
Traindate = []
TrainID = []

NumhardT = []
NumhardM = []
NumhardB = []
NumsoftT = []
NumsoftB = []
Numsoftseat = []
Numhardseat = []
Traindate = []
TrainID = []
Stationname = []


row = []
for line in lines:
    row.append(line.split(','))
for col in row:
    s0 = list(col[0])
    if (s0 != []):
        NumhardT.append(s0[0])
    else:
        NumhardT.append(col[0])
    s1 = list(col[1])
    if (s1 != []):
        NumhardM.append(s1[0])
    else:
        NumhardM.append(col[1])
    s2 = list(col[2])
    if(s2 != []):
        NumhardB.append(s2[0])
    else:
        NumhardB.append(col[2])
    s3 = list(col[3])
    if(s3 != []):
        NumsoftT.append(s3[0])
    else:
        NumsoftT.append(col[3])
    s4 = list(col[4])
    if(s4 != []):
        NumsoftB.append(s4[0])
    else:
        NumsoftB.append(col[4])
    s5 = list(col[5])
    if(s5 != []):
        Numsoftseat.append(s5[0])
    else:
        Numsoftseat.append(col[5])
    s6 = list(col[6])
    if (s6 != []):
        Numhardseat.append(s6[0])
    else:
        Numhardseat.append(col[6])
    Traindate.append(col[7])
    TrainID.append(col[8])
    a1 = col[9]
    a2 = '\n'
    if a2 in a1:
        a1 = a1.replace(a2, '')
    Stationname.append(a1)