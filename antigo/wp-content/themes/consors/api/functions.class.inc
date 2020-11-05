<?php
	 
	 require_once("functionsmanager.class.inc");
	 
	 class Functions extends FunctionsManager{

		 public static function getUrl($x){
			 return Connector::getUrl("tab_conteudo", $x);
		 }

		 public static function getUrlSeoLocal($x){
			 return HTTP_HOST . $x;
		 }
		 
		 public static function getUrlSub($x){
			 return Connector::getUrl("tab_conteudo_sub", $x);
		 }
		 
		 public static function getStatusContato($x){
		   if($x == 1)
		     return "Contato Recebido";
		   if($x == 2)
		     return "Contato Respondido";
		 }
		 
		 public static function getDay($data){

			  list($dia, $hora) = explode(" ", $data);

			  list($ano, $mes, $dia) = explode("-", $dia);

			  

			  return $dia;

			}
		 
		 public static function getMesAbreviado($dt){

					

					list($data, $horario) = explode(" ", $dt);

					

					list($ano, $mes, $dia) = explode("-", $data);

					

					return substr(self::getMes($mes), 0, 3);



			}

		 
		 public static function sendMail($MailTo, $NameTo, $Subject, $Message){
			 
			 // CONFIGURACAO ----------------------------------------------------------------------------------------
			  
				$usuario =  "contato@mastertest.com.br";
				$senha = "cliente3409";
				
				$nomeRemetente = "Mastertest Vagas";
				$email_remetente = "site@mastertestvagas.com.br";
				
				
			// -----------------------------------------------------------------------------------------------------
			/*
			include_once("phpmailer/class.phpmailer.php");
			
			$Host = 'smtp.'.substr(strstr($usuario, '@'), 1);
			$Username = $usuario;
			$Password = $senha;
			$Port = "465";
			
			$mail = new PHPMailer();
			$body = $Message;
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = $Host; // SMTP server
			$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
			// 1 = errors and messages
			// 2 = messages only
			$mail->SMTPSecure = "ssl";
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->Port = $Port; // set the SMTP port for the service server
			$mail->Username = $Username; // account username
			$mail->Password = $Password; // account password
			
			$mail->SetFrom($usuario, $nomeRemetente);
			$mail->Subject = 'teste';//$Subject;
			$mail->MsgHTML($body);
			$mail->AddAddress($MailTo, $NameTo);
			
			$mail->Send();
			*/
			
			$email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: contato@mastertest.com.br", "Subject: $Subject","Return-Path: $email_remetente","MIME-Version: 1.1","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
			
			mail ($MailTo, $Subject, $Message, $email_headers);

		 }
		 
		 public static function getTelefone($x){
			 return self::mask($x, 'tel');
		 }
		 
		 public static function getFormatCnpj($x){
			 return self::mask($x, '##.###.###/####-##');
		 }
		 
		 public static function getMaskCep($x){
			 return self::mask($x, '#####-###');
		 }
		 
		 public static function getGrupo($x){
			 return Connector::getAllName("tab_grupo", "nm_grupo", "id_grupo='" . $x . "'");
		 }

		 public static function getCategoria($x){
			 return Connector::getAllName("tab_categoria", "nm_categoria", "id_categoria='" . $x . "'");
		 }
		 
		 public static function getSubCategoria($x){
			 return Connector::getAllName("tab_subcategoria", "nm_subcategoria", "id_subcategoria='" . $x . "'");
		 }

		 public static function getBairro($x){
			 return Connector::getAllName("tab_bairro", "nm_bairro", "id_bairro='" . $x . "'");
		 }

		 public static function getCidade($x){
			 return Connector::getAllName("tab_bairro", "nm_cidade", "id_bairro='" . $x . "'");
		 }

		 public static function getServico($x){
			 return Connector::getAllName("tab_servico", "nm_servico", "id_servico='" . $x . "'");
		 }

		 public static function getZona($x){
			 $id_zona = Connector::getAllName("tab_bairro", "cd_zona", "id_bairro='" . $x . "'");
			 return Connector::getAllName("tab_zona", "nm_zona", "id_zona='" . $id_zona . "'");
		 }

		 public static function getTituloSeoLocal($x){

			 $nm_chamada = Connector::getAllName("tab_seo_local", "nm_chamada", "id_seo_local='" . $x . "'");
			 $id_bairro = Connector::getAllName("tab_seo_local", "id_bairro", "id_seo_local='" . $x . "'");
			 $id_servico = Connector::getAllName("tab_seo_local", "id_servico", "id_seo_local='" . $x . "'");

			 $titulo = Functions::getServico($id_servico);
			
			 if($nm_chamada) 
			   $titulo .= " " . $nm_chamada;

			 $titulo .= " " . Functions::getBairro($id_bairro);
			 
			 return $titulo;
		 }

	 }
	 
?>