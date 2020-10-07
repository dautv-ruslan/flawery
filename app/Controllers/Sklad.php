<?php namespace App\Controllers;

class Sklad extends BaseController {
    
    public function index() {
        /* Загружаем переменные сессии */
        session_start();
        /* Загружаем хелперы */

        helper('form');
        helper('html');
        helper('url');

        /* Определяем глобальный массив */

        $GLOBALS['product_types'] = array(
            'flowers' => 1,
            'goods' => 2,
            'herbs' => 3,
            'package' => 4,
            'ribbon' => 5,
            'other' => 6
        );

        /* Загружаем модель */

        $model = new \App\Models\sklad_Model();

        /* Загружаем модуль валидации */

        $validation = \Config\Services::validation();

        /* Загружаем базу данных */

        $db = \Config\Database::connect();

        /* Сегодняшний день */
        $today = time();
        
        /* Загружаем данные для таблицы товаров */
        
        $query = "SELECT `name`, `id`,`id_product`, `post_date`, `qty`, `type`, `cost`,`image`,`image_retina` FROM `fadmin_sklad`";
        $result = $db->query($query);

        /* Загружаем списанные товары */
        
        $writeoff_query = "SELECT * FROM `fadmin_writeoff`";
        $writeoff_result = $db->query($writeoff_query);
        
        /* Если файл загружен */
        /* Проверяем загруженный файл на вирусный код */
        if ($_FILES && $_FILES["photo"]["name"] != "") {
            /* $is_valid_image_file - корректный ли файл картинки */
            $is_valid_image_file = true;
            /* Проверяем не является ли загруженный файл скриптом php */
            $blacklist = array(".php", ".phtml", ".php3", ".php4");
            foreach ($blacklist as $item) {
                if (preg_match("/$item\$/i", $_FILES['photo']['name'])) {
                    echo "Загрузка PHP файлов запрещена\n";
                    $is_valid_image_file = false;
                }
            }
            /* Проверяем корректный ли формат загруженной картинки */
            $imageinfo = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($imageinfo["mime"] != "image/png" && $imageinfo["mime"] != "image/jpeg") {
                echo "Загружаемое изображение имеет неизвестный формат\n Допустимые типы: png, jpg\n";
                $is_valid_image_file = false;
            }
            /* Если корректный файл, сохраняем в размерах 25x25 для обычных экранов, 50x50 для экранов retina */
            $filename = str_replace(" ", "_", "25x25_" . esc($_FILES['photo']['name']));
            $filename_retina = str_replace(" ", "_", "50x50_" . esc($_FILES['photo']['name']));
            if ($is_valid_image_file) {
                $image = \Config\Services::image()
                        ->withFile($_FILES['photo']['tmp_name'])
                        ->fit(25, 25, 'center')
                        ->save("images/flowers/" . $filename);
                $image_retina = \Config\Services::image()
                        ->withFile($_FILES['photo']['tmp_name'])
                        ->fit(50, 50, 'center')
                        ->save("images/flowers/" . $filename_retina);
            }
        }
        /* Сохраняем сортировку */
        $sort = "";
        /* Нажата кнопка submit */
        if ($_POST) {
            $add = "";
            $order = "";
            $limit = "";
            /* Устанавливаем период */
            if (isset($_POST['period'])) {
                /* Получаем период */
                $period = filter_input(INPUT_POST, 'period');
                /* Создаем сегодняшнюю дату */
                $date = time();
                /* Создаем еще одну переменную для интервала дат */
                $d = new \DateTime(date("Y-m-d"));
                /* Если выбрано сегодня */
                if ($period == "Сегодня") {
                    /* Формируем дополнение к запросу */
                    $add = " YEAR(`post_date`) = " . $d->format("Y") . " AND MONTH(`post_date`) = " . $d->format("m") . " AND DAY(`post_date`) = " . $d->format("d");
                }
                /* Если выбрано вчера */
                if ($period == "Вчера") {
                    /* Отнимаем один день у сегодняшней даты */
                    $d->modify("-1 day");
                    /* Формируем дополнение к запросу */
                    $add = " YEAR(`post_date`) = " . $d->format("Y") . " AND MONTH(`post_date`) = " . $d->format("m") . " AND DAY(`post_date`) = " . $d->format("d");
                }
                /* Если выбрано 7 дней */
                if ($period == "7 дней") {
                    /* Отнимаем 7 дней у сегодняшней даты */
                    $d->modify("-7 day");
                    /* Формируем дополнение к запросу */
                    $add = " `post_date` > DATE_SUB(CURDATE(), INTERVAL (DAYOFWEEK(CURDATE()) -1) DAY) and `post_date` < DATE_ADD(CURDATE(), INTERVAL (9 - DAYOFWEEK(CURDATE())) DAY)";
                }
                /* Если выбрано месяц */
                if ($period == "Месяц") {
                    /* Формируем дополнение к запросу, указав год и месяц */
                    $add = " YEAR(`post_date`) = " . date("Y", $date) . " AND MONTH(`post_date`) = " . date("m", $date);
                }
            }
            if (isset($_POST['date'])) {
                $datepicker = filter_input(INPUT_POST, 'date');
                $date = explode(".", $datepicker);
                if (!empty($date)) {
                    $add = " MONTH(`post_date`) = " . (int)strip_tags($date[1]) . " AND DAY(`post_date`) = " . (int)strip_tags($date[0]); 
                }
            }
            if (isset($_POST['option'])) {
                $option = filter_input(INPUT_POST, 'option');
                if ($add != "" && $option != "Общие" && $option != "Списано") {
                    $add .= " AND";
                }
                switch ($option) {
                    case "Цветы": $add .= " `type` = 1 OR `type` = 0"; break;
                    case "Упаковка": $add .= " `type` = 3"; break;
                    case "Лента": $add .= " `type` = 4"; break;
                    case "Товар": $add .= " `type` = 5"; break;
                    case "Прочее": $add .= " `type` = 6"; break;
                    case "Зелень": $add .= " `type` = 2"; break;
                }
            }
            if (isset($_POST['keyword_search'])) {
                $keyword = filter_input(INPUT_POST, 'keyword_search');
                if ($add != "") {
                    $add .= " AND";
                }
                $add .= " `name` LIKE '%" . strip_tags(trim($keyword)) ."%'";
            }
//            if (isset($_POST['name'])) {
//                $sort = filter_input(INPUT_POST, 'name');
//            }
//            if (isset($_POST['post'])) {
//                $sort = filter_input(INPUT_POST, 'post');
//            }
//            if (isset($_POST['qty'])) {
//                $sort = filter_input(INPUT_POST, 'qty');
//            }
//            if (isset($_POST['type'])) {
//                $sort = filter_input(INPUT_POST, 'type');
//            }
//            if (isset($_POST['cost'])) {
//                $sort = filter_input(INPUT_POST, 'cost');
//            }
            if (isset($_POST['sort'])) {
                $sort = filter_input(INPUT_POST, 'sort');
                switch ($sort) {
                    case "Наименование": 
                        $order = " ORDER BY `name`";
                        if (isset($_SESSION['sort']) && $_SESSION['sort'] == "Наименование") {
                            if (isset($_SESSION['sort_by']) && $_SESSION['sort_by'] == "ASC") {
                                $order .= " DESC";
                                $_SESSION['sort_by'] = "DESC";
                            } else {
                                $_SESSION['sort_by'] = "ASC";
                            }
                        }
                        break;
                    case "Поставка": 
                        $order = " ORDER BY `post_date`";
                        if (isset($_SESSION['sort']) && $_SESSION['sort'] == "Поставка") {
                            if (isset($_SESSION['sort_by']) && $_SESSION['sort_by'] == "ASC") {
                                $order .= " DESC";
                                $_SESSION['sort_by'] = "DESC";
                            } else {
                                $_SESSION['sort_by'] = "ASC";
                            }
                        }
                        break;
                    case "Кол-во": 
                        $order = " ORDER BY `qty`";
                        if (isset($_SESSION['sort']) && $_SESSION['sort'] == "Кол-во") {
                            if (isset($_SESSION['sort_by']) && $_SESSION['sort_by'] == "ASC") {
                                $order .= " DESC";
                                $_SESSION['sort_by'] = "DESC";
                            } else {
                                $_SESSION['sort_by'] = "ASC";
                            }
                        }
                        break;
                    case "Тип": 
                        $order = " ORDER BY `type`";
                        if (isset($_SESSION['sort']) && $_SESSION['sort'] == "Тип") {
                            if (isset($_SESSION['sort_by']) && $_SESSION['sort_by'] == "ASC") {
                                $order .= " DESC";
                                $_SESSION['sort_by'] = "DESC";
                            } else {
                                $_SESSION['sort_by'] = "ASC";
                            }
                        }
                        break;
                    case "Стоимость": 
                        $order = " ORDER BY `cost`";
                        if (isset($_SESSION['sort']) && $_SESSION['sort'] == "Стоимость") {
                            if (isset($_SESSION['sort_by']) && $_SESSION['sort_by'] == "ASC") {
                                $order .= " DESC";
                                $_SESSION['sort_by'] = "DESC";
                            } else {
                                $_SESSION['sort_by'] = "ASC";
                            }
                        }
                        break;
                }
                $_SESSION['sort'] = $sort;
            }
            if (isset($_POST['show_all'])) {
                $show = filter_input(INPUT_POST, 'show_all');
                $limit .= " LIMIT " . strip_tags(trim($show));
            }
            /* Форма списания цветов */
            if (isset($_POST['flower_delete'])) {
                /* Получаем данные post запроса */
                $date = filter_input(INPUT_POST, 'arrival_date');
                $flower = filter_input(INPUT_POST, 'flower_name');
                $description = filter_input(INPUT_POST, 'description');
                $amount = filter_input(INPUT_POST, 'flower_amount');
                /* Валидация формы */
                if (!$this->validate([
                            /* Обязательное поле, точно 10 символов */
                            'arrival_date' => 'required|min_length[10]|max_length[10]',
                            /* Обязательное поле, число */
                            'flower_name' => 'required|integer',
                            /* Необязательное поле, строка */
                            'description' => 'string',
                            /* Обязательное поле, число, больше 0 */
                            'flower_amount' => 'required|integer|greater_than[0]'
                        ])) {
                    echo "Не прошло валидацию";
                    /* Выводим данные запроса на экрана для отладки */
                    //var_dump($_POST);
                    /* Если прошло валидацию */
                } else {
                    /* Получаем данные */
                    $insert_data = array(
                        'date' => $date,
                        'id_product' => $flower,
                        'description' => $description,
                        'qty' => $amount,
                        /* Переводим дату и время в нужный вид */
                        'post_date' => date("Y-m-d H:i:s", time())
                    );
                    /* Вычисляем количество цветов для списания */
                    $quantity_id = -1;
                    $qty = 0;
                    /* Цикл выполняется, пока не найдем нужную строку */
                    foreach ($result->getResultObject() as $row) {
                        if ($row->id_product === $insert_data['id_product']) {
                            $quantity_id = $row->id;
                            $qty = $row->qty;
                            break;
                        }
                    }
                    /* Проверяем найдена ли нужная строка в базе данных
                     * Если не найдена, смысла записывать списание нет
                     */
                    if ($quantity_id != -1) {
                        /* Вводим переменные для записи движения товара */
                        $insert_data['admission_type'] = 3;
                        $insert_data['event'] = 0;
                        /* Записываем списание цветов в базу данных */
                        $model->insert_writeoff($insert_data);
                        $model->insert_product_movement($insert_data);
                        /* Обновляем склад, устанавливаем новое количество товара, отнимаем количество списанных. */
                        /* $insert_data['id_product'] - id товара */
                        $query = "UPDATE `fadmin_sklad` SET `qty` = " . ($qty - $insert_data['qty']) . " WHERE `id_product` = " . $insert_data['id_product'];
                        $db->query($query);
                    }
                }
            }
            /* Если форма добавления цветов */
            if (isset($_POST['flower_add'])) {
                /* Проходим валидацию */
                if (!$this->validate([
                            /* Обязательное поле, минимальное количество символов в строке - 1, максимальное - 255 */
                            'name' => 'required|string|min_length[1]|max_length[255]',
                            /* Обязательное поле, минимальное количество символов в строке - 1, максимальное - 255 */
                            'sort' => 'required|string|min_length[1]|max_length[255]',
                            /* Обязательное поле, 2 символа */
                            'country' => 'required|alpha|min_length[2]|max_length[2]',
                            /* Обязательное поле, минимальное количество символов в строке - 1, максимальное - 255 */
                            'color' => 'required|string|min_length[1]|max_length[255]',
                            /* Обязательное поле, минимальное количество символов в строке - 1, максимальное - 255 */
                            'height' => 'required|string|min_length[1]|max_length[255]',
                            /* Обязательное поле, число, больше 0 */
                            'flower_amount' => 'required|integer|greater_than[0]',
                            /* Обязательное поле, число */
                            'price' => 'required|integer|greater_than[0]',
                            /* Обязательное поле, число */
                            'sale_price' => 'required|integer|greater_than[0]',
                            /* Необязательное поле */
                            'description' => 'string'
                        ])) {
                    echo "Не прошло валидацию";
                    /* Выводим post запрос */
                    //var_dump($_POST);
                } else {
                    /* Если прошло валидацию */
                    $insert_data = array(
                        'name' => strip_tags($this->request->getPost('name')),
                        'size' => strip_tags($this->request->getPost('height')),
                        'color' => strip_tags($this->request->getPost('color')),
                        'country' => strip_tags($this->request->getPost('country')),
                        'sort' => strip_tags($this->request->getPost('sort')),
                        'description' => strip_tags($this->request->getPost('description')),
                        'qty' => strip_tags($this->request->getPost('flower_amount')),
                        'cost' => strip_tags($this->request->getPost('price')),
                        'sale_price' => strip_tags($this->request->getPost('sale_price')),
                        /* Переводим дату и время в нужный вид */
                        'post_date' => date("Y-m-d H:i:s", time()),
                        'type' => 1,
                        'available' => 1,
                        'image' => isset($filename) ? "flowers/" . strip_tags($filename) : "",
                        'image_retina' => isset($filename_retina) ? "flowers/" . strip_tags($filename_retina) : ""
                    );
                    /* Добавляем цветок в базу данных products_flower */
                    $insert_data['id_product'] = $model->insert_flower($insert_data);
                    $insert_data['admission_type'] = 1;
                    $insert_data['event'] = 0;
                    /* Добавляем цветок в базу данных fadmin_sklad */
                    $model->insert_product($insert_data);
                    $model->insert_product_movement($insert_data);
                }
            }
            /* Загружаем данные для таблицы товаров заново так как данные поменялись */
            if (isset($_POST['option']) && $_POST['option'] == "Списано") {
                $query = "SELECT `product_flowers`.`name`, `fadmin_sklad`.`id`, `fadmin_sklad`.`id_product`, `fadmin_sklad`.`post_date`, `fadmin_writeoff`.`qty`, `fadmin_sklad`.`type`, `cost`, `fadmin_sklad`.`image`, `fadmin_sklad`.`image_retina` FROM `fadmin_sklad` LEFT JOIN `product_flowers` ON `product_flowers`.`id` = `fadmin_sklad`.`id_product` LEFT JOIN `fadmin_writeoff` ON `fadmin_writeoff`.`id_product` = `fadmin_sklad`.`id_product` WHERE `fadmin_writeoff`.`post_date` IS NOT NULL";
                if ($add != "") {
                    $query .= " AND" . $add;
                } 
            } else {
                $query = "SELECT `name`, `id`,`id_product`, `post_date`, `qty`, `type`, `cost`,`image`,`image_retina` FROM `fadmin_sklad`";
                if ($add != "") {
                    $query .= " WHERE" . $add;
                } 
            }
            if ($order != "") {
                $query .= $order;
            }
            if ($limit != "") {
                $query .= $limit;
            }
//            echo "$query";\
            $result = $db->query($query);
            /* Загружаем списанные товары */
            $writeoff_query = "SELECT * FROM `fadmin_writeoff`";
            if ($add != "") {
                $query .= " WHERE" . $add;
            }
            $writeoff_result = $db->query($writeoff_query);
        }
//        $email = \Config\Services::email();
//
//        $email->setFrom('admin@fadmin.profflo.store', 'Fadmin');
//        $email->setTo('some_email@gmail.com');
//
//        $email->setSubject('Тестируем класс электронной почты');
//        $email->setMessage('Тестируем отправку почты.');
//
//        $email->send();

        $data = [
            'records' => 3,
            'news' => $result->getResultObject(),
            'pager' => $model->pager,
            'validation' => $validation
        ];

        /* Загружаем названия стран для формы */

        $data['countries'] = $model->load_countries();
        
        /* Загружаем списанные товары */
        
        $data['writeoff'] = $writeoff_result->getResultObject();
        
        /* Передаем выбранный раздел товаров */
        
        $data['option'] = filter_input(INPUT_POST, 'option');
        
        /* Устанавливаем название страницы */

        $data['title'] = 'О сайте';
        $data['header'] = 'Склад';
        $data['nav'] = 'sklad';
        $data['period'] = filter_input(INPUT_POST, 'period');
        $data['datepicker'] = filter_input(INPUT_POST, 'date');
        /* Передаем строку поиска */
        if (isset($_POST['keyword_search'])) {
            $data['keyword'] = filter_input(INPUT_POST, 'keyword_search');
        }
        /* Передаем поле таблицы для сортировки */
        $data['sort'] = $sort;
        /* Передаем количество отображаемых строк */
        if (isset($_POST['show_all'])) {
            $data['show_all'] = filter_input(INPUT_POST, 'show_all');
        } else {
            $data['show_all'] = 9;
        }
        /* Загружаем вид */

        return view('sklad', $data);
    }
    
    public function get_autocomplete() {
        if (isset($_GET['term'])) {
//            $db = \Config\Database::connect();
//            $query = $db->query("SELECT * FROM `fadmin_sklad` WHERE `name` LIKE '%Роза' ORDER BY `name`");
//            $results = $query->getResult();
            
            $results = array("Анемоны","Альстромерии","Астры","Гвоздики","Герберы","Гиацинты","Гиперикум","Гипсофила","Гортензии","Ирисы","Каллы","Кустовые розы","Лаванда","Ландыши","Лилии","Луговые цветы","Маттиола","Мимозы","Нарциссы","Орхидеи","Пионы","Подсолнухи","Полевые цветы","Ранункулюс","Розы","Ромашки","Сантини","Сирень","Тюльпаны","Фрезии","Хризантемы","Эустома");
            
            if ($results) {
                /* Если ответ не пустой, перебираем строки ответа */
                foreach ($results as $res) {
                    if (strpos($res, $term) !== false) {
                    /* Сохраняем name в массив $arr_result */
                    $arr_result[] = $res;
                    }
                }
                /* Переводим массив $arr_result в json */
                return json_encode($arr_result);
                /* Если ответ пустой, возвращаем false */
            } else {
                return false;
            }
        }
    }
}
