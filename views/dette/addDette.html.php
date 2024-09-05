<div class="container mt-2 d-flex">
    <a href="<?= WEBROOT . "/?controller=dette&action=liste" ?>"><span class="material-symbols-outlined">
            reply_all
        </span> </a>
    <h5 class="mx-2 ">Ajout dettes</h5>
</div>
<div class=" form-add-dett bg-transparent mt-3  rounded mt-3 d-flex align-item-center justify-content-around">
    <div class="container col-5  shadow bg-light ">
        <form acton="" method="get" class="col-md-9 d-flex align-items-center mt-4 mx-2 ">
            <input type="hidden" value="<?= $clients->idclient ?? "" ?>" name="idclient">
            <label for="tel" class="form-label  mx-3">Tel:</label>
            <input type="text" class="form-control" id="inputTel" name="tel" value="<?= $search_tel ?? '' ?>">
            <input type="hidden" name="controller" value="dette">
            <input type="hidden" name="action" value="add">
            <button name="action" value="add" value="" type="submit" class=" border-0 color-but mx-3" id="">Ok</button>
        </form>
        <form action="" id="" method="get" class="mt-4 mx-4">
            <div class="col-11">
                <input type="text" class="form-control" id="nameInput" value="<?= $clients[0]->prenom ?? "" ?>"
                    name="prenom" disabled <?= isset($clients->idclient) ? "disabled" : "" ?> placeholder="prenom">
            </div>
            <div class="col-11 mt-4">
                <input type="text" class="form-control" id="nameInput" value="<?= $clients[0]->nom ?? "" ?>" name="nom"
                    disabled <?= isset($clients->idclient) ? "disabled" : "" ?> placeholder="nom">
            </div>

        </form>
    </div>
    <div class="container col-6  shadow bg-light ">
        <form acton="" method="get" class="col-md-9 d-flex align-items-center mt-4 mx-2 ">
            <label for="ref" class="form-label  mx-3">Ref:</label>
            <input type="text" class="form-control" id="inputTel" name="ref" value="<?= $search_ref ?? '' ?>">
            <input type="hidden" name="controller" value="dette">
            <input type="hidden" name="action" value="add">
            <button name="action" value="add" value="" type="submit" class=" border-0 color-but mx-3" id="">Ok</button>
        </form>
        <form action="" id="" method="post" class="mt-4 mx-4">
            <input type="hidden" value="<?= $articles->ida ?? "" ?>" name="ida">
            <div class="col-11">
                <input type="text" class="form-control" id="nameInput" value="<?= $articles[0]->libelle ?? "" ?>"
                    name="article" disabled placeholder="article">
                <?= isset($articles->ida) ? "disabled" : "" ?>
            </div>
            <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mb-2">
                <div class="col-5">
                    <input type="text" class="form-control" id="nameInput"
                        value="<?= $articles[0]->prixunitaire ?? "" ?>" name="prix" disabled placeholder="qteStock">
                    <?= isset($articles->ida) ? "disabled" : "" ?>
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" id="nameInput" value="<?= $articles[0]->qtestock ?? "" ?>"
                        name="qteStock" disabled placeholder="prix unitaire">
                    <?= isset($articles->ida) ? "disabled" : "" ?>
                </div>
            </div>

        </form>
    </div>
</div>
<div class="add-qte p-2 mt-3 shadow bg-light d-flex align-item-center justify-content-around ">
    <form acton="" method="post" class="col-md-6 d-flex align-items-center mt-4 mx-2 ">
        <label for="tel" class="form-label  mx-3">Quantite:</label>
        <div class="container col-12">
            <input type="text" class="form-control <?= isset($errors['quantite']) ? 'is-invalid' : '' ?>"
                id="inputQuantite" name="quantite">
            <div id="quantite_error" class="invalid-feedback"><?= $errors['quantite'] ?? "" ?></div>
        </div>
        <button name="valider" value="" type="submit" class=" border-0 color-but mx-3" id="">valider</button>
    </form>
</div>
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Erreur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errorMessages">
                        <?php if (!empty($errors)): ?>
                            <ul class="list-unstyled text-danger">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($errors)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            });
        </script>
    <?php endif; ?>
<div class=" add-qte bg-light  shadow rounded mt-3 ">
    <table class="table mt-5">
        <thead class="table-secondary ">
            <tr>
                <th scope="col">Article</th>
                <th scope="col">quantite</th>
                <th scope="col">prix unitaire</th>
                <th scope="col">Montant</th>
            </tr>
        </thead>
        <tbody id="tBody">
            <?php foreach ($articleCmde as $article): ?>
                <tr>
                    <td><?= $article->libelle ?></td>
                    <td><?= $article->qtecmd ?></td>
                    <td><?= $article->prixunitaire ?></td>
                    <td><?= $article->montant ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container d-flex align-item-center ">
    <div class="container  col-4 mx-5 mt-3">
        <h2>Total= <?= $_SESSION['dette']['total'] ?? '0' ?> FCFA</h2>
    </div>
    <form action="" method="post" class=" col-10 mt-3 ">
        <button class=" border border-0 bntAdd d-flex align-item-center justify-content-around  p-2" type="submit"
            name="enregistrer" action="">Enregistrer</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
