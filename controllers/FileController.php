<?php


namespace app\controllers;


use tn\phpmvc\Controller;
use tn\phpmvc\Request;
use tn\phpmvc\utils\Filesystem;

class FileController extends Controller
{
    public function getFile(Request $request)
    {
        $file = new Filesystem();
        $data  = $request->getBody();
        $mime_type = $file->mimeType($data['file']);
        header('Content-Type: '.$mime_type);

        readfile($data['file']);

    }

}