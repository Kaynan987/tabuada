<!DOCTYPE html>
<html>
<head>
    <title>Tabuada em PHP</title>
    <style>
        body {
            background-image: url('halloween.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }
        /* Estilos para a tabela */
        table {
            background-color: #ffffff;
            margin: 0 auto;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .text{
            color:#ffffff;
        }
    </style>
</head>
<body>
<center>
<h2 class="text">Tabuada em PHP</h2>

<form method="post" action="">
    <h1><label for="numero" class="text">Escolha um número:</label></h1>
    </br>
    <input type="number" name="numero" id="numero" required>
    <input type="submit" value="Gerar Tabuada">
</form>
    </center>
    <!-- =============================================================== -->
<?php
if (isset($_POST['numero'])) {
    $numero = (int)$_POST['numero'];

    echo "<table border='1'>";
    echo '</br>';
    echo "<tr><th>Multiplicador</th><th>Resultado</th></tr>";

    for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        echo "<tr><td>$i</td><td>$resultado</td></tr>";
    }

    echo "</table>";
}
?>
<!-- =============================================================== -->
</body>
</html>
