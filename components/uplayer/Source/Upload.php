<?php

namespace Source\Upload;
use Source\Verify\Verify;

class Upload extends Verify
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
                    echo "<h1 style='font-family: sans-serif;'>File format is different from the one informed</h1>";
                    die();
                }  
            }
 
            $ext = explode('.', $file['name']);
            $ext = end($ext);
            $newName = "IMG-".date('dmY').uniqid().'.' . $ext;

            if ($unique == true) {               
                if (!move_uploaded_file($file['tmp_name'], $this->directory."/". $newName)) {
                    echo "<h1 style='font-family: sans-serif;'>File could not be uploaded</h1>";
                }
            } else {
                if (!move_uploaded_file($file['tmp_name'], $this->directory."/". $file['name'])) {
                    echo "<h1 style='font-family: sans-serif;'>File could not be uploaded</h1>";
                }
            }
            
        } else {
            echo "<h1 style='font-family: sans-serif;'>File not found</h1>";
            echo "<p style='font-family: sans-serif;'>No files were sent</p>";
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
                        echo "<h1 style='font-family: sans-serif;'>File format is different from the one informed</h1>";
                        die();
                    }  
                }

                $ext = explode('.', $file['name'][$i]);
                $ext = end($ext);
                $newName = "IMG-".date('dmY').uniqid().'.' . $ext;
                
                if ($unique == true) {
                    if (!move_uploaded_file($file['tmp_name'][$i], $this->directory."/". $newName)) {
                        echo "<h1 style='font-family: sans-serif;'>Files could not be uploaded</h1>";
                    }
                } else {
                    if (!move_uploaded_file($file['tmp_name'][$i], $this->directory."/". $file['name'][$i])) {
                        echo "<h1 style='font-family: sans-serif;'>Files could not be uploaded</h1>";
                    }
                }
            }
            
        } else {
            echo "<h1 style='font-family: sans-serif;'>Files not found</h1>";
            echo "<p style='font-family: sans-serif;'>No files were sent</p>";
        }
    }
}
