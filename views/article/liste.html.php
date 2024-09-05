<div class=" div-filtre bg-light p-4 shadow rounded mt-2 d-flex">
    <h5 class="mx-2 mt-2">Liste des articles</h5>
    <button class=" border border-0 bntAjout d-flex align-item-center p-2" type="button"><span
            class="material-symbols-outlined px-2 add"> add </span><a class="text-decoration-none"
            href="<?= WEBROOT . "/?controller=article&action=add" ?>">Ajouter</a></button>
</div>
<div class=" div-tab bg-light p-2 shadow rounded mt-3 ">
    <table class="table ">
        <thead class="table-secondary ">
            <tr>
                <th scope="col">Article</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Quantite stock</th>
            </tr>
        </thead>
        <tbody id="tBody">
            <?php foreach ($articles as $article): ?>
                <tr>
                   <td><?=$article->libelle?></td>
                   <td><?=$article->prixunitaire?></td>
                   <td><?=$article->qtestock?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="container d-flex align-items-center justify-content-end" id="pagination">
        <ul class="pagination float-end">
            <li class="page-item <?= ($pagination['currentPage'] <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=article&action=liste&page=<?= $pagination['currentPage'] - 1 ?>">Préc</a>
            </li>
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?= ($i == $pagination['currentPage']) ? 'active' : '' ?>">
                    <a class="page-link" href="?controller=article&action=liste&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($pagination['currentPage'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=article&action=liste&page=<?= $pagination['currentPage'] + 1 ?>">Suiv</a>
            </li>
        </ul>
    </div>
</div>