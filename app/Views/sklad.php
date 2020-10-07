<?php
include 'config/env.php';
include 'templates/header.php';
include 'pages/menu.php';
?>
<div class="container-fluid content">
    <div class="sklad hidden-xs">
        <h1><?php echo "$header"; ?></h1>
        <span class="checkradios active"><span class="show-graph custom-style">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Показать график</span>
    </div>
    <div class="option hidden-xs">
        <form method="post">
        <ul class="list">
            <li><a <?php if (!isset($option) || $option == "Общие") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Общие" /></a></li>
            <li><a <?php if (isset($option) && $option == "Цветы") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Цветы" /></a></li>
            <li><a <?php if (isset($option) && $option == "Упаковка") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Упаковка" /></a></li>
            <li><a <?php if (isset($option) && $option == "Лента") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Лента" /></a></li>
            <li><a <?php if (isset($option) && $option == "Товар") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Товар" /></a></li>
            <li><a <?php if (isset($option) && $option == "Прочее") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Прочее" /></a></li>
            <li><a <?php if (isset($option) && $option == "Зелень") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Зелень" /></a></li>
            <li><a <?php if (isset($option) && $option == "Списано") { echo 'class="active"';} ?> href="#"><input type="submit" name="option" value="Списано" /></a></li>
        </ul>
        </form>
    </div>
    <div class="clear"></div>
    <div class="general">
        <form method="post">
            <ul class="list">
                <li <?php
                if (!isset($period) || $period == "Сегодня") {
                    echo 'class="active"';
                }
                ?>><a href="#"><input class="period" type="submit" name="period" value="Сегодня"></a></li>
                <li <?php
                if (isset($period) && $period == "Вчера") {
                    echo 'class="active"';
                }
                ?>><a href="#"><input class="period" type="submit" name="period" value="Вчера"></a></li>
                <li <?php
                if (isset($period) && $period == "7 дней") {
                    echo 'class="active"';
                }
                ?>><a href="#"><input class="period" type="submit" name="period" value="7 дней"></a></li>
                <li <?php
                if (isset($period) && $period == "Месяц") {
                    echo 'class="active"';
                }
                ?>><a href="#"><input class="period" type="submit" name="period" value="Месяц"></a></li>
            </ul>
        </form>
        <br />
        <a id="choose_date">
            <form method="post">
                <input class="datepicker" value="с" style="text-align: right;">
                <input onchange="submit()" type="input" id="datepicker" class="datepicker" name="date" value="<?php if (isset($datepicker) && $datepicker != "" && $datepicker != "Выбрать дату") { echo $datepicker; } else { echo "Выбрать дату"; } ?>" />
                <input class="datepicker" value="по" style="text-align: right;">
                <input onchange="submit()" type="input" id="datepicker1" class="datepicker" name="date1" value="<?php if (isset($datepicker1) && $datepicker1 != "" && $datepicker != "Выбрать дату") { echo $datepicker1; } else { echo "Выбрать дату"; } ?>" />
            </form></a>
        <br />
        &nbsp;
    </div>
    <div class="clear"></div>
    <div class="add_product">
        <button>+ Добавить товар</button>
    </div>
    <div class="delete_product">
        <button>- Списать товар</button>
    </div>
    <div class="chart_wrapper">
        <div class="caption">График</div>
        <div class="canvas_legend">
            <canvas id="speedChart" style="width: 958px;height: 184px;"></canvas>
            <div class="legend">
                <div class="legend_row"><div class="legend_one"></div><span class="legend_caption_one">Цветы</span></div>
                <div class="legend_row"><div class="legend_two"></div><span class="legend_caption_two">Упаковка</span></div>
                <div class="legend_row"><div class="legend_three"></div><span class="legend_caption_three">Лента</span></div>
                <div class="legend_row"><div class="legend_four"></div><span class="legend_caption_four">Товар</span></div>
                <div class="legend_row"><div class="legend_five"></div><span class="legend_caption_five">Прочее</span></div>
            </div>
        </div>
        <div id="chartContainer" style="height: 370px;display: none;"></div>
        <img class="menu_icon" src="<?php echo $images_folder; ?>/ico_menu.svg" alt="menu">
        <!--<div class="vk_menu">
            <button>Скрыть</button>
        </div>-->
    </div>
    <br />
    <div class="table-wrapper">
        <div style="width: 100%">
            <div class="table-container">
                <div class="table-background">
                    <div class="form_container">
                        <form method="post">
                            <input type="hidden" name="period" value="<?= isset($period) ? $period : '' ?>" />
                            <input type="text" name="keyword_search" <?php
                            if (isset($keyword)) {
                                echo 'value="' . $keyword . '"';
                            }
                            ?> />
                            <button type="submit"></button>
                            <label for="show_all_select">Показывать по: </label>
                            <select id="show_all_select" name="show_all" onchange="submit()">
                                <option value="10" <?php if (isset($show_all) && $show_all == 10) { echo "selected"; } ?>>10</option>
                                <option value="50" <?php if (isset($show_all) && $show_all == 50) { echo "selected"; } ?>>50</option>
                                <option value="100" <?php if (isset($show_all) && $show_all == 100) { echo "selected"; } ?>>100</option>
                            </select><?php /*
                            if (isset($show_all)) {
                                echo $show_all;
                            } */
                            ?>
                        </form>
                    </div>
                    <form method="post">
                    <table>
                        <caption>
                            Общие
                        </caption>
                        <tr>
                            <th><span class="table-checkbox check-group"></span></th>
                            <th <?php if (isset($sort) && $sort == "Наименование") { echo "style='opacity: 1; font-weight: bold'"; } ?>><label for="name">Наименование</label><input onclick="submit()" id="name" type="radio" name="sort" value="Наименование" /> <img src="<?php echo $images_folder; ?>/ico_table_arrow_down.svg" alt="arrow_down"></th>
                            <th <?php if (isset($sort) && $sort == "Поставка") { echo "style='opacity: 1; font-weight: bold'"; } ?>><label for="post">Поставка</label><input onclick="submit()" id="post" type="radio" name="sort" value="Поставка" /> <img src="<?php echo $images_folder; ?>/ico_table_arrow_up.svg" alt="arrow_up"></th>
                            <th <?php if (isset($sort) && $sort == "Кол-во") { echo "style='opacity: 1; font-weight: bold'"; } ?>><label for="qty">Кол-во</label><input onclick="submit()" id="qty" type="radio" name="sort" value="Кол-во" /> <img src="<?php echo $images_folder; ?>/ico_table_arrow_down.svg" alt="arrow_down"></th>
                            <th <?php if (isset($sort) && $sort == "Тип") { echo "style='opacity: 1; font-weight: bold'"; } ?>><label for="type">Тип</label><input onclick="submit()" id="type" type="radio" name="sort" value="Тип" /> <img src="<?php echo $images_folder; ?>/ico_table_arrow_down.svg" alt="arrow_down"></th>
                            <th <?php if (isset($sort) && $sort == "Стоимость") { echo "style='opacity: 1; font-weight: bold'"; } ?> ><label for="cost">Стоимость</label><input onclick="submit()" id="cost" type="radio" name="sort" value="Стоимость" /> <img src="<?php echo $images_folder; ?>/ico_table_arrow_down.svg" alt="arrow_down"></th>
                        </tr>
                        <?php $i = 0; ?>
                        <?php
                        if (!empty($news)) {
                            foreach ($news as $row):
                                ?>
                                <tr>
                                    <td><span class="table-checkbox"></span></td>
                                    <td><img 
                                            src='<?php echo "$images_folder/" . strip_tags($row->image); ?>' 
                                            srcset='<?php echo "$images_folder/" . strip_tags($row->image); ?> 1x, <?php echo "$images_folder/" . strip_tags($row->image_retina); ?> 2x'
                                            style="border-radius: 50px;" 
                                            alt="flower">
                                        <?php echo strip_tags($row->name) ?></td>
                                    <td><?php echo date("d.m.y", strtotime(strip_tags($row->post_date))); ?></td>
                                    <td><?php echo strip_tags("$row->qty"); ?></td>
                                    <td>
                                        <?php
                                        switch ($row->type) {
                                            case "1":
                                                $type = "Цветы";
                                                break;
                                            case "2":
                                                $type = "Зелень";
                                                break;
                                            case "3":
                                                $type = "Упаковка";
                                                break;
                                            case "4":
                                                $type = "Лента";
                                                break;
                                            case "5":
                                                $type = "Товар";
                                                break;
                                            case "6":
                                                $type = "Прочее";
                                                break;
                                            default:
                                                $type = "Цветы";
                                                break;
                                        }
                                        echo "$type";
                                        ?>
                                    </td>
                                    <td><?php
                                        echo strip_tags($row->cost) . " руб.&nbsp;";
                                        $i++;
                                        if ($i == 2 || $i == 4) {
                                            echo "<button class='button_btn'>Завершить</button>";
                                        }
                                        ?> &nbsp;</td>
                                </tr>
                            <?php
                            endforeach;
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">
                                    Нет данных за указанный период
                                </td>
                            </tr>
<?php } ?>
                    </table>
                    </form>
                    <img class="menu_icon" src="<?php echo $images_folder; ?>/ico_menu.svg" alt="menu">
                    <!--<div class="vk_menu">
                        <button>Скрыть</button>
                    </div>-->
                </div>
            </div>
            <div class="show_table_footer"><span class="table_show_from_to">Показано: с <?= $i > 0 ? 1 : 0 ?> по <?= $i ?> из <?= $i ?></span><span class="table_show_and_xml" style=""><img src="<?php echo $images_folder; ?>/ico_xml.svg" alt="download">Скачать в .xml</span></div>
            <div class="pager"><?php
                if ($records > 9) {
                    echo $pager->links();
                }
                ?>
            </div>
        </div>
