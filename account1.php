<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaVienRose</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
    <div class="header">
        <div class="header_logo">
            <a class="header_logo" href="index.html"><img class="header_logo_img" src="img/Логотип.png"> 
        </div>
        <div class="header_nav"id="headerNav">
          <a href="svadebniy.html" class="header_nav_a">Свадебные</a>
          <a href="vecherni.html" class="header_nav_a">Вечерние</a>
          <a href="sale.html" class="header_nav_a">SALE!</a>
          <a href="only.html" class="header_nav_a">Онлайн-запись</a>
        </div>
        <div class="header_account">
          <a href="korzina.html" class="header_account_a">Моя примерочная</a>
          <a href="account.html" class="header_icon"></a>
        </div>  
        <div class="header_hamburger-menu" onclick="toggleMenu()">
          <span></span>
          <span></span>
          <span></span>
        </div>        
      </div>


      <?php
    session_start();

    $db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

    if ($db->connect_error) {
        die("Ошибка подключения: " . $db->connect_error);
    }

    $userEmail = $_SESSION['email'];
    $query = $db->prepare("SELECT login, role FROM users WHERE email = ?");
    $query->bind_param("s", $userEmail);
    $query->execute();
    $result = $query->get_result();
    $userData = $result->fetch_assoc();

    if ($userData) {
        echo '<div class="user-icon-container">';
        echo '<div class="user-icon"><img src="img/иконка.png"/></div>';
        echo '<div class="username">' . htmlspecialchars($userData['login']);
        

        if ($userData['role'] == 'admin') {
            echo '<div class="admin-panel">';
            echo '<div class="user-management">';
            echo '<h2>Управление пользователями</h2>';
            echo '<form action="add_user.php" method="post">';
            echo '<h3>Добавить пользователя</h3>';
            echo '<input type="text" name="login" placeholder="Логин">';
            echo '<input type="text" name="email" placeholder="Email">';
            echo '<input type="password" name="password" placeholder="Пароль">';
            echo '<input type="text" name="role" placeholder="Роль">';
            echo '<input type="submit" value="Добавить">';
            echo '</form>';
            echo '<form action="update_user.php" method="post">';
            echo '<h3>Изменить пользователя</h3>';
            echo '<input type="text" name="users_id" placeholder="ID пользователя">';
            echo '<input type="text" name="login" placeholder="Новый логин">';
            echo '<input type="text" name="email" placeholder="Новый email">';
            echo '<input type="password" name="password" placeholder="Новый пароль">';
            echo '<input type="text" name="role" placeholder="Новая роль">';
            echo '<input type="submit" value="Изменить">';
            echo '</form>';
            echo '<form action="delete_user.php" method="post">';
            echo '<h3>Удалить пользователя</h3>';
            echo '<select name="users_id">';
                $query = $db->query("SELECT users_id, login FROM users");
                while ($row = $query->fetch_assoc()) {
                    echo "<option value=\"" . $row['users_id'] . "\">" . $row['login'] . "</option>";
                }
            echo '</select>';
            echo '<input type="submit" value="Удалить">';
            echo '</form>';
            echo '</div>';
            echo '</div>';

            echo '<div class="admin-panel">';
            echo '<h2>Управление онлайн-записями</h2>';
            echo '<form action="admin-only.php" method="post">';
            echo '<h3>Добавить запись</h3>';
            echo '<input type="text" name="name" placeholder="Имя">';
            echo '<input type="text" name="surname" placeholder="Фамилия">';
            echo '<input type="text" name="phone" placeholder="Телефон">';
            echo '<input type="text" name="dress_type" placeholder="Тип платья">';
            echo '<input type="date" name="date" placeholder="Дата">';
            echo '<input type="submit" name="add" value="Добавить">';
            echo '</form>';
            echo '<form action="admin-only.php" method="post">';
            echo '<h3>Изменить запись</h3>';
            echo '<input type="number" name="id" placeholder="ID">';
            echo '<input type="text" name="name" placeholder="Новое имя">';
            echo '<input type="text" name="surname" placeholder="Новая фамилия">';
            echo '<input type="text" name="phone" placeholder="Новый телефон">';
            echo '<input type="text" name="dress_type" placeholder="Новый тип платья">';
            echo '<input type="date" name="date" placeholder="Новая дата">';
            echo '<input type="submit" name="update" value="Изменить">';
            echo '</form>';
            echo '<form action="admin-only.php" method="post">';
            echo '<h3>Удалить запись</h3>';
            echo '<input type="number" name="id" placeholder="ID">';
            echo '<input type="submit" name="delete" value="Удалить">';
            echo '</form>';

            echo '<form action="add_selec.php" method="post">';
            echo '<h2>Управление оформлением</h2>';
            echo '<h3>Добавить оформление</h3>';
            echo '<input type="number" id="id" name="id" placeholder="ID" required>';
            echo '<input type="number" name="users_id" placeholder="ID пользователя" required>';
            echo '<input type="number" name="venues_id" placeholder="ID места" required>';
            echo '<input type="text" name="decoration_type" placeholder="Тип декорации" required>';
            echo '<textarea name="additional_services" placeholder="Дополнительные услуги"></textarea>';
            echo '<input type="submit" value="Добавить">';
            echo'</form>';
            echo '<form action="update_selec.php" method="post">';
            echo '<h3>Изменить оформление</h3>';
            echo '<input type="number" name="id" placeholder="ID" required>';
            echo '<input type="number" name="users_id" placeholder="ID пользователя" required>';
            echo '<input type="number" name="venues_id" placeholder="ID места" required>';
            echo '<input type="text" name="decoration_type" placeholder="Тип декорации" required>';
            echo '<textarea name="additional_services" placeholder="Дополнительные услуги"></textarea>';
            echo '<input type="submit" value="Обновить">';
            echo '</form>';
            echo '<form action="delete_selec.php" method="post">';
            echo '<h3>Удалить оформление</h3>';
            echo '<input type="number" name="id" placeholder="ID для удаления" required>';
            echo '<input type="submit" name="delete" value="Удалить">';
            echo '</form>';

            echo '<form method="post" action="add_v.php">';
            echo '<h2>Управление торжеством</h2>';
            echo '<h3>Добавить торжество</h3>';
            echo '<input type="number" id="id" name="id" placeholder="ID" required>';
            echo '<input type="text" id="name" name="name" placeholder="Название" required>';
            echo '<input type="text" id="address" name="address" placeholder="Адрес" required>';
            echo '<input type="number" id="capacity" name="capacity" placeholder="Вместимость" required>';
            echo '<input type="date" id="available_dates" name="available_dates">';
            echo '<input type="text" id="price" name="price" placeholder="Цена" required>';
            echo '<select id="payment_status" name="payment_status">';
            echo '<option value="Не оплачено">Не оплачено</option>';
            echo '<option value="Оплачено">Оплачено</option>';
            echo '</select>';
            echo '<input type="submit" name="submit" value="Добавить">';
            echo '</form>';
            echo '<form method="post" action="update_v.php">';
            echo '<h3>Изменить торжество</h3>';
            echo '<input type="number" id="id" name="id" placeholder="ID" required>';
            echo '<input type="text" id="name" name="name" placeholder="Название" required>';
            echo '<input type="text" id="address" name="address" placeholder="Адрес" required>';
            echo '<input type="number" id="capacity" name="capacity" placeholder="Вместимость" required>';
            echo '<input type="date" id="available_dates" name="available_dates">';
            echo '<input type="text" id="price" name="price" placeholder="Цена" required>';
            echo '<select id="payment_status" name="payment_status">';
            echo '<option value="Не оплачено">Не оплачено</option>';
            echo '<option value="Оплачено">Оплачено</option>';
            echo '</select>';
            echo '<input type="submit" name="update" value="Изменить">';
            echo '</form>';
            echo '<form method="post" action="delete_v.php">';
            echo '<h3>Удалить торжество</h3>';
            echo '<input type="number" id="id" name="id" placeholder="ID" required>';
            echo '<input type="submit" name="delete" value="Удалить">';
            echo '</form>';

            echo '<form action="add_dress.php" method="post">';
            echo '<h2>Управление платьями</h2>';
            echo '<h3>Добавить платье</h3>';    
            echo '<input type="text" id="name" name="name" placeholder="Название" required>';
            echo '<input type="text" id="size" name="size" placeholder="Размер">';
            echo '<input type="text" id="price" name="price" placeholder="Цена" required>';
            echo '<input type="text" id="manufacturer" name="manufacturer" placeholder="Производитель" required>';
            echo '<label for="in_stock">В наличии:</label>';
            echo '<input type="checkbox" id="in_stock" name="in_stock" checked>';
            echo '<input type="submit" value="Добавить">';
            echo '</form>';
            echo '<form action="update_dress.php" method="post">';
            echo '<h3>Изменить платье</h3>';
            echo '<input type="number" id="id" name="id" placeholder="ID" required>';
            echo '<input type="text" id="name" name="name" placeholder="Название" required>';
            echo '<input type="text" id="size" name="size" placeholder="Размер">';
            echo '<input type="text" id="price" name="price" placeholder="Цена" required>';
            echo '<input type="text" id="manufacturer" name="manufacturer" placeholder="Производитель" required>';
            echo '<label for="in_stock">В наличии:</label>';
            echo '<input type="checkbox" id="in_stock" name="in_stock">';
            echo '<input type="submit" value="Изменить">';
            echo '</form>';
            echo '<form action="delete_dress.php" method="post">';
            echo '<h3>Удалить платье</h3>';
            echo '<input type="number" id="id" name="id" placeholder="ID" required>';
            echo '<input type="submit" value="Удалить">';
            echo '</form>';

            echo '<form action="add_service.php" method="post">';
            echo '<h2>Управление услугами</h2>';
            echo '<h3>Добавить услугу</h3>';    
            echo '<input type="text" name="name" placeholder="Название услуги" required>';
            echo '<textarea name="description" placeholder="Описание услуги" required></textarea>';
            echo '<input type="submit" value="Добавить услугу">';
            echo '</form>';
            echo '<form action="modify_service.php" method="post">';
            echo '<h3>Изменить\Удалить услугу</h3>';
            echo '<input type="number" name="id" placeholder="ID услуги" required>';
            echo '<input type="text" name="name" placeholder="Новое название услуги">';
            echo '<textarea name="description" placeholder="Новое описание услуги"></textarea>';
            echo '<input type="submit" name="action" value="Изменить">';
            echo '<input type="submit" name="action" value="Удалить">';
            echo '</form>';
            $sql = "SELECT * FROM wedding_dresses WHERE manufacturer = 'Dian' AND in_stock = TRUE";
            $result = $db->query($sql);
            
            echo "<h3>ЗАПРОС 1. Наличие свадебных платьев от производителя 'Dian'.</h3>";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"]. " - Название: " . $row["name"]. " - Размер: " . $row["size"]. " - Цена: " . $row["price"]. " - Производитель: " . $row["manufacturer"]. " - В наличии: " . ($row["in_stock"] ? 'Да' : 'Нет') . "<br>";
                }
            } else {
                echo "0 результатов";
            }

            echo "<h3>ЗАПРОС 2. Список всех услугах.</h3>";
            $sql = "SELECT name FROM wedding_services";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "Название услуги: " . $row["name"] . "<br>";
                }
            } else {
                echo "Услуги не найдены.";
            }

            echo "<h3>ЗАПРОС 3. Список клиентов сделавщих заказ на платье А-силуэт.</h3>";
            $sql = "SELECT * FROM appointments WHERE dress_type = 'А-силуэт'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"]. " - Phone: " . $row["phone"]. " - Dress Type: " . $row["dress_type"]. " - Date: " . $row["date"]. "<br>";
            }
            } else {
            echo "0 results";
            }

            echo "<h3>ЗАПРОС 4. Список клиентов ожидающих примерку платья.</h3>";
            $sql = "SELECT id, name, surname, phone, date FROM appointments WHERE dress_type IN ('А-силуэт', 'Прямое')";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"]. " - Phone: " . $row["phone"]. " - Date: " . $row["date"]. "<br>";
            }
            } else {
            echo "0 results";
            }

            echo "<h3>ЗАПРОС 5. Статус примерки свадебного платья для определенного клиента.</h3>";
            $sql = "SELECT id, name, surname, phone, dress_type, date FROM appointments WHERE name = 'Марина' AND surname = 'Мирошниченко'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Surname: " . $row["surname"]. " - Phone: " . $row["phone"]. " - Dress Type: " . $row["dress_type"]. " - Date: " . $row["date"]. "<br>";
            }
            } else {
            echo "0 results";
            }

            
            echo "<h3>ЗАПРОС 6. Список всех доступных мест для проведения торжеств.</h3>";
            $selectSql = "SELECT * FROM venues WHERE payment_status = 'Не оплачено'";
            $result = $db->query($selectSql);

            // Проверка наличия результатов
            if ($result->num_rows > 0) {
            // Вывод данных каждой строки
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Address: " . $row["address"]. " - Capacity: " . $row["capacity"]. " - Available Dates: " . $row["available_dates"]. " - Price: " . $row["price"]. " - Payment Status: " . $row["payment_status"]. "<br>";
            }
            } else {
            echo "0 results";
            }

            echo "<h3>ЗАПРОС 7. Список всех клиентов, выбравших указанное место, тип оформления и дополнительные услуги.</h3>";
            $sql = "SELECT u.login, u.email, us.decoration_type, us.additional_services
            FROM users_selections us
            JOIN users u ON us.users_id = u.users_id
            WHERE us.venues_id = 1 AND us.decoration_type = 'Романтический' AND us.additional_services LIKE '%Флористика%'";

            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "login: " . $row["login"]. " - Email: " . $row["email"]. " - Тип декорации: " . $row["decoration_type"]. " - Дополнительные услуги: " . $row["additional_services"]. "<br>";
                }
            } else {
            echo "0 результатов";
        }

        echo "<h3>ЗАПРОС 8. Список клиентов, у которых проводится торжество в одном и том же месте с определенной тематикой оформления свадьбы.</h3>";
        $sql = "SELECT u.login, u.email, v.name AS venue_name, us.decoration_type
        FROM users AS u
        JOIN users_selections AS us ON u.users_id = us.users_id
        JOIN venues AS v ON us.venues_id = v.id
        WHERE v.available_dates BETWEEN '2024-08-01' AND '2024-09-05'
        AND us.decoration_type = 'Романтический'
        AND v.name = 'Банкетный зал Роскошь'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
        // Вывод данных каждой строки
        while($row = $result->fetch_assoc()) {
            echo "login: " . $row["login"]. " - Email: " . $row["email"]. " - Venue Name: " . $row["venue_name"]. " - Decoration Type: " . $row["decoration_type"]. "<br>";
        }
        } else {
        echo "0 results";
        }

        echo "<h3>ЗАПРОС 9. Список клиентов, сделавших заказы на свадебные услуги с указанием общей суммы заказов каждого клиента.</h3>";
        $sql = "SELECT u.login, u.email, SUM(v.price) AS total_amount
        FROM users AS u
        JOIN users_selections AS us ON u.users_id = us.users_id
        JOIN venues AS v ON us.venues_id = v.id
        GROUP BY u.login, u.email
        ORDER BY total_amount DESC";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
        // Начало таблицы и стилей
        echo '<table style="margin-left:auto;margin-right:auto;"><tr><th>Login</th><th>Email</th><th>Total Amount</th></tr>';
        // Вывод данных каждой строки
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["login"]. "</td><td>" . $row["email"]. "</td><td>" . $row["total_amount"]. "</td></tr>";
        }
        echo "</table>";
        } else {
        echo "0 results";
        }

        echo "<h3>ЗАПРОС 10. Список клиентов, у которых заказы на свадебные услуги ожидают оплаты.</h3>";
        $sql = "SELECT u.users_id, u.login, u.email
        FROM users_selections us
        INNER JOIN venues v ON us.venues_id = v.id
        INNER JOIN users u ON us.users_id = u.users_id
        WHERE v.payment_status = 'Не оплачено'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
        // Вывод данных каждой строки
        while($row = $result->fetch_assoc()) {
            echo "User ID: " . $row["users_id"]. " - Login: " . $row["login"]. " - Email: " . $row["email"]. "\n";
        }
        } else {
        echo "0 results";
        }
        $db->close();
            
            echo '</div>';
        
        }

        else {
            echo '</div></div>';
            echo '<div class="order-status">';
            echo 'Заказ:<span class="active-status">Активен</span>';
            echo '</div>';
            echo '<table class="order-table">';
            echo '<tr>';
            echo '<th>№</th>';
            echo '<th>Телефон</th>';
            echo '<th>Вид платья</th>';
            echo '<th>Дата приемки</th>';
            echo '</tr>';
            echo '</table>';
        }
    } else {
        header('Location: /login.php');
        exit();
    }
?>



      <footer class="footer">
        <div class="footer_socials">
            <a href="" class="footer_socials_link"><img src="img/вк.png"/></a>
            <a href="" class="footer_socials_link"><img src="img/пинтерест.png"/></a>
            <a href="" class="footer_socials_link"><img src="img/телеграмм.png"/></a>
        </div>
        <p class="footer_copyright">©LaVieenRose2024</p>
    </footer>
    <script src="account.js"></script>
  </body>
  </html>