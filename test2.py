# -*- coding: utf-8 -*-
import json
import requests
from threading import Timer 
from bs4 import BeautifulSoup


def waterdata():
    headers = {
    	'user-agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'
    }
    
    res=requests.get("https://www.wrasb.gov.tw/water/wm01.aspx", headers=headers)
    soup=BeautifulSoup(res.text, 'html.parser')
    
    data=soup.select('div[class="table-rwd"] table tr td')
    data1=[]
    data2=[]
    data3=[]
    
    for i in range(20,29):
        test=data[i].text
        data1.append(test.strip())
        
    for i in range(160,169):
        test2=data[i].text
        data2.append(test2.strip())  
    
    for i in range(180,189):
        test3=data[i].text
        data3.append(test3.strip()) 
    
    dat1={'name':data1[0], 'capacitym': data1[1], 'capacitym3': data1[2], 'nowm': data1[3], 'nowm3': data1[4], 'percent': data1[5], 'time': data1[8]}
    dat2={'name':data2[0], 'capacitym': data2[1], 'capacitym3': data2[2], 'nowm': data2[3], 'nowm3': data2[4], 'percent': data2[5], 'time': data2[8]}
    dat3={'name':data3[0], 'capacitym': data3[1], 'capacitym3': data3[2], 'nowm': data3[3], 'nowm3': data3[4], 'percent': data3[5], 'time': data3[8]}
    
        
    print(dat1)
    print(dat2)
    print(dat3)
    
    with open('C:/AppServ/www/water/water.json', 'w', encoding="utf-8") as f:
        f.write("[")
        json.dump(dat1,f,ensure_ascii=False,indent = 4)
        f.write(",")
        json.dump(dat2,f,ensure_ascii=False,indent = 4)
        f.write(",")
        json.dump(dat3,f,ensure_ascii=False,indent = 4)
        f.write("]")
        
    #water=Timer(10,waterdata)
    #water.start()

waterdata()