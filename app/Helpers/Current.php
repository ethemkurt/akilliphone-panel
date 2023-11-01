<?php
class Current{
    public static function User($attribute=null)
    {
        $result = false;
        try{
            $user = \WebService::isLogged();
            if($user){
                if($attribute){
                    if(array_key_exists($attribute, $user)){
                        $result = $user[$attribute];
                    }
                } else {
                    $result = $user;
                }
            }
        } catch (\Exception $ex){
            $result = $ex->getMessage();
        }
        return $result;
    }
}