<?php
$products_count = ['flowers' => 0,
    'goods' => 0,
    'herbs' => 0,
    'package' => 0,
    'ribbon' => 0,
    'other' => 0
];
$products_itogo = ['flowers' => 0,
    'goods' => 0,
    'package' => 0,
    'ribbon' => 0,
    'other' => 0];
$flowers = array();
$goods = array();
$herbs = array();
$package = array();
$ribbon = array();
$other = array();
if (!empty($news)) {
    foreach ($news as $row) {
        switch ($row->type) {
            case "0":
            case "1":
                $products_count['flowers'] ++;
                if (!isset($datepicker) || $period == "Месяц" || $period == "7 дней") {
                    $flowers['x'][] = date("d.m.y", strtotime(strip_tags($row->post_date)));
                } else {
                    $flowers['x'][] = date("H", strtotime(strip_tags($row->post_date)));
                }
                $flowers['y'][] = $row->cost * $row->qty;
                $products_itogo['flowers'] += $row->cost * $row->qty;
                break;
            case "5":
                $products_count['goods'] ++;
                if (!isset($datepicker) || $period == "Месяц" || $period == "7 дней") {
                    $goods['x'][] = date("d.m.y", strtotime(strip_tags($row->post_date)));
                } else {
                    $goods['x'][] = date("H", strtotime(strip_tags($row->post_date)));
                }
                $goods['y'][] = $row->cost * $row->qty;
                $products_itogo['goods'] += $row->cost * $row->qty;
                break;
            case "2":
                $products_count['herbs'] ++;
                if (!isset($datepicker) || $period == "Месяц" || $period == "7 дней") {
                    $herbs['x'][] = date("d.m.y", strtotime(strip_tags($row->post_date)));
                } else {
                    $herbs['x'][] = date("H", strtotime(strip_tags($row->post_date)));
                }
                $herbs['y'][] = $row->cost * $row->qty;
                break;
            case "3":
                $products_count['package'] ++;
                if (!isset($datepicker) || $period == "Месяц" || $period == "7 дней") {
                    $package['x'][] = date("d.m.y", strtotime(strip_tags($row->post_date)));
                } else {
                    $package['x'][] = date("H", strtotime(strip_tags($row->post_date)));
                }
                $package['y'][] = $row->cost * $row->qty;
                $products_itogo['package'] += $row->cost * $row->qty;
                break;
            case "4":
                $products_count['ribbon'] ++;
                if (!isset($datepicker) || $period == "Месяц" || $period == "7 дней") {
                    $ribbon['x'][] = date("d.m.y", strtotime(strip_tags($row->post_date)));
                } else {
                    $ribbon['x'][] = date("H", strtotime(strip_tags($row->post_date)));
                }
                $ribbon['y'][] = $row->cost * $row->qty;
                $products_itogo['ribbon'] += $row->cost * $row->qty;
                break;
            case "6":
                $products_count['other'] ++;
                if (!isset($datepicker) || $period == "Месяц" || $period == "7 дней") {
                    $other['x'][] = date("d.m.y", strtotime(strip_tags($row->post_date)));
                } else {
                    $other['x'][] = date("H", strtotime(strip_tags($row->post_date)));
                }
                $other['y'][] = $row->cost * $row->qty;
                $products_itogo['other'] += $row->cost * $row->qty;
                break;
        }
    }
    if ($products_count['flowers'] > 0) {
    $flowers_ux = array_unique($flowers['x'], SORT_STRING);
    foreach ($flowers_ux as $index) {
        $flowers_u[] = 0;
    }
    $flowers_uy = array_combine($flowers_ux, $flowers_u);
    foreach ($flowers_ux as $index) {
        for ($i = 0; $i < count($flowers['x']); $i++) {
            if ($index == $flowers['x'][$i]) {
                $flowers_uy[$index] += $flowers['y'][$i];
            }
        }
    }
    }
    if ($products_count['goods'] > 0) {
    $goods_ux = array_unique($goods['x'], SORT_STRING);
    foreach ($goods_ux as $index) {
        $goods_u[] = 0;
    }
    $goods_uy = array_combine($goods_ux, $goods_u);
    foreach ($goods_ux as $index) {
        for ($i = 0; $i < count($goods['x']); $i++) {
            if ($index == $goods['x'][$i]) {
                $goods_uy[$index] += $goods['y'][$i];
            }
        }
    }
    }
    if ($products_count['herbs'] > 0) {
    $herbs_ux = array_unique($herbs['x'], SORT_STRING);
    foreach ($herbs_ux as $index) {
        $herbs_u[] = 0;
    }
    $herbs_uy = array_combine($herbs_ux, $herbs_u);
    foreach ($herbs_ux as $index) {
        for ($i = 0; $i < count($herbs['x']); $i++) {
            if ($index == $herbs['x'][$i]) {
                $herbs_uy[$index] += $herbs['y'][$i];
            }
        }
    }
    }
    if ($products_count['package'] > 0) {
    $package_ux = array_unique($package['x'], SORT_STRING);
    foreach ($package_ux as $index) {
        $package_u[] = 0;
    }
    $package_uy = array_combine($package_ux, $package_u);
    foreach ($package_ux as $index) {
        for ($i = 0; $i < count($package['x']); $i++) {
            if ($index == $package['x'][$i]) {
                $package_uy[$index] += $package['y'][$i];
            }
        }
    }
    }
    if ($products_count['ribbon'] > 0) {
    $ribbon_ux = array_unique($ribbon['x'], SORT_STRING);
    foreach ($ribbon_ux as $index) {
        $ribbon_u[] = 0;
    }
    $ribbon_uy = array_combine($ribbon_ux, $ribbon_u);
    foreach ($ribbon_ux as $index) {
        for ($i = 0; $i < count($ribbon['x']); $i++) {
            if ($index == $ribbon['x'][$i]) {
                $ribbon_uy[$index] += $ribbon['y'][$i];
            }
        }
    }
    }
    if ($products_count['other'] > 0) {
    $other_ux = array_unique($other['x'], SORT_STRING);
    foreach ($other_ux as $index) {
        $other_u[] = 0;
    }
    $other_uy = array_combine($other_ux, $other_u);
    foreach ($other_ux as $index) {
        for ($i = 0; $i < count($other['x']); $i++) {
            if ($index == $other['x'][$i]) {
                $other_uy[$index] += $other['y'][$i];
            }
        }
    }
    }
}
$spisano = 0;
if (!empty($writeoff) && !empty($news)) {
    foreach ($writeoff as $item) {
        $cost = 0;
        foreach ($news as $product) {
            if ($product->id_product == $item->id_product) {
                $cost = $product->cost;
                break;
            }
        }
        $spisano += $item->qty * $cost;
    }
}
?>
        <div class="total_container">
            <table>
                <caption>
                    Смета
                </caption>
                <tr>
                    <th colspan="2">
                        <?php
                            if (isset($period) && $period == "Сегодня") {
                                echo "На сегодня";
                            }
                            if (isset($period) && $period == "Вчера") {
                                echo "За вчера";
                            }
                            if (isset($period) && $period == "7 дней") {
                                echo "На 7 дней";
                            }
                            if (isset($period) && $period == "Месяц") {
                                echo "На месяц";
                            }
                            if (!isset($period) || $period == "") {
                                echo "За весь период";
                            }
                        ?>
                    </th>

                </tr>
                <tr>
                    <td>Итого</td>
                    <td><?php echo array_sum($products_itogo) - $spisano; ?> руб.</td>
                </tr>
                <tr>
                    <td>Цветы</td><td><?php if ($products_count['flowers'] > 0) {
                        echo array_sum($flowers['y']); 
                    } else {
                        echo "0";
                    }
                        ?> руб.</td>
                </tr>
                <tr>
                    <td>Упаковка</td><td><?php if ($products_count['package'] > 0) {
                        echo array_sum($package['y']); 
                    } else {
                        echo "0";
                    }
                        ?> руб.</td>
                </tr>
                <tr>
                    <td>Лента</td><td><?php if ($products_count['ribbon'] > 0) {
                        echo array_sum($ribbon['y']); 
                    } else {
                        echo "0";
                    }
                        ?> руб.</td>
                </tr>
                <tr>
                    <td>Товар</td><td><?php if ($products_count['goods'] > 0) {
                        echo array_sum($goods['y']); 
                    } else {
                        echo "0";
                    }
                        ?> руб.</td>
                </tr>
                <tr>
                    <td>Прочее</td><td><?php if ($products_count['other'] > 0) {
                        echo array_sum($other['y']); 
                    } else {
                        echo "0";
                    }
                        ?> руб.</td>
                </tr>
                <tr>
                    <td>Списано</td><td><?php echo -$spisano; ?> руб.</td>
                </tr>
            </table>
            <img class="menu_icon" src="<?php echo $images_folder; ?>/ico_menu.svg" alt="menu">
            <!--<div class="vk_menu">
                <button>Скрыть</button>
            </div>-->
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
</div>
<div id="popup" class="popup_box">
    <p style="text-align: left; color: #FFFFFF">
        Выберите тип товара
    </p>
    <input type="button" value="Цветы"><br />
    <input type="button" value="Зелень"><br />
    <input type="button" value="Упаковка"><br />
    <input type="button" value="Лента"><br />
    <input type="button" value="Товар"><br />
    <input type="button" value="Прочее"><br />
    <div id="close"><a href="#" class="popup_close"><img src="<?php echo $images_folder; ?>/ico_cancel.svg" alt="cancel" /></a></div>
