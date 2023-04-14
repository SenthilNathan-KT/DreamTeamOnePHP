<?php
    require_once("./functions.inc.php");
    $errors=[];
    if($_SERVER["REQUEST_METHOD"]=="POST")
      {
        var_dump($_FILES);
        echo '<br>';
        
        $fileinfo=finfo_open(FILEINFO_MIME_TYPE);
        $fileType=finfo_file($fileinfo,$_FILES['pic1']['tmp_name']);
        echo $fileType.'<br>';
        
        if(in_array($fileType,['image/jpeg','image/png'])) {
          $ext=explode('/',$fileType)[1];
          $uniqId = uniqid('upload_',true);
          $fileNamewithExtension = $uniqId . "." . $ext;
          $newFileName='../images/' . $fileNamewithExtension;
          move_uploaded_file($_FILES['pic1']['tmp_name'],$newFileName);
          echo '<h3>Image saved.</h3>';
          echo '<a href="'.$newFileName.'" target="_blank">New Image</a><br>';
        } else {
            echo '<h3>Unsupported file type.</h3>';
        }
        if(empty($_POST["email"]))
        {
            $errors[]="<h3>Please enter a valid email.</h3>";
        }
        else if(empty($_POST["password"]))
        {
            $errors[]="<h3>Please enter a password.</h3>";
        }
        else
        {
            echo $newFileName;
            $result = signup($_POST["firstName"], $_POST["lastName"],$_POST["email"], $_POST["password"], $fileNamewithExtension);
            if($result) {
              header("Location: login.php");
            } else {
                echo "Login Unsuccessfull";
            }
        }
      }
?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in example • Pico.css</title>
    <meta name="description" content="A minimalist layout for Login pages. Built with Pico CSS.">
    <link rel="shortcut icon" href="https://picocss.com/favicon.ico">
    <link rel="canonical" href="https://picocss.com/examples/sign-in/">

    <!-- Pico.css -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">

    <!-- Custom styles for this example -->
    <link rel="stylesheet" href="custom.css">
  </head>

  <body>

    <!-- Nav -->
    <nav class="container-fluid">
      <ul>
        <li><a href="./" class="contrast" onclick="event.preventDefault()"><strong style="color: white">DONS Badminton Products</strong></a></li>
      </ul>
    </nav><!-- ./ Nav -->

    <!-- Main -->
    <main class="container">
      <article class="grid">
        <div>
          <hgroup>
            <h1>Sign Up</h1>
            <h2></h2>
          </hgroup>
          <form method="POST"  enctype='multipart/form-data'>
            <input type="text" class="signInInputBox" name="firstName" placeholder="First Name" aria-label="First Name" autocomplete="nickname">
            <input type="text" class="signInInputBox" name="lastName" placeholder="Last Name" aria-label="Last Name" autocomplete="nickname">
            <input type="text" class="signInInputBox" name="email" placeholder="Login" aria-label="Login" autocomplete="nickname">
            <input type="password" class="signInInputBox" name="password" placeholder="Password" aria-label="Password" autocomplete="current-password">
              <input type='file' name='pic1'>
            <fieldset>
              <label class="remember" for="remember">
                Alreay a User? <a href='http://localhost/PHP/DreamTeamOnePHP/app/login.php'>Sign in</a>
              </label>
            </fieldset>
            <button type="submit" class="contrast loginButton">Sign up</button>
          </form>
        </div>
        <div></div>
      </article>
    </main><!-- ./ Main -->

    <!-- Footer -->
    <!-- <footer class="container-fluid">
      <small>Built with <a href="https://picocss.com" class="secondary">Pico</a> • <a href="https://github.com/picocss/examples/tree/master/sign-in/" class="secondary">Source code</a></small>
    </footer> -->
    <!-- ./ Footer -->

    <!-- Minimal theme switcher -->
    <script src="../js/minimal-theme-switcher.js"></script>

  </body>
  <style>
    /* Grid */
body > main {
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-height: calc(100vh - 7rem);
  padding: 1rem 0;
}

article {
  padding: 0;
  overflow: hidden;
}

article div {
  padding: 1rem;
}

@media (min-width: 576px) {
  body > main {
    padding: 1.25rem 0;
  }

  article div {
    padding: 1.25rem;
  }
}

@media (min-width: 768px) {
  body > main {
    padding: 1.5rem 0;
  }

  article div {
    padding: 1.5rem;
  }
}

@media (min-width: 992px) {
  body > main {
    padding: 1.75rem 0;
  }

  article div {
    padding: 1.75rem;
  }
}

@media (min-width: 1200px) {
  body > main {
    padding: 2rem 0;
  }

  article div {
    padding: 2rem;
  }
}

/* Nav */
summary[role="link"].secondary:is([aria-current],:hover,:active,:focus) {
  background-color: transparent;
  color: var(--secondary-hover);
}

/* Hero Image */
article div:nth-of-type(2) {
  display: none;
  background-color: #374956;
  background-image: url("../images/Signin Page Image PHP.jpg");
  background-position: center;
  background-size: cover;
}

@media (min-width: 992px) {
  .grid > div:nth-of-type(2) {
    display: block;
  }
}

/* Footer */
body > footer {
  padding: 1rem 0;
}

h1 {
    color: hsl(205deg, 20%, 94%);
}
.headings>:last-child, hgroup>:last-child {
    color: hsl(205deg, 10%, 50%);
}
body {
    background-color: #11191f;
}
.grid {
    background-color: #141e26;
}
.remember {
    color: hsl(205deg, 16%, 77%);
}
.loginButton {
    background-color: hsl(205deg, 20%, 94%);
    color: #000;
}
.signInInputBox {
    background-color: #11191f;
}
  </style>

</html>