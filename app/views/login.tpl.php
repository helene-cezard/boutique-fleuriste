<form action="" method="POST" class="signup-form">
    <div class="email field">
        <label for="email">Entrez votre adresse e-mail</label>
        <input type="email" name="email" id="email" required>
        <?php if (!empty($errorsList['email'])) : ?>
            <p class="error"><?= $errorsList['email'] ?></p>
        <?php endif ?>
    </div>
    <div class="password field">
        <label for="password">Entrez votre mot de passe</label>
        <input type="password" name="password" id="password">
        <?php if (!empty($errorsList['password'])) : ?>
            <p class="error"><?= $errorsList['password'] ?></p>
        <?php endif ?>
    </div>
    <button class="field" type="submit">Envoyer</button>
</form>