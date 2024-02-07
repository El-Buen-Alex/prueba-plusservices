<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>STORE CHECK | RESULTS</title>
        <link rel="stylesheet" href="assets/styles/styles.css" />
        <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .title-wrapper{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        a {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
    </head>

    <body>

        <div class="title-wrapper">
            <h1>Tabla de Datos</h1>
            <a href="index.php">Seguir ingresando</a>
        </div>
        <table >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCIÓN</th>
                    <th>NÚMERO DE ENCUESTADOS</th>
                    <th>PROMEDIO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo $row['codigo_encuesta']; ?></td>
                        <td><?php echo $row['nombre_encuesta']; ?></td>
                        <td><?php echo $row['responses_count']; ?></td>
                        <td><?php echo $row['avg_calification']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>