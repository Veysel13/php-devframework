<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	
require("class.phpmailer.php");

function MailSend($body,$konu){



	$mail = new PHPMailer();
	$mail->IsSMTP();  
	$mail->CharSet="UTF-8";                               // send via SMTP
	$mail->Host     = "mail.veyselakpinar.com"; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "noreply@veyselakpinar.com";  // SMTP username
	$mail->Password = "veysel1995";// SMTP password
	$mail->Port     = 587;
	$mail->From     = "noreply@veyselakpinar.com";// smtp kullanýcý adýnýz ile ayný olmalý
	$mail->Fromname = "Veysel Akpınar";
	$mail->isHTML(true);
	//Çoklu mail için bu satırı çoğal
	$mail->AddAddress("veyselakpinar13@gmail.com");
	$mail->AddAddress("info@veyselakpinar.com");
	//$mail->addAttachment('reism');

	/*$mail->Subject  =  $_POST['adsoyad'];
	$mail->Body     =  implode("    ",$_POST);*/

$mail->Subject=$konu;
$mail->Body=$body;
$mail->Send();

/*if(!$mail->Send())
{
	echo "Mesaj Gönderilemedi <p>";
	echo "Mailer Error: " . $mail->ErrorInfo;
	exit;
}
*/
}

?>
<!--<meta http-equiv="refresh" content="0;URL=../iletisim.php?durum=ok">-->