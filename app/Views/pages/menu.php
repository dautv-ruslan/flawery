<div class="menu hidden-xs">
    <div class="menu-inner">
        <div class="user_image">
            <img src="/<?php echo $images_folder; ?>/img_user1.png" alt="User">
        </div>
        <div class="username" >Маргаритка</div>

        <div class="content-wrapper">
            <div class="itogo">
                <span class="itogo_itogo">Итого</span>
                <span class="itogo_sum">4300 руб.</span>
                <span class="arrow"><img src="/<?php echo $images_folder; ?>/ico_down_arrow.svg" alt="arrow_down"></span>
            </div>
        </div>
        <div class="dropdown_menu">
            <div class="dropdown_terminal">Терминал: <span>0 руб.</span></div>
            <div class="dropdown_kassa">В кассе: <span>4200 руб.</span></div>
            <div class="dropdown_card">Карта: <span>6789 руб.</span></div>
            <div class="dropdown_charge">Расход: <span>4200 руб.</span></div>
        </div>
        <div class="spisok">
            <nav>
                <ul>
                    <?php
                    if (!$nav) {
                        $nav = "sklad";
                    }
                    ?>
                    <?php if ($theme === "dark") { ?>
                        <!--<li class="calendar" <?php
                        // Пункт меню и ссылка на страницу "Календарь"
                        if ($nav != "" && $nav === "calendar") {
                            echo "style=\"background: url($images_folder/ico_calendar_active.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/calendar"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "calendar") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Календарь</span></a></li>-->
                        <li class="sklad" <?php
                        // Пункт меню и ссылка на страницу "Склад"
                        if ($nav != "" && $nav === "sklad") {
                            echo "style=\"background: url($images_folder/ico_sklad.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/sklad"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "sklad") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Склад</span></a></li>
                        <!--<li class="raskhod" <?php
                        // Пункт меню и ссылка на страницу "Расходы"
                        if ($nav != "" && $nav === "charges") {
                            echo "style=\"background: url($images_folder/ico_charges.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/charges"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "charges") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Расходы</span></a></li>-->
                        <li class="client" <?php
                        // Пункт меню и ссылка на страницу "Клиенты"
                        if ($nav != "" && $nav === "client") {
                            echo "style=\"background: url($images_folder/ico_people.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/client"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "client") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Клиенты</span></a></li>
                        <li class="sell" <?php
                        // Пункт меню и ссылка на страницу "Продажи"
                        if ($nav != "" && $nav === "sell") {
                            echo "style=\"background: url($images_folder/ico_sell.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/sell"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "sell") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Продажи</span></a></li>
                        <li class="vitrina" <?php
                        // Пункт меню и ссылка на страницу "Витрина"
                        if ($nav != "" && $nav === "showcase") {
                            echo "style=\"background: url(/$images_folder/ico_showcase.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/showcase"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "showcase") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Витрина</span></a></li>
                        <!--<li class="svodka" <?php
                        // Пункт меню и ссылка на страницу "Сводка"
                        if ($nav != "" && $nav === "assignment") {
                            echo "style=\"background: url($images_folder/ico_assignment.svg) 13px 10px no-repeat #2C2F31\"";
                        }
                        ?>><a href="/assignment"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "assignment") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Сводка</span></a></li>-->
                        <?php } elseif ($theme === "light") { ?>
                        <!--<li class="calendar" <?php
                        // Пункт меню и ссылка на страницу "Календарь"
                        if ($nav != "" && $nav === "calendar") {
                            echo "style=\"background: url($images_folder/ico_calendar_active.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url($images_folder/ico_calendar_light.svg) 13px 10px no-repeat\"";
                        }
                        ?>><a href="/calendar"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "calendar") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Календарь</span></a></li>-->
                        <li class="sklad" <?php
                        // Пункт меню и ссылка на страницу "Склад"
                        if ($nav != "" && $nav === "sklad") {
                            echo "style=\"background: url($images_folder/ico_sklad.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url($images_folder/ico_sklad_light.svg) 13px 10px no-repeat\"";
                        }
                        ?>><a href="/sklad"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "sklad") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Склад</span></a></li>
                        <!--<li class="raskhod" <?php
                        // Пункт меню и ссылка на страницу "Расходы"
                        if ($nav != "" && $nav === "charges") {
                            echo "style=\"background: url($images_folder/ico_charges.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url($images_folder/ico_raskhod_light.svg) 13px 10px no-repeat \"";
                        }
                        ?>><a href="/charges"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "charges") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Расходы</span></a></li>-->
                        <li class="client" <?php
                        // Пункт меню и ссылка на страницу "Клиенты"
                        if ($nav != "" && $nav === "client") {
                            echo "style=\"background: url($images_folder/ico_people.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url($images_folder/ico_client_light.svg) 13px 10px no-repeat\"";
                        }
                        ?>><a href="/client"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "client") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Клиенты</span></a></li>
                        <li class="sell" <?php
                        // Пункт меню и ссылка на страницу "Продажи"
                        if ($nav != "" && $nav === "sell") {
                            echo "style=\"background: url($images_folder/ico_sell.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url($images_folder/ico_sell_light.svg) 13px 10px no-repeat\"";
                        }
                        ?>><a href="/sell"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "sell") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Продажи</span></a></li>
                        <li class="vitrina" <?php
                        // Пункт меню и ссылка на страницу "Витрина"
                        if ($nav != "" && $nav === "showcase") {
                            echo "style=\"background: url(/$images_folder/ico_showcase.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url(/$images_folder/ico_showcase_light.svg) 13px 10px no-repeat\"";
                        }
                        ?>><a href="/showcase"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "showcase") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Витрина</span></a></li>
                        <!--<li class="svodka" <?php
                        // Пункт меню и ссылка на страницу "Сводка"
                        if ($nav != "" && $nav === "assignment") {
                            echo "style=\"background: url($images_folder/ico_assignment.svg) 13px 10px no-repeat #F7F7F7\"";
                        } else {
                            echo "style=\"background: url($images_folder/ico_assignment_light.svg) 13px 10px no-repeat\"";
                        }
                        ?>><a href="/assignment"><span class="item-inner" <?php
                            if ($nav != "" && $nav === "assignment") {
                                echo 'style="color: #51C75B;"';
                            }
                            ?>>Сводка</span></a></li>-->
                        <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="preferences">
        <hr class="settings_divider">
        <ul>
            <li class="settings"><span class="item-inner">Настройки</span></li>
        </ul>
    </div>
</div>