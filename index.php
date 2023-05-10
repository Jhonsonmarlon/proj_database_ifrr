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
                    <input type="text" id="nome_part" name="nome_part" placeholder="Digite o nome do participante">
                    <br><br>
                    <label for="tel_part">Telefone do participante:</label>
                    <input type="tel" id="tel_part" name="tel_part" placeholder="Digite o telefone do participante">
                    <br><br>
                    <label for="email_part">Email do participante:</label>
                    <input type="email" id="email_part" name="email_part" placeholder="Digite o email do participante">
                    <br><br>
                    <input type="submit" value="Cadastrar">
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if(isset($_POST['nome_part'])) {
                        $nome_part = $_POST['nome_part'];
                        }
                    if(isset($_POST['tel_part'])) {
                        $tel_part = $_POST['tel_part'];
                        }
                    if(isset($_POST['email_part'])) {
                        $email_part = $_POST['email_part'];
                        }

                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "eventos-ifrr";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Monta a query de inserção
                    $query = "INSERT INTO Participante (Nome_part, Tel_part, Email_part) VALUES ('$nome_part', '$tel_part', '$email_part')";

                    if ($conn->query($query) === TRUE) {
                        echo "<div style='background-color: green; color: white; padding: 5px;'>Participante cadastrado com sucesso.</div>";
                    } else {
                        echo "<div style='background-color: red; color: white; padding: 5px;'>Erro ao cadastrar participante: " . $conn->error . "</div>";
                    }
                    // verifica se o formulário foi submetido
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // verifica se todos os campos estão preenchidos
                        if (empty($_POST["Nome_part"]) || empty($_POST["Email_part"])) {
                            echo "Por favor, preencha todos os campos.";
                        } else {
                            // verifica se o e-mail já existe no banco de dados
                            $email = $_POST["Email_part"];
                            $sql = "SELECT * FROM Participante WHERE Email_part = '$email'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo "O e-mail inserido já existe no banco de dados.";
                            } else {
                                // todos os campos estão preenchidos e o e-mail é único, então insere os dados no banco de dados
                                $nome = $_POST["Nome_part"];
                                $tel = !empty($_POST["Tel_part"]) ? $_POST["Tel_part"] : "sem tel";
                                $sql = "INSERT INTO Participante (Nome_part, Tel_part, Email_part) VALUES ('$nome', '$tel', '$email')";
                                if ($conn->query($sql) === TRUE) {
                                    echo "Dados inseridos com sucesso.";
                                } else {
                                    echo "Erro ao inserir dados: " . $conn->error;
                                }
                            }
                        }
                    }
                    $conn->close();
                }
                ?>
            </div>

            <div class="consulta">
                <h1>Consulta Participante</h1>
                <form method="POST" action="">
                    <label for="id_part">ID do participante:</label>
                    <input type="number" name="id_part" placeholder="Digite o id do participante">
                    <br><br>
                    <label for="Nome_part">Nome do participante:</label>
                    <input type="text" id="Nome_part" name="Nome_part" placeholder="Digite o nome do participante">
                    <br><br>
                    <input type="submit" value="Consultar">
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if(isset($_POST['id_part'])) {
                        $nome_part = $_POST['id_part'];
                        }
                    if(isset($_POST['nome_part'])) {
                        $nome_part = $_POST['nome_part'];
                        }

                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "eventos-ifrr";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Monta a query de consulta
                    $query = "SELECT * FROM Participante WHERE 1=1";
                    if (!empty($id_part)) {
                        $query .= " AND Id_part = '$id_part'";
                    }
                    if (!empty($nome_part)) {
                        $query .= " AND Nome_part LIKE '%$nome_part%'";
                    }

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th></tr>";

                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Id_part"] . "</td>";
                            echo "<td>" . $row["Nome_part"] . "</td>";
                            echo "<td>" . $row["Tel_part"] . "</td>";
                            echo "<td>" . $row["Email_part"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<div style='background-color: red; color: white; padding: 5px;'>Não existe registro.</div>";
                    }

                    $conn->close();
                }
                ?>
            </div>
    </div>
</body>
</html>
