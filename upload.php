<?php 

include("connection.php");

$msg = false;

if(isset($_FILES['arquivo'])){

    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    $novo_nome = md5(time()). $extensao;
    $diretorio = "/upload";


    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

    $sql_code = "INSERT INTO arquivo (codigo, arquivo, data) VALUES (null, '$novo_nome', NOW())";

    if($conn->query($sql_code))
        $msg = "Arquivo enviado com sucesso!";
    else        
        $msg = "Falha ao enviar arquivo.";

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
</head>
<body>
    <h1><?php if($msg != false) echo "<p> $msg </p>"; ?></h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        Arquivo <input type="file" name="arquivo" id="" required>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>