<section class="vh-100 ">
    <div class="container py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <form class="p-4 text-center " action="<?= WEBROOT ?>" method="post">
                        <div class="cercle-login">
                        </div>
                        <h3 class=" mt-2">Connexion</h3>
                        <?php if (isset($errors['connect'])): ?>
                            <div class="alert alert-danger my-1" role="alert">
                                <?= $errors['connect'] ?? "" ?>
                            </div>
                        <?php endif ?>
                        <div class="">
                            <label for="exampleInputEmail1" class="form-label labelemail <?= isset($errors['email']) ? 'is-invalid' : '' ?>">Email </label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" name="email">
                                <div id="email-error" class="invalid-feedback"><?= $errors['email'] ?? "" ?></div>
                        </div>
                        <div class="">
                            <label for="exampleInputEmail1" class="form-label labelLogin <?= isset($errors['pwd']) ? 'is-invalid' : '' ?>">Mot de passe</label>
                            <input type="password" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" name="pwd">
                            <div id="email-error" class="invalid-feedback"><?= $errors['pwd'] ?? "" ?></div>
                        </div>
                        <input type="hidden" name="controller" value="login">
                        <input type="hidden" name="action" value="login">
                        <button type="submit" name="connect" class=" border border-none btnLogin mt-5 px-4 py-2 col-12"
                            id="loginBtn">Se
                            connecter</button>
                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>