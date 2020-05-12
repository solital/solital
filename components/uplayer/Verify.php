<?php

namespace Component\Verify;

abstract class Verify
{
    public function validation(string $extension)
    {
        switch ($extension) {
            case 'jpg':
                echo 'jpg';
                break;

            case 'png':
                echo 'png';
                break;

            case 'webp':
                echo 'webp';
                break;
            
            default:
                echo 'none';
                break;
        }
    }
}
