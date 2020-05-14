# encoding=utf-8

#decode('gbk').encode('utf-8')
import csv
import pandas as pd



csvfile=open('D:/PycharmProjects/BP/train-data-get.csv', encoding='utf-8')
csvreader = csv.reader(csvfile)
#csvreader = list(csvreader)
#print(csvreader)
'''for row in csvreader:
    # 行号从1开始
    print(csvreader.line_num, row)'''
lines = csvfile.readlines()
column = []
row = []
for line in lines:
    row.append(line.split(','))
print(row[0])
for col in row:
    column.append(col[0])
print(column)
tmp = 0
c1 = []
c2 = []
for i in range(0, len(column)):
    if (column[i] != tmp):
        c1.append(column[i])
        tmp=column[i]
print(c1)
print(c1[0][0])
for i in range(0, len(c1)):
    if (c1[i] < 'A'):
        c2.append('0')
    else:
        c2.append(c1[i][0])
print(c2)
'''
# 1. 创建文件对象
f = open('train-data.csv','w',encoding='utf-8')
# 2. 基于文件对象构建 csv写入对象
csv_writer = csv.writer(f)
csv_writer.writerow('trainID', 'Type')
for i in range(0,len(c1)):
    csv_writer.writerow(c1[i], c2[i])

# 5. 关闭文件
f.close()'''


#字典中的key值即为csv中列名
data = {'TrainID':c1,'Type':c2}
dataframe = pd.DataFrame(data, columns = ['TrainID','Type']) #columns自定义列的索引值
dataframe.to_csv(r'D:\PycharmProjects\BP\train-data-1.csv')
