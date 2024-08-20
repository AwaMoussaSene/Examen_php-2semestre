
    <div class=" div-filtre bg-light p-4 shadow rounded mt-2 ">
    <h5 class="mx-2 ">Liste dettes de <span
                style="color: red;"><?= $clients[0]->prenom . " " . $clients[0]->nom ?></span>
        </h5>
    <div class="container p-2  d-flex justify-content-around align-items-center">
        <div class="col-2 d-flex justify-content-around align-items-center">
        <div class="cercleFiche ">
                <img src="../assets/roles-re.png" alt="">
            </div>
        </div>
        <div class="fiche d-flex">
            <div class="container col-8 ">
                <h5>IDENTIFICATION</h5>
                <h6>Prenom: <?= $clients[0]->prenom ?></h6>
                <h6>Nom: <?= $clients[0]->nom ?></h6>
            </div>
        </div>
        <div class="fiche d-flex">
            <div class="container col-8 mt-2">
                <h5>CONTACT</h5>
                <h6>Telephone: <?= $clients[0]->telephone ?></h6>
                <h6> Adresse:<?= $clients[0]->adresse ?></h6>
                <h6>Email:<?= $clients[0]->email ?></h6>
            </div>

        </div>
        <div class="fiche d-flex">
            <div class="container col-8 mt-2">
                <h5>CATEGORIE</h5>
                <h6>Telephone: <?= $clients[0]->libelle_categorie ?></h6>
            </div>

        </div>
    </div>

    </div>
    <div class=" div-tab bg-light p-2 shadow rounded mt-3 ">
        <table class="table ">
            <thead class="table-secondary ">
                <tr>
                    <th scope="col">Client</th>
                    <th scope="col">Date</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Montant verse</th>
                    <th scope="col">Montant du</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tBody">
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <th scope="row"><?= $client->prenom . " " . $client->nom ?></th>
                        <td><?php
                        $date = new DateTime($client->dated);
                        $formattedDate = $date->format('d-m-Y');
                        echo ($formattedDate);
                        ?> </td>
                        <td><?= $client->montant ?> </td>
                        <td><?= $client->verse ?></td>
                        <td><?= $client->restant ?></td>
                        <td><?= $client->libelle ?> </td>
                        <td><a href="<?= WEBROOT . "/?controller=paiement&action=detail&iddet=$client->iddet" ?>"
                                class="text-decoration-none">details</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="container d-flex align-items-center justify-content-end" id="pagination">
            <ul class="pagination float-end">
                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link"
                        href="?controller=client&action=detail&iddet=<?= $_GET['iddet'] ?>&page=<?= $currentPage - 1 ?>">Préc</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link"
                            href="?controller=client&action=detail&iddet=<?= $_GET['iddet'] ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link"
                        href="?controller=client&action=detail&iddet=<?= $_GET['iddet'] ?>&page=<?= $currentPage + 1 ?>">Suiv</a>
                </li>
            </ul>
        </div>
    </div>