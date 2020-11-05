
<?php 

$nome = $_REQUEST["nome"];
$email = $_REQUEST["email"];
$telefone = $_REQUEST["telefone"];
$telefone_2 = $_REQUEST["telefone_2"];
$administradora = $_REQUEST["administradora"];
$grupo = $_REQUEST["grupo"];
$objeto = $_REQUEST["objeto"];
$contemplacao = $_REQUEST["contemplacao"];
$credito = $_REQUEST["credito"];
$saldo = $_REQUEST["saldo"];
$porc_pago = $_REQUEST["porc_pago"];
$valor_pretendido = $_REQUEST["valor_pretendido"];
$mensagem = $mensagem_email = $_REQUEST["mensagem"];

$msg = "<html xmlns='http://www.w3.org/1999/xhtml'>


<head>
<title>Quero vender meu consórcio</title>
</head>
<body style='margin:0px; padding:20px;' bgcolor='#F9F9F9'>
<table width='600' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td width='650'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td width='34%' align='left' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;color:#666666;'><strong>Vender Consórcio</strong></td>
<td width='66%' height='20'>&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>

<table width='100%' border='0' cellspacing='5' cellpadding='0'>


<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Nome:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$nome</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>E-mail:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$email</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Telefone:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$telefone</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Telefone 2:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$telefone_2</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Administradora:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$administradora</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Grupo:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$grupo</td>
</tr>
 
<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Objeto:</strong></td>
  <td width='83%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$objeto</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Contemplado:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$contemplacao</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Crédito:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$credito</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Saldo:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$saldo</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Porcentagem pago:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$porc_pago</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Valor Pretendido:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$valor_pretendido</td>
</tr>

<tr>
  <td width='30%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'><strong>Mensagem:</strong></td>
  <td width='70%' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;color:#666666;'>$mensagem</td>
</tr>


</table>

</td>
</tr>
</table>
</body>
</html>";

include_once("PHPMailer/PHPMailerAutoload.php");

// CONFIGURACAO AGUARDADA -----------------------------------------------------

        $email_destino = $email;

        $assunto = "Quero vender meu Consórcio";
        $nome_remetente = $nome;
		    
        $email_reply = $email;
        $mensagem = $msg;

      // CONFIGURACAO ---------------------------------------------------------
        
        $username = "sac@consors.com.br";
        $password = "Spitfire#4520";
        $host = "smtp.gmail.com";
        $port = "465";
        
      // ----------------------------------------------------------------------
      
      $mail = new PHPMailer();

      $mail->IsSMTP();

      $mail->setLanguage('br');
      $mail->SMTPSecure = 'SSL';
      $mail->CharSet = "UTF-8"; 

      $mail->Host = $host;
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true;
      $mail->Port = $port;

      $mail->Username = $username; // USUÁRIO DO SMTP DEDICADO
      $mail->Password = $password; // SENHA DO SMTP DEDICADO
      $mail->Subject = $assunto;
      
      $mail->SetFrom($username, $nome_remetente);
      $mail->addReplyTo($email_reply);

      $mail->MsgHTML($mensagem);

      $mail->AddAddress($email, $nome_remetente);
   
        $mail->AddAddress("mktconsors@gmail.com", "Consors");


      if (!$mail->send()) {
          //echo "<pre>"; print_r($mail);die;
      } else {
    //     echo "OK";die;
      }
      




      // ----------------------------------------------------------------

echo("<script>document.location='confirmacao-envio-cota';</script>");



?>