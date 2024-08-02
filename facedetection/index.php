<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detecção Facial</title>
    <style>
        body {
            background-color: rgb(92, 92, 92);
            width: 100vw;
            height: 100vh;
            
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .container{
            width: 720px;
            height: 560px;
            position: relative;
        }
        #video{
            width: 100%;
            height: 100%;
        }
        canvas{
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
        }

        #picturebutton{
            width: 40px;
            height: 40px;
            background-color: white;
            border: 5px solid rgba(0, 0, 0, 0);
            border-radius: 50px;
            outline: white solid 1px;
            position: absolute;
            top: 480px;
            left: 340px;
            z-index: 8;
        }

        #picturebutton:hover{
            cursor: pointer;
        }

        #msgDisplay{
            color: white;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 9;
        }

    </style>
</head>
<body>
    <div class="container">
    <video id="video" muted></video>
    </div>
    <script src="./face-api.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="./main.js"></script>
</body>
</html>