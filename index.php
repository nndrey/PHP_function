<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
//исходный рабочий массив
$example_persons_array = [
        [
            'fullname' => 'Иванов Иван Иванович',
            'job' => 'tester',
        ],
        [
            'fullname' => 'Степанова Наталья Степановна',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Пащенко Владимир Александрович',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Громов Александр Иванович',
            'job' => 'fullstack-developer',
        ],
        [
            'fullname' => 'Славин Семён Сергеевич',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Цой Владимир Антонович',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Быстрая Юлия Сергеевна',
            'job' => 'PR-manager',
        ],
        [
            'fullname' => 'Шматко Антонина Сергеевна',
            'job' => 'HR-manager',
        ],
        [
            'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Бардо Жаклин Фёдоровна',
            'job' => 'android-developer',
        ],
        [
            'fullname' => 'Шварцнегер Арнольд Густавович',
            'job' => 'babysitter',
        ],
    ];

//массив для определения соотношения мужчин и женщин
$arryGender = [
        'Иванов Иван Иванович',
        'Степанова Наталья Степановна',
        'Пащенко Владимир Александрович',
        'Громов Александр Иванович',
        'Славин Семён Сергеевич',
        'Цой Владимир Антонович',
        'Быстрая Юлия Сергеевна',
        'Шматко Антонина Сергеевна',
        'аль-Хорезми Мухаммад ибн-Муса',
        'Бардо Жаклин Фёдоровна',
        'Шварцнегер Арнольд Густавович',
    ];

//Разбиение и объединение ФИО
function getFullnameFromParts ($surname, $name, $patronymic) { //function объединения ФИО
return $fullName =  $surname . ' ' . $name . ' ' . $patronymic;
}

$user = getFullnameFromParts('Шебяковский', 'Андрей', 'Андреевич');
echo($user);
echo '<br>';
echo '<br>';

function getPartsFromFullname  ($splitString) {    //function разделения ФИО
$arryKeys = [
        'surname',
        'name',
        'patronymic',
    ];// массив для создания массива с нужными ключами
$a = (explode (' ', $splitString)); // разбиваем строку на элементы массива 
    return array_combine($arryKeys,$a); // объеденяем два массива в нужный нам массив
    };

$result = getPartsFromFullname($example_persons_array[0]['fullname']);

print_r ($result);
echo '<br>';
echo '<br>';

//Сокращение ФИО

function getShortName ($input) {
$arr = (getPartsFromFullname($input));//разбиваем входящие данные ФИО на элементы массива
    unset($arr['patronymic']); // удаляем из полученного массива "отчество"
$correctName = (mb_substr($arr['name'], 0, 1));//оставляем в имени только заглавную букву
    return getFullnameFromParts ($arr['surname'],$correctName,'.');//собираем все части массива в одно строку,с точкой в конце.
}
$shortUserName = getShortName ($example_persons_array[5]['fullname']);
echo ($shortUserName);
echo '<br>';
echo '<br>';

//Функция определения пола по ФИО
function getGenderFromName ($inputUser) {

$raskolUser = getPartsFromFullname($inputUser);//разбиваем ФИО на составляющие 
$sumGender = 0;
$yourGender = '';

if (mb_substr($raskolUser['surname'], -1, 1) == 'в') { // признаки мужского пола
    $sumGender += 1;
} else if (mb_substr($raskolUser['name'], -1, 1) == 'й' || mb_substr($raskolUser['name'], -1, 1) == 'н') {
    $sumGender += 1;
} else if (mb_substr($raskolUser['patronymic'], -2, 2) == 'ич') {
    $sumGender += 1;
}

if (mb_substr($raskolUser['surname'], -2, 2) == 'ва') {  // признаки женского пола
    $sumGender -= 1;
} else if (mb_substr($raskolUser['name'], -1, 1) == 'а') {
    $sumGender -= 1;
} else if (mb_substr($raskolUser['patronymic'], -3, 3) =='вна') {
    $sumGender -= 1;
}

if ($sumGender > 0) {  // определение пола
return $yourGender = 'ваш пол - мужской';
} else if ($sumGender == 0) {
return $yourGender = 'ваш пол - не определен!';
} else if ($sumGender < 0) {
return $yourGender = 'ваш пол - женский';
}}

$gender = (getGenderFromName ($example_persons_array[9]['fullname']));
print_r($gender);
echo '<br>';
echo '<br>';

//Определение возрастно-полового состава

function getGenderDescription ($arryPeople) {
$countPeople = count($arryPeople);// считаем людей в массиве

$countMen = array_filter($arryPeople, function($value) { // отбираем мужчин
return  getGenderFromName ($value)  == 'ваш пол - мужской';
});

$countWomen = array_filter($arryPeople, function($value) { // отбираем женщин
return  getGenderFromName ($value)  == 'ваш пол - женский';
});

$countAverage = array_filter($arryPeople, function($value) { // отбираем не определенных 
return  getGenderFromName ($value)  == 'ваш пол - не определен!';
});

// считаем всех в своих группах

$numbMen = count($countMen);
$numbWomen = count($countWomen);
$numbAver = count($countAverage);

// высчитываем процентное соотношение от общего количества

$procMen = round ((($numbMen / $countPeople) * 100),1);
$procWomen = round ((($numbWomen / $countPeople) * 100),1);
$procAnv = round ((($numbAver / $countPeople) * 100),1);

//выводим информацию

echo 'Гендерный состав аудитории:';
echo '<br>';
echo '-------------------------------------';
echo '<br>';
echo "Мужчины - $procMen % ";
echo '<br>';
echo "Женщины - $procWomen % ";
echo '<br>';
echo "Не удалось определить - $procAnv % ";
echo '<br>';
};

getGenderDescription ($arryGender);
echo '<br>';
echo '<br>';

//Идеальный подбор пары

function getPerfectPartner ($surname,$name,$patronymic,$arry) {
$vvod = getFullnameFromParts($surname,$name,$patronymic); //склеиваем ФИО
$lowerReg = mb_strtolower($vvod); // выравниваем регистр
$correctRegistr = mb_convert_case($lowerReg, MB_CASE_TITLE);

$youGend = getGenderFromName($correctRegistr); // определение пола вводного участника
$randomGender = (array_rand($arry, 1));
$perfectСouple = $arry[$randomGender]; // выбор идеальной пары
$perfectСoupleGender = getGenderFromName($perfectСouple); // определение пола подбираемой пары

$randomPercent =  rand (5000, 10000)/100; // процент совместимости

if ($youGend !== $perfectСoupleGender) {  // выводим инфорцаию, если пара подходит
    $shortName = getShortName($correctRegistr);
    $shortNameСouple = getShortName($perfectСouple);
    echo ($shortName . ' + ' . ' ' . $shortNameСouple . '=');
    echo '<br>';
    echo ("\u{2764} Идеально на $randomPercent%  \u{2764}");
} else {
    getPerfectPartner ($surname,$name,$patronymic,$arry);  // выполняем второй круг, если пара не подходит
}}

getPerfectPartner ('гАврИлова','надежда','МИХАЙЛОвна',$arryGender);

?>
</body>
</html>