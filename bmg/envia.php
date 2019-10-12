<?php
	require('phpmailer/class.phpmailer.php');


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;

$mail->SetFrom('saulo.informatica@gmail.com', 'Disparador');
$mail->Username = 'saulo.informatica@gmail.com';
$mail->Password = 'ssc2014@';

$mail->AddAddress('saulo.informatica@gmail.com', 'Receptor');

$recebe_nome = $_POST['nome'];
$recebe_fone = $_POST['fone'];
$recebe_ramal = $_POST['ramal'];
$recebe_email = $_POST['email'];

$mail->Subject='Contato pelo site';
$mail->MsgHTML('Nome:' . $recebe_nome . '<br>' . 'Fone:' . $recebe_fone . '<br>' . 'Ramal:' . $recebe_ramal . '<br>' . 'E-mail:' . $recebe_email);

if ($mail->Send()) {
		echo "<script type='text/javascript'> 
		alert('Mensagem enviada com sucesso!!'); 
		</script>"; 
	echo "<meta http-equiv='refresh' content='2;URL=http://www.palazzopropaganda.com.br'>";
	}
	
	else {
		echo "<script type='text/javascript'> 
		alert('Ocorreu um erro no envio!!'); 
		</script>"; 
	echo "<meta http-equiv='refresh' content='2;URL=index.php'>";	
	}
?>
