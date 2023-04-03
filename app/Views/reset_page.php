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
    <title>Reset Password</title>
</head>
<body>
    <main>
        <form id="resetForm" action="/reset" method="post">
            <div class="form-control">
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-control">
                <button type="submit">Reset</button>
            </div>
        </form>
    </main>
    <script>
        var form = document.getElementById("resetForm")
        var search = window.location.search
        var uriParams = new URLSearchParams(search)
        form.setAttribute("action", "/reset?email=" + uriParams.get('email'))
    </script>
</body>
</html>