<?php
if (file_exists($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/events.php'))
{
	require_once($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/events.php');
}


/*Почему не работает подключение файлов?(Добавлчяемая ссыдка должна начинаться с /)
И echo из init? 
Куда ссылаеться $_SERVER["DOCUMENT_ROOT"]?(/home/bitrix/www)*/

?>