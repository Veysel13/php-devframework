<?php

namespace System\Libraries\Language;

use Exception;

class Translator
{

    /**
     * Definition of the enclosing characters for the parameters inside the translation strings.
     * @type array
     */
    private $parameter_enclosing_chars = ['{','}'];

    /**
     * Definition of the language iso code.
     * @type array
     */
    private $locale;

    /**
     * Definition of the language index.
     *
     * @type string
     */
    private $locale_key;

    public static function initialize()
    {
        return new Translator();
    }

    /**
     * Handle dynamic, static calls to the object.
     * @param  string $locale
     * @param  string $key
     * @param  array $args
     * @return null
     * @throws
     */
    public function trans($key, $locale, $args = [])
    {

        $this->checkLocale($locale);
        $this->checkArgs($args);

        $array = $this->parseKey($key);

        if ( is_array($array) ) {

            $text = $array[$this->getLocaleKey()];

            if ( !empty($args) ) {

                foreach ($args as $parameter => $replacement) {
                    $text = str_replace($this->parameter_enclosing_chars[0] . $parameter . $this->parameter_enclosing_chars[1], $replacement, $text);
                }

            }

            return $text;

        }

        return null;

    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string  $locale
     *
     * @throws
     */
    public function checkLocale($locale)
    {
        if ( !is_string($locale) || strlen($locale) != 2 ) {
            throw new Exception('Invalid language code!');
        }

        $this->locale = $locale;
    }

    /**
     * Handle dynamic, static calls to the object.
     * @param  string $key
     * @return mixed
     * @throws
     */
    public function parseKey($key)
    {
        if ( !is_string($key) || is_null($key) || empty($key) ) {
            throw new Exception('Invalid directory');
        }

        $key   = explode('.', $key);
        $index = $key[count($key)-1];

        unset($key[count($key)-1]);

        $file = Config::options()->getDirectory() . $this->locale . '/' . implode('/', $key) . '.php';

        if ( !file_exists($file) ) {
            throw new Exception('Directory not found');
        }

        $this->setLocaleKey($index);

        return include $file;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  array  $args
     *
     * @throws
     */
    public function checkArgs(array $args)
    {
        if (!is_array($args)) {
            throw new Exception('Invalid parameter');
        }
    }

    public function setLocaleKey($locale_key)
    {
        $this->locale_key = $locale_key;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @return  string
     */
    public function getLocaleKey()
    {
        return $this->locale_key;
    }

}