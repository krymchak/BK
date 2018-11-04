import base64
import itertools
import string
import codecs
import multiprocessing
import os
from Crypto.Cipher import AES

 
def worker(a):
    IV = codecs.decode('5266556a586e3272357538782f413f44', 'hex')
    ct = base64.b64decode(
        "ZWylMrshF52d37HZGuvApA==")
	#45 28 48 2b 4b 62 50 65 53 68 56 6d 59 71 33 74 36 77 39 7a 24 43 26 46 29 4a 40 4e 63 51 66 54 
    suffix = '28482b4b6250655368566d597133743677397a24432646294a404e63516654'
    for start in a:
        for prefix in itertools.product(string.hexdigits, repeat=1):
            key = codecs.decode(start+("".join(prefix) + suffix), 'hex')
            decryptor = AES.new(key, AES.MODE_CBC, IV)
            pt = decryptor.decrypt(ct)
            if all(c in string.printable for c in pt[:11].decode("utf-8", "ignore")):
                try:
                    print(codecs.encode(key, 'hex'), pt.decode("utf-8", "ignore"))
                except Exception:
                    print("")
 
if __name__ == '__main__':
    jobs = []
    p1 = multiprocessing.Process(target=worker(({'0','1','2','3'})))
    p2 = multiprocessing.Process(target=worker(({'4','5','6','7'})))
    p3 = multiprocessing.Process(target=worker(({'8','9','a','b'})))
    p4 = multiprocessing.Process(target=worker(({'c','d','e','f'})))
    jobs.append(p1)
    p1.start()
    jobs.append(p2)
    p2.start()
    jobs.append(p3)
    p3.start()
    jobs.append(p4)
    p4.start()
