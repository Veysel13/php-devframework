<?php
namespace BusinessLayer\ValidationRules\MyRules;

use BusinessLayer\Functions\Helpers\Helper;
use Businesslayer\Functions\Validation\Validator;
use System\Exceptions\ResponseException;
use System\Libraries\Language\Lang;

class DenemeValidator{

    private $validator;


    public function __construct()
    {
        $this->validator     = new Validator();

    }

    public function validateForUpdate($model,$lang)
    {


        $this->validator->set_data([
            'Name'  => $model["Name"],
            'Description' => $model["Description"],
            'Email' => $model["Email"],
            'Age'   =>$model["Age"],
            'Token' =>$model["Token"]
        ], true);

        $this->validator->set_rules([
            'Name'  => Lang::get('deneme.name', $lang).'|required',
            'Description' => Lang::get('deneme.desc', $lang).'|required',
            'Email' => Lang::get('deneme.email', $lang).'|required',
            'Age' => Lang::get('deneme.age', $lang).'|required',
            'Token' => Lang::get('deneme.eror', $lang).'|required',
        ]);

        if($this->validator->is_valid() !== true) {
            $messages ="";
            foreach($this->validator->errors as $error) {
                if ($error) {

                    $messages.= $error.'/';
                }
            }
            $messages=rtrim($messages,'/');

            throw new ResponseException($messages, 0);
        }



        //email kontrolu


    }

    public function emailInputCheck($email,$lang="en"){

        $check_email=Helper::emailFormatControl($email);

        if ( $check_email===false ) {
            throw new ResponseException(Lang::get('deneme.email_incorrect', $lang), 0);
        }
    }

}