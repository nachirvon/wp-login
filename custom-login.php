<?php
// Custom Login And Register Form, By : Morteza Daryouzheh
/*
Template Name: ورود و عضویت با موبایل
*/
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/loginform/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title><?php bloginfo('name').' - '.the_title();?></title>
</head>
<body>
<div class="backtosite">
    <a href="<?php echo bloginfo( 'url' )?>"><h3>بازگشت به سایت</h3></a>
</div>
<div class="wrapper">
  <div class="title-text">
    <div class="title login">
      ورود
    </div>
    <div class="title signup">
      ثبت نام
    </div>
  </div>
  <div class="form-container">
    <div class="slide-controls">
      <input type="radio" name="slide" id="login" checked>
      <input type="radio" name="slide" id="signup">
      <label for="login" class="slide login">ورود</label>
      <label for="signup" class="slide signup">ثبت نام</label>
      <div class="slider-tab"></div>
    </div>
    <div class="form-inner">
      <form action="#" method="post" id="login_form" class="login">
        <div class="field">
          <input type="text" name="login_phone" id="login_phone" placeholder="شماره موبایل" required>
        </div>

        <input type="button" id="send_login_code" value="ارسال کد تایید">
        <div class="field">
          <input type="text" name="login_code" id="login_code" placeholder="کد تایید را وارد کنید" required style="display:none;">
        </div>

        <div class="field btn"  id="login_btn_box" style="display:none;">
          <div class="btn-layer"></div>
          <input type="button" id="md_login_user" value="ورود">
        </div>

        <div class="pass-link">
        
        </div>

      


        
        <div class="signup-link-sp" style="font-size: 10px !important;">
         با دل و جان توسط :   <a href="https://houniya.ir">مرتضی دریوژه </a>
        </div>
      </form>
      <form action="#" method="post" id="register_form" class="signup">
        <div class="field">
          <input type="text" id="reg_phone" name="reg_phone" placeholder="شماره موبایل" inputmode="numeric" required>
        </div>
        <div class="field" id="send_reg_code_field">
          <input type="button" id="send_reg_code" value="ارسال کد تایید">
        </div>
        <div id="send_code_res"></div>
        <div class="field" id="reg_phone_code_field">
          <input type="text" id="reg_phone_code" name="reg_phone_code" placeholder="کد تایید را وارد کنید" required style="display:none;">
        </div>

        <div class="field" id="verify_reg_code_field" style="display:none;">
          <input type="button" id="verify_reg_code" value="تایید شماره موبایل">
        </div>
        <div id="verify_code_res"></div>

        <div class="field">
          <input type="text" id="reg_namefamily" name="reg_namefamily" placeholder="نام و نام خانوادگی را وارد کنید" required style="display:none;">
        </div>

        <div class="field btn"  id="register_btn_box" style="display:none;">
          <div class="btn-layer"></div>
          <input type="button" id="md_reg_user" value="ثبت نام">
        </div>
      </form>
      
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">بازیابی رمز عبور</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form action="" method="post">
        <div class="field">
          <input type="text" id="rp_number" name="rp_number" placeholder="شماره موبایل" required inputmode="numeric">
        </div>
          
          <input type="button" id="rp_send_link" value="ارسال لینک بازیابی">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>


</body>

<script>
var loginText = document.querySelector(".title-text .login");
var loginForm = document.querySelector("form.login");
var loginBtn = document.querySelector("label.login");
var signupBtn = document.querySelector("label.signup");
var signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (()=>{
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (()=>{
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
});
signupLink.onclick = (()=>{
  signupBtn.click();
  return false;
});
</script>
<script src="<?php echo get_template_directory_uri();?>/loginform/codes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</html>