<!-- ฅ•ω•ฅ -->
<?php
session_start();

// Verifica se o usuário está logado
function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>comida</title>

    <style>
        body {
            background-color: #f8f8f8;
            font-family: 'Material Symbols Outlined', sans-serif;
        }

        header {
            background-color: #ff6f61;
            padding: 15px;
            text-align: center;
        }

        header a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        .logo img {
            width: 150px;
        }

        .cab {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .direita {
            margin: 20px;
        }

        .bannr {
            background-color: #ffcc80;
            padding: 20px;
            border-radius: 10px;
        }

        .corzinha h1 {
            color: #ff6f61;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .pusca {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        #titulo {
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        button {
            background-color: #ff6f61;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .bolinhas {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .bolinhast img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        .bolinhast:hover img {
            transform: scale(1.2);
        }

        .lista-comida {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .cartao {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .cartao:hover {
            transform: scale(1.05);
        }

        .imagem img {
            width: 100%;
            max-width: 200000px;
            height: auto;
            max-height: 1500px;
            object-fit: contain;
            border-radius: 5px;
        }

        .nometext {
            color: #333;
            margin-top: 10px;
            font-size: 16px;
        }

        .btn-secondary2 {
            background-color: #ff6f61;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            margin-top: 10px;
        }
        
    </style>
</head>

<body>
    <header style="z-index: 40;">
        <div class="cab">
            <a href="index.php" class="hotbartext1">INÍCIO</a>
            <a href="login.php" class="hotbartext1">CONTA</a>

            <?php
            if (isset($_SESSION['email']) && $_SESSION['email'] == 'root@root.com') {
                echo '<a href="dashboard.php" class="hotbartext1">ADMIN</a>';
            }

            if (isset($_SESSION['email'])) {
                // Usuário está conectado, exibir o status
                echo '<li><a class="hotbartext1" href="logout.php">Sair</a><p class="user-status">Conectado como: ' . $_SESSION['email'] . '</p></li>';
            } else {
                // Usuário não está conectado, exibir mensagem alternativa
                echo '<li><a href="entrar.php" class="hotbartext1">entra</a><p class="user-status">Você não está em nenhuma conta</p></li>';
            }
            ?>
        </div>
    </header>

    <div class="direita">
        <div class="bannr">
            <div class="corzinha">
                <center>
                    <h1 class="white"> O que voce quer comer hoje?</h1>
                </center>
                <form class="pusca" action="pesquisa.php" method="GET">
                    <input type="text" id="nome_receita" name="nome_receita" placeholder="Pesquise por comida">
                    <button type="submit">Pesquisar</button>
                </form>
                <center>
            </div>
        </div>
        </center>
        <section class="main">
            <div class="lista-comida">
                <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "root";
                  $dbname = "gatoculinario";

                try {
                    // Conecta ao banco de dados
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Prepara e executa a consulta SQL
                    $sql = $pdo->prepare("SELECT * FROM receitas");
                    $sql->execute();
                    $receitas = $sql->fetchAll(PDO::FETCH_ASSOC);

                    // Exibe as receitas
                    foreach ($receitas as $receita) {
                        echo '<div class="cartao">';
                        echo '<div class="imagem">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($receita['imagem']) . '" alt="' . $receita['nome_usuario'] . '" width="400">';
                        echo '</div>';
                        echo '<h3 class="nometext">' . $receita['nome_receita'] . '</h3>';
                        echo '<a href="info.php?id=' . $receita['id'] . '" class="btn-secondary2">Alugar</a>';
                        echo '</div>';
                    }
                } catch (PDOException $e) {
                    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
                }
                ?>
            </div>
        </section>
    </div>





  </body>
</html>
