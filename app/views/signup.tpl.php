<form action="" method="POST" class="signup-form">
    <div class="firstname field">
        <label for="firstname">Entrez votre prénom</label>
        <input type="text" name="firstname" id="firstname" required>
        <?php if (!empty($errorsList['firstname'])) : ?>
            <p class="error"><?= $errorsList['firstname'] ?></p>
        <?php endif ?>
    </div>
    <div class="lastname field">
        <label for="lastname">Entrez votre nom</label>
        <input type="text" name="lastname" id="lastname" required>
        <?php if (!empty($errorsList['lastname'])) : ?>
            <p class="error"><?= $errorsList['lastname'] ?></p>
        <?php endif ?>
    </div>
    <div class="email field">
        <label for="email">Entrez votre adresse e-mail</label>
        <input type="email" name="email" id="email" required>
        <?php if (!empty($errorsList['email'])) : ?>
            <p class="error"><?= $errorsList['email'] ?></p>
        <?php endif ?>
    </div>
    <div class="password field">
        <label for="password">Choisissez un mot de passe</label>
        <input type="password" name="password" id="password">
        <?php if (!empty($errorsList['password'])) : ?>
            <p class="error"><?= $errorsList['password'] ?></p>
        <?php endif ?>
    </div>
    <button class="field" type="submit">Envoyer</button>
</form>