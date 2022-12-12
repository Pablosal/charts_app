<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./index.css">
  <title>Encuesta Nueva Vida</title>
</head>


<body>
  <nav></nav>
  <main class="main-container">
    <div class="main-container--header">
      <h1>Encuesta tu nueva vida saludable</h1>
      <p>Gracias por tomar esta encuesta que servira para cambiar tu vida a una mas saludable.</p>
      <p>Te lo agradece Planes Nutricionales Balboa</p>
    </div>

    <!-- Generamos nuestro post a la pagina de respuestas-encuesta.php -->
    <form class="main-form" method="POST" action="respuestas-encuesta.php">
      <div class="form-group">
        <label class="top-label" for="food">¿Cual de estas comidas prefieres?</label>
        <div class="form-group-body">
          <div class="form-input selected-poll ">
            <input class="poll--option" checked type="radio" id="comidaChatarra" name="food" value="Comida Chatarra" />
            <label class="inner--value" for="comidaChatarra">Comida Chatarra</label><br />
          </div>
          <div class="form-input">

            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="carnesVerduras" name="food" value="Carnes y verduras" />
            <label class="inner--value" for="carnesVerduras">Carnes y verduras</label><br />
          </div>
          <div class="form-input">

            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="legumbres" name="food" value="Legumbres" />
            <label class="inner--value" for="legumbres">Legumbres</label>
          </div>

        </div>
      </div>
      <div class="form-group">

        <label class="top-label " for="fruits">¿Cuantas frutas comes al dia?</label>
        <div class="form-group-body">
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="ningunaFruta" name="fruits" value="ninguna" />
            <label class="inner--value" for="ningunaFruta">0 frutas</label>
          </div>
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="unaFruta" name="fruits" value="1 a 2" checked />
            <label class="inner--value" for="unaFruta">1 a 2 frutas</label><br />
          </div>
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="masDeUnaFruta" name="fruits" value="Mas de 1" />
            <label class="inner--value" for="masDeUnaFruta"> > 2 frutas</label><br />
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="top-label" for="exercise">¿Cuantas horas a la semana haces ejercicio ?</label>
        <div class="form-group-body">
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="noHago" name="exercise" value="0 Horas" checked />
            <label class="inner--value" for="noHago">No Hago Ejercicio</label><br />
          </div>
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="unaHora" name="exercise" value="1 Hora" />
            <label class="inner--value" for="unaHora">1 Hora</label><br />
          </div>
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="Mas de 2 Horas" name="exercise" value="2 o mas horas" />
            <label class="inner--value" for="Mas de 2 Horas">2 o mas horas</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="top-label" for="drink">¿Que tanto alcohol tomas a la semana?</label>
        <div class="form-group-body">
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="una Cerveza" name="drink" value="una Cerveza" checked />
            <label class="inner--value" for="una Cerveza">
              < 1 litro</label><br />
          </div>
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="mas de un litro" name="drink" value="mas de un litro" />
            <label class="inner--value" for="mas de un litro"> > 1 litro</label><br />
          </div>
          <div class="form-input">
            <input class="poll--option" type="radio" onclick="changeOnChecked(this)" id="Mas de 2 Litros" name="drink" value="Mas de 2 Litros" />
            <label class="inner--value" for="Mas de 2 Litros"> > 2 Litros</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="top-label" for="followUp">¿Estarias dispuesto a cambiar a una vida mas saludable con la ayuda de profesionales?</label>
        <div class="form-group-body">
          <select name="followUp" id="followUp">
            <option value="si" selected>SI</option>
            <option value="no">No</option>
          </select>
        </div>
      </div>

      <input type="submit" value="Responder Encuesta" class="myButton" />
    </form>
  </main>
  <script>
    // Obtiene los elementos de opciones 
    const optionElements = document.getElementsByClassName("poll--option")
    // Esta funcion se encarga de agregar el estilo de selected poll a los divs padres de los options
    // Ademas de removerlo en aquellos elementos que no esten checkeados
    function changeOnChecked(e) {
      // Se debe convertir en array ya que se obtiene una coleccion de html con la funcion anterior
      for (let i = 0; i < Array.from(optionElements).length; i++) {
        // Obtenemos el elemento actual por donde pasa el siclo
        const element = optionElements[i];
        // verificamos de que no este checked el elemento, y en caso verdadero removemos la clase selected poll
        if (!element.checked) element.parentElement.classList.remove("selected-poll")
      }
      // Como ya todos los elementos anteriores estan verificados, añadimos al elemento actual que se esta cambiando la clase para darle los estilos
      e.parentElement.classList.add("selected-poll")
    }
    // Esta funcion se ejecutara al inicio de la pagina y es para darle la clase a las opciones que estan por defectos añadiendo la clase con los estilos de seleccion
    (function() {
      for (let i = 0; i < Array.from(optionElements).length; i++) {
        const element = optionElements[i];
        if (element.checked) element.parentElement.classList.add("selected-poll")
      }
    })()
  </script>
</body>

</html>