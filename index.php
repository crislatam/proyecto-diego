<?php
// Create connection
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "diego";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Conexión fallida a DB de registro: " . $conn->connect_error);
}
// Cuento aforo
$sql0 = "SELECT COUNT(estado) 'cantidad'
FROM diego.restaurante
WHERE estado = 'Presente';";
$result = $conn->query($sql0);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $aforo = $row["cantidad"];
    }
}
?>

<html lang="es-CL">
    <meta charset="UTF-8">
    <title>Sitio WEB de Diego</title>
<head>
    <script>
    document.addEventListener("wheel", function(event){
        if(document.activeElement.type === "number"){
            document.activeElement.blur();
        }
    });
    function checkRut(rut) {
        var valor = rut.value.replace('.','');
        valor = valor.replace('-','');
        cuerpo = valor.slice(0,-1);
        dv = valor.slice(-1).toUpperCase();
        rut.value = cuerpo + '-'+ dv
        if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
        suma = 0;
        multiplo = 2;
        for(i=1;i<=cuerpo.length;i++) {
            index = multiplo  valor.charAt(cuerpo.length - i);
            suma = suma + index;
            if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
        }
        dvEsperado = 11 - (suma % 11);
        dv = (dv == 'K')?10:dv;
        dv = (dv == 0)?11:dv;
        if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
        rut.setCustomValidity('');
    }
    </script>
    <style>
    / Chrome, Safari, Edge, Opera /
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    / Firefox /
    input[type=number] {
      -moz-appearance: textfield;
    }

    *,
    *::before,
    *::after {
    box-sizing: border-box;
    }

    :root {
    --input-border: #8b8a8b;
    --input-focus-h: 245;
    --input-focus-s: 100%;
    --input-focus-l: 42%;
    }

    .input {
    font-size: 16px;
    // Capitalized to prevent Sass
    // thinking it's the Sass max()
    font-size: Max(16px, 1em);
    font-family: inherit;
    padding: 0.25em 0.5em;
    background-color: #fff;
    border: 2px solid var(--input-border);
    border-radius: 4px;
    transition: 180ms box-shadow ease-in-out;
    }

    .input:focus {
    border-color: hsl(
        var(--input-focus-h),
        var(--input-focus-s),
        var(--input-focus-l)
    );
    box-shadow: 0 0 0 3px
        hsla(
        var(--input-focus-h),
        var(--input-focus-s),
        calc(var(--input-focus-l) + 40%),
        0.8
        );
    outline: 3px solid transparent;
    }

    .input:not(textarea) {
    line-height: 1;
    height: 2.25rem;
    }

    input[type="file"] {
    font-size: 0.9em;
    padding-top: 0.35rem;
    }

    textarea.input {
    resize: vertical;
    }

    .input[readonly] {
    border-style: dotted;
    cursor: not-allowed;
    color: #777;
    }

    .input[disabled] {
    --input-border: #ccc;

    background-color: #eee;
    cursor: not-allowed;
    }

    label {
    font-size: 1.125rem;
    font-weight: 500;
    line-height: 1;
    }

    .input + label {
    margin-top: 2rem;
    }

    body {
    min-height: 100vh;
    display: grid;
    place-content: center;
    grid-gap: 0.5rem;
    font-family: "Baloo 2", sans-serif;
    background-color: #e9f2fd;
    padding: 1rem;
    }
    
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    }

    li {
    float: left;
    }

    li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    li a:hover {
    background-color: #111;
    }

    </style>
    </head>
    <body>
    <h1>Formulario de Ingreso de Clientes</h4><br>
        <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="clientes.php?DEL=0">Clientes</a></li>
        <li><a href="registro.php">Registro</a></li>
        </ul>
        <p>Aforo Actual: <?php echo "$aforo";?></p>
        <h3>Ingrese los datos del cliente</h3>
        <form enctype="multipart/form-data" id="formulario" method="post" action="">
        <p>        
            <label for="primerNombre">Primer Nombre:</label>
            <input name="primerNombre" id="primerNombre" value="" required="" type="text">
            <label for="segundoNombre">Segundo Nombre:</label>
            <input name="segundoNombre" id="segundoNombre" value="" required="" type="text">
        </p>
        <p>  
            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input name="apellidoPaterno" id="apellidoPaterno" value="" required="" type="text">
            <label for="apellidoMaterno">Apellido Materno:</label>
            <input name="apellidoMaterno" id="apellidoMaterno" value="" required="" type="text">
        </p>
        <p>  
            <label for="rut">RUT:</label>
            <input name="rut" id="rut" value="" required="" type="text" oninput="checkRut(this)" placeholder="Ingrese RUT 11222333-K">
        </p>
        <p>
            <label for="edad">Edad:</label>
            <input name="edad" id="edad" value="" required="" step="any" type="number">
        </p>
        <p>  
            <label for="celular">Celular:</label>
            <input name="celular" id="celular" value="" required="" step="any" type="number">
        </p>
        <p>
            <label for="direccion">Dirección:</label>
            <input name="direccion" id="direccion" value="" required="" type="text">
        </p>
        <p>  
            <label for="temperatura">Temperatura:</label>
            <input name="temperatura" id="temperatura" value="" required="" step="any" type="number">
        </p>
        <div class="input row">
            <center><input value="Enviar" type="submit" name="Enviar"></center>
        </div>
    </form>
