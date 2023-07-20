<?php

namespace app\core;

class Translator
{
    const FILE_EXTENSION = '.json';
    const LANG_ENGLISH   = 'en';
    const LANG_ROMANIAN  = 'ro';

    private string $path = '';

    public function translate(string $file, string $key, array $replaceable = [], string $lang = self::LANG_ENGLISH)
    {
        $filePath = $this->path . $lang . '\\' . $file . self::FILE_EXTENSION;

        if (file_exists($filePath)) {
            $fileContent     = file_get_contents($filePath);
            $parsableContent = json_decode($fileContent, true);
            $translation     = vsprintf($parsableContent[$key], $replaceable);

            var_dump ($translation); die;
        }

        //TODO: Throw exception - file not found
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
