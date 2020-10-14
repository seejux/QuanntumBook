<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Quantum Admin</title>
        <link rel="stylesheet" href="/css/style.css" />
        <link rel="icon" type="image/png" href="/img/profile.png">

        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.nice-select.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.11.0/beautify-html.min.js"></script>

        <script src="/js/main.js"></script>
        <script src="/js/mediaPicker.js"></script>
        <script src="/js/fileSaver.js"></script>
        <script src="/js/inputToXML.js"></script>
        <script src="/js/xmlToInput.js"></script>
        <script src="/js/blockManager.js"></script>

        <link rel="stylesheet" href="/css/nice-select.css">
        <link rel="stylesheet" href="/css/bigfoot-default.css">
        <link rel="stylesheet" href="/fontawesome/css/all.min.css">

        <script type="text/javascript" src="/js/bigfoot.js"></script>
        <script>
                let bigfoot = $.bigfoot();
        </script>

        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap" rel="stylesheet">


        <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
        @yield('body')
</body>
</html>
