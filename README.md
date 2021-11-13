# CustomersChains
Программа ищет цепочки дубликатов клиентов в файле data/customers.csv

## Требования к файлу customers.csv
Файл должен содержать поля ID, PARENT_ID, EMAIL, CARD, PHONE
```
ID,PARENT_ID,EMAIL,CARD,PHONE,TMP
1,NULL,email1,card1,phone1,
2,NULL,email1,card2,phone2,
3,NULL,email3,card3,phone3,
4,NULL,email4,card4,phone2,
```
Порядок полей может быть другим, но они обязательно должны присутствовать.

Для запуска используйте команду:
```
php public/index.php
```
Результат выполнения программы будет сохранен в папку data

### Пример выходных данных:
```
ID,PARENT_ID
1,1
2,1
3,3
4,1
```
