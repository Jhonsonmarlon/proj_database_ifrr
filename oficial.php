<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Participante</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>DATABASE 1 - TADS</title>
</head>

<body>
    <div class="container">
        <div class="cadastro">
            <h2>Cadastrar Participante</h2>
            <form method="POST" action="">
                <label for="nome_part">Nome do participante:</label>
                <input required type="text" id="nome_part" name="nome_part" placeholder="Digite o nome do participante">
                <br><br>
                <label for="tel_part">Telefone do participante:</label>
                <input required type="tel" id="tel_part" name="tel_part"
                    placeholder="Digite o telefone do participante">
                <br><br>
                <label for="email_part">Email do participante:</label>
                <input required type="email" id="email_part" name="email_part"
                    placeholder="Digite o email do participante">
                <br><br>
                <input type="submit" value="Cadastrar">
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // verifica se todos os campos estão preenchidos
                if (empty($_POST["nome_part"]) || empty($_POST["email_part"])) {
                    echo "<div id='msg' style='background-color: red; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Por favor, preencha todos os campos.</div>";
                    echo "<script>setTimeout(function() { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                } else {
                    $nome_part = $_POST['nome_part'];
                    $tel_part = !empty($_POST['tel_part']) ? $_POST['tel_part'] : null;
                    $email_part = $_POST['email_part'];

                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "eventos_ifrr";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // verifica se o e-mail já existe no banco de dados
                    $sql = "SELECT * FROM Participante WHERE Email_part = '$email_part'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<div id='msg' style='background-color: red;color: white;margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>O e-mail inserido já existe no banco de dados.</div>";
                        echo "<script>setTimeout(function() { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                    } else {
                        // Monta a query de inserção
                        $query = "INSERT INTO Participante (Nome_part, Tel_part, Email_part) VALUES ('$nome_part', '$tel_part', '$email_part')";

                        if ($conn->query($query) === TRUE) {
                            header("Location: " . $_SERVER["PHP_SELF"]);
                            exit();
                        } else {
                            echo "<div id='msg' style='background-color: red; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Erro ao cadastrar participante: " . $conn->error . "</div>";
                            echo "<script>setTimeout(function() { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";
                        }
                        
                    }
                    $conn->close();
                }
            }
            ?>
        </div>

        <div class="consulta">
            <h1>Consulta Participante</h1>
            <form method="POST" action="">
                <label for="nome_part">Nome do participante:</label>
                <input required type="text" id="nome_part" name="nome_part" placeholder="Digite o nome do participante">
                <br><br>
                <label for="email_part">Email do participante:</label>
                <input  type="text" id="email_part" name="email_part" placeholder="Digite o email do participante">
                <br><br>
                <input type="submit" value="Consultar">
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Conexão com o banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "eventos_ifrr";

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
                    echo "<div id='msg' style='background-color: red; color: white; padding: 5px; margin-top: 10px;border-radius: 10px;padding: 5px;text-align: center;font-weight: bold;'>Erro ao cadastrar participante: " . $conn->error . "</div>";
                    echo "<script>setTimeout(function() { document.getElementById('msg').style.display = 'none'; }, 5000);</script>";;
                }

                $conn->close();
            }
            ?>
        </div>

    </div>
</body>

</html>