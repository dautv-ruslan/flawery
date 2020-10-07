<form id="add_ribbon" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>" />
    <input type="hidden" name="product">
    <input type="hidden" name="ribbon_add">
    <label for="ribbon_name">Лента</label><br />
    <input id="ribbon_name" type="text" name="name" value="" placeholder="Начните вводить название"><br />
    <label for="ribbon_material">Материал</label><label for="ribbon_country">Страна</label><br />
    <input id="ribbon_material" type="text" value="" name="material" placeholder="Начните вводить материал">
    <select id="ribbon_country" name="country">
        <?php foreach ($countries as $country): ?>
            <option <?php
            if ($country->id == "EC") {
                echo "selected";
            }
            ?> value="<?php echo $country->id; ?>"><?php echo "$country->value"; ?></option>
        <?php endforeach; ?>
    </select><br />
    <label for="ribbon_color">Цвет</label><label for="ribbon_height">Длина</label><br /><label for="ribbon_width">Ширина</label>
    <input id="ribbon_color" type="text" value="" name="color" placeholder="Начните вводить цвет">
    <input id="ribbon_height" type="text" value="" name="height" placeholder="Например: 50 см"><br />
    <input id="ribbon_width" type="text" value="" name="width" placeholder="Например: 40 см"><br />
    <label for="ribbon_description">Описание</label>
    <textarea id="ribbon_description" placeholder ="(По желанию...)" name="description"></textarea><br /><br />
    <div id="photo">
        <input id="photo4" type="file" name="photo" value="Загрузить фото">
        <label for="photo4">Загрузить фото</label>
    </div>
    <hr>
    <label for="ra_amount">Кол-во</label>
    <label for="ribbon_price">Себестоимость за шт. (руб.)</label>
    <label for="ribbon_sale_price">Стоимость продажи (руб.)</label><br />
    <div id="ribbon_amount">
        <button id="ra_minus">-</button>
        <input id="ra_amount" name="flower_amount" value="1">
        <button id="ra_plus">+</button>
    </div>
    <input id="ribbon_price" type="text" value="0" name="price">
    <input id="ribbon_sale_price" type="text" value="0" name="sale_price">
    <hr class="green_border">
    <p><span class="total_price">Итого</span> <span class="sum_price">0 руб.</span></p>
    <input class="popup2_add" type="submit" name="submit" value="Добавить">
    <input id="popup2_close" type="button" value="Отмена">
</form>