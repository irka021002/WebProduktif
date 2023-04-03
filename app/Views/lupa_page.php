<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="/css/auth.css">
    <title>Lupa Password</title>
</head>
<body>
    <main>
        <form action="/lupa" method="post">
            <p class="error"><?php echo session()->getFlashdata("status") ? session()->getFlashdata("status") : ""; ?></p>
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-control">
                <button type="submit">Lupa</button>
            </div>
        </form>
    </main>
</body>
</html>