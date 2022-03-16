$(function() {
    const url = 'http://127.0.0.1:8000';

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //設定するボタン
    $('.select_config').click(function() {
        $('.fadein_first').hide();
        $('.which_config.fadein').fadeIn();
    });

    $('.close_config').click(function() {
        $('.which_config.fadein').hide();
        $('.fadein_first').fadeIn();
    });

    $('.config').click(function() {
        window.location.href = 'config';
    });

    $('.shop_config').click(function() {
        window.location.href = 'shop_config';
    });

    //入力するボタン
    $('.register').click(function() {
        $('.fadein_first').hide();
        $('.date.fadein').fadeIn();
    });

    //出力するボタン
    $('.export').click(function() {
        $('.fadein_first').hide();
        $('.which_data.fadein').fadeIn();
    });

    $('.close_data').click(function() {
        $('.fadein_first').fadeIn();
        $('.which_data.fadein').hide();
    });

    //確認するボタン
    $('.confirmation').click(function() {
        window.location.href = 'show';
    });

    $('#page_top').click(function() {
        $('.table-area').animate({
            scrollTop: 0
        }, 500);
    });

    $('#page_back').click(function() {
        window.location.href = 'home';
    });

    $('#prev-item-link').click(function() {
        window.location.href = 'home';
    });

    $('#next-item-link').click(function() {
        $('.cake-all').css('display', 'none');
        $('.onebyone').fadeIn();
    });

    $('.close_register').click(function() {
        $('.onebyone').css('display', 'none');
        $('.cake-all').fadeIn();
    });

    //日にち選択画面
    $('.close_date').click(function() {
        $('.date.fadein').hide();
        $('.fadein_first').fadeIn();
    });

    //日にちを選択したら確認画面のh3の値を書き換える
    $('.date_select').each(function() {
        $(this).click(function() {
            var view_date = '予約日：' + $(this).text();
            var date = $(this).data('date-id');
            $('.js_date').html(view_date).data('date', date);
            $('.date.fadein').hide();
            $('.through.fadein').fadeIn();
        });
    });

    //通し番号入力画面
    $('.close_through').click(function() {
        $('.through.fadein').hide();
        $('.date.fadein').fadeIn();
    });

    $('.through_select').click(function() {
        var through = $('#through').val();
        if(through == '') {
            var through = '未入力';
        }
        $('.js_through').html('通し番号：' + through).data('through', through);
        $('.through.fadein').hide();
        $('.maker.fadein').fadeIn();
    });

    //メーカー選択画面
    $('.close_maker').click(function() {
        $('.maker.fadein').hide();
        $('.through.fadein').fadeIn();
    });

    //メーカーを選択したら確認画面のh3の値を書き換える
    $('.maker_select').each(function() {
        $(this).click(function() {
            var maker = 'メーカー：' + $(this).text();
            var confirm = $(this).data('maker-id');
            $('.js_maker').html(maker).data('maker', $(this).text());
            $('.maker.fadein').hide();
            $('.cakes.fadein').fadeIn();
            
            $('#' + confirm).css('display', 'block');
        });
    });

    //ケーキ選択画面
    $('.close_cake').click(function() {
        $('.cakes.fadein').hide();
        $('.cakes.fadein select').css('display', 'none');
        $('#quantity').css('display', 'block');
        $('.maker.fadein').fadeIn();
    });

    //ケーキを選択したら確認画面のh3の値を書き換える
    $('.cake_select').click(function() {
        if($('#yamazaki').val() != 0) {
            var cake = $('#yamazaki').val();
        } else if($('#siraisi').val() != 0) {
            var cake = $('#siraisi').val();
        } else if($('#pasco').val() != 0) {
            var cake = $('#pasco').val();
        }
        var cake_array = cake.split('.');
        var cake_number = cake_array[0];
        var cake_name = cake_array[1];
        var quantity = $('#quantity').val();

        $('.js_cake_number').html(cake_number).data('cake_number', cake_number);
        $('.js_cake_name').html(cake_name).data('cake_name', cake_name);
        $('.js_quantity').html('個数：' + quantity).data('quantity', quantity);
        $('.js_number_name').html('ケーキ：' + cake_number + '.' + cake_name);

        if(quantity != 0 && cake != 0) {
            $('.cakes.fadein').hide();
            $('.customer.fadein').fadeIn(); 
        }
    });

    //お客様情報入力画面
    $('.close_customer').click(function() {
        $('.customer.fadein').hide();
        $('.cakes.fadein').fadeIn();
    });

    $(function() {
        $('input[type="tel"]').on("keypress input", function(){
          let str = $(this).val();
          $(this).val(str.replace(/[^0-9]/g, ""));
        });
    });

    //お客様情報を入力したらh3を書き換える
    $('.customer_select').click(function() {
        var customer_name = $('#customer_name').val();
        if(customer_name == "") {
            var customer_name = '未入力';
        }
        var customer_phone = $('#customer_phone').val();
        if(customer_phone == "") {
            var customer_phone = '未入力';
        } else {
            let a = customer_phone.split('');
            if(customer_phone.length == 10) {
                var customer_phone = a[0] + a[1] + a[2] + '-' + a[3] + a[4] + a[5] + '-' + a[6] + a[7] + a[8] + a[9];
            } else if(customer_phone.length == 11) {
                var customer_phone = a[0] + a[1] + a[2] + '-' + a[3] + a[4] + a[5] + a[6] + '-' + a[7] + a[8] + a[9] + a[10];
            } else if(customer_phone.length == 7) {
                var customer_phone = a[0] + a[1] + a[2] + '-' + a[3] + a[4] + a[5] + a[6];
            } else if(customer_phone.length == 6) {
                var customer_phone = a[0] + a[1] + '-' + a[2] + a[3] + a[4] + a[5] ;
            }
        }
        var customer_time = $('#customer_time').val();
        if(customer_time == "") {
            var customer_time = '未入力';
        }

        $('.js_customer_name').html('お客様氏名：' + customer_name).data('customer_name', customer_name);
        $('.js_customer_phone').html('電話番号：' + customer_phone).data('customer_phone', customer_phone);
        $('.js_customer_time').html('来店予定時刻：' + customer_time).data('customer_time', customer_time);

        $('.customer.fadein').hide();
        $('.confirm.fadein').fadeIn();
    });

    //最終確認ページ
    $('.close_confirm').click(function() {
        location.reload();
    });

    $('.confirm_select').click(function() {
        $('.confirm.fadein').hide();
        $('.success.fadein').fadeIn();
            
        var db_shop_id = $('.auth').data('id');
        var db_shop_name = $('.auth').data('shop');
        var db_date = $('.js_date').data('date');
        var db_through = $('.js_through').data('through');
        var db_maker = $('.js_maker').data('maker');
        var db_cake_number = $('.js_cake_number').data('cake_number');
        var db_cake_name = $('.js_cake_name').data('cake_name');
        var db_quantity = $('.js_quantity').data('quantity');
        var db_customer_name = $('.js_customer_name').data('customer_name');
        var db_customer_phone = $('.js_customer_phone').data('customer_phone');
        var db_customer_time = $('.js_customer_time').data('customer_time');

        $('.c_shop_id').val(db_shop_id);
        $('.c_shop_name').val(db_shop_name);
        $('.c_date').val(db_date);
        $('.c_through').val(db_through);
        $('.c_maker').val(db_maker);
        $('.c_cake_number').val(db_cake_number);
        $('.c_cake_name').val(db_cake_name);
        $('.c_quantity').val(db_quantity);
        $('.c_customer_name').val(db_customer_name);
        $('.c_customer_phone').val(db_customer_phone);
        $('.c_customer_time').val(db_customer_time);

        setTimeout(function() {
            $('#submit').submit();
        },2000);
    });

    //show用のjs
    $('.close_show').click(function() {
        window.location.href = 'home';
    });

    $(document).ready(function() {
        let container_height = $('.nb-container-show').height()        
        let sub_height = $('.top').outerHeight(true) + $('.text-center.mb-4').outerHeight(true) + $('.navbar.navbar-light.bg-light.mb-4').outerHeight(true);
        let set_table_height = container_height - sub_height;
        $('.table-area').css('height', set_table_height - 5);

        //カウントダウン
        var time = 3;
        var repeat = function() {
            if(time == 1) {
                $('.logout').submit();
            }
            $('.countdown').html(time-- + '秒');
            setTimeout(repeat, 1000);
        }
        repeat();
    });

    $('.badge-danger').each(function() {
        $(this).click(function() {
            var id = $(this).data('delete-id');
            $('.nb-container-show').css('display', 'none');
            $('.jumbotron.delete_area').fadeIn('slow');
            $('#page_top').css('display', 'none');
            $('#page_back').css('display', 'none');
            $('.table.achievement.mt-2').css('display', 'none');

            $.ajax({
                type: 'POST',
                url: url + "/api/delete_confirm/" + id,
                datatype: 'text',
                cache: false
            })
            .then(
                function(param){
                    var data = param;
                    var d_date = data[0].reserva_date.slice(-3);
                    var d_through = data[0].through;
                    var d_cake_maker = data[0].cake_maker;
                    var d_cake_name = data[0].cake_number + ', ' + data[0].cake_name;
                    var d_quantity = data[0].quantity;
                    var d_customer_name = data[1].name;
                    var d_customer_phone = data[1].phone;
                    var d_customer_time = data[1].time;
                    $('.d_date').html(d_date);
                    $('.d_through').html(d_through);
                    $('.d_cake_maker').html(d_cake_maker);
                    $('.d_cake_name').html(d_cake_name);
                    $('.d_quantity').html(d_quantity);
                    $('.d_customer_name').html(d_customer_name);
                    $('.d_customer_phone').html(d_customer_phone);
                    $('.d_customer_time').html(d_customer_time);
                    $('.d_id').attr('value', id);
                },
                function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(XMLHttpRequest);
                }
            );
        });
    });

    $('.btn.btn-outline-secondary.retry, .btn.btn-outline-warning.my-2.my-sm-0.ml-4').click(function() {
        window.location.href = 'show';
    });

    $('.btn.btn-outline-danger.delete').click(function() {
        var delete_id = $('.d_id').val();
        $('.jumbotron.delete_area').hide();
        $('.delete.fadein').fadeIn();
        setTimeout(function() {
            $('#delete').attr('action', `${url}/delete/${delete_id}`).submit();
        },2000);
    });

    //detail用のjs
    $('.btn.btn-outline-primary.mt-3.col-md-6').each(function() {
        $(this).click(function() {
            $('.btn.btn-outline-primary.mt-3.col-md-6.focus').removeClass('focus');
            $(this).addClass('focus');
            $('.u_date').val($(this).html());
        });
    });

    var cake_name = $('.selected_name.mt-1').data('cake-name');
    $('.u_cake_name').val(cake_name);

    var through = $('#through').val();

    $('#through_check').change(function() {
        var through = $(this).val();
        $('.u_through').val(through);  
    });

    $('.custom-select.mt-3').change(function() {
        let maker = $(this).val();
        $('.u_maker').val(maker);
        $('.default').prop('disabled', true);
        $('.append').each(function() {
            $(this).remove();
        });
        $.ajax({
            type: 'POST',
            url: url + "/api/maker/" + maker,
            datatype: "text",  
            cache: false
        })
        .then(
            function(param) {
                let cakes = param;
                let count = cakes.length;
                for(let i = 0; i < count; i++) {
                    $('.custom-select.mt-2').append
                    (
                        `<option class="append" value="${cakes[i].id}">${cakes[i].number + ',' + cakes[i].name}</option>`
                    )
                }
                $('.custom-select.mt-2').change(function() {
                    for(var key of Object.keys(cakes)) {
                        if(cakes[key].id == $('.custom-select.mt-2').val()) {
                            var cake_number = cakes[key].number;
                            var cake_name = cakes[key].number + ',' + cakes[key].name;
                            var form_cake_name = cakes[key].name;
                        }
                    }
                    $('.change.mt-4').html('変更後').css('color', 'red');
                    $('.selected_name.mt-1').html($('.custom-select.mt-3').val() + '：' + cake_name);
                    $('.u_cake_name').val(form_cake_name);
                    $('.u_cake_number').val(cake_number);
                });
            },
            function(XMLHttpRequest, textStatus, errorThrown){ 
                console.log(XMLHttpRequest);
            }
        );
    });

    $('#confirm').click(function() {
        $('.change_area').css('display', 'none');
        $('.confirm_area').css('display', 'block');

        var quantity = $('.form-control.col-md-3').val();
        $('.u_quantity').val(quantity);
        
        var u_customer_name = $('#check_name').val();
        $('.u_customer_name').val(u_customer_name);
    
        var u_customer_phone = $('#check_phone').val();
        if(u_customer_phone == "") {
            var u_customer_phone = '未入力';
        } else {
            let b = u_customer_phone.split('');
            if(u_customer_phone.length == 10) {
                var u_customer_phone = b[0] + b[1] + b[2] + '-' + b[3] + b[4] + b[5] + '-' + b[6] + b[7] + b[8] + b[9];
            } else if(u_customer_phone.length == 11) {
                var u_customer_phone = b[0] + b[1] + b[2] + '-' + b[3] + b[4] + b[5] + b[6] + '-' + b[7] + b[8] + b[9] + b[10];
            } else if(u_customer_phone.length == 7) {
                var u_customer_phone = b[0] + b[1] + b[2] + '-' + b[3] + b[4] + b[5] + b[6];
            } else if(u_customer_phone.length == 6) {
                var u_customer_phone = b[0] + b[1] + '-' + b[2] + b[3] + b[4] + b[5] ;
            }
        }
        $('.u_customer_phone').val(u_customer_phone);
    
        var u_customer_time = $('#check_time').val();
        $('.u_customer_time').val(u_customer_time);    

        $('#u_through').html($('.u_through').val());
        $('#u_date').html($('.u_date').val());
        $('#u_cake_maker').html($('.u_maker').val());
        $('#u_cake_number_name').html($('.u_cake_number').val() + ', ' + $('.u_cake_name').val());
        $('#u_quantity').html($('.u_quantity').val());
        $('#u_customer_name').html($('.u_customer_name').val());
        $('#u_customer_phone').html($('.u_customer_phone').val());
        $('#u_customer_time').html($('.u_customer_time').val());
    });

    $('.retry_update').click(function() {
        $('.change_area').css('display', 'block');
        $('.confirm_area').css('display', 'none');
    });

    $('.btn.btn-outline-success.update').click(function() {
        $('.jumbotron.confirm_area').hide();
        $('.update.fadein').fadeIn();
        setTimeout(function() {
            $('#update').submit();
        },2000);
    });    
});