</div>
<div id="popup2" class="popup_box">
    <div class="caption">
        Цветы
    </div>
    <?php
    // echo form_open_multipart("/", 'id="myform"');
    ?>
    <form id="add_flower" method="post" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>" />
        <input type="hidden" name="product">
        <input type="hidden" name="flower_add">
        <label for="flower_name">Цветок</label><br />
        <input id="flower_name" type="text" name="name" value="" placeholder="Начните вводить название"><br />
        <label for="sort">Сорт</label><label for="country">Страна</label><br />
        <input id="sort" type="text" value="" name="sort" placeholder="Начните вводить сорт">
        <select id="country" name="country">
            <?php foreach ($countries as $country): ?>
                <option <?php
                if ($country->id == "EC") {
                    echo "selected";
                }
                ?> value="<?php echo $country->id; ?>"><?php echo "$country->value"; ?></option>
<?php endforeach; ?>
        </select><br />
        <label for="color">Цвет</label><label for="height">Высота</label><br />
        <input id="color" type="text" value="" name="color" placeholder="Начните вводить цвет">
        <input id="height" type="text" value="" name="height" placeholder="Например: 50 см"><br />
        <label for="flower_description">Описание</label>
        <textarea id="flower_description" placeholder ="(По желанию...)" name="description"></textarea><br /><br />
        <div id="photo">
            <input id="photo1" type="file" name="photo" value="Загрузить фото">
            <label for="photo1">Загрузить фото</label>
        </div>
        <hr>
        <label for="fa_amount">Кол-во</label>
        <label for="flower_price">Себестоимость за шт. (руб.)</label>
        <label for="flower_sale_price">Стоимость продажи (руб.)</label><br />
        <div id="flower_amount">
            <button id="fa_minus">-</button>
            <input id="fa_amount" name="flower_amount" value="1">
            <button id="fa_plus">+</button>
        </div>
        <input id="flower_price" type="text" value="0" name="price">
        <input id="flower_sale_price" type="text" value="0" name="sale_price">
        <hr class="green_border">
        <p><span class="total_price">Итого</span> <span class="sum_price">0 руб.</span></p>
        <input class="popup2_add" type="submit" name="submit" value="Добавить">
        <input id="popup2_close" type="button" value="Отмена">
    </form>
    <div id="close"><a href="#" class="popup_close"><img src="<?php echo $images_folder; ?>/ico_cancel.svg" alt="cancel" /></a></div>
