<div class=" div-filtre bg-light p-4 shadow rounded mt-2 ">
    <h5 class="mx-2 ">Statistiques</h5>
    <div class="container p-2  d-flex justify-content-around">
        <div class="carte d-flex">
            <div class="container col-8 mt-2">
                <h6>Nombre de client</h6>
                <h6><?=$nbreClients[0]->nombre_client?></h6>
            </div>
            <div class="container cert-img col-4 mt-2">
                <img src="../assets/profil.png" alt="">
            </div>
        </div>
        <div class="carte d-flex">
        <div class="container col-8 mt-2">
                <h6>Total dettes</h6>
                <h6><?=$sumDettes[0]->dette_total?></h6>
            </div>
            <div class="container certe-img col-4 mt-2">
                <img src="../assets/dette.png" alt="">
            </div>
        </div>
        <div class="carte d-flex">
        <div class="container col-8 mt-2">
                <h6>Dettes de la journee</h6>
                <h6><?=$sumDetteJour[0]->dette_total?></h6>
                <h6><?= date('d/m/Y') ?></h6>
            </div>
            <div class="container certe-img col-4 mt-2">
                <img src="../assets/dette.png" alt="">
            </div>
        </div>
        <div class="carte d-flex">
        <div class="container col-8 mt-2">
                <h6>Stock d'articles</h6>
                <h6><?=$sumStocks[0]->stock_total?></h6>
                <h6><?=$sumStockVendu[0]->stock_vendu?> article vendu</h6>
            </div>
            <div class="container certe-img col-4 mt-2">
                <img src="../assets/produit.png" alt="">
            </div>
        </div>
    </div>

</div>
<div class=" div-filtre bg-light p-4 shadow rounded mt-2 ">
<form action="" method="get" class="d-flex align-items-center mt-4 col-12 mb-2">
        <label for="tel" class="form-label mx-3">Tel:</label>
        <input type="text" class=" filterTel" id="inputTel" name="tel" value="<?= $_GET['tel'] ?? '' ?>">
        <input type="hidden" name="controller" value="dashboard">
        <input type="hidden" name="action" value="dashboard">
        <button type="submit" name="action" value="dashboard" class="btn btn-secondary mx-3">Ok</button>
        <button type="submit" name="action" value="dashboard" class="btn btn-secondary mx-3">
            <a href="<?= WEBROOT ?>/?controller=dashboard&action=dashboard"
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
                <th scope="col">Email verse</th>
                <th scope="col">Categorie </th>
                <th scope="col">Monant dettes</th>
                <th scope="col">Action</th>


            </tr>
        </thead>
        <tbody id="tBody">
            <?php foreach ($clients as $client): ?>
                <tr>
                   <td><?=$client->prenom." ".$client->nom?></td>
                   <td><?=$client->telephone?></td>
                   <td><?=$client->adresse?></td>
                   <td><?=$client->email?></td>
                   <td><?=$client->libelle?></td>
                   <td><?=$client->montant_total ?></td>
                   <td><a href="<?= WEBROOT . "/?controller=client&action=detail&iddet=$client->iddet" ?>" class="text-decoration-none">details</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="container d-flex align-items-center justify-content-end" id="pagination">
        <ul class="pagination float-end">
            <li class="page-item <?= ($pagination['currentPage'] <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=dashboard&action=dashboard&page=<?= $pagination['currentPage'] - 1 ?>">Préc</a>
            </li>
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?= ($i == $pagination['currentPage']) ? 'active' : '' ?>">
                    <a class="page-link" href="?controller=dashboard&action=dashboard&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($pagination['currentPage'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=dashboard&action=dashboard&page=<?= $pagination['currentPage'] + 1 ?>">Suiv</a>
            </li>
        </ul>
    </div>
</div>
