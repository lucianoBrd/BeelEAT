<?php

function email($destinataire, $mailTitre, $titre, $sousTitre, $description){
	$header="MIME-Version: 1.0\r\n";
	$header.='From:"BeelEAT"<beeleat@lucien-brd.com>'."\n";
	$header.='Content-Type:text/html; charset="uft-8"'."\n";
	$header.='Content-Transfer-Encoding: 8bit';

	$message='
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<!--IMPORTANT:
	Before deploying this email template into your application make sure you convert all the css code in <style> tag using http://beaker.mailchimp.com/inline-css.
	Chrome and other few mail clients do not support <style> tag so the above converter from mailchip will make sure that all the css code will be converted into inline css.
	-->
	<title>BeelEAT</title>
	<style type="text/css">
	html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
	@media only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
		*[class="table_width_100"] {
			width: 96% !important;
		}
		*[class="border-right_mob"] {
			border-right: 1px solid #dddddd;
		}
		*[class="mob_100"] {
			width: 100% !important;
		}
		*[class="mob_center"] {
			text-align: center !important;
		}
		*[class="mob_center_bl"] {
			float: none !important;
			display: block !important;
			margin: 0px auto;
		}
		.iage_footer a {
			text-decoration: none;
			color: #929ca8;
		}
		img.mob_display_none {
			width: 0px !important;
			height: 0px !important;
			display: none !important;
		}
		img.mob_width_50 {
			width: 40% !important;
			height: auto !important;
		}
	}
	.table_width_100 {
		width: 680px;
	}
	</style>
	</head>

	<body style="padding: 0px; margin: 0px;">
	<div id="mailsub" class="notification" align="center">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">


	<!--[if gte mso 10]>
	<table width="680" border="0" cellspacing="0" cellpadding="0">
	<tr><td>
	<![endif]-->

	<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
		<!--header -->
		<tr><td align="center" bgcolor="#eff3f8">
			<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
			<table width="96%" border="0" cellspacing="0" cellpadding="0">
				<tr><td align="left"><!--

					Item --><div class="mob_center_bl" style="float: left; display: inline-block; width: 115px;">
						<table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
							<tr><td align="left" valign="middle">
								<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
								<table width="115" border="0" cellspacing="0" cellpadding="0" >
									<tr><td align="left" valign="top" class="mob_center">
										<a href="'.MAIL_LINK.'" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
										<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
										<img src="'.MAIL_LINK.'assets/images/favicons/logo.png" width="50" height="50" alt="BeelEAT" border="0" style="display: block;" /></font></a>
									</td></tr>
								</table>
							</td></tr>
						</table></div><!-- Item END--><!--[if gte mso 10]>
						</td>
						<td align="right">
					<![endif]--><!--

					Item --><div class="mob_center_bl" style="float: right; display: inline-block; width: 88px;">
						<table width="88" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;">
							<tr><td align="right" valign="middle">
								<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" >
									<tr><td align="right">
										<!--social -->
										<!--social END-->
									</td></tr>
								</table>
							</td></tr>
						</table></div><!-- Item END--></td>
				</tr>
			</table>
			<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
		</td></tr>
		<!--header END-->

		<!--content 1 -->
		<tr><td align="center" bgcolor="#ffffff">
			<table width="90%" border="0" cellspacing="0" cellpadding="0">
				<tr><td align="center">
					<!-- padding --><div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
					<div style="line-height: 44px;">
						<font face="Arial, Helvetica, sans-serif" size="5" color="#57697e" style="font-size: 34px;">
						<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
							'.$titre.'
						</span></font>
					</div>
					<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
				</td></tr>
				<tr><td align="center">
					<div style="line-height: 30px;">
						<font face="Arial, Helvetica, sans-serif" size="5" color="#4db3a4" style="font-size: 17px;">
						<span style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; color: #4db3a4;">
							'.$sousTitre.'
						</span></font>
					</div>
					<!-- padding --><div style="height: 35px; line-height: 35px; font-size: 10px;">&nbsp;</div>
				</td></tr>
				<tr><td align="center">
							<table width="80%" align="center" border="0" cellspacing="0" cellpadding="0">
								<tr><td align="center">
									<div style="line-height: 24px;">
										<font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 16px;">
										<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
											'.$description.'
										</span></font>
									</div>
								</td></tr>
							</table>
					<!-- padding --><div style="height: 45px; line-height: 45px; font-size: 10px;">&nbsp;</div>
				</td></tr>
				<tr><td align="center">
					<div style="line-height:24px;">
							<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
								<img src="'.MAIL_LINK.'/assets/images/favicons/logo.png" width="100" height="100" alt="BeelEAT" border="0" style="display: block;" /></font>
					</div>
					<!-- padding --><div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
				</td></tr>
			</table>
		</td></tr>
		<!--content 1 END-->

		<!--links -->
		<tr><td align="center" bgcolor="#f9fafc">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td align="center">
					<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
	        <table width="80%" align="center" cellpadding="0" cellspacing="0">
	          <tr>
	            <td align="center" valign="middle" style="font-size: 12px; line-height:22px;">
	            	<font face="Tahoma, Arial, Helvetica, sans-serif" size="2" color="#282f37" style="font-size: 12px;">
									<span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #5b9bd1;">
			              <p target="_blank" style="color: #5b9bd1; text-decoration: none;">A très vite sur BeelEAT</p>
	              </span></font>
	            </td>
	          </tr>
	        </table>
				</td></tr>
				<tr><td><!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div></td></tr>
			</table>
		</td></tr>
		<!--links END-->

		<!--footer -->
		<tr><td class="iage_footer" align="center" bgcolor="#eff3f8">
			<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td align="center">
					<font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
						'.date('Y').' &copy; BeelEAT.
					</span></font>
				</td></tr>
			</table>

			<!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
		</td></tr>
		<!--footer END-->
	</table>
	<!--[if gte mso 10]>
	</td></tr>
	</table>
	<![endif]-->

	</td></tr>
	</table>

	</div>
	</body>
	</html>
';
	mail($destinataire, $mailTitre, $message, $header);
}
?>
