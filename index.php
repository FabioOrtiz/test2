<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GEMA SAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
    <div class="columns is-centered">
        <div class="box is-centered">
            <article class="message">
                <div class="message-header">
                    <p>GEMA SAS</p>
                </div>
            </article>
            <div class="columns is-centered">
                <label class="label">
                        Formulario de carga de información
                </label>
            </div>

            <form enctype="multipart/form-data" action = "visualization.php" method="POST">
                <div class="columns">
                    <div class="column">
                        <div class="file is-primary">
                            <label class="file-label">
                                <input class="file-input" type="file" name='data'>
                                <span class="file-cta">
                                    <span class="file-label">
                                        Examinar…
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="column">
                        <input type='hidden' name='formulario'>
                        <br>
                        <button class="button is-link">Enviar Formulario</button>
                    </div>
            </form>


            
        </div>
    </div>
</body>