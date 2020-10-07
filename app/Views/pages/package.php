<form id="add_package" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>" />
    <input type="hidden" name="product">
    <input type="hidden" name="package_add">
    <label for="package_name">Упаковка</label><br />
    <input id="package_name" type="text" name="name" value="" placeholder="Начните вводить название"><br />
    <label for="package_material">Материал</label><label for="package_country">Страна</label><br />
    <input id="package_material" type="text" value="" name="material" placeholder="Начните вводить материал">
    <select id="package_country" name="country">
        <?php foreach ($countries as $country): ?>
            <option <?php
            if ($country->id == "EC") {
                echo "selected";
            }
            ?> value="<?php echo $country->id; ?>"><?php echo "$country->value"; ?></option>
        <?php endforeach; ?>
    </select><br />
    <label for="package_color">Цвет</label><label for="package_height">Длина</label><br /><label for="package_width">Ширина</label>
    <input id="package_color" type="text" value="" name="color" placeholder="Начните вводить цвет">
    <input id="package_height" type="text" value="" name="height" placeholder="Например: 50 см"><br />
    <input id="package_width" type="text" value="" name="width" placeholder="Например: 40 см"><br />
    <label for="roll">Рулон</label><label for="sheet">Лист</label><br />
    <input id="roll" type="radio" value="Рулон" name="dim">
    <input id="sheet" type="radio" value="Лист" name="dim"><br />
    <label for="package_description">Описание</label>
    <textarea id="package_description" placeholder ="(По желанию...)" name="description"></textarea><br /><br />
    <div id="package_photo">
        <input id="photo3" type="file" name="photo" value="Загрузить фото">
        <label for="photo3">Загрузить фото</label>
    </div>
    <hr>
    <label for="pa_amount">Кол-во</label>
    <label for="package_price">Себестоимость за шт. (руб.)</label>
    <label for="package_sale_price">Стоимость продажи (руб.)</label><br />
    <div id="package_amount">
        <button id="pa_minus">-</button>
        <input id="pa_amount" name="flower_amount" value="1">
        <button id="pa_plus">+</button>
    </div>
    <input id="package_price" type="text" value="0" name="price">
    <input id="package_sale_price" type="text" value="0" name="sale_price">
    <hr class="green_border">
    <p><span class="total_price">Итого</span> <span class="sum_price">0 руб.</span></p>
    <input class="popup2_add" type="submit" name="submit" value="Добавить">
    <input id="popup2_close" type="button" value="Отмена">
</form>