<?php

$status = \Solital\Core\Kernel\Application::appStatus();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="{{ load_img('favicon.ico') }}">
    <link rel="stylesheet/less" type="text/css" href="{{ load_css('style.less') }}" />
    <title>Welcome to Solital Framework!</title>
</head>

<body>
    <section class="container">
        <section class="info">
            {% if($status['status'] == true): %}
                <p><strong class="message success">All right, you can now start creating your projects!</strong></p>
            {% else: %}
                <p><strong class="message warning">You have settings to do!</strong>
                    <button class="btn" onclick="openModal('dv-modal')">View error</button>
                </p>
            {% endif; %}
        </section>

        <section class="welcome">
            <img src="https://res.cloudinary.com/bdlsltfmk/image/upload/v1615812227/Solital_logo_2/solital-logo-md-trans_xotcpr.png" align="center">

            <div class="info-2">
                <p class="version">{{ Solital\Core\Kernel\Application::SOLITAL_VERSION }}</p>
            </div>
        </section>

        <div class="flex">
            <div class="flex-div">
                <span class="material-icons">description</span>
                <p><a href="http://solitalframework.com/" target="_blank" class="link">Documentation</a></p>
            </div>

            <div class="flex-div">
                <span class="material-icons">code</span>
                <p><a href="https://github.com/solital/solital" target="_blank" class="link">Github</a></p>
            </div>

            <div class="flex-div">
                <span class="material-icons">newspaper</span>
                <p><a href="https://github.com/solital/solital/blob/master/CHANGELOG.md" target="_blank" class="link">News</a></p>
            </div>
        </div>

    </section>

    <div id="dv-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1>You have settings to do!</h1>
            </div>

            <div class="modal-body">
                <ul>
                    {% foreach($status['message'] as $message): %}
                        <li>{{ $message }}</li>
                    {% endforeach; %}
                </ul>
            </div>

            <div class="modal-footer">
                <button class="btn" onclick="closeModal('dv-modal')">Fechar</button>
            </div>
        </div>
    </div>

    <script src="{{ load_js('script.js') }}"></script>
</body>

</html>