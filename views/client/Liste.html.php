<div class=" div-filtre bg-light p-4 shadow rounded mt-2 d-flex">
    <h5 class="mx-2 mt-2">Liste des dettes</h5>
    <button class=" border border-0 bntAjout d-flex align-item-center p-2" type="button"><span
            class="material-symbols-outlined px-2 add"> add </span><a class="text-decoration-none"
            href="<?= WEBROOT . "/?controller=client&action=add" ?>">Ajouter</a></button>
</div>
<div class=" div-filtre bg-light p-4 shadow rounded mt-2 ">
<form action="" method="get" class="d-flex align-items-center mt-4 col-12 mb-2">
        <label for="tel" class="form-label mx-3">Tel:</label>
        <input type="text" class=" filterTel" id="inputTel" name="tel" value="<?= $_GET['tel'] ?? '' ?>">
        <label for="tel" class="form-label mx-3">Categorie:</label>
        <select id="inputFonction" class="filterTel" name="categorie">
            <option selected value=""></option>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie->libelle ?>" <?= isset($_GET['categorie']) && $_GET['categorie'] == $categorie->libelle ? 'selected' : '' ?>><?= $categorie->libelle ?></option>
            <?php endforeach ?>
        </select>
        <input type="hidden" name="controller" value="client">
        <input type="hidden" name="action" value="liste">
        <button type="submit" name="" value="" class="btn btn-secondary mx-3">Ok</button>
        <button type="submit" name="action" value="liste" class="btn btn-secondary mx-3">
            <a href="<?= WEBROOT ?>/?controller=client&action=liste"
                style="color: white; text-decoration: none;">Tout</a>
        </button>
    </form>
</div>
<div class=" div-tab bg-light p-2 shadow rounded mt-3 ">
    <table class="table ">
        <thead class="table-secondary ">
            <tr>
                <th scope="col">Client</th>
                <th scope="col">Tephone</th>
                <th scope="col">Adresse</th>
                <th scope="col">Email </th>
                <th scope="col">Montant seuil </th>
                <th scope="col">Categorie </th>
                <th scope="col">Monant dettes</th>
                <!-- <th scope="col">Action</th> -->


            </tr>
        </thead>
        <tbody id="tBody">
            <?php foreach ($clients as $client): ?>
                <tr>
                   <td><?=$client->prenom." ".$client->nom?></td>
                   <td><?=$client->telephone?></td>
                   <td><?=$client->adresse?></td>
                   <td><?=$client->email?></td>
                   <td><?=$client->montantseuil?></td>
                   <td><?=$client->libelle?></td>
                   <td><?=$client->montant_total ?></td>
                   <!-- <td><a href="<?= WEBROOT . "/?controller=client&action=detail&iddet=$client->iddet" ?>" class="text-decoration-none">details</a></td> -->
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="container d-flex align-items-center justify-content-end" id="pagination">
        <ul class="pagination float-end">
            <li class="page-item <?= ($pagination['currentPage'] <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=client&action=liste&page=<?= $pagination['currentPage'] - 1 ?>">Préc</a>
            </li>
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?= ($i == $pagination['currentPage']) ? 'active' : '' ?>">
                    <a class="page-link" href="?controller=client&action=liste&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($pagination['currentPage'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=client&action=liste&page=<?= $pagination['currentPage'] + 1 ?>">Suiv</a>
            </li>
        </ul>
    </div>
</div>