</body>
</html>

<?php
if(isset($_POST['Enviar'])){
        $temperatura = $_REQUEST["temperatura"];
        $primerNombre = $_REQUEST["primerNombre"];
        $segundoNombre = $_REQUEST["segundoNombre"];
        $apellidoPaterno = $_REQUEST["apellidoPaterno"];
        $apellidoMaterno = $_REQUEST["apellidoMaterno"];
        $rut = $_REQUEST["rut"];
        $edad = $_REQUEST["edad"];
        $celular = $_REQUEST["celular"];
        $direccion = $_REQUEST["direccion"];
        
    // Obtiene Fecha y Hora de ingreso
    date_default_timezone_set('America/Santiago');
    $fechatiempoactual = date("Y-m-d H:i:s");

    // Valida estado por temperatura
    if ($temperatura >= 37) {
        $estado = "No Admitido";
        $salud = "Fiebre";
        echo "<h4>Cliente tiene Fiebre</h4>";
    } else {
        $estado = "Presente";
        $salud = "Sano";
    }

    //echo "$fechatiempoactual<br>";
    //echo "$temperatura <br>";
    //echo "$primerNombre <br>";
    //echo "$segundoNombre <br>";
    //echo "$apellidoPaterno <br>";
    //echo "$apellidoMaterno <br>";
    //echo "$rut <br>";
    //echo "$edad <br>";
    //echo "$celular <br>";
    //echo "$direccion <br>";
    //echo "$estado<br>";
    //echo "$salud<br>";

    // Create connection
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "diego";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Conexión fallida a DB de registro: " . $conn->connect_error);
    }
    // Cuento aforo
    $sql0 = "SELECT COUNT(estado) 'cantidad'
    FROM diego.restaurante
    WHERE estado = 'Presente';";
    $result = $conn->query($sql0);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $aforo = $row["cantidad"];
        }
    }
    // Validoa Aforo e Inserta
    if ($aforo >= 10){
        echo "<h4>ERROR, no es posible ingresar más clientes. ";
        echo "El Aforo actual es $aforo</h4>";
    }
    else {
        $sql1 = "INSERT INTO `diego`.`restaurante`
        (`rut`,
        `primerNombre`,
        `segundoNombre`,
        `apellidoPaterno`,
        `apellidoMaterno`,
        `edad`,
        `celular`,
        `direccion`,
        `estado`,
        `salud`,
        `temperatura`,
        `fechatiempoactual`)
        VALUES
        ('$rut',
        '$primerNombre',
        '$segundoNombre',
        '$apellidoPaterno',
        '$apellidoMaterno',
        '$edad',
        '$celular',
        '$direccion',
        '$estado',
        '$salud',
        '$temperatura',
        '$fechatiempoactual');";
        if ($conn->query($sql1)) {
            echo "<h4>Cliente registrado correctamente. ";
            $result = $conn->query($sql0);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $aforo = $row["cantidad"];
                }
            }
            echo "El Aforo actual es $aforo.</h4>";
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>