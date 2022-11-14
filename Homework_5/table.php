 <?php
 if (isset($_POST['submit'])) {
    //если нажата - читаю значения из формы
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    if (empty($name)) {
     //проверка на пустоту фамилии
        $errors[] = 'Не указано Фамилия';
    }
    elseif (empty($message)) {
        //проверка на пустоту сообщения
        $errors[] = 'Не указана Фамилия';
    }
    
    if (empty($name)) {
        //проверка на пустоту фамилии
           $errors[] = 'Не указано Укажите количество баллов';
       }
       elseif (empty($message)) {
           //проверка на пустоту сообщения
           $errors[] = 'Не укащвно количество баллов';
       }

    elseif (empty($message)) {
        //проверка на пустоту сообщения
        $errors[] = 'Пустая строка';
    }
    //проверяем были ли ошибки
    if (!empty($errors)) {
     //ошибки были
        foreach ($errors as $error) {
            echo "$error";
        } 
    }
    else {
        //ошибок нет, все поля указаны
        $insertDB = true;
    }
}

if ($insertDB) {
    //задаем параметры для подключения
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $database = 'Exam';

    //вызываем функцию соединения с базой данных
    $mysqli = new mysqli($host, $user, $password, $database);

    // проверка правильности подключения
    if(!$mysqli){ 
        echo 'Ошибка соединения: ' . mysqli_connect_error() . '<br>';
        echo 'Код ошибки: ' . mysqli_connect_errno();
    }
    else{ 
        // соединение было установлено успешно
        $query = "INSERT INTO messages(id, name, message) VALUES (NULL,'$name','$message')";
        $result = $mysqli->query($query);
    }

    if ($score > 50){
     $value = 'yes';
    } else {
     $value = 'no';
    }
     /*КОД ДЛЯ ВЫПОЛНЕНИЯ ЗАПРОСА НА ВСТАВКУ ДАННЫХ ИЗ ФОРМЫ */
    $query = "INSERT INTO student(id, surname, result, Valuation) VALUES (NULL,'$name','$score', '$value')";
   $result = $mysqli->query($query);
 
}

if ($result) {


     // вывод в виде таблицы
     ?>
 <table border="2">
 <tr>
     <th>№</th>
     <th>Фамилия</th>
     <th>Количество баллов</th>
 </tr>
     <?php
$number = 0;
     foreach ($result as $row) {

         ?>
         <tr>
         <td> <?php echo $number = ($number + 1); ?></td>
         <td> <?php echo $row['surname']; ?></td>
         <td> <?php echo $row['result']; ?></td>
         </tr>
         <?php
     }
     ?>
     
 </table>

 <?php

    if(!$result){ 
        // запрос завершился ошибкой
        echo 'Ошибка запроса: ' . mysqli_error($mysqli) . '<br>';
        echo 'Код ошибки: ' . mysqli_errno($mysqli);
    }
    else { 
        // запрос успешно выполнился
        // обрабатываем полученные данные
        echo 'Спасибо, ваши данные записаны!';
    }
}
?>