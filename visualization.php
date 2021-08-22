<?php
require('dbconnect.php');
?>

<?php
if(isset($_POST['formulario'])){
    $doc = $_FILES['data'];
    $name = $_FILES['data']['name'];
    $tmp_name = $_FILES['data']['tmp_name'];
    $error = $_FILES['data']['error'];
    
    $route = 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/'.$name;
    move_uploaded_file($tmp_name, $route);

    $sql = "TRUNCATE TABLE datos;";
    $conn->query($sql);

    function uploadData($conn) {
        $name = $_FILES['data']['name'];    
        $sql = "LOAD DATA INFILE 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/$name' INTO TABLE datos FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n';";
        $conn->query($sql);
    }

    function check($conn) {
        $result = $conn->query("SELECT COUNT(*) FROM datos WHERE state NOT IN (1,2,3);");
        $row = $result->fetch(PDO::FETCH_NUM);

        if ($row[0] > 0){
            echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Error de formato de archivo');
                    window.location.href='/index.php';
                    </script>");
        }
    }

    uploadData($conn);
    check($conn);

}

?>


<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizacion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>

    <div class="columns is-centered">
        <div class="box is-centered">
            
            <a href="/index.php">Volver</a>
            
            <br>

            <h5 class="title is-5">Usuarios Activos</h5>    
        
            <table class="table  is-bordered">
                <thead>
                    <tr>
                        <td>Email</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Revisor</td>
                    </tr>
                </thead>
                <tfoot>
                <?php
                    $result = $conn->query("SELECT * FROM datos LEFT JOIN revisores ON datos.revisor + 8 = revisores.id WHERE state=1;");
                    
                    while ($row = $result->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>".
                            "<td>" . $row[0] . "</td>" .
                            "<td>" . $row[1] . "</td>" .
                            "<td>" . $row[2] . "</td>" .
                            "<td>" . $row[7] . "</td>" .
                            "</tr>";
                    }
                ?>
                </tfoot>
            </table>

            <h5 class="title is-5">Usuarios Inactivos</h5>
        
            <table class="table  is-bordered">
                <thead>
                    <tr>
                        <td>Email</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Revisor</td>
                    </tr>
                </thead>
                <tfoot>
                <?php
                    $result = $conn->query("SELECT * FROM datos LEFT JOIN revisores ON datos.revisor + 8 = revisores.id WHERE state=2;");
                    
                    while ($row = $result->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>".
                            "<td>" . $row[0] . "</td>" .
                            "<td>" . $row[1] . "</td>" .
                            "<td>" . $row[2] . "</td>" .
                            "<td>" . $row[7] . "</td>" .
                            "</tr>";
                    }
                ?>
                </tfoot>
            </table>

            <h5 class="title is-5">Usuarios en Espera</h5>    
        
            <table class="table  is-bordered">
                <thead>
                    <tr>
                        <td>Email</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Revisor</td>
                    </tr>
                </thead>
                <tfoot>
                <?php
                    $result = $conn->query("SELECT * FROM datos LEFT JOIN revisores ON datos.revisor + 8 = revisores.id WHERE state=3;");
                    
                    while ($row = $result->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>".
                            "<td>" . $row[0] . "</td>" .
                            "<td>" . $row[1] . "</td>" .
                            "<td>" . $row[2] . "</td>" .
                            "<td>" . $row[7] . "</td>" .
                            "</tr>";
                    }
                ?>
                </tfoot>
            </table>
        </div>
    </div>
</body>