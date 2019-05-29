<?php


function _e($text){
    echo _($text);
}

if ( ! function_exists('is_loaded'))
{
    function &is_loaded($class = '')
    {
        static $_is_loaded = array();

        if ($class !== '')
        {
            $_is_loaded[$class] = $class;
        }

        return $_is_loaded;
    }
}

if ( ! function_exists('get_url'))
{
    function get_url(){
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        if($url != null){
            $url = rtrim($url, "/");
            $url = explode("/", $url);
        }else{
            unset($url);
        }
        return $url;
    }
}



if(!function_exists('sendSMTPMail'))
{
    function sendSMTPMail($data = array(), $mail_config = array(), $from_name = ''){
        $config = array(
            'server'    => $mail_config[0]["smtp_host"],
            'username'  => $mail_config[0]["smtp_username"],
            'password'  => $mail_config[0]["smtp_password"],
            'port'      => $mail_config[0]["smtp_port"],
            'charset'   => 'UTF-8',
            'secure'    => 'ssl',
            'auth'      => true
        );

        include_once SYSURL . "libraries/Mail/Mail.php";
        $mail = new Mail($config);

        if ( $from_name != '' ) {
            $mail->from($data["from"], $from_name);
        } else {
            $mail->from($data["from"], $data["from"]);
        }

        $mail->to($data["to"]);
        $mail->subject($data["subject"]);

        ob_start();
        include ROOT_DIR . $data['view_file'];
        $output = ob_get_contents();
        ob_end_clean();

        $mail->message($output);

        if( $mail->send() ){
            return true;
        }else{
            return false;
        }


    }
}

if(!function_exists('get_post')) {
    function get_post($post_value = "", $is_empty = false)
    {
        if(!isset($_POST["$post_value"])){
            return false;
        }

        $post   = $_POST["$post_value"];
        $post   = trim($post);             //bastaki ve sondaki boslukları siler
        //$post = htmlspecialchars($post); //Özel karakterleri HTML öğeleri haline getirir
        //$post = htmlentities($post);     //Dönüştürülebilecek tüm karakterleri HTML öğeleri haline getirir
        $post   = strip_tags($post);       //Html etiketlerini temizler
        $post   = addslashes($post);       //Üsten kesme işaretini (') geçersiz yapar
        //$post = mysql_real_escape_string($post);

        if($is_empty) {
            if (empty($post)) {
                return false;
            }
        }

        return $post;
    }
}

if(!function_exists('request_all')) {
    function request_all($model)
    {
        if ( !isset($model) ) {
            return false;
        }
        foreach ($model as $key => $value) {
            $model[$key] = addslashes(strip_tags(trim($value)));
        }

        return $model;
    }
}


/**
 * String Debug
 * @param 	string 	$data
 * @param 	bool 	$stop
 * @return 	string
 */
if( ! function_exists('debug')) {
    function debug($data, $stop = true)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if($stop) {
            die();
        }
    }
}

if(!function_exists('tarihDonustur')) {
    function tarihDonustur($unix)
    {
        $diff = strtotime(date("Y-m-d H:i:s")) - $unix;

        $times = array(
            array(3600, 60, 'dakika'), // bir dakika 60 saniye - 60 dakika 3600 saniye
            array(86400, 3600, 'saat'), // bir saat 3600 saniye 24 saat 86400 saniye
            array(604800, 86400, 'gün', 'Dün'), // sonuç "1 gün" ise, onun yerine "Dün" yazar
            array(2592000, 604800, 'hafta', 'Geçen hafta'), // sonuç "1 hafta" ise, onun yerine "Geçen hafta" yazar
            array(31104000, 2592000, 'ay', 'Geçen ay') // sonuç "1 ay" ise, onun yerine "Geçen ay" yazar
        );

        if ($diff < 60) {
            return 'Az önce';
        }
        foreach ($times as $time) {
            if ($diff < $time[0]){
                // return (isset($time[3]) ? $time[3] : floor($diff / $time[1]) . ' ' . $time[2] . ' önce');
                return (floor($diff / $time[1]) . ' ' . $time[2] . ' önce');
            }
        }

        // return strftime('%e %B %Y %A, %H:%I', $unix);
        return date("d-m-Y H:i:s", $unix);
    }
}

/*
 * gelen ülke koduna göre hangi dil secildiyse ulkenin o dildeki ismini dondulur.
 *
 */

