<div class="div-filtre bg-light p-4 shadow rounded mt-2">
    <h5 class="mx-2">Fiche de <span style="color: red;"><?= $clients[0]->prenom . " " . $clients[0]->nom ?></span></h5>
</div>

<div class="div-filtre bg-light p-4 shadow rounded mt-2">
    <div class="form-add-dett bg-transparent mt-5 rounded d-flex align-items-center justify-content-around">
        <div class="container w-100 rounded">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Informations</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profiles" type="button" role="tab" aria-controls="pills-profiles"
                        aria-selected="false">Dettes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-depots-tab" data-bs-toggle="pill" data-bs-target="#pills-depots"
                        type="button" role="tab" aria-controls="pills-depots" aria-selected="false">Depots</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Informations Tab -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container p-2 d-flex justify-content-around align-items-center">
                        <div class="col-2 d-flex justify-content-around align-items-center">
                            <div class="cercleFiche">
                                <img src="../assets/<?= $clients[0]->photo ?>" alt="">
                            </div>
                        </div>
                        <div class="fiche d-flex">
                            <div class="container col-8">
                                <h5>IDENTIFICATION</h5>
                                <h6>Prenom: <?= $clients[0]->prenom ?></h6>
                                <h6>Nom: <?= $clients[0]->nom ?></h6>
                                <h6>Categorie: <?= $clients[0]->libelle_categorie ?></h6>
                            </div>
                        </div>
                        <div class="fiche d-flex">
                            <div class="container col-8 mt-2">
                                <h5>CONTACT</h5>
                                <h6>Telephone: <?= $clients[0]->telephone ?></h6>
                                <h6>Adresse: <?= $clients[0]->adresse ?></h6>
                                <h6>Email: <?= $clients[0]->email ?></h6>
                            </div>
                        </div>
                        <div class="fiche d-flex">
                            <div class="container col-8 mt-2">
                                <h5>Autre informations</h5>
                                <h6>Compte: <?= !empty($sumDepotClient) && isset($sumDepotClient[0]->montant_total) ? $sumDepotClient[0]->montant_total : 0 ?></h6>
                                <h6>Total dette: <?= $sumDetteClients[0]->montant_total ?></h6>
                                <h6>Seuil: <?= $clients[0]->montantseuil ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->autorisation->hasRole("boutiquier")): ?>
                        <div class="container w-100 rounded">
                            <div class="container w-100 mt-2 d-flex align-items-center justify-content-around rounded">
                                <div class="container col-6 mt-5 border shadow align-items-center justify-content-around rounded">
                                    <label for="inputCity" class="form-label mt-4 mx-3">Categorie :</label>
                                    <form action="" method="post" class="col-md-9 d-flex align-items-center mx-2 mb-5">
                                        <input type="hidden" name="idclient" value="<?= $clients[0]->idclient ?>">
                                        <input type="hidden" name="iddet" value="<?= $clients[0]->iddet ?>">
                                        <select id="inputFonction" class="form-select" name="categorie">
                                            <option selected value="<?= htmlspecialchars($clients[0]->libelle_categorie) ?>">
                                                <?= htmlspecialchars($clients[0]->libelle_categorie) ?>
                                            </option>
                                            <?php foreach ($categories as $categorie): ?>
                                                <?php if ($categorie->libelle !== $clients[0]->libelle_categorie): ?>
                                                    <option value="<?= $categorie->idcat ?>"
                                                        <?= isset($_GET['categorie']) && $_GET['categorie'] == $categorie->libelle ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($categorie->libelle) ?>
                                                    </option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" name="controller" value="client">
                                        <input type="hidden" name="action" value="detail">
                                        <button type="submit" name="modifier" class="btn-modifier mx-3">Modifier</button>
                                    </form>
                                </div>
                                <div class="container col-5 mt-5 border shadow align-items-center justify-content-around rounded">
                                    <label for="inputCity" class="form-label mt-4 mx-3">Montant seuil:</label>
                                    <form action="" method="post" class="col-md-9 d-flex align-items-center mx-2 mb-5">
                                    <input type="hidden" name="idclient" value="<?= $clients[0]->idclient ?>">
                                    <input type="hidden" name="iddet" value="<?= $clients[0]->iddet ?>">
                                        <input type="text" class="form-control" id="inputTel" name="montantseuil"
                                            placeholder="<?= $clients[0]->montantseuil ?>">
                                        <input type="hidden" name="controller" value="client">
                                        <input type="hidden" name="action" value="detail">
                                        <button type="submit" name="modifier-seuil" class="btn-modifier mx-3">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <!-- Dettes Tab -->
                <div class="tab-pane fade" id="pills-profiles" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="div-tab bg-light p-2 shadow rounded mt-3">
                        <table class="table">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">Client</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Montant versé</th>
                                    <th scope="col">Montant dû</th>
                                    <th scope="col">État</th>
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
                                            echo $formattedDate;
                                        ?></td>
                                        <td><?= $client->montant ?></td>
                                        <td><?= $client->verse ?></td>
                                        <td><?= $client->restant ?></td>
                                        <td><?= $client->libelle ?></td>
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
                                        href="<?= isset($_GET['iddet']) ? "?controller=client&action=detail&iddet=" . $_GET['iddet'] . "&page=" . ($currentPage - 1) : "?controller=client&action=Client-connect&page=" . ($currentPage - 1) ?>">Préc</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                        <a class="page-link"
                                            href="<?= isset($_GET['iddet']) ? "?controller=client&action=detail&iddet=" . $_GET['iddet'] . "&page=" . $i : "?controller=client&action=Client-connect&page=" . $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= isset($_GET['iddet']) ? "?controller=client&action=detail&iddet=" . $_GET['iddet'] . "&page=" . ($currentPage + 1) : "?controller=client&action=Client-connect&page=" . ($currentPage + 1) ?>">Suiv</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Depots Tab -->
                 
                <div class="tab-pane fade" id="pills-depots" role="tabpanel" aria-labelledby="pills-depots-tab">
                <?php if ($this->autorisation->hasRole("boutiquier")): ?>
                        <div class="add-qtes p-2 mt-4 shadow bg-light d-flex align-item-center justify-content-between ">
                            <form acton="" method="post" class="col-md-6 d-flex align-items-center mt-4  ">
                            <input type="hidden" name="idclient" value="<?= $clients[0]->idclient ?>">
                            <input type="hidden" name="iddet" value="<?= $clients[0]->iddet ?>">
                                    <label for="montant" class="form-label  mx-3">Montant:</label>
                                    <div class="container col-12">
                                    <input type="text" class="form-control  <?= isset($errors['montant-depot']) ? 'is-invalid' : '' ?>"
                                        id="inputTel" name="montant-depot" value="">
                                    <div id="montant_error" class="invalid-feedback"><?= $errors['montant-depot'] ?? '' ?></div>
                                    </div>
                                    <input type="hidden" name="controller" value="client">
                                    <input type="hidden" name="action" value="detail">
                                <button name="valider-depot" value="" type="submit" class="border-0 color-but mx-3 col-2">
                                    valider
                                </button>
                            </form>
                        </div>
                    <?php endif?>
                    <div class="div-tab bg-light p-2 shadow rounded mt-3">
                        <table class="table">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tBody">
                                <?php foreach ($depots as $depot): ?>
                                    <tr>
                                        <td><?php
                                            $date = new DateTime($depot->datedepot);
                                            $formattedDate = $date->format('d-m-Y');
                                            echo $formattedDate;
                                        ?></td>
                                        <td><?= $depot->montant ?></td>
                                        <td><a href="<?= WEBROOT . "/?controller=depot&action=detail&iddet=$depot->iddet" ?>"
                                                class="text-decoration-none">details</a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <div class="container d-flex align-items-center justify-content-end" id="pagination">
                            <ul class="pagination float-end">
                                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= isset($_GET['iddet']) ? "?controller=client&action=detail&iddet=" . $_GET['iddet'] . "&page=" . ($currentPage - 1) : "?controller=client&action=Client-connect&page=" . ($currentPage - 1) ?>">Préc</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                        <a class="page-link"
                                            href="<?= isset($_GET['iddet']) ? "?controller=client&action=detail&iddet=" . $_GET['iddet'] . "&page=" . $i : "?controller=client&action=Client-connect&page=" . $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= isset($_GET['iddet']) ? "?controller=client&action=detail&iddet=" . $_GET['iddet'] . "&page=" . ($currentPage + 1) : "?controller=client&action=Client-connect&page=" . ($currentPage + 1) ?>">Suiv</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Succès</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-danger">
                <?php if (!empty($message)): ?>
                    <?= htmlspecialchars($message) ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if (!empty($message)): ?>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
            keyboard: false
        });
        myModal.show();
    <?php endif; ?>
});
</script>