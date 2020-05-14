# encoding=utf-8

import csv
import pandas as pd
import time
import datetime

csvfile=open('D:/PycharmProjects/BP/pass-data.csv', encoding='utf-8')
csvreader = csv.reader(csvfile)
lines = csvfile.readlines()

file2 = open('D:/PycharmProjects/BP/ticket-data-2.csv', encoding='utf-8')
file2reader = csv.reader(file2)
lines2 = file2.readlines()

Day = []
TotalTime = []

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
    Day.append(col[1])
    TotalTime.append(col[0])

row = []
for line in lines2:
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



for i in range(2*len(Day)):
    if(i <= len(Day)):
        Day.append(Day[i])
    else:
        Day.append(Day[i-len(Day)])

for i in range(len(Traindate)):
    a = int(Traindate[i][7])
    b = int(Day[i])
    s = list(Traindate[i])
    a += b
    s[7] = str(a)
    Traindate[i]=''.join(s)

for i in range(2*len(TotalTime)):
    if(i < len(TotalTime)):
        TotalTime.append(TotalTime[i])
    else:
        TotalTime.append(TotalTime[i - len(TotalTime)])

for i in range(len(NumhardB)):
    if(TotalTime[i] == '0' ):
        NumhardT[i] = '5'
        NumhardM[i] = '5'
        NumhardB[i] = '5'
        NumsoftT[i] = '5'
        NumsoftB[i] = '5'
        Numsoftseat[i] = '5'
        Numhardseat[i] = '5'


print(Stationname[0])

data2 = {'NumhardT':NumhardT, 'NumhardM':NumhardM, 'NumhardB':NumhardB,'NumsoftT':NumsoftT,'NumsoftB':NumsoftB,
        'Numsoftseat':Numsoftseat,'Numhardseat':Numhardseat,'Traindate':Traindate, 'TrainID':TrainID,
        'Stationname':Stationname}
dataframe2 = pd.DataFrame(data2, columns = ['NumhardT', 'NumhardM', 'NumhardB','NumsoftT','NumsoftB',
        'Numsoftseat','Numhardseat','Traindate', 'TrainID',
        'Stationname']) #columns自定义列的索引值
dataframe2.to_csv(r'D:\PycharmProjects\BP\ticket-data-3.csv')