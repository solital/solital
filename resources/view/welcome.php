<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="icon" href="<?= loadImg("favicon.ico") ?>" />
    <link rel="stylesheet" href="<?= loadMinCss() ?>">
    <title>Welcome to Solital Framework!</title>
</head>

<body>
    <section class="container">
        <div class="info">
            <a href="https://solital.github.io/docs-v2/" target="_blank" class="link">Documentation</a>
            <a href="https://github.com/solital/solital" target="_blank" class="link">Github</a>
            <a href="https://github.com/solital/solital/blob/master/CHANGELOG.md" target="_blank" class="link">News</a>
        </div>

        <img src="https://res.cloudinary.com/bdlsltfmk/image/upload/v1615812227/Solital_logo_2/solital-logo-md-trans_xotcpr.png" align="center" width="650">

        <div class="info-2">
            <p><strong>All right, you can now start creating your projects!</strong></p>
            <p class="version"><?= Solital\Core\Console\Version::SOLITAL_VERSION; ?></p>
        </div>
    </section>
</body>

</html>