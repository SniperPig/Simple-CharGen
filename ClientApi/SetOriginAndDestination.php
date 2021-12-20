
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
        }

        body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    </head>

    <body class="text-center">
        <main class="form-signin">
            <form action="/ClientApi/DisplayRoute.php" method="post">
                <img class="mb-4" src="arrows-alt-solid.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please enter Locations</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Origin" name="origin">
                    <label for="floatingInput">Origin</label>
                </div>
                
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Destination" name="destination">
                    <label for="floatingPassword">Destination</label>
                </div>

                <div class="checkbox mb-3">
                    
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit" name="SubmitGetDirection">Get Directions</button>
                <p class="mt-5 mb-3 text-muted">&copy; WarPigs 2021–2021</p>

                <?php
                if(isset($_POST["SubmitGetDirection"])) {
                    if(isset($_POST["origin"])) {
                        var_dump($_POST["origin"]);
                        if(isset($_POST["destination"])) {
                            var_dump($_POST["destination"]);
                        }
                    }
                }
                ?>
            </form>
        </main>
    </body>
</html>



<!-- 
<form action="/test/Display Route.php" method="post">
Enter origin location :<input type="text" name="origin"><br/>
Enter destination :<input type="text" name="destination"><br/>
<input type="submit" value="Get Directions" name="SubmitGetDirection"><br/><br/>



</form>
</body>
</html> -->