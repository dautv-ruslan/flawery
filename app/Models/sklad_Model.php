<?php

namespace App\Models;

use CodeIgniter\Model;

class sklad_Model extends Model {
    /* Объявляем переменную $db - база данных */
    protected $db;
    /* Выбираем таблицу fadmin_sklad в переменной $table нашей модели */
    protected $table = 'fadmin_sklad';
    /* Выбираем ключ таблицы */
    protected $primaryKey = 'id';
    /* Выбираем вид возвращаемых данных объект */
    protected $returnType = 'object';
    /* Помечать данные как удаленные вместо фактического удаления? false */
    protected $useSoftDeletes = false;
    /* Выбираем поля, которые будем записывать методами INSERT, UPDATE */
    protected $allowedFields = [
        'name', 'qty', 'price'
    ];
    /* Определяем массив наименований товаров */
    public $name_product = [1 => "Цветы", 2 => "Зелень", 3 => "Упаковка", 4 => "Лента", 5 => "Товар", 6 => "Прочее"];

    /* Конструктор */
    function __construct(\CodeIgniter\Database\ConnectionInterface &$db = null, \CodeIgniter\Validation\ValidationInterface $validation = null) {
        parent::__construct($db, $validation);
        $this->db = & $db;
    }

    /* load_product - выбираем товары из таблицы fadmin_sklad
     *  Имя товара получаем из таблицы product_flowers 
     */
    public function load_product() {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Формируем запрос */
        $query = "SELECT `name`, `fadmin_sklad`.`id_product`, `post_date`, `qty`, `type`, `cost` FROM `fadmin_sklad` LEFT JOIN `product_flowers` ON `product_flowers`.`id` = `fadmin_sklad`.`id_product`";
        /* Выполняем запрос */
        $result = $this->db->query($query);
        /* Возвращаем результат */
        return $result;
    }
    /* insert_flower($insert_data) - записываем данные в таблицу product_flowers */
    public function insert_flower($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос
             * Используем подготовку запроса, где
             * знак вопроса это поля, которые
             * подставим позже */            
            $query = "INSERT INTO `product_flowers` (`name`, `size`, `color`,`country`,`sort`,`description`) VALUES (?,?,?,?,?,?)";
            /* Выполняем запрос, подставляя нужные данные в запрос */
            $this->db->query($query,
                    [   $insert_data['name'],
                        $insert_data['size'],
                        $insert_data['color'],
                        $insert_data['country'],
                        $insert_data['sort'],
                        $insert_data['description']
                    ]);
            /* Получаем id вставленной строки */
            $insert_data['id_product'] = $this->db->insertID();
            /* Возвращаем id_product для записи в таблицу fadmin_sklad */
            return $insert_data['id_product'];
        }
    }
    /* insert_other($insert_data) - записываем данные в таблицу product_other */
    public function insert_other($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос
             * Используем подготовку запроса, где
             * знак вопроса это поля, которые
             * подставим позже */            
            $query = "INSERT INTO `product_other` (`color`,`material`,`country`,`width`,`height`) VALUES (?,?,?,?,?)";
            /* Выполняем запрос, подставляя нужные данные в запрос */
            $this->db->query($query,
                    [   $insert_data['color'],
                        $insert_data['material'],
                        $insert_data['country'],
                        $insert_data['width'],
                        $insert_data['height']
                    ]);
            /* Получаем id вставленной строки */
            $insert_data['id_product'] = $this->db->insertID();
            /* Возвращаем id_product для записи в таблицу fadmin_sklad */
            return $insert_data['id_product'];
        }
    }
    /* insert_goods($insert_data) - записываем данные в таблицу product_goods */
    public function insert_goods($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос
             * Используем подготовку запроса, где
             * знак вопроса это поля, которые
             * подставим позже */            
            $query = "INSERT INTO `product_goods` (`color`,`material`,`country`,`width`,`height`) VALUES (?,?,?,?,?)";
            /* Выполняем запрос, подставляя нужные данные в запрос */
            $this->db->query($query,
                    [   $insert_data['color'],
                        $insert_data['material'],
                        $insert_data['country'],
                        $insert_data['width'],
                        $insert_data['height']
                    ]);
            /* Получаем id вставленной строки */
            $insert_data['id_product'] = $this->db->insertID();
            /* Возвращаем id_product для записи в таблицу fadmin_sklad */
            return $insert_data['id_product'];
        }
    }
    /* insert_herbs($insert_data) - записываем данные в таблицу product_herbs */
    public function insert_herbs($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос
             * Используем подготовку запроса, где
             * знак вопроса это поля, которые
             * подставим позже */            
            $query = "INSERT INTO `product_herbs` (`country`,`sort`,`piece`) VALUES (?,?,?)";
            /* Выполняем запрос, подставляя нужные данные в запрос */
            $this->db->query($query,
                    [   $insert_data['country'],
                        $insert_data['sort'],
                        $insert_data['piece']
                    ]);
            /* Получаем id вставленной строки */
            $insert_data['id_product'] = $this->db->insertID();
            /* Возвращаем id_product для записи в таблицу fadmin_sklad */
            return $insert_data['id_product'];
        }
    }
    /* insert_ribbon($insert_data) - записываем данные в таблицу product_ribbon */
    public function insert_ribbon($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос
             * Используем подготовку запроса, где
             * знак вопроса это поля, которые
             * подставим позже */            
            $query = "INSERT INTO `product_ribbon` (`color`,`material`,`country`,`width`,`height`) VALUES (?,?,?,?,?)";
            /* Выполняем запрос, подставляя нужные данные в запрос */
            $this->db->query($query,
                    [   $insert_data['color'],
                        $insert_data['material'],
                        $insert_data['country'],
                        $insert_data['width'],
                        $insert_data['height']
                    ]);
            /* Получаем id вставленной строки */
            $insert_data['id_product'] = $this->db->insertID();
            /* Возвращаем id_product для записи в таблицу fadmin_sklad */
            return $insert_data['id_product'];
        }
    }
    /* insert_package($insert_data) - записываем данные в таблицу product_package */
    public function insert_package($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос
             * Используем подготовку запроса, где
             * знак вопроса это поля, которые
             * подставим позже */            
            $query = "INSERT INTO `product_package` (`color`,`material`,`country`,`roll`,`width`,`height`) VALUES (?,?,?,?,?,?)";
            /* Выполняем запрос, подставляя нужные данные в запрос */
            $this->db->query($query,
                    [   $insert_data['color'],
                        $insert_data['material'],
                        $insert_data['country'],
                        $insert_data['roll'],
                        $insert_data['width'],
                        $insert_data['height']
                    ]);
            /* Получаем id вставленной строки */
            $insert_data['id_product'] = $this->db->insertID();
            /* Возвращаем id_product для записи в таблицу fadmin_sklad */
            return $insert_data['id_product'];
        }
    }
    /* insert_product - записываем данные в таблицу fadmin_sklad */
    public function insert_product($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Если параметр $insert_data не пустой массив */
        if (!empty($insert_data)) {
            /* Формируем запрос, где в знаки вопроса подставим нужные значения */
            $query = "INSERT INTO `fadmin_sklad` (`id_product`, `name`, `qty`, `cost`,`sale_price`,`post_date`,`type`,`available`, `image`, `image_retina`) VALUES (?,?,?,?,?,?,?,?,?,?)";
            /* Выполняем запрос, подставляя нужные значения */
            $this->db->query($query,
                    [   $insert_data['id_product'],
                        $insert_data['name'],
                        $insert_data['qty'],
                        $insert_data['cost'],
                        $insert_data['sale_price'],
                        $insert_data['post_date'],
                        $insert_data['type'],
                        $insert_data['available'],
                        $insert_data['image'],
                        $insert_data['image_retina']
                    ]);
        }
    }
    /* insert_movement($insert_data) - функция записи списания товара в базу данных fadmin_admission */
    public function insert_product_movement($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Формируем запрос */
        $query = "INSERT INTO `fadmin_admission` (`type`, `id_product`, `qty`, `event`) VALUES (?,?,?,?)";
        /* Выполняем запрос, подставляя нужные значения вместа знака "?" */
        $result = $this->db->query($query, [$insert_data['admission_type'], $insert_data['id_product'], $insert_data['qty'], $insert_data['event']]);
        /* Возвращаем результат */
        return $result;
    }
    /* insert_writeoff($insert_data) - функция записи списания товара в базу данных */
    public function insert_writeoff($insert_data = array()) {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Формируем запрос */
        $query = "INSERT INTO `fadmin_writeoff` (`type`, `id_product`, `description`, `qty`, `post_date`) VALUES (?,?,?,?,?)";
        /* Выполняем запрос, подставляя нужные значения вместа знака "?" */
        $result = $this->db->query($query, ['flower', $insert_data['id_product'], $insert_data['description'], $insert_data['qty'], $insert_data['post_date']]);
        /* Возвращаем результат */
        return $result;
    }
    /* Загрузка названий стран */
    public function load_countries() {
        /* Загружаем базу данных */
        $this->db = \Config\Database::connect();
        /* Выполняем запрос */
        $results = $this->db->query("SELECT * FROM `list` ORDER BY `value`");
        /* Возвращаем список стран */
        return $results->getResultObject();
    }
}

?>