if(!function_exists('tarihcevir'))
{
    function tarihcevir($tarih, $birlestirme_ayraci = "-", $ayirma_ayraci = "-", $saat = false, $tarih_saat = true){

        if ($tarih == ""){
            return "-";
        }

        $tarihtam = explode(" ", $tarih);
        $tarih    = explode("$ayirma_ayraci", $tarihtam[0]);

        if ($saat){
            return $tarihtam[1];
        }

        if(isset($tarihtam[1]) && $tarih_saat)
        {
            $saat  = explode(":", $tarihtam[1]);
            $tarih = $tarih[2] . $birlestirme_ayraci . $tarih[1] . $birlestirme_ayraci . $tarih[0] . " " . $saat[0] . ":" . $saat[1];
        }
        else
        {
            $tarih = $tarih[2] . $birlestirme_ayraci . $tarih[1] . $birlestirme_ayraci . $tarih[0];
        }

        return $tarih;
    }
}

if(!function_exists("json_response")){
    function response($data = array())
    {
       // return json_encode($data);
        return $data;

        /*if($data["success"] == "0"){
            die;
        }*/
    }
}

if(!function_exists("response_message")){
    function response_message($code = 0){
        $message = array(
            "100" => "Servis Bulunamadı",
            "101" => "Kullanıcı Bulunamadı.",
        );

        return $message[$code];
    }
}

