<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class BackendController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        // theCreator
                    [
                         'controllers' => ['user', 'tex', 'site', 'building', 'room', 'material-base'],

                        'actions' => ['index',  'indexs','update', 'view', 'material-base', 'create', 'viewuser','qrpdf', 'finalpdf', 'qrpdftr'],

                        'allow' => true,
                        'roles' => ['theCreator'],
                    ],

                    // Admin
                    [
                        'controllers' => [ 'tex', 'site', 'building', 'room', 'material-base'],
                        'actions' => ['index', 'indexs', 'update', 'view', 'material-base', 'create', 'olx', 'viewuser','qrpdf', 'finalpdf', 'qrpdftr' ],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],

                ], // rules

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ], // verbs

        ]; // return

    } // behaviors



} // BackendController
