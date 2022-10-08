<?php

/**
 * @Author: yosrio
 * @Date:   2022-10-08 12:36:48
 * @Last Modified by:   yosri
 * @Last Modified time: 2022-10-08 12:38:21
 */
class Controller {
    public function view($view, $data=[]){
        require_once 'app/views/'.$view.'.php';
    }

    public function model($model){
        require_once 'app/models/'.$model.'.php';
        return new $model;
    }
}