<h2 class="section-title"><?= empty($user->getId()) ? 'Créez votre compte' : 'Modifiez votre compte' ?></h2>
<?= isset($_GET['accountModified']) ? '<p class="accountModified">Votre compte a bien été modifié</p>' : '' ?>
<form action="" method="POST" class="signup-form">
    <div class="firstname field">
        <label for="firstname"><?= empty($user->getId()) ? 'Entrez votre prénom' : 'Nouveau prénom' ?></label>
        <input type="text" name="firstname" id="firstname" value="<?= $user->getFirstname() ?>" required>
        <?php if (!empty($errorsList['firstname'])) : ?>
            <p class="error"><?= $errorsList['firstname'] ?></p>
        <?php endif ?>
    </div>
    <div class="lastname field">
        <label for="lastname"><?= empty($user->getId()) ? 'Entrez votre nom' : 'Nouveau nom' ?></label>
        <input type="text" name="lastname" id="lastname" value="<?= $user->getLastname() ?>" required>
        <?php if (!empty($errorsList['lastname'])) : ?>
            <p class="error"><?= $errorsList['lastname'] ?></p>
        <?php endif ?>
    </div>
    <div class="email field">
        <label for="email"><?= empty($user->getId()) ? 'Entrez votre adresse e-mail' : 'Nouvelle adresse e-mail' ?></label>
        <input type="email" name="email" id="email" value="<?= $user->getEmail() ?>" required>
        <?php if (!empty($errorsList['email'])) : ?>
            <p class="error"><?= $errorsList['email'] ?></p>
        <?php endif ?>
    </div>
    <div class="password field">
        <label for="password"><?= empty($user->getId()) ? 'Choisissez un mot de passe' : 'Nouveau mot de passe' ?></label>
        <input type="password" name="password" id="password">
        <?php if (!empty($errorsList['password'])) : ?>
            <p class="error"><?= $errorsList['password'] ?></p>
        <?php endif ?>
    </div>
    <button class="field" type="submit">Envoyer</button>
</form>