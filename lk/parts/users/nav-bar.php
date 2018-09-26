<header>

  <nav id="menu" class="navbar fixed-top navbar-expand-lg navbar-dark black scrolling-navbar">
      <a class="navbar-brand" href="https://vk.com/aleksei_khamidov"><strong>AMOBIRD</strong></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
              <?php if ($userdata[ 'leasing'] ) { ?>
             <li class="nav-item ">
                  <a class="nav-link" href="index.php" id="navbarDropdownMenuLink" >
                    Потребительский кредит
                  </a>
              </li>
             <?php } ?>
               <li class="nav-item ">
                  <a class="nav-link" href="logout.php" id="navbarDropdownMenuLink" >
                     <?php echo "{$userdata['user_login']}"; ?> (Выйти)
                  </a>
              </li>
          </ul>

      </div>
  </nav>
</header>
