<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .text {
                font-size: 30px;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    You have been phished :)
                </div>
                <div class="text m-b-md">
                    Please, do <strong>NOT</strong> inform your colleagues. This exercises are useful to measure our company awareness.<br>
                    We do <strong>NOT</strong> store any credentials or sensitive information about you or your accounts.<br>
                    We will <strong>NOT</strong> share or publish anything that could identify you individually in later reports or presentations.<br><br>
                    If you need to know more details, please, contact {{ env('CONTACT') }}.
                </div>
            </div>
        </div>
    </body>
</html>