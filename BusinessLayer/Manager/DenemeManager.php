<?php

namespace BusinessLayer\Manager;

use BusinessLayer\Functions\Helpers\Helper;
use BusinessLayer\ValidationRules\MyRules\DenemeValidator;
use Model\Deneme;
use System\Exceptions\ResponseException;
use System\Libraries\Language\Lang;

class DenemeManager
{
    //TODO::buraya kullanıcı rol işlermleri gelebilir
    /**
     * @var DenemeValidator
     */
    private $validator;
    /**
     * @var Deneme
     */
    private $deneme_model;

    public function __construct()
    {
        $this->validator = new DenemeValidator();
        $this->deneme_model=new Deneme();
    }

    public function ListQuery()
    {
       try{
            $result=$this->deneme_model->get();
            return response(['success' => 1, 'data' => $result, 'message' =>'']);
       }
       catch (ResponseException $e ) {
           return response($e->getResponse());
       }
    }

    public function GetById($id)
    {
        return $this->deneme_model->find($id);
    }

    public function UserDelete($id)
    {
        try{
            $result=$this->deneme_model->where(["Id"=>$id])->delete();
            if ($result>0){
                return response(['success' => 1, 'data' =>[], 'message' =>'']);
            }else{
                throw new ResponseException(Lang::get('deneme.eror', "en"), 0);
            }
        }catch (ResponseException $e ) {
            return response($e->getResponse());
        }
    }

    public function DenemeAdd($model)
    {   try{

        $model["Token"]=Helper::getGUID();
        request_all($model);
        $this->validator->validateForUpdate($model,"en");
        $this->validator->emailInputCheck($model["Email"]);

        $result=$this->deneme_model->add($model);

        if ($result>0){
           return response(['success' => 1, 'data' => $model, 'message' =>'']);
        }else{
           return response(['success' => 0, 'data' => $model, 'message' =>'']);
        }
    }
    catch (ResponseException $e ) {
        return response($e->getResponse());
    }

    }

}


?>