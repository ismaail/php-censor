<?php

namespace PHPCensor;

use PHPCensor\Common\Exception\RuntimeException;

class View
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $viewFile;

    /**
     * @var string
     */
    protected static $extension = 'phtml';

    /**
     * @param string      $file
     * @param string|null $path
     */
    public function __construct($file, $path = null)
    {
        if (!self::exists($file, $path)) {
            throw new RuntimeException('View file does not exist: ' . $file);
        }

        $this->viewFile = self::getViewFile($file, $path);
    }

    /**
     * @param string      $file
     * @param string|null $path
     *
     * @return string
     */
    protected static function getViewFile($file, $path = null)
    {
        $viewPath = is_null($path) ? (SRC_DIR . 'View/') : $path;

        return $viewPath . $file . '.' . static::$extension;
    }

    /**
     * @param string      $file
     * @param string|null $path
     *
     * @return bool
     */
    public static function exists($file, $path = null)
    {
        if (!file_exists(self::getViewFile($file, $path))) {
            return false;
        }

        return true;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data[$key];
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return string
     */
    public function render()
    {
        extract($this->data);

        ob_start();

        require($this->viewFile);

        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}
