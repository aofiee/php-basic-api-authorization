PHP 7.1
Mysql

Fixed ค่า Header ไว้ใน Code ตัวอย่าง
ปรกติจะดึงจาก Database ว่า Key มี Permission อะไรบ้าง

Application-Authorization: /FJrr2h1w/KhJ/Ltygyx1h20s/09JrfIyl7yrgC1Ls/67d9V5x4IxW0TkMWQfVm+wN6n65AKSaEVzVwV3YJleA==
Secret: 8Z0PJ95FMTGDB3FB4t1SM5tgU8ZVcIsaiSBLtQ==

1. แบบเรียก request ธรรมดา ไม่ส่ง header
curl -H "Content-Type:application/json" \
-X POST -d '{"username": "aofiee","password":"mypassword"}' http://localhost:8888/login.php

return json {"status":false,"desc":"Application-authorization not match."}


2. แบบ header ที่เรียก request ถูก แต่ Application-Authorization หรือ Secret Key ผิด
curl -H "Content-Type:application/json" \
-H "Application-Authorization: asdSSD" \
-H "Secret: SADASDSA" \
-X POST -d '{"username": "aofiee","password":"mypassword"}' http://localhost:8888/login.php

return json {"status":false,"desc":"Application-authorization not match."}

3. แบบที่ header เรียก request ถูกต้อง ส่งค่า json username password ไปเช็คที่ Server
curl -H "Content-Type:application/json" \
-H "Application-Authorization: /FJrr2h1w/KhJ/Ltygyx1h20s/09JrfIyl7yrgC1Ls/67d9V5x4IxW0TkMWQfVm+wN6n65AKSaEVzVwV3YJleA==" \
-H "Secret: 8Z0PJ95FMTGDB3FB4t1SM5tgU8ZVcIsaiSBLtQ==" \
-X POST -d '{"username": "aofiee","password":"mypassword"}' http://localhost:8888/login.php

return {"status":true,"desc":"Login completed.","token":"pAve8+lIKn533efUQ5cMyg=="} และ update ค่า token ลง DB

4. ใช้ token get user profile
curl -H "Content-Type:application/json" \
-H "Application-Authorization: /FJrr2h1w/KhJ/Ltygyx1h20s/09JrfIyl7yrgC1Ls/67d9V5x4IxW0TkMWQfVm+wN6n65AKSaEVzVwV3YJleA==" \
-H "Secret: 8Z0PJ95FMTGDB3FB4t1SM5tgU8ZVcIsaiSBLtQ==" \
-H "Token: pAve8+lIKn533efUQ5cMyg==" \
-X POST -d '{"apiname": "getuserprofile"}' http://localhost:8888/accessprofile.php