if (!function_exists('getDistance')) {
    function getDistance($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

if(!function_exists('generateRandomString'))
{
    function generateRandomString($length = 10, $character_type = "all") {
        if($character_type == "int") {
            $characters = '0123456789';
        }else{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}

if(!function_exists("getUrl")){
    function getUrl($lang = "tr"){
        $lang = strtolower($lang);
        if($lang == "tr"){
            $url = "https://www.lokalfirsat.com/";
        }else{
            $url = "https://www.qboni.com/";
        }
        return $url;
    }
}

if(!function_exists('XMLPOST'))
{
    function XMLPOST($PostAddress,$xmlData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$PostAddress);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        $result = curl_exec($ch);
        return $result;
    }
}

if(!function_exists('smsGonder'))
{
    function smsGonder($no, $mesaj){
        $xml='<?xml version="1.0" encoding="UTF-8"?><mainbody><header><company dil="TR">Netgsm</company><usercode>8503041112</usercode><password>JPQXVFSB</password><startdate></startdate><stopdate></stopdate><type>1:n</type><msgheader>LOKALFIRSAT</msgheader></header><body><msg><![CDATA[' . $mesaj . ']]></msg><no>' . $no .'</no></body></mainbody>';


        $gelen = XMLPOST('https://api.netgsm.com.tr/sms/send/xml',$xml);

        //debug($gelen);

        $part = explode(" ", $gelen);
        if ( count($part) == 2 ) {
            return true;
        } else {
            $sms = sendOtpSms($no, $mesaj);

            if ( $sms === true ) {
                return true;
            }

            return false;
        }

        // include_once ($_SERVER['DOCUMENT_ROOT'] . '/system/libraries/sms_class.php');
        // $basscell = new SMS();
        // $basscell->setUser("5337919182");
        // $basscell->setPass("5337919182");
        // $basscell->setTitle("Lokalfirsat");

        // $result = $basscell->send($no,$mesaj);
        // $result = explode(':', $result[1]);

        // if ( $result[0] == 'OK' ) {
        // return 1;
        // } else {
        // return 0;
        // }

    }
}

if ( !function_exists('sendOtpSms') ) {
    function sendOtpSms($no, $mesaj) {
        $xml='<?xml version="1.0" encoding="UTF-8"?>
                <mainbody>
                    <header>
                        <usercode>8503041112</usercode>
                        <password>JPQXVFSB </password>
                        <msgheader>LOKALFIRSAT</msgheader>
                    </header>
                    <body>
                        <msg><![CDATA[' . $mesaj . ']]></msg>
                        <no>' . $no .'</no>
                    </body>
                </mainbody>';

        $gelen = XMLPOST('https://api.netgsm.com.tr/sms/send/otp',$xml);

        $gelen = strip_tags($gelen);

        if ( $gelen[0] == 0 || $gelen[0] == '0' ) {
            return true;
        } else {
            $sms = smsGonder($no, $mesaj);
            return $sms;
        }
    }
}

if(!function_exists('days')) {
    function days($data)
    {
        if ( $data == '1' ) {
            return _('Pazartesi');
        } elseif ( $data == '2' ) {
            return _('Salı');
        } elseif ( $data == '3' ) {
            return _('Çarşamba');
        } elseif ( $data == '4' ) {
            return _('Perşembe');
        } elseif ( $data == '5' ) {
            return _('Cuma');
        } elseif ( $data == '6' ) {
            return _('Cumartesi');
        } elseif ( $data == '7' ) {
            return _('Pazar');
        }
    }
}

if(!function_exists('englishDays')) {
    function englishDays($data)
    {
        if ( $data == 'Pazartesi' ) {
            return 'Monday';
        } elseif ( $data == 'Salı' ) {
            return 'Tuesday';
        } elseif ( $data == 'Çarşamba' ) {
            return 'Wednesday';
        } elseif ( $data == 'Perşembe' ) {
            return 'Thursday';
        } elseif ( $data == 'Cuma' ) {
            return 'Friday';
        } elseif ( $data == 'Cumartesi' ) {
            return 'Saturday';
        } elseif ( $data == 'Pazar' ) {
            return 'Sunday';
        }
    }
}

if(!function_exists('businessHours')) {
    function businessHours($data = array())
    {
        $timestamp = time();

        $times = $data[date('l',$timestamp)];

        $now    = strtotime(date("H:i"));

        foreach ($times as $value) {

            $start_time = strtotime($value[0]);
            $end_time   = strtotime($value[1]);

            if ( $start_time > $end_time ) {
                $end_time = strtotime(date('24:00')) + $end_time;
            }

            if ( $now > $start_time && $now < ($end_time-3600)) {
                return 1;
            } elseif ($now > ($end_time-3600) && $now < $end_time) {
                return 0;
            }
        }

        return -1;
    }
}

if(!function_exists('getOSName')) {
    function getOSName($os = 'unknown')
    {
        if($os != 'android' && $os != 'ios' && $os != 'web' && $os != 'mobil'){
            return 'unknown';
        }
        return $os;
    }
}

if(!function_exists('sentMail'))
{
    function sentMail($alici, $konu = '', $icerik = '', $adsoyad = '', $lang = 'TR'){

        include_once("mail_view.php");
        if($lang == "EN"){
            $content   = mailContentEN($konu, $icerik, $adsoyad);
            $from      = "QBoni";
            $from_mail = "info@qboni.com";
            $reply_to  = "info@qboni.com";
        }elseif($lang == "DE"){
            $content   = mailContentEN($konu, $icerik, $adsoyad);
            $from      = "QBoni";
            $from_mail = "info@qboni.com";
            $reply_to  = "info@qboni.com";
        }else{
            $content   = mailContent($konu, $icerik, $adsoyad);
            $from      = "Lokal Fırsat";
            $from_mail = "info@lokalfirsat.com";
            $reply_to  = "info@lokalfirsat.com";
        }

        $random_hash = md5(date('r', time()));

        $headers     = "MIME-Version: 1.0" . "\r\n";
        $headers    .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers    .= "From: $from<$from_mail>\r\nReply-To: $reply_to";
        //$headers  .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\"";

        if(mb_send_mail($alici,$konu,$content,$headers)){
            return true;
        }

        return false;

    }
}

if(!function_exists('countryCodeControl')) {

    function countryCodeControl( $phone, $country_code )
    {
        $country_code   = '+'.$country_code;
        $country_length = strlen($country_code);

        $country_code_control = substr($phone, 0, $country_length);

        if ( $country_code_control != $country_code ) {
            return false;
        }

        $split = explode($country_code, $phone);

        return $split[1];
    }

}

if (!function_exists('nowAt')) {

    function nowAt( $type = 'datetime' )
    {

        if ( $type == 'date' ) {
            return date('Y-m-d');
        } elseif ( $type == 'datetime' ) {
            return date('Y-m-d H:i:s');
        }

    }

}

if (!function_exists('showErrors')) {

    function show_errors()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

}

if (!function_exists('locale')) {

    function locale($lang)
    {
        $check = require_once APPURL . 'config/language.php';

        if ( !in_array($lang, $check) || empty($lang) ) {
            return 'en';
        }

        return $lang;
    }

}

if ( !function_exists('calculate_age') ) {
    /**
     * @param $birthday
     * @return int
     * @throws Exception
     */
    function calculate_age($birthday)
    {
        $born = new DateTime($birthday);
        $now  = new DateTime(date('Y-m-d'));

        $interval = $now->diff($born);

        return $interval->y;
    }
}

if ( !function_exists('getAuthorizationHeader') ) {
    /**
     * Get header Authorization
     * */
    function getAuthorizationHeader(){
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();

            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }

            if ( isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ) {
                $headers = trim($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
            }
        }

        return $headers;
    }
}

if ( !function_exists('getBearerToken') ) {
    /**
     * get access token from header
     * */
    function getBearerToken() {
        $headers = getAuthorizationHeader();

        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}


?>