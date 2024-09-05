<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="<?= WEBROOT ?>/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="body">
    <div class="container-fluid col-12 nav-bar  d-flex justify-content-between rounded align-item-center">
        <div class="  col-2 nav-bar-child ">
            <img src="../assets/kay_dieude.png" alt="">
        </div>
        <button class=" border border-0 deconnect d-flex align-item-center p-2" type="button"><span
            class="material-symbols-outlined px-2 add"> keyboard_double_arrow_left </span><a class="text-decoration-none"
            href="<?= WEBROOT ?>/?controller=login&action=logout">Deconnexion</a></button>

    </div>
    <div class=" col-12 d-flex  justify-content-between">
 
        <div class=" border border-0 shadow mt-2 main-client bg-light ">
            <?= $contentForView ?>


        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="http://localhost:8050/js/demande.js"></script>

</body>

</html>