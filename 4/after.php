<?php

// Вариант "после"

/*
 * Найденные ошибки:
 * - логика и представление "слеплены" (нет MVC)
 * - нет типизации аргументов функции
 * - вытащить повторяющееся действие (подключение к БД) за пределы цикла
 * - параметры подключения к БД хранятся внутри кода
 * - ту же самую операцию можно выполнить одним SQL запросом
 * - есть XSS уязвимость, если пользователь зарегистрируется с именем `</a><script ...` (нет шаблонизации)
 * - есть blind sql injection, проэксплуатировать можно так:
 *  `?user_ids=2 or 1=1`
 * - будут ворнинги так как $data не определен
 *
 * Я сохранил интерфейс функции, но добавил тайп хинтинг
 */

/**
 * @param string $user_ids
 * @return array
 */
function load_users_data(string $user_ids): array
{
  $user_ids = explode(',', $user_ids);
  $user_ids = array_filter($user_ids);
  if(!count($user_ids)) return [];
  $user_ids = array_map(function($id){
    return (int)$id;
  }, $user_ids);

  $data = [];

  // соединение с БД должно быть на уровне приложения, а не в функции
  $db = App::getDefaultConnection();

  $query = sprintf("SELECT id, name FROM users WHERE id IN(%s)", implode(",", $user_ids));

  $sql = mysqli_query($db, $query);
  while ($obj = $sql->fetch_object()) {
    $data[$obj->id] = $obj->name;
  }

  return $data;
}

// тестовые данные
$_GET['user_ids'] = "1, 2,3, 5,,";

// где-то во view:
$data = load_users_data($_GET['user_ids']);

// в шаблоне:
foreach ($data as $user_id => $name) { ?>
    <a href="/show_user.php?id=<?= (int)$user_id ?>"><?= htmlspecialchars($name) ?></a>
<?php }