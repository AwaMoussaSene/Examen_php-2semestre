<div class=" div-recu bg-light p-2 shadow rounded mt-3 ">
    <div class="container-fluid col-12   d-flex justify-content-between rounded">
        <div class="  col-2 nav-bar-child ">
            <H1 style="color: #FF7312">Recu</H1>
        </div>
        <div class=" p-3 col-3 recu ">
            <div class="cercle-recu">
            </div>
        </div>

    </div>
    <div class="hr mt-2"></div>
    <div class="info mt-4 mx-5">
        <h2>Kay Dieunde Boutique</h2>
        <h6>Sacre Coeur 3</h6>
        <h6>Dakar</h6>
        <h6>778332716</h6>
    </div>
    <div class="container-info d-flex justify-content-between rounded  p-4 mt-2">
        <div class="info">
            <h6>Date de la facture : <?= $paiementArts[0]->datep ?></h6>
            <h6>Paiement effectué le : <?= $paiementArts[0]->datep ?></h6>
            <h6>Référence de facture : <?= $paiementArts[0]->reference ?></h6>
            <h6>Émis par : <?= $paiements[0]->boutiquier_prenom . " " . $paiements[0]->boutiquier_nom ?></h6>
        </div>
        <div class="info">
            <h2>Destinateur</h2>
            <h6>Nom: <?= $paiements[0]->nom ?></h6>
            <h6>Prenom: <?= $paiements[0]->prenom ?></h6>
            <h6>Adress:<?= $paiements[0]->adresse ?></h6>
        </div>
    </div>
    <div class="info mt-3 mx-5">
        <h2>Information additionnelles</h2>
        <h6>Merci d'avoir choisi Kay Ndieude Boutique pour vos services</h6>
    </div>   
    <div class="hr mt-2"></div>
    <div class="container-info d-flex justify-content-between rounded   mt-2">
    <table class="table mt-4">
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
                    <td><?= $article->libelle ?></td>
                    <td><?= $article->quantite ?></td>
                    <td><?= $article->prixunitaire ?></td>
                    <td><?= $article->montant_article ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="container  col-6 mx-5 mt-3">
        <h6>Montant dette: <?= $paiements[0]->montant ?></h6>
        <h6>Montant verse: <?= $paiements[0]->verse ?></h6>
        <h6>Montant du: <?= $paiements[0]->restant ?></h6>

    </div>
</div>