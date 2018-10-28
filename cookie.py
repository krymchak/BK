from selenium import webdriver


handle = open("cookie.txt")
i=0
while i!=2:
	byte=handle.read(1)
	if byte==';':
		i+=1
while byte!='=':
	byte=handle.read(1)
data=''
byte = handle.read(1)
while byte!='\n':
	data=data+byte
	byte = handle.read(1)
handle.close()
driver = webdriver.Chrome("C:/chromedriver_win32/chromedriver.exe") 
driver.get("http://mikolaj.ovh")
driver.add_cookie({'name': 'PHPSESSID', 'value': data})
print(driver.get_cookie('PHPSESSID'))
driver.get("http://mikolaj.ovh")