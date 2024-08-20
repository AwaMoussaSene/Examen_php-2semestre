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
    <div class="container-fluid col-12 nav-bar  d-flex justify-content-between rounded">
        <div class="  col-2 nav-bar-child ">
            <img src="../assets/kay_dieude.png" alt="">
        </div>
        <div class=" p-3 col-3 nav-bar-child1 ">
            <div class="cercle">
            </div>
        </div>

    </div>
        <div class=" col-12 d-flex  justify-content-between">
            <div class=" col-2  shadow site-bar border-top rounded">
                <ul class="list-group mt-5 ">
                    <li class="list-group-item liste bg-transparent border-0">
                        <a href="<?= WEBROOT ?>/?controller=dashboard&action=dashboard" class="list-group-item   liste d-flex align-item-center border border-0 "> <span
                                class="material-symbols-outlined px-2"> dashboard </span>Dashboard</a>
                    </li>
                    <li class="list-group-item liste1 bg-transparent border-0">
                        <a href="<?= WEBROOT ?>/?controller=dette&action=liste"
                            class="list-group-item  d-flex align-item-center border border-0 text-light"><span
                                class="material-symbols-outlined px-2"> checkbook </span>Liste dettes</a>
                    </li>
                    <li class="list-group-item liste1 bg-transparent border-0">
                        <a href="<?= WEBROOT ?>/?controller=dette"
                            class="list-group-item  d-flex align-item-center border border-0 text-light"><span
                                class="material-symbols-outlined px-2"> checkbook </span>Liste clients</a>
                    </li>
                    <li class="list-group-item liste1 bg-transparent border-0">
                        <a href="<?= WEBROOT ?>/?controller=dette"
                            class="list-group-item  d-flex align-item-center border border-0 text-light"><span
                                class="material-symbols-outlined px-2"> checkbook </span>Liste articles</a>
                    </li>
                    <li class="list-group-item liste1 bg-transparent border-0">
                        <a href="<?= WEBROOT ?>/?controller=dette"
                            class="list-group-item  d-flex align-item-center border border-0 text-light"><span
                                class="material-symbols-outlined px-2"> date_range </span>faire depot</a>
                    </li>
                    <li class="list-group-item  liste-end bg-transparent border-0">
                        <a href="<?= WEBROOT ?>/?controller=login&action=logout" class="list-group-item   liste d-flex align-item-center border border-0 "> <span
                                class="material-symbols-outlined px-2">
                                keyboard_double_arrow_left
                            </span>Deconnexion</a>
                    </li>
                </ul>

            </div>

            <div class=" border border-0 shadow mt-2 main bg-light ">
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