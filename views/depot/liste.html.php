<div class=" div-filtre bg-light p-4 shadow rounded mt-2 d-flex">
    <h5 class="mx-2 mt-2">Liste des depot</h5>
</div>
<div class=" div-tab bg-light p-2 shadow rounded mt-3 ">
    <table class="table ">
        <thead class="table-secondary ">
            <tr>
                <th scope="col">Client</th>
                <th scope="col">Date</th>
                <th scope="col">Montant</th>
        </thead>
        <tbody id="tBody">
            <?php foreach ($depots as $depot): ?>
                <tr>
                    <th scope="row"><?= $depot->prenom . " " . $depot->nom ?></th>
                    <td><?php
                    $date = new DateTime($depot->datedepot);
                    $formattedDate = $date->format('d-m-Y');
                    echo ($formattedDate);
                    ?> </td>
                    <td><?= $depot->montant ?> </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>