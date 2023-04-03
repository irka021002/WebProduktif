<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/tulisan.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;600;700&display=swap"
        rel="stylesheet"
    >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js" integrity="sha512-tbXTHOY9yg3iMu7/maK4/riWonAxPpblIf5liooEUo7U39WDMITQDTcA++6Y/SPcsTqLfZfK07Wb0am09Urrjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Tulisanku | kamal.irka</title>
</head>
<body>
    <nav>
        <button id="home" class="nav-menu"><mark class="komentar-mark">Hallo</mark></button>
        <?php echo $isLoggedIn ? '<button id="logout" class="nav-menu"><mark class="komentar-mark">Keluar</mark></button>' : '<a href="/masuk" class="nav-menu"><mark class="komentar-mark">Masuk</mark></a>';?>
    </nav>
    <main>
        <div class="artikel-container">
            <h1>
                <a href="/artikel?id=2">
                    <mark class="judul-mark"><?php echo $judul; ?></mark>
                </a>
            </h1>
            <div class="tulisan">
                <?php echo $isi; ?>
            </div>
        </div>
        <div class="komentar-container">
            <?php foreach ($komentar as $k) : ?>
                <div class="komentar">
                    <h2 class="username">
                        <?php echo $k['username']; ?>
                    </h2>
                    <p class="isi-komentar">
                        <?php echo $k['komentar']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
            <?php
                if($isLoggedIn){
            ?>
                    <div class="komentar">
                        <form class="form-komentar" action="/insertkomentar?aid=<?php echo $aid; ?>" method="post">
                            <div class="form-control input-komentar">
                                <textarea name="komentar" id="" cols="5"></textarea>
                            </div>
                            <div class="form-control input-komentar">
                                <button class="komentar-kirim" type="submit">
                                    Kirim
                                </button>
                            </div>
                        </form>
                    </div>
            <?php
                }
            ?>
        </div>
    </main>

    <script>
    const button = document.getElementById('home');
    button.addEventListener('click', function(){
        window.location.href = '/';
    });

    const buttonLG = document.getElementById('logout');
    buttonLG.addEventListener('click', function(){
        window.location.href = '/keluar';
    });
    </script>
</body>
</html>
