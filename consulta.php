<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet" />
        <title>Consulta Participante</title>
        <link rel="stylesheet" type="text/css" href="./styleofc2.css">
        <title>DATABASE 1 - TADS</title>
    </head>

    <body>
        <div class="container">
            <div class="consulta">
                <h1>Consulta Participante</h1>
                <form method="POST" action="">
                    <label for="nome_part">Nome do participante:</label>
                    <input autocomplete="off" required type="text" id="nome_part" name="nome_part"
                        placeholder="Digite o nome do participante">
                    <br><br>
                    <label for="email_part">Email do participante:</label>
                    <input autocomplete="off" type="text" id="email_part" name="email_part"
                        placeholder="Digite o email do participante">
                    <br><br>
                    <input type="submit" value="Consultar">
                </form>
                <div class="footer-redir" style='margin-top: 30px; text-align: center;'>
                    <p>Se deseja voltar para o menu: <a style='text-decoration: none; color: blue;' href="./index.html">CLIQUE AQUI</a></p>
                    <p>Caso queira cadastrar participante: <a style='text-decoration: none; color: blue;' href="./cadastro.php">CLIQUE AQUI</a></p>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "u413736887_jjdev";
                    $password = "Postgres913198@";
                    $dbname = "u413736887_eventos_ifrr";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Monta a query de consulta
                    $query = "SELECT * FROM Participante WHERE 1=1";
                    if (!empty($_POST['nome_part'])) {
                        $nome_part = $_POST['nome_part'];
                        $query .= " AND Nome_part = '$nome_part'";
                    }
                    if (!empty($_POST['email_part'])) {
                        $email_part = $_POST['email_part'];
                        $query .= " AND Email_part LIKE '%$email_part%'";
                    }

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["Id_part"] . "</td><td>" . $row["Nome_part"] . "</td><td>" . $row["Tel_part"] . "</td><td>" . $row["Email_part"] . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<div id='msg' style='background-color: red; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Nenhum Resultado não Encontrado: " . $conn->error . "</div>";
                        echo "<script>setTimeout(function() { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                        ;
                    }

                    $conn->close();
                }
                ?>
            </div>

        </div>
    </body>

</html>