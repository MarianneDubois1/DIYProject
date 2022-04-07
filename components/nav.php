<nav>
  <div class="nav">
       <img src="./assets/D.png" alt="logo">
    <div>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="categorie.php">Catégorie</a> </li>
        <li><a href="profil.php">Mon Compte</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="/logout.php">Se Deconnecter</a></li>
        <!--Pour l'admin-->
        <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === '["ROLE_ADMIN"]') : ?>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:3000/admin.php">Dashboard</a>
        </li>
      <?php endif ?>
      </ul>
    </div>
  </div>
</nav>