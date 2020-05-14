# encoding=utf-8

import csv
import pandas as pd
import time
import datetime

csvfile=open('D:/PycharmProjects/BP/train-data-get.csv', encoding='utf-8')
csvreader = csv.reader(csvfile)
lines = csvfile.readlines()

file2 = open('D:/PycharmProjects/BP/station-data.csv', encoding='utf-8')
file2reader = csv.reader(file2)
lines2 = file2.readlines()

TotalTime = []
Day = []
ArrivalTime = []
DepartureTime = []
StationNum = []
TrainID = []
Stationname = []
PricehardT = []
PricehardM = []
PricehardB = []
PricesoftT = []
PricesoftB = []
Pricesoftseat = []
Pricehardseat = []


NumhardT = []
NumhardM = []
NumhardB = []
NumsoftT = []
NumsoftB = []
Numsoftseat = []
Numhardseat = []
Traindate = []
#TrainID = []




row = []
for line in lines:
    row.append(line.split(','))
#print(row[0])
for col in row:
    TrainID.append(col[0])
    StationNum.append(col[2])
    Stationname.append(col[1])
    if(col[2] == '1'):
        #Starttime = time.strptime(col[4], "%H:%M")
        Starttime = datetime.datetime.strptime(col[4], "%H:%M")
        pretime = 0
        TotalTime.append(0)
        Day.append('0')
        tmptime = datetime.datetime.strptime('23:59', "%H:%M")
        deltatime = (tmptime - Starttime).seconds + 60
    else:
        #time = time.strptime(col[3], "%H:%M")
        time = datetime.datetime.strptime(col[3], "%H:%M")
        time = (time - Starttime).seconds
        if(time < pretime):
            time += 24*60*60
        if(time != pretime):
            pretime = time;
        if (time > deltatime and time - deltatime < 24*60*60):
            Day.append('1')
        elif(time - deltatime > 24*60*60):
            Day.append('2')
        else:
            Day.append('0')
        time = time/60
        #print(time)
        #print(type(time))
        #time = time.strftime("%H:%M", time)
        TotalTime.append(time)

    ArrivalTime.append(col[3])
    DepartureTime.append(col[4])
    if (col[5] != '0' and col[5] != ''):
        Pricehardseat.append(col[5])
    else:
        Pricehardseat.append('0')
    if (col[5]=='' or col[5]=='0'):
        Numhardseat.append('null')
    else:
        Numhardseat.append('5')

    if (col[6] != '0' and col[6] != ''):
        Pricesoftseat.append(col[6])
    else:
        Pricesoftseat.append('0')
    if (col[6]=='' or col[6]=='0'):
        Numsoftseat.append('null')
    else:
        Numsoftseat.append('5')

    if (col[7] != '0' and col[7] != ''):
        PricehardT.append(col[7])
    else:
        PricehardT.append('0')
    if (col[7]=='' or col[7]=='0'):
        NumhardT.append('null')
    else:
        NumhardT.append('5')

    if (col[8] != '0' and col[8] != ''):
        PricehardM.append(col[8])
    else:
        PricehardM.append('0')
    if (col[8]=='' or col[8]=='0'):
        NumhardM.append('null')
    else:
        NumhardM.append('5')

    if (col[9] != '0' and col[9] != ''):
        PricehardB.append(col[9])
    else:
        PricehardB.append('0')
    if (col[9]=='' or col[9]=='0'):
        NumhardB.append('null')
    else:
        NumhardB.append('5')

    if (col[10] != '0' and col[10] != ''):
        PricesoftT.append(col[10])
    else:
        PricesoftT.append('0')
    if (col[10]=='' or col[10]=='0'):
        NumsoftT.append('null')
    else:
        NumsoftT.append('5')

    s1 = col[11]
    s2 = '\n'
    flag = 1
    if s2 in s1:
        s1 = s1.replace(s2, '')
    if (s1 != '0' and s1 != ''):
        PricesoftB.append(s1)
    else:
        PricesoftB.append('0')
    if (s1=='' or s1=='0'):
        NumsoftB.append('null')
    else:
        NumsoftB.append('5')
    Traindate.append('2020-5-1')





#print(TrainID)
#print(StationNum)
'''print(ArrivalTime)
print(DepartureTime)
print(TotalTime)
print(Pricehardseat)
print(Pricesoftseat)
print(PricehardT)
print(PricehardM)
print(PricehardB)
print(PricesoftT)
print(PricesoftB)
print(NumhardT)
print(NumhardM)
print(NumhardB)
print(NumsoftT)
print(NumsoftB)
print(Numsoftseat)
print(Numhardseat)'''

print(len(TotalTime))
print(len(Day))
'''print(len(ArrivalTime))
print(len(DepartureTime))
print(len(StationNum))
print(len(TrainID))
print(len(Stationname))
print(len(PricehardT))
print(len(PricehardM))
print(len(PricehardB))
print(len(PricesoftT))
print(len(PricesoftB))
print(len(Pricesoftseat))
print(len(Pricehardseat))'''
'''
data1={'TotalTime':TotalTime, 'Day': Day, 'ArrivalTime':ArrivalTime,'DepartureTime':DepartureTime,
       'StationNum':StationNum, 'TrainID': TrainID, 'Stationname':Stationname, 'PricehardT':PricehardT,
       'PricehardM':PricehardM, 'PricehardB' : PricehardB, 'PricesoftT':PricesoftT, 'PricesoftB':PricesoftB,
       'Pricesoftseat':Pricesoftseat,'Pricehardseat':Pricehardseat}

dataframe = pd.DataFrame(data1, columns = ['TotalTime', 'Day', 'ArrivalTime', 'DepartureTime', 'StationNum',
                                        'TrainID', 'Stationname','PricehardT', 'PricehardM', 'PricehardB',
                                        'PricesoftT', 'PricesoftB', 'Pricesoftseat', 'Pricehardseat']) #columns自定义列的索引值
dataframe.to_csv(r'D:\PycharmProjects\BP\pass-data-1.csv')'''




data2 = {'NumhardT':NumhardT, 'NumhardM':NumhardM, 'NumhardB':NumhardB,'NumsoftT':NumsoftT,'NumsoftB':NumsoftB,
        'Numsoftseat':Numsoftseat,'Numhardseat':Numhardseat,'Traindate':Traindate, 'TrainID':TrainID,
        'Stationname':Stationname}
dataframe2 = pd.DataFrame(data2, columns = ['NumhardT', 'NumhardM', 'NumhardB','NumsoftT','NumsoftB',
        'Numsoftseat','Numhardseat','Traindate', 'TrainID',
        'Stationname']) #columns自定义列的索引值
dataframe2.to_csv(r'D:\PycharmProjects\BP\ticket-data-1.csv')