<div class="container mt-2 d-flex">
    <a href="<?= WEBROOT . "/?controller=dette&action=liste" ?>"><span class="material-symbols-outlined">
            reply_all
        </span> </a>
    <h5 class="mx-2 ">detail dette</h5>
</div>
<div class=" div-tabe bg-light p-2 shadow rounded mt-3 ">
    <div class="container-fluid col-12   d-flex justify-content-between rounded">
        <div class="  col-4  d-flex justify-content-between mt-4">
            <div class="cercle-user ">
                <img src="../assets/role.png" alt="">
            </div>
            <div class="container w-75">
                <h6>Prenom: Awa moussa</h6>
                <h6>Nom: Sene</h6>
            </div>
        </div>
        <div class="  col-3  mt-2">
            <div class=" ">
                <h6>Montant dette: 10000</h6>
                <h6>Montant verse: 6000</h6>
                <h6>Montant du: 4000</h6>
            </div>
        </div>
    </div>

    <hr>
    <div class="add-qte p-2 mt-3 shadow bg-light d-flex align-item-center justify-content-between ">
        <form acton="" method="get" class="col-md-6 d-flex align-items-center mt-4  ">
            <label for="tel" class="form-label  mx-3">Quantite:</label>
            <input type="text" class="form-control col-6" id="inputTel" name="quantite">
            <button action="" value="" type="submit" class=" border-0 color-but mx-3 col-2" id="">valider</button>
        </form>

    </div>
    <div class=" form-add-dett bg-transparent mt-5  rounded  d-flex align-item-center justify-content-around">
        <div class="container col-6 p-2 shadow bg-light ">
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
                    <tr>
                        <th scope="row">Sucre</th>
                        <td>10</td>
                        <td>1000</td>
                        <td>10000</td>
                    </tr>
                    <tr>
                        <th scope="row">Sucre</th>
                        <td>10</td>
                        <td>1000</td>
                        <td>10000</td>
                    </tr>
                    <tr>
                        <th scope="row">Sucre</th>
                        <td>10</td>
                        <td>1000</td>
                        <td>10000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container col-5  p-2 shadow bg-light ">

            <table class="table ">
                <thead class="table-secondary ">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Montant</th>
                        <th scope="col">reference</th>


                    </tr>
                </thead>
                <tbody id="tBody">
                    <tr>
                        <td>01/08/2024</td>
                        <td>100000</td>
                        <td>ref1234</td>
                    </tr>
                    <tr>
                        <td>01/08/2024</td>
                        <td>100000</td>
                        <td>ref1234</td>
                    </tr>
                    <tr>
                        <td>01/08/2024</td>
                        <td>100000</td>
                        <td>ref1234</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>