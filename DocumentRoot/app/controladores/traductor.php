<?php
require_once '/var/www/html/modelos/modelotraducciones.php';

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 86400, "/"); // Utiliza $lang en lugar de $nuevoIdioma
} else {
    if (!isset($_COOKIE['lang'])) {
        $userLanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $configLangUser = explode(',', $userLanguages);
        $userLang = $configLangUser[0];
        if ($userLang == "es-ES") {
            setcookie('lang', 'ESP', time() + 86400, "/");
            $lang = 'ESP';
        } elseif ($userLang == "ca-CA") {
            setcookie('lang', 'CAT', time() + 86400, "/");
            $lang = 'CAT';
        } elseif ($userLang == "it-IT") {
            setcookie('lang', 'ITA', time() + 86400, "/");
            $lang = 'ITA';
        } else {
            setcookie('lang', 'ENG', time() + 86400, "/");
            $lang = 'ENG';
        }
    } else {
        $lang = $_COOKIE['lang'];

    }
}

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

