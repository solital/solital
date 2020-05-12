<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="icon" href="<?php self::loadImg('favicon.ico'); ?>"/>
    <title>Vinci: Development Mode</title>
    <style>
    html,
    body {
        margin: 0 auto;
        padding: 0 auto;
        font-family: 'Montserrat', sans-serif;
    }
    
    section {
        text-align: center;
        margin-left: 100px;
        margin-right: 100px;
    }

    input {
        margin: 10px;
        padding: 10px;
        border: 1px solid grey;
        border-radius: 15px;
        outline: none;
    }

    button {
        margin-bottom: 25px;
        background-color: #1E90FF;
        border: none;
        padding: 10px;
        border-radius: 5px;
        color: #FFF;
        cursor: pointer;
        transition: 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    button:hover {
        transition: 0.2s;
        background-color: #104E8B;
    }

    small {
        margin-bottom: 20px;
    }

    .btn-info {
        font-weight: bold;
        border: none;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none; 
        color: #104E8B;
    }

    .label {
        margin-top: 20px;
        font-size: 20px;
    }
    
    .content {
        margin-top: 30px; 
        float: left; 
        width: 50%;
    }
    </style>
</head>

<body>