# Пять функций на языке PHP #
----

1. **Обработка строк**

Функция **getFullnameFromParts** принимает как аргумент три строки — фамилию, имя и отчество. Возвращает как результат их же, но склеенные через пробел.

Функция getPartsFromFullname принимает как аргумент одну строку — склеенное ФИО. Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’.


2. **Сокращение ФИО**

Функция **getShortName**, принимающая как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» и возвращающую строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество.


3. **Функция определения пола по ФИО**

Функция **getGenderFromName**, принимающая как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович»), после чего определяет пол вводимого ФИО.


4. **Определение возрастно-полового состава**

Функция **getGenderDescription** для определения полового состава аудитории. Как аргумент в функцию передается массив. Возвращает результат в процентном соотношенеи.

5. **Идеальный подбор пары**

Функция **getPerfectPartner** принемает как аргумент ФИО вводимое пользователем,и массив участников, из которых будет выбрана идеальная пара для пользователя.