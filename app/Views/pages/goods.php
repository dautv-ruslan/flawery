<form id="add_goods" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>" />
    <input type="hidden" name="product">
    <input type="hidden" name="goods_add">
    <label for="goods_name">Упаковка</label><br />
    <input id="goods_name" type="text" name="name" value="" placeholder="Начните вводить название"><br />
    <label for="goods_material">Материал</label><label for="goods_country">Страна</label><br />
    <input id="goods_material" type="text" value="" name="material" placeholder="Начните вводить материал">
    <select id="goods_country" name="country">
        <?php foreach ($countries as $country): ?>
            <option <?php
            if ($country->id == "EC") {
                echo "selected";
            }
            ?> value="<?php echo $country->id; ?>"><?php echo "$country->value"; ?></option>
        <?php endforeach; ?>
    </select><br />
    <label for="goods_color">Цвет</label><label for="goods_height">Длина</label><br /><label for="goods_width">Ширина</label>
    <input id="goods_color" type="text" value="" name="color" placeholder="Начните вводить цвет">
    <input id="goods_height" type="text" value="" name="height" placeholder="Например: 50 см"><br />
    <input id="goods_width" type="text" value="" name="width" placeholder="Например: 40 см"><br />
    <label for="goods_description">Описание</label>
    <textarea id="goods_description" placeholder ="(По желанию...)" name="description"></textarea><br /><br />
    <div id="photo">
        <input id="photo5" type="file" name="photo" value="Загрузить фото">
        <label for="photo5">Загрузить фото</label>
    </div>
    <hr>
    <label for="ga_amount">Кол-во</label>
    <label for="goods_price">Себестоимость за шт. (руб.)</label>
    <label for="goods_sale_price">Стоимость продажи (руб.)</label><br />
    <div id="goods_amount">
        <button id="ga_minus">-</button>
        <input id="ga_amount" name="flower_amount" value="1">
        <button id="ga_plus">+</button>
    </div>
    <input id="goods_price" type="text" value="0" name="price">
    <input id="goods_sale_price" type="text" value="0" name="sale_price">
    <hr class="green_border">
    <p><span class="total_price">Итого</span> <span class="sum_price">0 руб.</span></p>
    <input class="popup2_add" type="submit" name="submit" value="Добавить">
    <input id="popup2_close" type="button" value="Отмена">
</form>