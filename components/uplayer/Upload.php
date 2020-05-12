<?php

namespace Component\Uplayer;
use Component\Verify\Verify;
use Component\Exception\NotFoundException;
use Component\Exception\Exception;

class Uplayer extends Verify
{

    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function uploadFile(string $name, array $format = null, bool $unique = false)
    {

        if (isset($_FILES[$name]) && !empty($_FILES[$name]['name'])) {

            $file = $_FILES[$name];

            $ext = explode(".", $file['name']);
            $extFile = $ext[1];

            if (isset($format)) {
                if (!in_array($extFile, $format)) {
                    Exception::fileError("File format is different from the one informed");
                }  
            }
 
            $ext = explode('.', $file['name']);
            $ext = end($ext);
            $newName = "IMG-".date('dmY').uniqid().'.' . $ext;

            if ($unique == true) {               
                if (!move_uploaded_file($file['tmp_name'], $this->directory."/". $newName)) {
                    Exception::fileError("File could not be uploaded");
                }
            } else {
                if (!move_uploaded_file($file['tmp_name'], $this->directory."/". $file['name'])) {
                    Exception::fileError("File could not be uploaded");
                }
            }
            
        } else {
            NotFoundException::fileNotFound("File not found", "No files were sent");
        }
    }

    public function uploadFiles(string $name, array $format = null, bool $unique = false)
    {
        if (isset($_FILES[$name]) && !empty($_FILES[$name]['name'])) {

            $file = $_FILES[$name];
            $countFiles = count($file['name']);
 
            for ($i = 0; $i < $countFiles; $i++) {

                $ext = explode(".", $file['name'][$i]);
                $extFile = $ext[1];

                if (isset($format)) {
                    if (!in_array($extFile, $format)) {
                        Exception::fileError("File format is different from the one informed");
                    }  
                }

                $ext = explode('.', $file['name'][$i]);
                $ext = end($ext);
                $newName = "IMG-".date('dmY').uniqid().'.' . $ext;
                
                if ($unique == true) {
                    if (!move_uploaded_file($file['tmp_name'][$i], $this->directory."/". $newName)) {
                        Exception::fileError("Files could not be uploaded");
                    }
                } else {
                    if (!move_uploaded_file($file['tmp_name'][$i], $this->directory."/". $file['name'][$i])) {
                        Exception::fileError("Files could not be uploaded");
                    }
                }
            }
            
        } else {
            NotFoundException::fileNotFound("File not found", "No files were sent");
        }
    }
}
