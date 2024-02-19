<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Connexion et d'inscription</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Formulaire de connexion</div>
      <div class="title signup">Formulaire d'inscription</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Connexion</label>
        <label for="signup" class="slide signup">Inscription</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">
        <form action="sign_in.php" method="post" class="login">
          <div class="field">
            <input type="text" placeholder="Adresse e-mail" name="username" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Mot de passe" name="password" required>
          </div>
          
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Connexion">
          </div>
          <div class="signup-link">Pas un membre? <a href="#">S'inscrire maintenant</a></div>
        </form>
        <form action="sign_up.php" method="post" class="signup">
          <div class="field">
            <input type="text" placeholder="Adresse e-mail" name="username" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Mot de passe" name="password" required>
          </div>
          <div class="field">
            <input type="password" placeholder="Confirmez le mot de passe" name="confirmpassword" required>
          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="S'inscrire">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="./script.js"></script>
</body>
</html>
