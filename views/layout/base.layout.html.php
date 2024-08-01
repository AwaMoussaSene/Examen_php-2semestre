<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="localhost:8005/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

    <main>
        <div class="container-fluid col-12 d-flex vh-100 ">
            <div class="container col-2  shadow">
                <img src="Images/logo.jpg" class="img-fluid col-7" alt="">
                <p class="fw-light fs-6 mt-3 mb-3">-MENU</p>
                <ul class="list-group">
                    <li class="list-group-item ">

                        <a href="" class="list-group-item list-group-item-action active d-flex align-item-center"> <span
                                class="material-symbols-outlined px-2"> dashboard </span>Dashboard</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= WEBROOT ?>/?ressource=html&controller=compte"
                            class="list-group-item list-group-item-action d-flex align-item-center"><span
                                class="material-symbols-outlined px-2"> checkbook </span>Liste comptes</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?= WEBROOT ?>/?ressource=html&controller=demande"
                            class="list-group-item list-group-item-action d-flex align-item-center"><span
                                class="material-symbols-outlined px-2"> date_range </span>Liste demandes</a>
                    </li>
                
               
             
                    <li class="list-group-item">
                        <a href="<?= WEBROOT ?>/?ressource=html&controller=transaction"
                            class="list-group-item list-group-item-action d-flex align-item-center"><span
                                class="material-symbols-outlined px-2"> date_range </span>Transactions</a>
                    </li>
                   
                <li class="list-group-item">
                        <a href="<?= WEBROOT ?>/?ressource=html&controller=login&action=logout"
                            class="list-group-item list-group-item-action d-flex align-item-center"><span
                                class="material-symbols-outlined px-2"> date_range </span>Deconnexion</a>
                    </li>
                </ul>

            </div>

            <div class="container col-10 border mt-2">
                <?= $contentForView ?>


            </div>
        </div>



    </main>
    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script src="http://localhost:8050/js/demande.js"></script>

</body>

</html>