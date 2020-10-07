<form id="add_herb" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>" />
    <input type="hidden" name="product">
    <input type="hidden" name="package_add">
    <label for="herb_name">Упаковка</label><br />
    <input id="package_name" type="text" name="name" value="" placeholder="Начните вводить название"><br />
    <label for="material">Материал</label><label for="country">Страна</label><br />
    <input id="material" type="text" value="" name="material" placeholder="Начните вводить материал">
    <select id="country" name="country">
        <?php foreach ($countries as $country): ?>
            <option <?php
            if ($country->id == "EC") {
                echo "selected";
            }
            ?> value="<?php echo $country->id; ?>"><?php echo "$country->value"; ?></option>
            <?php endforeach; ?>
    </select><br />
    <label for="color">Цвет</label><label for="height">Длина</label><br /><label for="width">Ширина</label>
    <input id="color" type="text" value="" name="color" placeholder="Начните вводить цвет">
    <input id="height" type="text" value="" name="height" placeholder="Например: 50 см"><br />
    <input id="width" type="text" value="" name="width" placeholder="Например: 40 см"><br />
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