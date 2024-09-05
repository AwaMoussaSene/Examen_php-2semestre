<div class=" div-tabe bg-light p-2  rounded mt-3 ">
    <div class="container  d-flex">
        <?php if ($this->autorisation->hasRole("boutiquier")): ?>
            <a href="<?= WEBROOT . "/?controller=dette&action=liste" ?>"><span class="material-symbols-outlined">
                reply_all
            </span> </a>
        <?php endif?>
        <?php if ($this->autorisation->hasRole("client")): ?>
            <a href="<?= WEBROOT . "/?controller=client&action=Client-connect" ?>"><span class="material-symbols-outlined">
                reply_all
            </span> </a>
        <?php endif?>
        <h5 class="mx-2 ">detail dette</h5>
    </div>
    <div class="container-fluid col-12 mt-2 shadow d-flex justify-content-between rounded">
        <div class="  col-4  d-flex justify-content-between mt-4">
            <div class="cercle-user ">
                <img src="../assets/role.png" alt="">
            </div>
            <div class="container w-75">
                <h6>Prenom: <?= $paiements[0]->prenom ?></h6>
                <h6>Nom: <?= $paiements[0]->nom ?></h6>
            </div>
        </div>
        <div class="  col-3  mt-2">
            <div class=" ">
                <h6>Montant dette: <?= $paiements[0]->montant ?></h6>
                <h6>Montant verse: <?= $paiements[0]->verse ?></h6>
                <h6>Montant du: <?= $paiements[0]->restant ?></h6>
            </div>
        </div>
    </div>
    <?php if ($this->autorisation->hasRole("boutiquier")): ?>
    <div class="add-qtes p-2 mt-4 shadow bg-light d-flex align-item-center justify-content-between ">
        <form acton="" method="post" class="col-md-6 d-flex align-items-center mt-4  ">
                <label for="montant" class="form-label  mx-3">Montant:</label>
                <div class="container col-12">
                <input type="text" class="form-control  <?= isset($errors['montant']) ? 'is-invalid' : '' ?>"
                    id="inputTel" name="montant" value="">
                <div id="montant_error" class="invalid-feedback"><?= $errors['montant'] ?? '' ?></div>
                </div>
            <button name="valider" value="montantpaiement" type="submit" class="border-0 color-but mx-3 col-2"
                <?= intval($paiements[0]->restant) <= 0 ? 'disabled' : '' ?>>
                valider
            </button>
        </form>
    </div>
    <?php endif?>

    <div class=" form-add-dett bg-transparent mt-5  rounded  d-flex align-item-center justify-content-around">
        <div class="container w-100    rounded ">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Historique Paiement</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Articles</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <table class="table ">
                        <thead class="table-secondary ">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Montant</th>
                                <th scope="col">reference</th>


                            </tr>
                        </thead>
                        <tbody id="tBody">
                            <?php foreach ($paiementArts as $paiementArt): ?>
                                <tr>
                                    <th scope="row"><?= $paiementArt->datep ?> </th>
                                    <td><?= $paiementArt->montantpay ?> </td>
                                    <td><?= $paiementArt->reference ?> </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <table class="table ">
                        <thead class="table-secondary ">
                            <tr>
                                <th scope="col">Article</th>
                                <th scope="col">quantite</th>
                                <th scope="col">prix unitaire</th>
                                <th scope="col">Montant</th>
                            </tr>
                        </thead>
                        <tbody id="tBody">
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <th scope="row"><?= $article->libelle ?> </th>
                                    <td><?= $article->quantite ?> </td>
                                    <td><?= $article->prixunitaire ?> </td>
                                    <td><?= $article->montant_article ?> </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>