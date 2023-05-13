<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet" />
        <title>Cadastro Participante</title>
        <link rel="stylesheet" type="text/css" href="./styleofc2.css">
        <title>DATABASE 1 - TADS</title>
    </head>

    <body>
        <div class="container">
            <div class="cadastro">
                <h2>Cadastrar Participante</h2>
                <form method="POST" action="">
                    <label for="nome_part">Nome do participante:</label>
                    <input autocomplete="off" required type="text" id="nome_part" name="nome_part"
                        placeholder="Digite o nome do participante">
                    <br><br>
                    <label for="tel_part">Telefone do participante:</label>
                    <input autocomplete="off" required type="tel" id="tel_part" name="tel_part"
                        placeholder="Digite o telefone do participante">
                    <br><br>
                    <label for="email_part">Email do participante:</label>
                    <input autocomplete="off" required type="email" id="email_part" name="email_part"
                        placeholder="Digite o email do participante">
                    <br><br>
                    <input type="submit" value="Cadastrar">
                </form>
                <div class="footer-redir">
                    <p>Se deseja voltar para o menu: <a href="./index.html">CLIQUE AQUI</a></p>
                    <p>Caso queira consultar participante: <a href="./consulta.php">CLIQUE AQUI</a></p>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // verifica se todos os campos estão preenchidos
                    if (empty($_POST["nome_part"]) || empty($_POST["email_part"])) {
                        echo "<div id='msg' style='background-color: red; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Por favor, preencha todos os campos.</div>";
                        echo "<script>setTimeout(function () { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                    } else {
                        $nome_part = $_POST['nome_part'];
                        $tel_part = !empty($_POST['tel_part']) ? $_POST['tel_part'] : null;
                        $email_part = $_POST['email_part'];

                        // Conexão com o banco de dados
                        $servername = "localhost";
                        $username = "u413736887_jjdev";
                        $password = "Postgres9131@";
                        $dbname = "u413736887_eventos_ifrr";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // verifica se o e-mail já existe no banco de dados
                        $sql = "SELECT * FROM Participante WHERE Email_part = '$email_part'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<div id='msg' style='background-color: red;color: white;margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>O e-mail inserido já existe no banco de dados.</div>";
                            echo "<script>setTimeout(function () { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                        } else {
                            // Monta a query de inserção
                            $query = "INSERT INTO Participante (Nome_part, Tel_part, Email_part) VALUES ('$nome_part', '$tel_part', '$email_part')";

                            if ($conn->query($query) === TRUE) {
                                header("Location: " . $_SERVER["PHP_SELF"]);
                                echo "<div id='msg' style='background-color: green; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Participante cadastrado com sucesso.</div>";
                                echo "<script>setTimeout(function () { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                                exit();
                            } else {
                                echo "<div id='msg' style='background-color: red; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Erro ao cadastrar participante: " . $conn->error . "</div>";
                                echo "<script>setTimeout(function () { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                            }

                        }
                        $conn->close();
                    }
                }
                ?>
            </div>
        </div>
    </body>

</html>