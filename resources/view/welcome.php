<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="shortcut icon" href="<?= self::loadImg("favicon.ico"); ?>" type="image/x-icon">

    <title>Welcome to Solital</title>

    <style>
        html,
        body {
            padding: 0px;
            margin: 0 auto;
            font-family: 'Montserrat', sans-serif;
        }

        h2 {
            font-weight: 500;
        }

        .main-text {
            font-size: 60px;
            font-weight: 500;
        }

        .container {
            text-align: center;
        }

        .link {
            color: #1C1C1C;
            text-decoration: none;
            margin-right: 25px;
            transition: 0.2s;
        }

        .link:hover {
            transition: 0.2s;
            color: #1E90FF;
        }

        .info-2 {
            font-size: 25px;
            margin-top: 80px;
        }

        .info {
            background-color: #DCDCDC;
            padding: 20px;
            margin-bottom: 30px;
            font-size: 18px;
        }

        .info-2>.version {
            font-size: 20px;
            margin-top: 50px;
        }

        .info a {
            color: #1C1C1C;
            text-decoration: none;
        }

        small {
            font-size: 15px;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="info">
            <a href="https://solital.github.io/docs-v1/" target="_blank" class="link">Documentation</a>
            <a href="https://github.com/solital/solital" target="_blank" class="link">Github</a>
            <a href="https://github.com/solital/solital/blob/master/CHANGELOG.md" target="_blank" class="link">News</a>
        </div>

        <img src="https://res.cloudinary.com/bdlsltfmk/image/upload/v1593342725/Solital_logo/solital-logo_iyoo2u.png" align="center" width="600">

        <div class="info-2">
            <p><strong>All right!!! You can now start creating your projects</strong></p>
            <p class="version">Solital version: <?= Solital\Core\Console\Console::SOLITAL_VERSION; ?></p>

            <small>PHP version: <?php echo PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION; ?></small>
        </div>
    </section>
</body>

</html>