</div>
<div id="popup3" class="popup_box">
    <div class="caption" style="text-align: left; color: #FFFFFF">
        Цветы
    </div>
    <form id="unsubscribe_flower" method="post">
        <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>" />
        <input type="hidden" name="product">
        <input type="hidden" name="flower_delete">
        <label for="date">Дата поставки</label><br />
        <select id="date" name="arrival_date">
<?php foreach ($news as $row): ?>

                <option value="<?= $row->id ?>"><?= date("d ", strtotime(strip_tags($row->post_date))) . $month[date("n", strtotime(strip_tags($row->post_date)))] . date(" Y", strtotime(strip_tags($row->post_date))); ?></option>
<?php endforeach; ?>
        </select><br />
        <label for="flower">Цветок</label><br />
        <!--<input id="flower" type="text" value="Роза freedom 60 см"><br />-->
        <select id="flower" name="flower_name">
<?php foreach ($news as $row): ?>

                <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
<?php endforeach; ?>
        </select><br />
        <p><span class="total">Всего на складе</span> <span id="qty" class="sum">48 шт</span></p>
        <p><span class="total">Стоимость закупа</span> <span id="cost" class="sum" cost="70">70 руб.</span></p>
        <hr class="grayscale">
        <label for="description">Причина</label>
        <textarea id="description" placeholder ="(По желанию...)" name="description"></textarea><br />
        <label for="a_amount">Кол-во</label><label for="price">Стоимость закупа (руб.)</label><br />
        <div id="amount"><button id="a_minus">-</button><input id="a_amount" name="flower_amount" value="0"><button id="a_plus">+</button></div>
        <input id="price" type="text" value="70">
        <hr class="green_border">
        <p><span class="total_price">Итого</span> <span class="sum_price">0 руб.</span></p>
        <input class="popup3_add" type="submit" value="Списать" name="submit">
        <input id="popup3_close" type="button" value="Отмена">
    </form>
