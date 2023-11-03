<?php
session_start();
add_action('wp_ajax_send_sms_code', 'send_sms_code');
add_action('wp_ajax_nopriv_send_sms_code', 'send_sms_code');
function send_sms_code() {
    $md = rand(1111,9999);
    $_SESSION['code'] = $md;
    if(isset($_POST['shomare']))
    {
        global $post;
        if(!empty($_POST['shomare'])){
$username = sanitize_user( $_POST['shomare'] );
if(!username_exists( $username )){
    ini_set("soap.wsdl_cache_enabled","0");
    $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
    $data = array(
        "username"=>"@",
        "password"=>"@",
        "text"=>array($_SESSION['code']),
        "to"=>$_POST['shomare'],
        "bodyId"=>62783);
        $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;
echo json_encode(array('unsuccess' => 1));
            wp_die();
}else{
echo json_encode(['unsucces' => 2]);
wp_die();
}
        } 
    }
}



// verify code
add_action('wp_ajax_verify_sms_code', 'verify_sms_code');
add_action('wp_ajax_nopriv_verify_sms_code', 'verify_sms_code');
function verify_sms_code() {
    if(isset($_POST['session_code'])){
        if(!empty($_POST['session_code'])){
            if($_SESSION['code'] == $_POST['session_code']){
                echo json_encode(array('success' => 1));
            wp_die();
        }else{
            echo json_encode(array('success' => 0));
            wp_die();
        }
        }
    }
}


// create user
add_action('wp_ajax_md_create_user', 'md_create_user');
add_action('wp_ajax_nopriv_md_create_user', 'md_create_user');
function md_create_user() {
    if(isset($_POST['username']) and isset($_POST['shomaremobile'])){
        if(!empty($_POST['username']) and !empty($_POST['shomaremobile'])){
            $username = $_POST['shomaremobile'];
            $nicname = $_POST['username'];
            $dname = $_POST['username'];
            $nikname = $_POST['username'];
            $md_names = $_POST['username'];
            $flname = explode(" ", $md_names);
                $user_data = array(
                    'user_login'           => $username,
                    'user_nicename'     => 'aralbaby',
                    'user_pass'     => wp_hash_password($_POST['shomaremobile']),
                    'role'      => 'customer'
                );
                $user_id = wp_insert_user($user_data);
                update_user_meta( $user_id, 'first_name', $flname[0]);
                update_user_meta( $user_id, 'last_name', $flname[1]);
                update_user_meta( $user_id, 'display_name', $dname);
                update_user_meta( $user_id, 'nickname', $dname);
                update_user_meta( $user_id, 'nicename', $dname);

                if(! is_wp_error( $user_id )){
                    ini_set("soap.wsdl_cache_enabled","0");
                    $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
                    $data = array(
                        "username"=>"@",
                        "password"=>"@",
                        "text"=>array("به سایت من خوش آمدید"),
                        "to"=>$_POST['shomaremobile'],
                        "bodyId"=>62783);
                        $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;
                        echo json_encode(array('created' => 1));
                        wp_die();
                }
                if(is_wp_error( $user_id )){
                        echo json_encode(array('created' => 0));
                        wp_die();
                }
        }
    }
}


function get_user_exists($shomare_mobile){
    get_users( $args ); 
   $args = array(  
           'meta_key'     => 'user_login',
           'meta_value'   => $shomare_mobile,
       );   
   $blogusers = get_users( $args );
   foreach ( $blogusers as  $my_users ) {
       if($my_users){
         return true;
       }
   } 
   }
// reset password
add_action('wp_ajax_md_rpassword', 'md_rpassword');
add_action('wp_ajax_nopriv_md_rpassword', 'md_rpassword');
function md_rpassword() {
   if(isset($_POST['rpmobile'])){
    $username = sanitize_user( $_POST['rpmobile'] );
        if(username_exists($_POST['rpmobile'])){
            $user = get_user_by('login', $_POST['rpmobile']);
            $user_id = $user->ID;
            $user_info = get_userdata($user_id);
            $uniq = get_password_reset_key($user_info);
            $url = site_url("wp-login.php?action=rp&key=$uniq&login=". rawurlencode($user_info->user_login),'login');
ini_set("soap.wsdl_cache_enabled","0");
$sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
$data = array(
    "username"=>"@",
    "password"=>"@@",
    "text"=>array("لینک بازیابی رمز عبور شما : 
$url
"),
    "to"=>$_POST['rpmobile'],
    "bodyId"=>62783);
    $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;

            echo json_encode(array('send' => 1));
            wp_die();
        }else{
            echo json_encode(array('send' => 0));
            wp_die();
        }
   }
}





// send login code
add_action('wp_ajax_md_login_sendcode', 'md_login_sendcode');
add_action('wp_ajax_nopriv_md_login_sendcode', 'md_login_sendcode');
function md_login_sendcode() {
    $md = rand(1111,9999);
    $_SESSION['logincode'] = $md;
    if(isset($_POST['rpmobile']))
    {
        global $post;
        if(!empty($_POST['rpmobile'])){
$username = sanitize_user( $_POST['rpmobile'] );
$logincode = $_SESSION['logincode'];
if(username_exists( $username )){

ini_set("soap.wsdl_cache_enabled","0");
$sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
$data = array(
    "username"=>"@",
    "password"=>"@",
    "text"=>array("کد ورود شما : 
    $logincode"),
    "to"=>$_POST['rpmobile'],
    "bodyId"=>62783);
    $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;

echo json_encode(array('loginsend' => 1));
            wp_die();
}else{
echo json_encode(['loginsend' => 0]);
wp_die();
}
        } 
    }
}





// login user
add_action('wp_ajax_md_login_func', 'md_login_func');
add_action('wp_ajax_nopriv_md_login_func', 'md_login_func');
function md_login_func() {
    if(isset($_POST['lgmobile']) and isset($_POST['lgcode'])){
        global $post;
        if(!empty($_POST['lgmobile']) and !empty($_POST['lgcode'])){
            $username = sanitize_user( $_POST['rpmobile'] );
            $logincode = $_SESSION['logincode'];
            if($_POST['lgcode'] == $logincode){
                $user = get_user_by('login', $_POST['lgmobile']);
                wp_clear_auth_cookie();
                wp_set_current_user ( $user->ID );
                wp_set_auth_cookie  ( $user->ID );
                echo json_encode(array('login' => 1));
                wp_die();
            }else{
                echo json_encode(['login' => 0]);
                wp_die();
            }
        } 
    }
}


