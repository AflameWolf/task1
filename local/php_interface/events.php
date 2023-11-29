<?php

addEventHandler("main", "OnBeforeEventAdd", Array("MyClass", "OnBeforeEventAddHandler")); # При отлове события выполняем метод класса 


class MyClass

{
	public static function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)#передаем методы функции по ссылке(т.е модифицируем везде,а не только в функции?)
	#Проверяем событие ли это формы. Если да модефицируем данные
	{ 	
		
		if ($event=="FEEDBACK_FORM")
		{
			global $USER;
			if ($USER->IsAuthorized()) 
			#Вызов метода встроенного класса юзер который возвращает true усли пользователь в системе 
			{
				$id = $USER->GetID();
				$name = $USER->GetFullName();
				$login = $USER->GetLogin();
				$form_name=$arFields['AUTHOR'];
				$arFields['AUTHOR'] = "Пользователь авторизован: $id ($login) $name, данные из формы: $form_name";#Замена данных отпровляемых (на почту?)




			}else{
				$form_name=$arFields['AUTHOR'];
				$arFields['AUTHOR'] = "Пользователь не авторизован, данные из формы: $form_name";

			}


			CEventLog::Add(array(#Странно логировать событие до того как оно произошло(уточнить)
				"SEVERITY" => "SECURITY",
				"AUDIT_TYPE_ID" => "Замена данных в отсылаемом письме",
				"MODULE_ID" => "main",
				"ITEM_ID" => $event,
				"DESCRIPTION" => "Замена данных в отсылаемом письме-".$arFields['AUTHOR'],
			));#Логирование события 

		}
	}
}


?>