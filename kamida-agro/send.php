<?
// ------------- конфигурация ---------------//

$adminemail="leozaviriukha@ukr.net"; // e-mail админа

$date=date("d.m.y"); // число.месяц.го
$time=date("H:i"); // часы:минуты:секунды
$backurl="https://lzaviriukha.github.io/kamida-agro/"; // на какую старинцу переходит после отправки

//--------------------------------------------//

// прринимаем данные с формы

$email=$_POST['email'];

//проверяем валидность e-mail

if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", strtolower($email)))

  { 

 	echo 
  " <center>Вернитесь <a href='javascript:history.back(1)'><B>назад</B></a>. Вы указали неверные даные!";
  }


  else

  {
     $msg="

  	<p>E-mail: $email<p>
  	";

  	//Отправляем письмо админу 
  	mail("$adminemail", "$date $time Сообщение от $email");

  	// Сохраняем в базу данных

  	$f = fopen("message.txt", "a+");
  	fwrite($f, "\n $date $time Сообщение от $email");
  	fwrite($f, "\n $msg");
  	fwrite($f, "\n ---------------");
  	fclose($f);
  }


  // Выводим сообщение пользователю

  print "<script language='Javascript'><!--function reload() {location = \"$backurl\"}; setTimeout('reload()', 6000); //--></script>

  $msg 

  <p>Сообщение отправлено! Подождите, сейчас вы будете перенаправлены на главную страницу...</p>";
  exit;
}

?>