</div>
<div id="popup4" class="popup_box">
    <div class="caption">
        Зелень
    </div>
    <?php include "herbs.php"; ?>
</div>
<div id="popup5" class="popup_box">
    <div class="caption">
        Упаковка
    </div>
    <?php include "pages/package.php"; ?>
</div>
<div id="popup6" class="popup_box">
    <div class="caption">
        Лента
    </div>
    <?php include "pages/ribbon.php"; ?>
</div>
<div id="popup7" class="popup_box">
    <div class="caption">
        Товар
    </div>
    <?php include "pages/goods.php"; ?>
</div>
<div id="popup8" class="popup_box">
    <div class="caption">
        Прочее
    </div>
    <?php include "pages/other.php"; ?>
</div>
<div class="overlay"></div>
<!-- Checkradios plugin -->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
<script src="<?php echo "$bootstrap_folder"; ?>/js/bootstrap.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
<!--<script type="text/javascript" src="js/chart.js"></script>-->
<script>
    $(document).ready(function () {
//    var options = $('select').selectmenu('option');
    $('select').select2({
        theme: "classic"
    });
    $("#popup2 #flower_name").autocomplete({
    source: 'Home/get_autocomplete/'
    });
    $("#popup2 #sort").autocomplete({
        source: 'Home/get_autocomplete_for_flower/'
    });
    $('#popup2 #color').autocomplete({
        source: ["Белый", "Красный", "Бордовый", "Розовый", "Фиолетовый", "Оранжевый", "Желтый", "Зеленый", "Синий", "Голубой", "Микс", "Черный"]
    });
    $('#datepicker, #datepicker1').datepicker({
        dateFormat: "dd.mm.yy",
        monthNames: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        numberOfMonths: 3,
        nextText: ">",
        prevText: "<",
        firstDay: 1 
    });
    $('.table-checkbox').click(function () {
    if ($(this).hasClass('check-group')) {
    if ($(this).hasClass('checked')) {
    $(this).removeClass('checked');
    $('.table-checkbox').css('background', 'url(\'/images/ico_checkbox.svg\') no-repeat');
    } else {
    $(this).addClass('checked');
    $('.table-checkbox').css('background', 'url(\'/images/ico_checkbox_checked.svg\') no-repeat');
    }
    } else {
    if ($(this).hasClass('checked')) {
    $(this).removeClass('checked');
    $(this).css('background', 'url(\'/images/ico_checkbox.svg\') no-repeat');
    } else {
    $(this).addClass('checked');
    $(this).css('background', 'url(\'/images/ico_checkbox_checked.svg\') no-repeat');
    }
    }
    });
    $("select#country").change(function () {
    var country = $("#country").val();
    var value = $("select#country").select2('data');
    console.log(value[0].id);
    $("select#country").css('background-image', 'url(../images/icons/' + country + '.ico)');
    $("#popup2 .select2-container").css('background-image', 'url(../images/icons/' + value[0].id + '.ico)');
    });
    $('.add_product').click(function () {
    $('body').css('overflow-y', 'hidden');
    $('#popup').css('display', 'block');
    $('.overlay').show();
    });
    $('.delete_product').click(function () {
    $('body').css('overflow-y', 'hidden');
    $('#popup3').css('display', 'block');
    $('.overlay').show();
    });
    $('#popup input').click(function () {
        $('body').css('overflow-y', 'hidden');
        $('#popup').css('display', 'none');
        if ($(this).val() == "Цветы") {
            $('#popup2').css('display', 'block');
        }
        if ($(this).val() == "Зелень") {
            $('#popup4').css('display', 'block');
        }
        if ($(this).val() == "Упаковка") {
            $('#popup5').css('display', 'block');
        }
        if ($(this).val() == "Лента") {
            $('#popup6').css('display', 'block');
        }
        if ($(this).val() == "Товар") {
            $('#popup7').css('display', 'block');
        }
        if ($(this).val() == "Прочее") {
            $('#popup8').css('display', 'block');
        }
    });
    $('.popup_close').click(function () {
    $('body').css('overflow-y', 'auto');
    $('#popup').hide();
    $('#popup2').hide();
    $('.overlay').hide();
    });
    $('#popup2_close').click(function () {
    $('body').css('overflow-y', 'auto');
    $('#popup').css('display', 'none');
    $('#popup2').css('display', 'none');
    $('.overlay').hide();
    });
    $('#popup3_close').click(function () {
    $('body').css('overflow-y', 'auto');
    $('#popup3').css('display', 'none');
    $('.overlay').hide();
    });
    $('#fa_plus').click(function (event) {
        event.preventDefault();
        $val = parseInt($('#fa_amount').val()) + 1;
        $('#fa_amount').val($val);
    });
    $('#fa_minus').click(function (event) {
        event.preventDefault();
        $val = parseInt($('#fa_amount').val());
        if ($val > 0) {
            $('#fa_amount').val($val - 1);
        }
    });
    $('#flower_price').keyup(function() {
        $val = parseInt($('#flower_price').val());
        if ($val !== NaN && $val > 0) {
            $('#flower_sale_price').val($val * 2);
        }
    });
    $('#flower_price').change(function() {
        $val = parseInt($('#flower_price').val());
        if ($val !== NaN && $val > 0) {
            $('#flower_sale_price').val($val * 2);
        }
    });
    $('#a_plus').click(function (event) {
    event.preventDefault();
    $val = parseInt($('#a_amount').val());
    $max_val = $('#popup3 #qty').html();
    if ($val < parseInt($max_val)) {
    $val++;
    $('#a_amount').val($val);
    }
    $qty = parseInt($('#cost').attr('cost'));
    $('.sum_price').html($val * $qty + " руб.");
    });
    $('#a_minus').click(function (event) {
    event.preventDefault();
    $val = parseInt($('#a_amount').val()) - 1;
    if ($val >= 0) {
    $('#a_amount').val($val);
    $qty = parseInt($('#cost').attr('cost'));
    $('.sum_price').html($val * $qty + " руб.");
    }
    });
    $('#a_amount').change(function () {
    $val = $('#a_amount').val();
    $max_val = $('#popup3 #qty').html();
    if ($val < 0) {
    $('#a_amount').val(0);
    } else if ($val > parseInt($max_val)) {
    $('#a_amount').val(parseInt($max_val));
    } else if ($val !== parseInt($val)) {
    if (parseInt($val) === "NaN") {
    $('#a_amount').val(0);
    } else {
    $('#a_amount').val(parseInt($val));
    }
    }

    });
    $('#popup input').hover(function () {
    $(this).css('background', '#51C75B');
    // $(this).css('color', '#2C2B30');
    $(this).css('font-weight', '500');
    });
    $('#popup input').mouseout(function () {
    $(this).css('background', '#67666A');
    $(this).css('color', '#FFFFFF');
    $(this).css('font-weight', 'normal');
    });
    $('#popup2 label[for="sort"]').css('width', '' + (256 + 15 + 4) + 'px');
    $('#popup2 label[for="color"]').css('width', '' + (256 + 15 + 4) + 'px');
    $('#popup2 label[for="flower_amount"]').css('width', '' + (102 + 15 + 4) + 'px');
    $('#popup3 label[for="amount"]').css('width', '' + (102 + 15 + 4) + 'px');
    $('#popup2 span.total_price').css('width', '' + (256 + 15 + 4) + 'px');
    $.get("Home/get_ajax_post_date", function (data) {
    $('select#date').html(data);
    $.get("Home/get_ajax_flowers?date=" + $('select#date').val(), function (data) {
    $('select#flower').html(data);
    });
    });
    $.get("Home/get_ajax_data?id=" + $('select#flower').val(), function (data) {
    info = data !== false ? JSON.parse(data) : "";
    $('#popup3 #qty').html(info['total'] + " шт");
    $('#popup3 #cost').html(info['sum'] + " руб.");
    $('#popup3 #cost').attr('cost', info['sum']);
    });
    $('select#date').change(function () {
    $.get("Home/get_ajax_flowers?date=" + $('select#date').val(), function (data) {
    $('select#flower').html(data);
    });
    $.get("Home/get_ajax_data?id=" + $('select#flower').val(), function (data) {
    info = data !== false ? JSON.parse(data) : "";
    $('#popup3 #qty').html(info['total'] + " шт");
    $('#popup3 #cost').html(info['sum'] + " руб.");
    $('#popup3 #cost').attr('cost', info['sum']);
    });
    });
    $('select#flower').click(function () {
    $.get("Home/get_ajax_data?id=" + $('select#flower').val(), function (data) {
    info = data !== false ? JSON.parse(data) : "";
    $('#popup3 #qty').html(info['total'] + " шт");
    $('#popup3 #cost').html(info['sum'] + " руб.");
    $('#popup3 #cost').attr('cost', info['sum']);
    $val = parseInt($('#a_amount').val());
    $('.sum_price').html($val * parseInt(info['sum']) + " руб.");
    });
    });
    /*
     $('.menu .spisok .sklad').addClass('active');
     $('.menu .spisok .sklad .item-inner').css('color','#BCD823');
     $('.menu .spisok ul li.sklad').css('background','url(../../images/ico_sklad.svg) 13px 10px no-repeat #67666A');
     $('.menu .spisok ul li.sklad').css('background-color','#67666A');
     $('.menu .spisok ul li.sklad').css('border-raduis','5px');
     */
    });</script>
