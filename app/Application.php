<?php
/**
 * Created by PhpStorm.
 * User: Frederyk Antunnes
 * Date: 07/08/2018
 * Time: 21:04
 */

namespace App;


class Application extends \Illuminate\Foundation\Application {
    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'public_html';
    }
}
