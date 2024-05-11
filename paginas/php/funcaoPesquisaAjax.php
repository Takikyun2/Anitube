<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "anitube";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search_term = $_POST["search"];
    $sql = "SELECT nomeanime, anoanime FROM animes where nomeanime LIKE '%$search_term%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = '<table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ano</th>
                            </tr>
                        </thead>
                        <tbody>';
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr><td>" . $row["nomeanime"] . "</td><td>" . $row["anoanime"] . "</td></tr>"; 

        }

        $output .= '<tbody></table>';
        echo $output;
    } else {
        echo "<p class='mt-4'>Nenhum resultado encontrado.</p>";
    }
}

$conn->close();