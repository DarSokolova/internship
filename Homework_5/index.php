<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Форма для заполнения</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Форма заполнения</h1>
            <form action="" method="post" name="form">
                <div class="mb-3">
                    <label for="fname" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="fname" placeholder="Напишите фамилию студента" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="fmessage" class="form-label">Количество баллов</label>
                    <input type="text" class="form-control" id="points" placeholder="Количество баллов" name="name" required>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Отправить</button>
            </form>
        </div>
    </div>

    <?php
    //задаем параметры для подключения
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $database = 'exam';

    $connects = mysqli_connect($host, $user, $password, $database);

    if (isset($_POST['btn'])) {
        $surname = $_POST['surname'];
        $result = $_POST['result'];
      }
  
      $ins = "INSERT INTO Student(result, surname) VALUES('$result', '$surname')";
      mysqli_query($connects, $ins);
  
      $query = "SELECT surname, result, CASE WHEN result>50 THEN 'yes' ELSE 'no' END AS valuation FROM `Student` ORDER BY result DESC";
      $obj = mysqli_query($connects, $query);
      if (!$obj) {
        die('Неверный запрос: ' . mysqli_error($connects));
      }
      ?>
  
      <!--Вывод таблицы-->
  
      <table border="1" class="table">
        <tr>
          <th>№</th>
          <th>Фамилия</th>
          <th>Баллы</th>
          <th>Оценка</th>
        </tr>
  
        <?php
  
        $i = 1;
        while ($row = mysqli_fetch_array($obj)) {
          echo '<tr>';
  
          echo "<td>$i</td>";
          echo "<td>$row[surname]</td>";
          echo "<td>$row[result]</td>";
          echo "<td>$row[valuation]</td>";
          $i++;
  
          echo '</tr>';
        };
  
        ?>
      </table>
  
  
    </div>

    <?php		
	else {
        echo 'Ошибка запроса: ' . mysqli_error($mysqli) . '<br>';
        echo 'Код ошибки: ' . mysqli_errno($mysqli);
	}
    ?>
  </body>
 </html>