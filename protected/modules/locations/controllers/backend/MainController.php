<?php
/**********************************************************************************************
 *                            CMS Open Real Estate
 *                              -----------------
 *	version				:	1.8.1
 *	copyright			:	(c) 2014 Monoray
 *	website				:	http://www.monoray.ru/
 *	contact us			:	http://www.monoray.ru/contact
 *
 * This file is part of CMS Open Real Estate
 *
 * Open Real Estate is free software. This work is licensed under a GNU GPL.
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Open Real Estate is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 ***********************************************************************************************/

class MainController extends ModuleAdminController{


    public function actionList(){
        $regions = Region::model()->findAll();
        $this->render('list', array('regions'=>$regions));
    }

    public function actionEdit($id){
        $region = Region::model()->findByPk($id);
        $region->scenario = 'create';
        if (isset($_POST['Region']))
        {
            $region->attributes = $_POST['Region'];
            if ($region->validate())
            {
                if ($region->save()){
                    $url = Yii::app()->createUrl('locations/backend/main/list');
                    $this->redirect($url);
                }
            }
        }
        $this->render('edit', array('region'=>$region));
    }
}