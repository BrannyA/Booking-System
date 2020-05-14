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
Stationname = []

row = []
for line in lines:
    row.append(line.split(','))
for col in row:
    s0 = list(col[0])
    NumhardT.append(s0[0])
    s1 = list(col[1])
    NumhardM.append(s1[0])
    s2 = list(col[2])
    NumhardB.append(s2[0])
    s3 = list(col[3])
    NumsoftT.append(s3[0])
    s4 = list(col[4])
    NumsoftB.append(s4[0])
    s5 = list(col[5])
    Numsoftseat.append(s5[0])
    s6 = list(col[6])
    Numhardseat.append(s6[0])
    Traindate.append(col[7])
    TrainID.append(col[8])
    a1= col[9]
    a2 = '\n'
    a3 = '"'
    if a2 in a1:
        a1 = a1.replace(a2, '')
    if a3 in a1:
        a1 = a1.replace(a3, '')
    Stationname.append(a1)

data2 = {'NumhardT':NumhardT, 'NumhardM':NumhardM, 'NumhardB':NumhardB,'NumsoftT':NumsoftT,'NumsoftB':NumsoftB,
        'Numsoftseat':Numsoftseat,'Numhardseat':Numhardseat,'Traindate':Traindate, 'TrainID':TrainID,
        'Stationname':Stationname}
dataframe2 = pd.DataFrame(data2, columns = ['NumhardT', 'NumhardM', 'NumhardB','NumsoftT','NumsoftB',
        'Numsoftseat','Numhardseat','Traindate', 'TrainID',
        'Stationname']) #columns自定义列的索引值
dataframe2.to_csv(r'D:\PycharmProjects\BP\ticket-data-4.csv')