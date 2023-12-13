<?php
require_once '/var/www/html/modelos/modelotraducciones.php';

if (isset($_GET['lang'])) {
    setcookie('lang', $_GET['lang'], time() + 86400, "/"); // Utiliza $lang en lugar de $nuevoIdioma
}

$lang = $_COOKIE['lang'];

//static class for translate
class TranslatePage {
    private static $translate;

    public static function initTranslator() {
        self::$translate = new Traducciones();
    }

    public static function pageTranslate($text, $site, $lang) {
        // Inicializar la propiedad estática si aún no está inicializada
        if (self::$translate === null) {
            self::initTranslator();
        }

        // Usar la propiedad estática
        echo self::$translate->translatePage($text, $site);
    }
}
//init static
TranslatePage::initTranslator();

?>

