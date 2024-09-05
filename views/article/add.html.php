<div class="container mt-2 d-flex">
    <a href="<?= WEBROOT . "/?controller=article&action=liste" ?>"><span class="material-symbols-outlined">
            reply_all
        </span> </a>
    <h5 class="mx-2 ">Ajout article</h5>
</div>
<div class="container p-2 border col-10 mt-5 shadow d-flex justify-content-around">
    <form class=" col-11" method="post" action="" enctype="multipart/form-data" >
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-12 ">
                <label for="">Article:</label>
                <input type="text" class="form-control <?= isset($errors['libelle']) ? "is-invalid" : "" ?>" 
                id="nameInput" value="<?=(!isset($errors['libelle'])) ? $_POST['libelle']??'':'' ?>" name="libelle" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['libelle'] ?? "" ?></div>
            </div>
        </div>
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-12 ">
                <label for="">Prix Unitaire:</label>
                <input type="text" class="form-control <?= isset($errors['prixunitaire']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['prixunitaire'])) ? $_POST['prixunitaire']??'':'' ?>" name="prixunitaire" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['prixunitaire'] ?? "" ?></div>

            </div>
        </div>
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-12 mb-5">
                <label for="">Quantite Stock:</label>
                <input type="text" class="form-control <?= isset($errors['qtestock']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['qtestock'])) ? $_POST['qtestock']??'':'' ?>" name="qtestock" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['qtestock'] ?? "" ?></div>
            </div>
        </div>
        <input type="hidden" name="controller" value="article">
        <input type="hidden" name="action" value="add">
            <button class=" border border-0 bntAddClient mb-5 d-flex align-item-center justify-content-around  p-2"
                type="submit" name="enregistrer" action="">Enregistrer</button>
    </form>
</div>

