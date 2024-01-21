<?php $status = \Solital\Core\Kernel\Application::appStatus(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ load_img('favicon.ico') }}">
    <link rel="stylesheet" href="{{ load_css('style.css') }}">
    <title>Welcome to Solital Framework!</title>
</head>

<body>
    <div class="context">
        <header>
            <div class="sides" style="margin-left: 5px;">
                <img src="https://res.cloudinary.com/bdlsltfmk/image/upload/c_thumb,w_200,g_face/v1616757121/Solital_logo_2/solital-logo-profile_logwvv.png">
            </div>
            <div class="sides header-right solital-version">{{ Solital\Core\Kernel\Application::SOLITAL_VERSION }}</div>
        </header>

        <main>
            <h1>Solital Framework</h1>

            <section class="alert-config">
                {% if($status['status'] == true): %}
                <p><strong class="message-success">All right, you can now start creating your projects!</strong></p>
                {% else: %}
                <p><strong class="message-warning">There are alerts you need to see</strong></p>
                <p><a class="button" href="#popup">See alerts</a></p>
                {% endif; %}
            </section>

            <div class="ag-format-container">
                <div class="ag-courses_box">
                    <div class="ag-courses_item">
                        <a href="{{ Solital\Core\Kernel\Application::SITE_DOC_DOMAIN }}" target="_blank" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                Documentation
                            </div>

                            <div class="ag-courses-item_date-box">
                                Read the full documentation on the project website
                            </div>
                        </a>
                    </div>

                    <div class="ag-courses_item">
                        <a href="https://github.com/solital/solital" target="_blank" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                Github
                            </div>

                            <div class="ag-courses-item_date-box">
                                Check the project source code on Github and help us implement new features
                            </div>
                        </a>
                    </div>

                    <div class="ag-courses_item">
                        <a href="https://github.com/solital/solital/blob/master/CHANGELOG.md" target="_blank" class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                News
                            </div>

                            <div class="ag-courses-item_date-box">
                                See what new features are being implemented
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="popup" id="popup">
                <div class="popup-content">
                    <h2 class="heading-secondary">There are alerts you need to see</h2>
                    <ul>
                        {% foreach($status['message'] as $key => $message): %}
                        <li><span class="alert">{{ $key }}:</span> {{ $message }}</li>
                        {% endforeach; %}
                    </ul>
                    <a href="#" class="button">Close Popup</a>
                </div>
            </div>
        </main>

    </div>

    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>