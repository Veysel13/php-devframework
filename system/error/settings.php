<?php
/**
 * Created by PhpStorm.
 * User: kutuphane
 * Date: 12.12.2016
 * Time: 19:22
 */
/*
 hata ayarları-error settings
 */
$page_404="404";
/*
  404 sayfasının adı .uzantısı php olmalı
 404 name of page.extension must is php of 404 page
  */
error_reporting(E_ALL);
/*if dont showing error E_ALL instead of 0(zero)
  E__ALL yerine sıfır(0) kullanırsanız proje hatta vermez
  */
set_time_limit(3);
/*max 10 seconds work project..after 10 seconds stop
 projeniz max 10 saniyede cevap vermezse durur
 */
//ini_set('session.gc_maxlifetime', 3600);
/*
 3600 second is session life
3600 saniyede session biter
*/