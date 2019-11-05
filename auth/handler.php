<?php
use Bitrix\Main\Page\Asset;
//регистрируем обработчик добавления css
AddEventHandler("main", "OnEpilog", Array("IkigayEpilog", "addAuthCss"));

/**
 *класс определения функций доработки формы авторизации в ИКИГАЙ
 */
class IkigayEpilog
{   /*добавление */

    /**
     *
     */
    function addAuthCss()
	{
		global $USER;
		if(!$USER->IsAuthorized()){
		    $asset = Asset::getInstance();
            IkigayEpilog::initAuthJsAndCss();
            $asset->addString('<script>BX.ready(function () { BX.AuthFormCSS.init(); });</script>');
		}

	}

    /**
     *
     */
    static function initAuthJsAndCss(){
	    CJSCore::RegisterExt('authInit',
            array(
                'js' => '/local/php_interface/include/main/auth/script.js',
                'lang' => '/local/php_interface/include/main/auth/lang/'. LANGUAGE_ID .'/lang.php',
                'css' => '/local/php_interface/include/main/auth/styles.css',
                'rel' => array(
                    'core'
                )
            )
        );

	    CJSCore::Init('authInit');
    }
}

?>