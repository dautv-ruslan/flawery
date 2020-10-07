$(document).ready(function () {
    $('.checkradios').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.chart_wrapper').hide('slow');
            $('.show-graph').css('background', 'url(\'/images/checkbox.svg\') no-repeat');
        } else {
            $(this).addClass('active');
            $('.chart_wrapper').show('slow');
            $('.show-graph').css('background', 'url(\'/images/checkbox_checked.svg\') no-repeat');
        }
    });
    $('.table_container .table-checkbox').click(function () {
        if ($(this).hasClass('check-group')) {
            if ($(this).hasClass('checked')) {
                $(this).removeClass('checked');
                $('.table_container .table-checkbox').css('background', 'url(\'/images/ico_checkbox.svg\') no-repeat');
            } else {
                $(this).addClass('checked');
                $('.table_container .table-checkbox').css('background', 'url(\'/images/ico_checkbox_checked.svg\') no-repeat');
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
    $('.chart_wrapper canvas').click(function () {
        $('.chart_wrapper .vk_menu').hide('slow');
    });
    $('.chart_wrapper img.menu_icon').click(function () {
        $('.chart_wrapper .vk_menu').show('slow');
    });
    $('.chart_wrapper .vk_menu').click(function () {
        $('.chart_wrapper .vk_menu').hide('slow');
        $('.chart_wrapper').hide('slow');
        if ($('.checkradios').hasClass('active')) {
            $('.checkradios').removeClass('active');
            $('.chart_wrapper').hide('slow');
            $('.show-graph').css('background', 'url(\'/images/checkbox.svg\') no-repeat');
        }
    });
    $(".itogo").click(function() {
        $(".dropdown_menu").css('display','flex');
        if ($(".itogo").hasClass('open')) {
            $(".dropdown_menu").hide();
            $(".itogo").removeClass('open');
            $(".itogo span.arrow img").css('transform','rotate(0deg)');
            
        } else {
            $(".dropdown_menu").show();
            $(".itogo").addClass('open');
            $(".itogo span.arrow img").css('transform','rotate(180deg)');
        }
        
    });
});