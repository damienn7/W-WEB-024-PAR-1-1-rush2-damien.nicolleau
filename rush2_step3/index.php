<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipo</title>
</head>

<body>

    <!-- Header main -->
    <header>
        <nav>
            <h1>Zipo</h1>
            <ul>
                <li><a href="#" class="link">Accueil</a></li>
                <li><a href="index.html" class="link">Inscription</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <main>
        <div class="main-container">
            <div class="container">
                <div class="container-title">
                    <h2 class="title">Welcome to Zipo :)</h2>
                    <p class="text">Hébergez tous vos fichers sur Zipo !</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Section main -->
    <section>
        <div class="main-sub-container"></div>
        <form name="myForm" onsubmit="return validateForm()">
            <!-- séparation -->
            <div class="input">
                <label for="namefile" class="name">Nom de l'archive :</label>
                <input type="text" name="nameFile" id="nameFile" placeholder="Nom de l'archive..." required>
            </div>

<!-- séparation -->
            <div class="container-rectangle">
                <div class="rectangle">
                    <h3 class="title-rectangle">Ajouter un fichier</h3>
                    <input type="file" name="fileName" id="fileName">
                </div>
            </div>
            <!-- séparation -->
            <form action="index.php" method="post">
            <div class="button-section">
                <div class="btn">
                    <button class="button-design" onclick="btnOne">Générer un fichier tar</button>
                </div>

                <div class="btn">
                    <button class="button-design" onclick="btnTwo">Télécharger l'archive</button>
                </div>
            </div>
            </form>
            <!-- séparation -->
            <?php if(isset($_POST["FILE"])):?>
                
            <div class="sub-carre">
                <div class="carre">
                    <div class="sub-trait">
                    <?php foreach($_POST["FILE"] as $name):?>
                    <?php echo "<div class=\"trait\">".$name."</div>";?>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            </div>
        </form>
    </section>

</body>
<script src="script.js" type="text/javascript"></script>

</html>