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
        <?php echo $role === 'A' ? '<button class="nav-menu" data-bs-toggle="modal" data-bs-target="#addModal" ><mark class="komentar-mark">Buat</mark></button>' : '' ?>
        <?php echo $isLoggedIn ? '<button id="logout" class="nav-menu"><mark class="komentar-mark">Keluar</mark></button>' : '<a href="/masuk" class="nav-menu"><mark class="komentar-mark">Masuk</mark></a>';?>
    </nav>
    <main>

        <?php
          foreach ($artikels as $artikel):
        ?>
        <div class="artikel-container">
            <h1>
                <a href="/artikel?aid=<?php echo $artikel['aid'];?>">
                    <mark class="judul-mark"><?php echo $artikel['judul'];?></mark>
                </a>
            </h1>
            <div class="tulisan">
              <?php echo $artikel['isi'];?>
            </div>

            <?php
              if($role === 'A'){
                echo '<div class="edit-container">';
                echo '<a href="/deleteartikel?aid='.$artikel['aid'].'" ><mark class="komentar-mark">Hapus</mark></a>';
                echo '<a data-bs-toggle="modal" data-bs-target="#editModal'.$artikel['aid'].'"><mark class="komentar-mark">Edit</mark></a>';
                echo '</div>';
              }
            ?>

            <a href="/artikel?aid=<?php echo $artikel['aid'];?>"><mark class="komentar-mark">Komentar disini</mark></a>
            <hr>
        </div>
        <?php
          endforeach;
        ?>
    </main>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Artikel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/insertartikel" method="post">
            <div class="form-control">
                <label for="username">Judul</label>
                <input type="text" name="judul" id="username">
            </div>
            <div class="form-control">
                <label for="password">Isi</label>
                <textarea id="mytextarea" name="isi"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  foreach ($artikels as $artikel):
?>
<div class="modal fade" id="editModal<?php echo $artikel['aid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Artikel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/editartikel?aid=<?php echo $artikel['aid'];?>" method="post">
            <div class="form-control">
                <label for="username">Judul</label>
                <input type="text" name="judul" id="username" value="<?php echo $artikel['judul'];?>">
            </div>
            <div class="form-control">
                <label for="password">Isi</label>
                <textarea id="mytextarea" name="isi"><?php echo $artikel['isi'];?></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  endforeach;
?>

<script>
    const button = document.getElementById('home');
    button.addEventListener('click', function(){
        window.location.href = '/';
    });

    const buttonLG = document.getElementById('logout');
    buttonLG.addEventListener('click', function(){
        window.location.href = '/keluar';
    });

    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating', 
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      height: 500,
    })
</script>

</body>
</html>
