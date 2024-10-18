<?php
session_start();
// Definición de constantes o parámetros de funcionamiento del juego
define('MAX_INTENTOS', 5);
define('LIM_INF', 1);
define('LIM_SUP', 20);
define('ERROR_APUESTA', 'Introduce una apuesta');

if (filter_has_var(INPUT_POST, 'envio_apuesta')) {
    $numOculto = $_SESSION['num_oculto'];
    $numIntentos = $_SESSION['num_intentos'];
    $apuesta = filter_input(INPUT_POST, 'apuesta', FILTER_VALIDATE_INT);
    $numeros = $_SESSION['numeros'];
    $apuestaErr = empty($apuesta);
    if (!$apuestaErr) {
        $numeros[] = $apuesta;
        $numIntentos++;
        $_SESSION['num_intentos'] = $numIntentos;
        $_SESSION['numeros'] = $numeros;
        $fin = $numIntentos >= MAX_INTENTOS || $apuesta === $numOculto; // Establezco si se ha acabado la partida o no
        $_SESSION['fin'] = $fin;
    }
} elseif (filter_has_var(INPUT_POST, 'numeros_jugados')) {
    $petNumerosJugados = true;
    $numOculto = $_SESSION['num_oculto'];
    $numIntentos = $_SESSION['num_intentos'];
    $numeros = $_SESSION['numeros'];
    $fin = $_SESSION['fin'];
} else { // Si se arranca el juego o se solicita una nueva partida
    $_SESSION['num_intentos'] = $numIntentos = 0;
    $_SESSION['num_oculto'] = $numOculto = mt_rand(LIM_INF, LIM_SUP); // Genero un valor aleatorio
    $_SESSION['numeros'] = $numeros = []; // Array de números jugados
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Adivina número</title>
        <meta name="viewport" content="width=device-width">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <div class="page">
            <h1>¡Adivina el número oculto!</h1>
            <div class="capaform">
                <form class="form" name="form_apuestanumero" 
                      action="index.php" method="POST">
                    <div class="input-seccion">
                        <label for="apuesta"><?= 'Enter a numero (' . LIM_INF . '-' . LIM_SUP . '):' ?></label> 
                        <input id="apuesta" type="number" name="apuesta" min="<?= LIM_INF ?>" 
                               max="<?= LIM_SUP ?>" value="<?= ($apuesta) ?? ''; ?>" <?= !empty($fin) ? 'readonly' : '' ?> />
                        <span class="error <?= (isset($apuestaErr) && $apuestaErr) ? 'error-visible' : '' ?>">
                            <?= constant("ERROR_APUESTA") ?>
                        </span>
                    </div>
                    <?php if (isset($fin) && $fin): ?> <!-- Si no se ha acabado la partida incluyo la pista para el jugador -->
                        <div class="submit-seccion">
                            <!-- Si se ha acabado el juego añado un botón para iniciar una nueva partida y un mensaje de fin de juego -->
                            <input class="submit" type="submit" 
                                   value="Nuevo Juego" name="nuevo_juego" /> 
                        </div>
                        <?php if (!isset($petNumerosJugados)): ?>
                            <p class="info-seccion"><?=
                                ($apuesta === $numOculto) ?
                                        "Enhorabuena!!! El número era el $numOculto. Lo has acertado en $numIntentos " . (($numIntentos !== 1) ?
                                                "intentos" : "intento") : "Lo sentimos!!. El número era $numOculto"
                                ?></p> 
                        <?php endif ?>
                    <?php else: ?>
                        <div class="submit-seccion">
                            <!-- Si es el inicio del juego o no se ha acabado el juego añado un botón para enviar apuesta -->
                            <input class="submit" type="submit" 
                                   value="Realiza una apuesta" name="envio_apuesta" /> 
                        </div>
                        <?php if (isset($fin) && !$fin): ?>
                            <div class="info-seccion">
                                <!-- Si no se ha acabado el juego añado una pista para el usuario -->
                                <p>Intentos restantes: <?= MAX_INTENTOS - $numIntentos ?></p>
                                <p><?= ($apuesta <=> $numOculto) > 0 ? 'Inténtalo con un número mas bajo' : 'Inténtalo con un número mas alto' ?></p>
                            </div>
                        <?php endif ?>
                    <?php endif ?> 
                    <?php if (isset($petNumerosJugados)): ?>
                        <p class="info-seccion">
                            <?= ($numeros) ? "Ya has jugado con los siguientes números: " . implode(",", $numeros) : "No hay números todavía" ?></p>
                    <?php endif ?>
                    <div class="submit-seccion">
                        <!-- Si es el inicio del juego o no se ha acabado el juego añado un botón para enviar apuesta -->
                        <input class="submit" type="submit" 
                               value="Numeros Jugados" name="numeros_jugados" /> 
                    </div>
                </form> 
            </div>
        </div>  
    </body>
</html>
