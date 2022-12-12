<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Gracias por tu respuesta</title>
    <style>
        html {
            background-color: #9d69a3;

        }

        main {
            background-color: white;
            max-width: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .grid {
            display: grid;

            grid-template-rows: 1fr 1fr;
            grid-template-columns: none;

            justify-content: center;
        }

        .main--title {
            text-align: center;
        }

        @media only screen and (min-width: 720px) {
            .grid {
                grid-template-rows: none;
                grid-template-columns: 1fr 1fr;
            }

            main {
                background-color: white;
                max-width: 50%;
                margin: auto;

            }
        }
    </style>
</head>

<body>
    <main>
        <h2 class="main--title">Estos son los resultados, ve en donde te encuentras</h2>
        <div class="grid-container">
            <div class="grid">
                <div id="food_chart_div"></div>
                <div id="fruits_chart_div"></div>
            </div>
            <div class="grid">
                <div id="exercise_chart_div"></div>
                <div id="drinks_chart_div"></div>
            </div>
            <div class="grid">
                <div id="follow_up_chart_div"></div>
            </div>

        </div>



    </main>
    <?php
    //Clase para manejar el proceso de base de datos y la relacion con los datos de la encuesta
    class SurveyManager
    {
        // Definimos las repuestas de la encuesta por medio de variables junto con los datos de conexion mysql
        public $food;
        public $exercise;
        public $drink;
        public $followUp;
        public $fruit;
        private $servername = "localhost";
        private $username = "ipchile";
        private $password = "1234";
        private $dbname = "respuestas_encuesta";

        // Nos aceguramos de que al inicializar la nueva clase se entreguen inmediatamente los datos de la encuesta para guardarlos
        function __construct($food, $exercise, $drink, $followUp, $fruit)
        {
            $this->food = $food;
            $this->exercise = $exercise;
            $this->drink = $drink;
            $this->followUp = $followUp;
            $this->fruit = $fruit;
        }
        //Esta funcion obtiene los resultados de la tabla respuestas para que estos sean contados y luego enviados a google charts
        function getTableResults()
        {
            // Creamos la conexion con mysql
            $conn = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->dbname
            );
            // Identificamos la conexion y si hay un error la destruimos
            if ($conn->connect_error) {
                die("Conexion Fallida: " . $conn->connect_error);
            }
            // Query para obtener la cuenta de los elementos dependiendo de su resultado, 
            $sql = "SELECT  COUNT(if(food = 'Comida Chatarra',1,null))     AS fastFoodCount
            ,COUNT(if(food = 'Carnes y verduras',1,null))   AS vegetablesAndMeatCount
            ,COUNT(if(food = 'Legumbres',1,null))           AS legumesCount
            ,COUNT(if(fruit = 'ninguna',1,null))            AS noFruitsCount
            ,COUNT(if(fruit = '1 a 2',1,null))              AS oneOrMoreCount
            ,COUNT(if(fruit = 'Mas de 1',1,null))           AS moreThanOneFruitCount
            ,COUNT(if(exercise = '0 Horas',1,null))         AS dontDoExerciseCount
            ,COUNT(if(exercise = '1 Hora',1,null))          AS oneHourExerciseCount
            ,COUNT(if(exercise = '2 o mas horas',1,null))   AS moreThantwoExerciseCount
            ,COUNT(if(drinks = 'Menos de un litro',1,null)) AS lessThanOneDrinkCount
            ,COUNT(if(drinks = 'Mas de un litro',1,null))   AS moreThanOneDrinkCount
            ,COUNT(if(drinks = 'Mas de 2 litros',1,null))   AS moreThantwoDrinkCount
            ,COUNT(if(follow_up = 'si',1,null))             AS wantFollowUpCount
            ,COUNT(if(follow_up = 'no',1,null))             AS doesntwantFollowUpCount
            FROM respuestas;";

            // Guardamos el resultado en una variable
            $result = $conn->query($sql);
            // Guardamos las filas en otra variable para luego retornar
            $row = $result->fetch_assoc();
            $conn->close();
            return $row;
        }
        function uploadResponses()
        {
            // Creamos la conexion con la BD
            $conn = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->dbname
            );
            // Identificamos la conexion y si hay un error la destruimos
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Creamos dinamicamente nuestra query con las variables entregadas al nuevo objeto que sera creado
            $sql =
                "INSERT INTO respuestas (food, exercise, drinks,follow_up,fruit) VALUES ('" .
                $this->food .
                "','" .
                $this->exercise .
                "','" .
                $this->drink .
                "','" .
                $this->followUp .
                "', '" .
                $this->fruit .
                "')";

            // Ejecutamos la query y luego cerramos la conexion
            $conn->query($sql);

            $conn->close();
        }
    }
    // Entregamos los valores del formulario y creamos un nuevo objeto por medio de nuestra clase survey manager
    $localSurvey = new SurveyManager(
        $_POST["food"],
        $_POST["exercise"],
        $_POST["drink"],
        $_POST["followUp"],
        $_POST["fruits"]
    );
    // Ejecutamos la insersion de los elementos
    $localSurvey->uploadResponses();
    // Obtenemos de vuelta los elementos de la tabla para enviarlos al grafico
    $row = $localSurvey->getTableResults();
    // Obtenemos en una variable cada resultado de la cuenta de nuestra tabla
    $fastFoodCount = $row["fastFoodCount"];
    $vegetablesAndMeatCount = $row["vegetablesAndMeatCount"];
    $legumesCount = $row["legumesCount"];
    $noFruitsCount = $row["noFruitsCount"];
    $oneOrMoreCount = $row["oneOrMoreCount"];
    $moreThanOneFruitCount = $row["moreThanOneFruitCount"];
    $dontDoExerciseCount = $row["dontDoExerciseCount"];
    $oneHourExerciseCount = $row["oneHourExerciseCount"];
    $moreThantwoExerciseCount = $row["moreThantwoExerciseCount"];
    $lessThanOneDrinkCount = $row["lessThanOneDrinkCount"];
    $moreThanOneDrinkCount = $row["moreThanOneDrinkCount"];
    $moreThantwoDrinkCount = $row["moreThantwoDrinkCount"];
    $wantFollowUpCount = $row["wantFollowUpCount"];
    $doesntwantFollowUpCount = $row["doesntwantFollowUpCount"];

    ?>

    <script type="text/javascript">
        // Obtenemos las variables de php y las cambiamos a numero por medio de javascript
        // Comida
        const fastFoodCount = parseInt('<?= $fastFoodCount ?>')
        const vegetablesAndMeatCount = parseInt('<?= $vegetablesAndMeatCount ?>')
        const legumesCount = parseInt('<?= $legumesCount ?>')
        // Frutas
        const noFruitsCount = parseInt('<?= $noFruitsCount ?>')
        const oneOrMoreCount = parseInt('<?= $oneOrMoreCount ?>')
        const moreThanOneFruitCount = parseInt('<?= $moreThanOneFruitCount ?>')
        // Ejercicio
        const dontDoExerciseCount = parseInt('<?= $dontDoExerciseCount ?>')
        const oneHourExerciseCount = parseInt('<?= $oneHourExerciseCount ?>')
        const moreThantwoExerciseCount = parseInt('<?= $moreThantwoExerciseCount ?>')
        // Alcohol
        const lessThanOneDrinkCount = parseInt('<?= $lessThanOneDrinkCount ?>')
        const moreThanOneDrinkCount = parseInt('<?= $moreThanOneDrinkCount ?>')
        const moreThantwoDrinkCount = parseInt('<?= $moreThantwoDrinkCount ?>')
        // FollowUp
        const wantFollowUpCount = parseInt('<?= $wantFollowUpCount ?>')
        const doesntwantFollowUpCount = parseInt('<?= $doesntwantFollowUpCount ?>')

        // agrupacion de variables con los datos necesarios para cada grafico
        //  element sera el div donde ira el grafico, las opciones son de cada grafico, y table son los datos que se transformaran en un
        // formato adecuado para ser mostrados
        const foodResult = {
            element: document.getElementById('food_chart_div'),
            options: {
                title: 'Que comida prefiere',
                is3D: true,
            },
            table: [
                ['Encuesta', 'Resultado'],
                ['Prefiere comer comida chatarra', fastFoodCount],
                ['Prefiere vegetales y carne', vegetablesAndMeatCount],
                ['Prefiere un plato de legumbres', legumesCount],
            ]
        }
        const fruitsResult = {
            element: document.getElementById('fruits_chart_div'),
            options: {
                title: 'Cuantas frutas al dia come',
                is3D: true,
            },
            table: [
                ['Encuesta', 'Resultado'],
                ['No come frutas', noFruitsCount],
                ['Come entre 1 y 2 frutas', oneOrMoreCount],
                ['Come mas de 2 frutas', moreThanOneFruitCount],
            ]
        }
        const exerciseResult = {
            element: document.getElementById('exercise_chart_div'),
            options: {
                title: 'Cuanto ejercicio a la semana hace',
                is3D: true,
            },
            table: [
                ['Encuesta', 'Resultado'],
                ['No hace ejercicio', dontDoExerciseCount],
                ['Hace 1 hora a la semana', oneHourExerciseCount],
                ['Hace mas de 2 horas a la semana', moreThantwoExerciseCount],
            ]
        }
        const drinksResult = {
            element: document.getElementById('drinks_chart_div'),
            options: {
                title: '¿Cuantos litros de alcohol toma a la semana?',
                is3D: true,
            },
            table: [
                ['Encuesta', 'Resultado'],
                ['0 o menos de 1 litro', lessThanOneDrinkCount],
                ['mas de 1 litro a la semana', moreThanOneDrinkCount],
                ['mas de 2 litros a la semana', moreThantwoDrinkCount],
            ]
        }
        const followUpResult = {
            element: document.getElementById('follow_up_chart_div'),
            options: {
                title: '¿Cuantos litros de alcohol toma a la semana?',
                is3D: true,
            },
            table: [
                ["Follow Up", "Quiere cambiar su vida", {
                    role: "style"
                }],
                ["SI, quiero que mi vida sea aun mejor", wantFollowUpCount, "green"],
                ["No quiero vivir lo mas saludable posible", doesntwantFollowUpCount, "red"],
            ]
        }

        // Cargamos el packete de google para visualizar los graficos
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });

        //Es un callback para correr la api de visualizacion cuando se carga l pagina
        google.charts.setOnLoadCallback(drawCharts);



        function drawCharts() {

            // Cambiamos al formato correcto de google y luego dibujamos el chart
            var foodData = google.visualization.arrayToDataTable(foodResult.table)
            var foodChart = new google.visualization.PieChart(foodResult.element);
            foodChart.draw(foodData, foodResult.options);

            var fruitsData = google.visualization.arrayToDataTable(fruitsResult.table)
            var fruitsChart = new google.visualization.PieChart(fruitsResult.element);
            fruitsChart.draw(fruitsData, fruitsResult.options);

            var exerciseData = google.visualization.arrayToDataTable(exerciseResult.table)
            var exerciseChart = new google.visualization.PieChart(exerciseResult.element);
            exerciseChart.draw(exerciseData, exerciseResult.options);

            var drinkData = google.visualization.arrayToDataTable(drinksResult.table)
            var drinkChart = new google.visualization.PieChart(drinksResult.element);
            drinkChart.draw(drinkData, drinksResult.options);

            // Aqui es lo mismo que lo anterior solo que con un grafico de barras
            var view = new google.visualization.DataView(google.visualization.arrayToDataTable(followUpResult.table));
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Quienes quieren cambiar su vida con nosotros",
                width: 400,
                height: 200,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(followUpResult.element);
            chart.draw(view, options);
        }
    </script>
</body>

</html>