<script>
    window.onload = function () {

    var speedCanvas = document.getElementById("speedChart");
    var ctx = speedCanvas.getContext('2d');
    Chart.defaults.global.defaultFontFamily = "Roboto";
    Chart.defaults.global.defaultFontSize = 12;
    Chart.defaults.global.defaultFontColor = 'rgb(109, 110, 112)';
    var red = ctx.createLinearGradient(0, 199, 0, 117);
    red.addColorStop(0.321, 'rgba(226, 97, 95, 0)');
    red.addColorStop(0.9994, 'rgba(242, 84, 84, 0.4)');
    var green = ctx.createLinearGradient(0, 199, 0, 117);
    green.addColorStop(0.2759, 'rgba(165, 80, 255, 0)');
    green.addColorStop(1.0, 'rgba(165, 80, 255, 0.4)');
    var blue = ctx.createLinearGradient(0, 199, 0, 117);
    blue.addColorStop(0.4374, 'rgba(91, 141, 229, 0)');
    blue.addColorStop(1.0, 'rgba(61, 128, 246, 0.4)');
    var purple = ctx.createLinearGradient(0, 199, 0, 117);
    purple.addColorStop(0.3547, 'rgba(81, 199, 91, 0)');
    purple.addColorStop(0.9998, 'rgba(81, 199, 91, 0.4)');
    var orange = ctx.createLinearGradient(0, 199, 0, 0);
    orange.addColorStop(0.3326, 'rgba(242, 167, 84, 0)');
    orange.addColorStop(1.0, 'rgba(242, 167, 84, 0.4)');
    var speedData = {
<?php 
    if ($products_count['flowers'] > 0) {
    if (isset($period) && ($period == "Сегодня" || $period == "Вчера" || isset($datepicker))) { ?>
        labels: ['<?php
                    if (!empty($flowers_ux)) {
                        echo implode("','", $flowers_ux);
                    }
                ?>'
                /* "8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "18:00", "19:00", "20:00" */],
                datasets: [{
                label: "Цветы",
                        data: ['<?php
                            if (!empty($flowers_uy)) {
                                echo implode("','",$flowers_uy);
                            }
                        ?>'],
                        backgroundColor: purple,
                        fill: true,
                        borderColor: 'rgb(81, 199, 91)',
                        borderWidth: '1',
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'transparent',
                        cubicInterpolationMode: 'monotone'}
                ]
<?php } elseif (!isset($period) || $period == "Месяц"  || $period == "7 дней") { ?>
        labels: ['<?php echo implode("','", $flowers_ux); ?>'],
                datasets: [{
                label: "Цветы",
                        data: [<?php echo implode(",", $flowers_uy); ?>],
                        backgroundColor: purple,
                        fill: true,
                        borderColor: 'rgb(81, 199, 91)',
                        borderWidth: '1',
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'transparent',
                        cubicInterpolationMode: 'monotone'
                }]
<?php } 
    } ?>
    };
    var chartOptions = {
    title: {
    display: false,
            text: 'График',
            fontColor: '#FFFFFF',
            position: 'top'
    },
            legend: {
            display: false,
                    position: 'bottom',
                    labels: {
                    boxWidth: 15,
                            fontColor: '#51C75B'
                    }
            },
            layout: {
            padding: '20'
            },
            tooltips: {
            enabled: false
            },
            scales: {
            borderColor: '#9891A8',
                    borderWidth: 1,
                    paddingLeft: 20,
                    paddingRight: 20,
                    xAxes: [{
                    barPercentage: 1,
                            categoryPercentage: 0.6,
                            scaleLabel: {
                            fontColor: '#969696',
                                    fontSize: 12
                            },
                            gridLines: {
                            color: 'transparent',
                                    zeroLineColor: '#2F2F2F'
                            }
                    }],
                    yAxes: [{
                    ticks: {
                    suggestedMin: 0,
                            //suggestedMax: 10000,
                            padding: 18,
                            callback: function (value, index, values) {
                            if (index == 0 || index == 5 || value == 0) {
                            return value + ' руб.';
                            }
                            }
                    },
                            scaleLabel: {
                            fontColor: '#6E6D70',
                                    fontSize: 12
                            },
                            gridLines: {
                            color: '#2F2F2F',
                                    zeroLineColor: '#2F2F2F'
                            }
                    }]
            }
    };
    var lineChart = new Chart(speedCanvas, {
    type: 'line',
            data: speedData,
            options: chartOptions
    });
    }
</script>
<?php
include "templates/footer.php";
