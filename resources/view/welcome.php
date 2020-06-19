<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <title>Welcome to Solital</title>

    <style>
        body {
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
            margin-top: 100px;
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
            margin-top: 100px;
        }

        .info {
            background-color: #DCDCDC;
            padding: 20px;
            margin-top: 30px;
            font-size: 18px;
        }

        .info-2 > .version {
            font-size: 20px;
            margin-top: 100px;
        }

        .info a {
            color: #1C1C1C;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <section class="container">
        <h1 class="main-text">Welcome to Solital</h1>

        <div class="info">
            <a href="#" target="_blank" class="link">Documentation</a>
            <a href="/vinci-mode" target="_blank" class="link">Vinci Mode</a>
            <a href="https://github.com/solital/solital" target="_blank" class="link">Github</a>
            <a href="#" target="_blank" class="link">Blog</a>
        </div>

        <div class="info-2">
            <p>All right!!! You can now start creating your projects</p>
            <p class="version">Version: <?= Solital\Vinci\Vinci::SOLITAL_VERSION; ?></p>
        </div>
    </section>
</body>

</html>