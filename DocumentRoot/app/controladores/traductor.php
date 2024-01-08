<?php
require_once '/var/www/html/modelos/modelotraducciones.php';

$response = array(); // Crear un array para la respuesta

if (isset($_GET['lang'])) {
    setcookie('lang', $_GET['lang'], time() + 86400, "/"); // Utiliza $lang en lugar de $nuevoIdioma
    $response['success'] = true;
    $response['message'] = 'Idioma cambiado exitosamente.';
    // Enviar la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $userLanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $configLangUser = explode(',', $userLanguages);
    $userLang = $configLangUser[0];
    if ($userLang == "es-ES") {
        $lang = "ESP";
    } elseif ($userLang == "ca-CA") {
        $lang = "CAT";
    } else {
        $lang = "ENG";
    }
}


//////////////////////////////////////////////
//static class for translate
class TranslateTextPage {
    private static $translate;

    public static function initTranslator() {
        self::$translate = new Traducciones();
    }

    public static function pageTranslate($text, $site, $lang) {
        // Inicializar la propiedad estática si aún no está inicializada
        if (self::$translate === null) {
            self::initTranslator();
        }
        $trans = self::$translate->translateTextPage ($text, $site, $lang);
        return $trans[0]['translation'];
    }
}
//init static
TranslateTextPage::initTranslator();
?>