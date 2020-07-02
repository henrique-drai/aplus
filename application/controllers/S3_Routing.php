<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class S3_Routing extends CI_Controller {

    
    public $s3;
    public $bucketName;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UserModel');


        $this->bucketName = 'plusa';
        $IAM_KEY = 'AKIAVFIHVJAOIQ3CYTWP';
        $IAM_SECRET = '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';
        
        $this -> s3 = S3Client::factory(
            array(
                'credentials' => array(
                    'key' => $IAM_KEY,
                    'secret' => $IAM_SECRET
                ),
                'version' => 'latest',
                'region'  => 'eu-west-3'
            )
        );
        
    }

  
    public function profile_pic($userId){


        $userId = htmlspecialchars($userId);
        $userPicture = $this->UserModel->getUserById($userId)->picture;


        if($userPicture ==""){
            $plain_url = base_url() . "uploads/profile/default.jpg";

            $image = file_get_contents($plain_url);
            header('Content-type: image/jpg;');            
        }
        else{

            $plain_url = $this->s3->getObjectUrl($this->bucketName, "profile/" . $userId . "." . $userPicture);
        
            $image = file_get_contents($plain_url);
            header('Content-type: image/' . $userPicture . ';');
        }

        header("Content-Length: " . strlen($image));
        echo $image;
    }


    public function enunciado_projeto($idProjeto){

        $idProjeto = htmlspecialchars($idProjeto);
        // $idCadeira = htmlspecialchars($idCadeira);

        $plain_url = $this->s3->getObjectUrl($this->bucketName, "enunciados_files/" . $idProjeto . ".pdf");

        $file = file_get_contents($plain_url);
        header('Content-type: application/pdf;');
        header("Content-Length: " . strlen($file));

        // echo $plain_url;

        // print_r($plain_url);

        echo $file;

    }

}
