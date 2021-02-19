<?php
/**
 * Created by PhpStorm.
 * User: NguyenVan
 * Date: 23/05/2016
 * Time: 11:58 SA
 */
class WebUser extends CWebUser {
    private $_model;

    public function init(){
        parent::init();
    }

    // Load user model.
    protected function loadUser($id = null){
        if ($this->_model === null) {
            if ($id !== null)
                $this->_model = $id;
        }
        return $this->_model;
    }

    public function getCurrentRoleUser()
    {
        $user = $this->loadUser(Yii::app()->user->role);
        return $user;
    }

    function isAdmin()
    {
        $user = User::model()->findByPk($this->getCurrentUser());
        if ($user != null) {
            return intval($user->role) == Constants::ROLE_ADMIN;
        } else {
            return false;
        }
    }

    function isCustomer()
    {
        $user = User::model()->findByPk($this->getCurrentUser());
        if ($user != null) {
            if(intval($user->role) == Constants::ROLE_CUSTOMER)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

    public function getCurrentUser()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        return $user;
    }
}