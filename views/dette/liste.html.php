<h5 class="mx-2 mt-2">Liste des dettes</h5>
<button class=" border border-0 bntAjout d-flex align-item-center p-2" type="button"><span
        class="material-symbols-outlined px-2"> add </span><a class="text-decoration-none"
        href="<?= WEBROOT . "/?controller=dette&action=add" ?>">Ajouter</a></button>
<div class=" div-filtre bg-light p-2 shadow rounded mt-3 d-flex">
    <form acton="" method="get" class="col-4 d-flex align-items-center mt-4  mb-2">
        <label for="client" class="form-label  mx-3">Client:</label>
        <input type="text" class="form-control" id="inputTel" name="client">
        <button action="" value="" type="submit" class="btn btn-secondary mx-3" id="">Ok</button>
    </form>
    <form acton="" method="get" class="col-4 d-flex align-items-center mt-4  mb-2">
        <label for="date" class="form-label  mx-3">Date:</label>
        <input type="date" class="form-control" id="inputTel" name="date">
        <button action="" value="" type="submit" class="btn btn-secondary mx-3" id="">Ok</button>
    </form>
    <form acton="" method="get" class="col-4 d-flex align-items-center mt-4  mb-2">
        <label for="tel" class="form-label  mx-3">Etat:</label>
        <select id="inputFonction" class="form-select" name="typecpt" value="<?= $typeCompte->idtcpt ?>">
            <option selected></option>
            <option>Non solvant</option>
        </select>
        <button action="" value="" type="submit" class="btn btn-secondary mx-3" id="">Ok</button>
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
            <tr>
                <th scope="row">Amadou Ba</th>
                <td>01/08/2024</td>
                <td>100000</td>
                <td>60000</td>
                <td>40000</td>
                <td>Solvant</td>
                <td><a href="<?= WEBROOT . "/?controller=dette&action=detail" ?>">Detail</a></td>
            </tr>
            <tr>
                <th scope="row">Amadou Ba</th>
                <td>01/08/2024</td>
                <td>100000</td>
                <td>60000</td>
                <td>40000</td>
                <td>Solvant</td>
                <td><a href="<?= WEBROOT . "/?controller=dette&action=detail" ?>">Detail</a></td>
            </tr>
            <tr>
                <th scope="row">Amadou Ba</th>
                <td>01/08/2024</td>
                <td>100000</td>
                <td>60000</td>
                <td>40000</td>
                <td>Solvant</td>
                <td><a href="<?= WEBROOT . "/?controller=dette&action=detail" ?>">Detail</a></td>
            </tr>
        </tbody>
    </table>
    <div class="container d-flex align-item-center justify-content-end " id="pagination">
        <ul class="pagination mt-2 " id="paginationDemande">
            <li class="page-item"><a class="page-link" href="#">precedent</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">suivant</a></li>
        </ul>
    </div>
</div>