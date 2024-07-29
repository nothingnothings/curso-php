<?


# alterar a variável abaixo colocando o seu email


$destinatario = "arthur.panazolo@acad.pucrs.br";


$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$mensagem = $_REQUEST['mensagem'];
$assunto = $_REQUEST['assunto'];


//monta o e-mail (email de resposta) na variavel $body


$body = "=========================================" . "\n";
$body = $body . "FALE CONOSCO - TESTE COMPROVATIVO" . "\n"; // campos que podem ser editados; layout do email de reposta que você fará para o cliente      ("\n"; é a função para pular de linha)
$body= $body . "====================================" . "\n
\n";  //("\n\n"; pula duas linhas)

$body = $body . "Nome: " . $nome . "\n";     //nome do cliente
$body = $body . "Email: " . $email . "\n";   // email de contato do cliente
$body = $body . "Mensagem: " . $mensagem . "\n\n";  //mensagem automotizada com informações que o cliente informar
$body = $body . "====================================" . "\n";


//envia o email

mail($destinatario, $assunto, $body, "From: $email\r\n");


//redireciona para a página de obrigado


header('Location: index.html');
exit;





?>