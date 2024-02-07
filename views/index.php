<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>STORE CHECK | HOME</title>
        <link rel="stylesheet" href="assets/styles/styles.css" />
        <style >
            button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
            .main-form{
                display: flex;
                justify-content: center;
                width: 100%;
                text-align: center;
            }
            button:hover {
                background-color: #0056b3;
            }
            #combo-box-wrapper,
            #question-box-wrapper {
                margin-bottom: 20px;
            }

            select {
                padding: 8px;
                border-radius: 5px;
                width: 100%;
            }

            p {
                font-weight: bold;
                margin-bottom: 5px;
            }

            input[type="radio"] {
                margin-right: 5px;
            }

            div.radio-button-group-wrapper {
                margin-top: 5px;
            }

            div.question-wrapper {
                margin-bottom: 10px;
            }
            .button-save-wrapper{
                width: 100%;
                display: flex;
                justify-content: center;
            }
            .save-button{
                width: 100%;
            }
        </style>
    </head>

    <body>
        <div id="main-form">
            <h1>Encuesta</h1>
            <div id="combo-box-wrapper">

            </div>
            <div id="question-box-wrapper">

            </div>
            <div class="button-save-wrapper">
                <button
                    class="save-button"
                    onclick="save()"
                >Guardar</button>
            </div>
        </div>

        <script src="assets/js/pollService.js"></script>
        <script src="assets/js/pollView.js"></script>
    </body>
</html>