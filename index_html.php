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
                        <label for="apuesta">Introduce un número:</label> 
                        <input id="apuesta" type="number" name="apuesta">
                        
                    </div>
                    <!-- Si se ha acabado la partida $fin está definido y es verdadero -->
                        <div class="submit-seccion">
                            <!-- Añado un botón para iniciar una nueva partida y un mensaje de fin de juego -->
                            <input class="submit" type="submit" value="Nuevo Juego" name="nuevo_juego" > 
                        </div>
                        <!-- Si no se solicita los números jugados muestro un mensaje de fin de juego -->
                            <p class="info-seccion"></p>
                        
                        <!-- Si no se ha acabado la partida $fin está definido y es falso o no está definido --> 
                        <div class="submit-seccion">
                            <!-- Añado un botón para enviar apuesta -->
                            <input class="submit" type="submit" value="Realiza una apuesta" name="envio_apuesta"> 
                        </div>
                        <div class="info-seccion">
                            <!-- Muestro los intentos restantes -->
                            <p>Intentos restantes: </p>
                             <!-- Si apuesta no está vacío y no se solicitan los números jugados muestro una pista -->  
                                    
                                <p></p>
                            
                        </div>
                   
                   <!-- Si es una solicitud de números jugados se muestran los números -->
                        <p class="info-seccion">
                           
                        </p>
                    
                    <div class="submit-seccion">
                        <!-- Si es el inicio del juego o no se ha acabado el juego añado un botón para enviar apuesta -->
                        <input class="submit" type="submit" value="Numeros Jugados" name="numeros_jugados"> 
                    </div>
                </form> 
            </div>
        </div>  
    </body>
</html>
