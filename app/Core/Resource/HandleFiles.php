<?php

namespace Solital\Core\Resource;

use FilesystemIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Solital\Core\Exceptions\NotFoundException;

class HandleFiles
{
    /**
     * @var string
     */
    private $folder;

    /**
     * @var array
     */
    private $files = [];

    /**
     * @param string $folder
     * @return HandleFiles
     */
    public function folder(string $folder): HandleFiles
    {
        $this->folder = $folder."/";
        return $this;
    }

    /**
     * @return array
     * @thrown NotFoundException
     */
    public function files(): array
    {
        if (is_dir($this->folder)) {
            $dir = dir($this->folder);

            while (($files = $dir->read()) !== false) {
                if(($files != '.') && ($files != '..')) {
                    $this->files[] = $this->folder.$files;
                }
            }

            $dir->close();

            return $this->files;
        } else {
            NotFoundException::FileSystemNotFound($this->folder);
        }
    }

    /**
     * @param string $word
     * @return null|array
     */
    public function file($word): ?string
    {
        $iterator = new \FileSystemIterator($this->folder);
        foreach ($iterator as $file) {

            $filename = $file->getRealpath();

            if (strpos($filename, $word) !== false) {
                return $this->files[] = $filename;
            }
        }

        return null;
    }

    /**
     * @param string $file
     * @return null|bool
     */
    public function fileExists($file): bool
    {
        if (file_exists($this->folder.$file)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $dir
     * @param int $permission
     * @return bool
     */
    public function create(string $dir, int $permission = 0777): bool
    {
        $dir = ROOT."/".$dir."/";
        
        if (!is_dir($dir)) {
            \mkdir($dir, $permission, true);
            \chmod($dir, $permission);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $dir
     * @param bool $safe
     * @return bool
     */
    public function remove(string $dir, bool $safe = true): bool
    {
        $dir = dir(ROOT."/".$dir."/");
        
        while (($files = $dir->read()) !== false) {
            if(($files != '.') && ($files != '..')) {
                $this->files[] = $this->folder.$files;
            }
        }

        $dir->close();

        if (is_dir($dir->path)) {
            if ($safe == false) {
                $this->removeFiles($dir->path);
                return true;
            }
            
            if (is_array($this->files)) {
                return false;
            }

            \rmdir($dir->path);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $dir
     * @return bool
     */
    private function removeFiles(string $dir): bool
    {
        $di = new \RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new \RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($ri as $file) {
            $file->isDir() ?  \rmdir($file) : \unlink($file);
        }

        \rmdir($dir);

        return true;
    }
}
