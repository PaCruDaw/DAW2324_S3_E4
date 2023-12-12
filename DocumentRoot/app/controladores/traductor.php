<?php
require_once '../modelos/modelotraducciones.php';


//static class for translate
class TranslatePage {
    private static $translate;

    public static function initTranslator() {
        self::$translate = new Traducciones();
    }

    public static function pageTranslate($text, $site) {
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