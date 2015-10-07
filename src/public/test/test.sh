#!/bin/sh
#time /usr/local/bin/wget -p -q --directory-prefix=./resdir/  http://np.tst.netping.ru:8090/test/page2.html
time /usr/local/bin/wget -p -q  --directory-prefix=./resdir/  $1
rm -r resdir/ 

