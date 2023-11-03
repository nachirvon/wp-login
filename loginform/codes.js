jQuery(function ($) {
    var ajaxurl = "https://aralbaby.com/wp-admin/admin-ajax.php";
    var test = document.getElementById('reg_phone');

    // send code message
    $('#send_reg_code').click(function () {
        Swal.fire({
            icon: 'success',
            title: 'عملیات موفق',
            text: 'پیامک تایید برای شما ارسال شد',
        });
        var  $number = document.getElementById('reg_phone').value;
           $('#send_code_res').empty();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: 'action=send_sms_code&shomare=' + $number,
            success: function (response) {
                //alert('کد ارسال شد');
                var jData = JSON.parse(response);
                if (jData.unsuccess === 1){
                    $("#reg_phone").attr('readonly', true);
                    $("#send_code_res").append('کد تایید با موفقیت به شماره ' + $number + 'ارسال شد').delay(3000).fadeOut();
                    $("#send_reg_code_field").hide();
                    $("#reg_phone_code").show();
                    $("#verify_reg_code_field").show();
                }
                if (jData.unsucces === 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'این کاربر از قبل ثبت نام شده است، لطفا از شماره دیگری استفاده کنید',
                        footer: '<a href="">رمز عبور را فراموش کرده اید؟</a>'
                    });
                    //$("#send_code_res").append('این شماره در سایت وجود دارد').delay(3000).fadeOut();
                }
            }
        });
    });

    // verify number js codes
    $('#verify_reg_code').click(function () {
        var  $smscode = document.getElementById('reg_phone_code').value;
           $('#verify_code_res').empty();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: 'action=verify_sms_code&session_code=' + $smscode,
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1"){
                    Swal.fire({
                        icon: 'success',
                        title: 'عملیات موفق',
                        text: 'شماره شما تایید شد، به ادامه مراحل ثبت نام بپردازید',
                    });
                    $("#verify_reg_code_field").hide();
                    $("#reg_code_field").hide();
                    $("#reg_phone_code_field").delay(1500).hide();
                    $("#reg_namefamily").delay(700).fadeIn();
                    $("#register_btn_box").delay(900).fadeIn();
                }
                if (jsonData.success == "0") {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'کد وارد شده صحیح نیست و یا منقضی شده است، لطفا مجددا بررسی کنید',
                    });
                }
            }
        });
    });


// create user ajax code
$('#md_reg_user').click(function () {
    var $username = document.getElementById('reg_namefamily').value;
    var  $shomare = document.getElementById('reg_phone').value;
       $('#verify_code_res').empty();
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'md_create_user',
            username: $username,
            shomaremobile: $shomare
        },
        success: function (response) {
            var jsonData = JSON.parse(response);
            if (jsonData.created == 1){
                Swal.fire({
                    icon: 'success',
                    title: 'عملیات موفق',
                    text: 'حساب کاربری شما در آرال بیبی ایجاد شد',
                });
                // $("#verify_reg_code_field").hide();
                // $("#reg_code_field").hide();
                // $("#reg_phone_code_field").delay(1500).hide();
                // $("#reg_namefamily").delay(700).fadeIn();
                // $("#register_btn_box").delay(900).fadeIn();
            }
            if (jsonData.created == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'این شماره در دیتابیس موجود میباشد، در صورتی که این شماره برای شماست و رمز آن را فراموش کرده اید به بخش بازیابی رمز عبور مراجعه نمایید.',
                });
            }
        }
    });
});
    
    
// reset password
    $('#rp_send_link').click(function () {
        Swal.fire({
            icon: 'success',
            title: 'عملیات موفق',
            text: 'پیامک تایید برای شما ارسال شد',
        });
    var $rpmob = document.getElementById('rp_number').value;
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'md_rpassword',
            rpmobile: $rpmob
        },
        success: function (response) {
            var jsonData = JSON.parse(response);
            // if (jsonData.send == 1){
            //     Swal.fire({
            //         icon: 'success',
            //         title: 'عملیات موفق',
            //         text: 'لینک بازیابی رمز برای شما پیامک شد',
            //     });
            // }
            if (jsonData.send == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'خطایی در روند عملیات رخ داد، ممکن است کاربری با این شماره در سایت نباشد، پس از بررسی مجدد سعی کنید',
                });
            }
        }
    });
    });


    $('#send_login_code').click(function () {
        Swal.fire({
            icon: 'success',
            title: '',
            text: 'درخواست شما انجام شد، درصورت صحیح بودن اطلاعات پیام برای شما ارسال خواهد شد',
        });
        var $loginnum = document.getElementById('login_phone').value;
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'md_login_sendcode',
                rpmobile: $loginnum
            },
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.loginsend == 1){
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'عملیات موفق',
                    //     text: 'کد تایید با موفقیت برای شما پیامک شد.',
                    // });
                    $("#login_code").delay(400).fadeIn();
                    $("#send_login_code").delay(300).fadeOut();
                    $("#login_btn_box").show();
                }
                if (jsonData.loginsend == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'این شماره در سایت وجود ندارد لطفا مجددا سعی کنید',
                    });
                }
            }
        });
    });



    $('#md_login_user').click(function () {
        var $loginnum = document.getElementById('login_phone').value;
        var $logincode = document.getElementById('login_code').value;
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'md_login_func',
                lgmobile: $loginnum,
                lgcode: $logincode
            },
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.login == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'ورود موفق',
                        text: 'ورود شما با موفقیت انجام شد، شما به پنل کاربری هدایت میشوید...',
                    });
                    window.location.href = 'https://aralbaby.com/my-account';
                }
                if (jsonData.login == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'خطایی در روند ورود رخ داد، لطفا پس از بررسی مجدد سعی کنید',
                    });
                }
            }
        });
    });




});




