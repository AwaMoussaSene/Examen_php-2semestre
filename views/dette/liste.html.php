<div class=" div-filtre bg-light p-4 shadow rounded mt-2 d-flex">
    <h5 class="mx-2 mt-2">Liste des dettes</h5>
    <button class=" border border-0 bntAjout d-flex align-item-center p-2" type="button"><span
            class="material-symbols-outlined px-2 add"> add </span><a class="text-decoration-none"
            href="<?= WEBROOT . "/?controller=dette&action=add" ?>">Ajouter</a></button>
</div>

<div class=" div-filtre bg-light p-2 shadow rounded mt-3 d-flex">

    <form action="" method="get" class="d-flex align-items-center mt-4 col-12 mb-2">
        <label for="tel" class="form-label mx-3">Tel:</label>
        <input type="text" class="form-control" id="inputTel" name="tel" value="<?= $_GET['tel'] ?? '' ?>">

        <label for="date" class="form-label mx-3">Date:</label>
        <input type="date" class="form-control" id="inputDate" name="date" value="<?= $_GET['date'] ?? '' ?>">

        <label for="etat" class="form-label mx-3">Etat:</label>
        <select id="inputFonction" class="form-select" name="etat">
            <option selected value=""></option>
            <?php foreach ($etats as $etat): ?>
                <option value="<?= $etat->libelle ?>" <?= isset($_GET['etat']) && $_GET['etat'] == $etat->libelle ? 'selected' : '' ?>><?= $etat->libelle ?></option>
            <?php endforeach ?>
        </select>
        <input type="hidden" name="controller" value="dette">
        <input type="hidden" name="action" value="liste">
        <button type="submit" name="action" value="liste" class="btn btn-secondary mx-3">Ok</button>
        <button type="submit" name="action" value="liste" class="btn btn-secondary mx-3">
            <a href="<?= WEBROOT ?>/?controller=dette&action=liste"
                style="color: white; text-decoration: none;">Tout</a>
        </button>
    </form>
</div>

<div class=" div-tab bg-light p-2 shadow rounded mt-3 ">
    <table class="table mt-5">
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
            <?php foreach ($datas as $data): ?>
                <tr>
                    <th scope="row"><?= $data->prenom . " " . $data->nom ?></th>
                    <td><?php
                    $date = new DateTime($data->dated);
                    $formattedDate = $date->format('d-m-Y');
                    echo ($formattedDate);
                    ?> </td>
                    <td><?= $data->montant ?> </td>
                    <td><?= $data->verse ?></td>
                    <td><?= $data->restant ?></td>
                    <td><?= $data->libelle ?> </td>
                    <td><a href="<?= WEBROOT . "/?controller=paiement&action=detail&iddet=$data->iddet" ?>">Detail</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="container d-flex align-item-center justify-content-end " id="pagination">
        <ul class="pagination float-end">
            <li class="page-item <?= ($pagination['currentPage'] <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=dette&action=liste&page=$pagination['currentPage'] - 1 ?>">Prec</a>
            </li>
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?=($i == $pagination['currentPage']) ? 'active' : '' ?>">
                    <a class="page-link " href="?controller=dette&action=liste&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($pagination['currentPage'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=dette&action=liste&page=<?= $pagination['currentPage'] + 1 ?>">Next</a>
            </li>
        </ul>
    </div>


</div>