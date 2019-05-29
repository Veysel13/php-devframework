<?php
namespace BusinessLayer\Functions\Helpers;

//defined('DIRECT') OR exit('No direct script access allowed');

class Helper
{
    /*
    * @param email -> string
    * @return true or false
    */

    public static function emailFormatControl($email = '')
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    * @param username -> string
    * @param  minCharacterCount -> minimum character count, default count = 4
    *  @param  maxCharacterCount -> maximum character count, default count = 20
    * @return true or false
    */
    public static function usernameFormatControl($username = '', $minCharacterCount = 4, $maxCharacterCount = 20){
        if(preg_match('/^\w{'.$minCharacterCount.','.$maxCharacterCount.'}$/', $username)) { // \w equals "[0-9A-Za-z_]"
            // valid username, alphanumeric & longer than or equals 5 chars
            return true;
        }
        return false;
    }

    /*
    * @param password          -> input password
    * @param mincharacterCount -> password min characterCout
    * @param maxcharacterCount -> password max characterCout
    * @param characterTypes    -> password types, alpha, number, numerik vs
    * @return true or false
    */
    public static function passwordFormatControl($password = '', $minCharacterCount = 5, $maxCharacterCount = 25, $characterTypes = array()){
        // type controls


        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            return false;
        }
        return true;
    }

    /*
    * @param iban -> string
    * @return true or false
    */
    public static function ibanFormatControl($iban = ''){
        $iban = strtoupper(str_replace(' ', '', $iban));
        if (preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $iban)) {

            $country = substr($iban, 0, 2);
            $check = intval(substr($iban, 2, 2));
            $account = substr($iban, 4);

            // To numeric representation
            $search = range('A','Z');
            foreach (range(10,35) as $tmp)
                $replace[]=strval($tmp);
            $numstr=str_replace($search, $replace, $account.$country.'00');

            // Calculate checksum
            $checksum = intval(substr($numstr, 0, 1));
            for ($pos = 1; $pos < strlen($numstr); $pos++) {
                $checksum *= 10;
                $checksum += intval(substr($numstr, $pos,1));
                $checksum %= 97;
            }
            // echo $iban;

            // $sonuc = 1;
            $sonuc =  ((98-$checksum) == $check);
            if ( empty($sonuc) ) {
                return false;
            }
            return true;
        }
        return false;
    }

    /*
    * @param str string
    * @return clean string str
    */
    public static function generateCleanString($str = '', $point = '-'){
        $tr  = array("ş","Ş","ı","ü","Ü","ö","Ö","ç","Ç","ğ","Ğ","İ");
        $en  = array("s","S","i","u","U","o","O","c","C","g","G","I");
        $str = str_replace($tr, $en, $str);
        $str = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i",$point, $str);
        $str = strtolower($str);
        return $str;
    }


    /**
     * string to upper case turkish
     * @param string $data
     * @return  string $data
     */
    public static function strtoupperTR($data = ''){
        $lower = array('ı','i','ş','ö','ğ','ç','ü');
        $upper = array('I','İ','Ş','Ö','Ğ','Ç','Ü');

        $data = str_replace($lower, $upper, $data);
        $data = strtoupper($data);

        return $data;
    }

    /**
     * Guid generate
     * return guid
     */
    public static function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return $uuid;
        }
    }

    /**
     * String add star
     * @param $data string
     * $start kaçıncı karakterden itibaren yıldız koyacagı
     * $end sondan kac karaktere yıldız koymayacagı
     * Example : data = nurullah, start = 5, end = 0 => nurul***
     * Example : data = nurullah, start = 5, end = 1 => nurul**h
     * @return string
     */
    public static function strAddStar($data = '', $start = 0, $end = 0){
        $after  = substr($data, 0, $start);
        $repeat = str_repeat('*', (strlen($data) - ($start + $end)));
        $before = substr($data, (strlen($data) - $end), strlen($data));
        return $after . $repeat . $before;
    }

    public static function tcVerify( $tcno )
    {
        if (!preg_match('/^[1-9]{1}[0-9]{9}[0,2,4,6,8]{1}$/', $tcno)) {
            return false;
        }

        $odd     = $tcno[0] + $tcno[2] + $tcno[4] + $tcno[6] + $tcno[8];
        $even    = $tcno[1] + $tcno[3] + $tcno[5] + $tcno[7];
        $digit10 = ($odd * 7 - $even) % 10;
        $total   = ($odd + $even + $tcno[9]) % 10;

        if ($digit10 != $tcno[9] ||  $total != $tcno[10]) {
            return false;
        }

        return true;
    }

    public static function credentialControl($tc, $name, $surname, $birthday)
    {
        $explode   = explode('-', $birthday);
        $birthyear = $explode[0];

        $post_data = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
                <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
                    <TCKimlikNo>'.$tc.'</TCKimlikNo>
                    <Ad>'.Helper::strtoupperTR($name).'</Ad>
                    <Soyad>'.Helper::strtoupperTR($surname).'</Soyad>
                    <DogumYili>'.$birthyear.'</DogumYili>
                </TCKimlikNoDogrula>
            </soap:Body>
        </soap:Envelope>';

        $ch = curl_init();

        // CURL options
        $options = array(
            CURLOPT_URL            => 'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx',
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $post_data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => array(
                'POST /Service/KPSPublic.asmx HTTP/1.1',
                'Host: tckimlik.nvi.gov.tr',
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
                'Content-Length: '.strlen($post_data)
            ),
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}