<div class="container mt-2 d-flex">
    <a href="<?= WEBROOT . "/?controller=dette&action=liste" ?>"><span class="material-symbols-outlined">
            reply_all
        </span> </a>
    <h5 class="mx-2 ">Liste des dettes</h5>
</div>
<div class=" form-add-dett bg-transparent mt-3  rounded mt-3 d-flex align-item-center justify-content-around">
    <div class="container col-5  shadow bg-light ">
        <form acton="" method="get" class="col-md-9 d-flex align-items-center mt-4 mx-2 ">
            <label for="tel" class="form-label  mx-3">Tel:</label>
            <input type="text" class="form-control" id="inputTel" name="tel">
            <button action="" value="" type="submit" class=" border-0 color-but mx-3" id="">Ok</button>
        </form>
        <form action="" id="" method="post" class="mt-4 mx-4">
            <div class="col-11">
                <input type="text" class="form-control" id="nameInput" value="" name="prenom" disabled
                    placeholder="prenom">
            </div>
            <div class="col-11 mt-4">
                <input type="text" class="form-control" id="nameInput" value="" name="nom" disabled placeholder="nom">
            </div>

        </form>
    </div>
    <div class="container col-6  shadow bg-light ">
        <form acton="" method="get" class="col-md-9 d-flex align-items-center mt-4 mx-2 ">
            <label for="ref" class="form-label  mx-3">Ref:</label>
            <input type="text" class="form-control" id="inputTel" name="ref">
            <button action="" value="" type="submit" class=" border-0 color-but mx-3" id="">Ok</button>
        </form>
        <form action="" id="" method="post" class="mt-4 mx-4">
            <div class="col-11">
                <input type="text" class="form-control" id="nameInput" value="" name="article" disabled
                    placeholder="article">
            </div>
            <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mb-2">
                <div class="col-5">
                    <input type="text" class="form-control" id="nameInput" value="" name="qteStock" disabled
                        placeholder="qteStock">
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" id="nameInput" value="" name="prix unitaire" disabled
                        placeholder="prix unitaire">
                </div>
            </div>

        </form>
    </div>
</div>
<div class="add-qte p-2 mt-3 shadow bg-light d-flex align-item-center justify-content-around ">
    <form acton="" method="get" class="col-md-6 d-flex align-items-center mt-4 mx-2 ">
        <label for="tel" class="form-label  mx-3">Quantite:</label>
        <input type="text" class="form-control" id="inputTel" name="quantite">
        <button action="" value="" type="submit" class=" border-0 color-but mx-3" id="">valider</button>
    </form>

</div>
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
            <tr>
                <th scope="row">Sucre</th>
                <td>10</td>
                <td>1000</td>
                <td>10000</td>
            </tr>

        </tbody>
    </table>
</div>
<div class="container p-2 border border-primary col-2 mx-5 mt-4">
    <h2>Total= 10000</h2>
</div>
<button class=" border border-0 bntAjout d-flex align-item-center justify-content-around  p-2" type="submit">Enregistrer</button>