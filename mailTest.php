<?php

$header="MIME-Version: 1.0\r\n";
$header.='From:"BeelEAT"<beeleat@lucien-brd.com>'."\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
	<body>
		<div align="center">
			<img src="http://www.luciano-brd.com/assets/images/favicons/logo.png"/>
			<br />
			Test envoie mail
			<br />
			<img src="http://www.primfx.com/mailing/separation.png"/>
		</div>
	</body>
</html>
';

mail("lucien.burdet@laposte.net", "Titre", $message, $header);

?>
