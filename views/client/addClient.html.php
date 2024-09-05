<div class="container mt-2 d-flex">
    <a href="<?= WEBROOT . "/?controller=client&action=liste" ?>"><span class="material-symbols-outlined">
            reply_all
        </span> </a>
    <h5 class="mx-2 ">Ajout client</h5>
</div>
<div class="container p-2 border col-10 mt-5 shadow d-flex justify-content-around">
    <form class=" col-11" method="post" action="" enctype="multipart/form-data" >
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-5">
                <label for="">Prenom:</label>
                <input type="text" class="form-control <?= isset($errors['prenom']) ? "is-invalid" : "" ?>" 
                id="nameInput" value="<?=(!isset($errors['prenom'])) ? $_POST['prenom']??'':'' ?>" name="prenom" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['prenom'] ?? "" ?></div>
            </div>
            <div class="col-5">
                <label for="">Nom</label>
                <input type="text" class="form-control <?= isset($errors['nom']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['nom'])) ? $_POST['nom']??'':'' ?>" name="nom" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['nom'] ?? "" ?></div>
            </div>
        </div>
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-5">
                <label for="">Adresse:</label>
                <input type="text" class="form-control <?= isset($errors['adresse']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['adresse'])) ? $_POST['adresse']??'':'' ?>" name="adresse" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['adresse'] ?? "" ?></div>
            </div>
            <div class="col-5">
                <label for="">Email</label>
                <input type="text" class="form-control <?= isset($errors['email']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['email'])) ? $_POST['email']??'':'' ?>" name="email" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['email'] ?? "" ?></div>

            </div>
        </div>
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-5">
                <label for="">Mot de passe:</label>
                <input type="password" class="form-control <?= isset($errors['pwd']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['pwd'])) ? $_POST['pwd']??'':'' ?>" name="pwd" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['pwd'] ?? "" ?></div>
            </div>
            <div class="col-5">
                <label for="">Photo</label>
                <input type="file" class="form-control <?= isset($errors['photo']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="" name="photo" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['photo'] ?? "" ?></div>
            </div>
        </div>
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4  mx-2">
            <div class="col-5">
                <label for="">Telephone:</label>
                <input type="text" class="form-control <?= isset($errors['tel']) ? "is-invalid" : "" ?>"
                 id="nameInput" value="<?=(!isset($errors['tel'])) ? $_POST['tel']??'':'' ?>" name="tel" placeholder="">
                <div id="username_error" class="invalid-feedback"><?= $errors['tel'] ?? "" ?></div>
            </div>
            <div class="col-5">
                <label for="">Categorie:</label>
                <select id="categorie" class="cat-select <?= isset($errors['categorie']) ? "is-invalid" : "" ?>"
                   name="categorie">
                    <option selected value=""></option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie->libelle ?>" <?= isset($_POST['categorie']) && $_POST['categorie'] == $categorie->libelle ? 'selected' : '' ?>><?= $categorie->libelle ?></option>
                    <?php endforeach ?>
                </select>
                <div id="username_error" class="invalid-feedback"><?= $errors['categorie'] ?? "" ?></div>
            </div>
        </div>
        <div class="col-md-11 d-flex align-items-center justify-content-between mt-4 mb-4  mx-2">
            <div class="col-5">
                <label for="">Compte:</label>
                <input type="text" id="compte" class="form-control" id="nameInput" value="" name="compte" disabled  placeholder="">
            </div>
            <div class="col-5">
                <label for="">Montant seuil</label>
                <input type="text" id="seuil" class="form-control" id="nameInput" value="" name="seuil" disabled  placeholder="">
            </div>
        </div>
        <input type="hidden" name="controller" value="client">
        <input type="hidden" name="action" value="add">
            <button class=" border border-0 bntAddClient mb-5 d-flex align-item-center justify-content-around  p-2"
                type="submit" name="enregistrer" action="">Enregistrer</button>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorieSelect = document.getElementById('categorie');
    const compteInput = document.getElementById('compte');
    const seuilInput = document.getElementById('seuil');

    function toggleInputs() {
        const selectedValue = categorieSelect.value;

        if (selectedValue === 'nouveau') {  
            compteInput.setAttribute('disabled', 'disabled');
            seuilInput.setAttribute('disabled', 'disabled');
            compteInput.value = ''; 
            seuilInput.value = '';
        } else if (selectedValue === 'solvable') {  
            compteInput.removeAttribute('disabled');
            seuilInput.removeAttribute('disabled');
            if (compteInput.value === '') {
                compteInput.value = '0';
            }
        } else {
            compteInput.setAttribute('disabled', 'disabled');
            seuilInput.setAttribute('disabled', 'disabled');
            compteInput.value = '';
            seuilInput.value = '';
        }
    }

    toggleInputs();

    categorieSelect.addEventListener('change', toggleInputs);
});
</script>
