<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/projet/assets/styles/reset.css" rel="stylesheet" />
    <link href="/projet/assets/styles/styles.css" rel="stylesheet" />
    <link href="/projet/assets/styles/typo.css" rel="stylesheet" />

    <title>Login | PteroTalk Forum</title>
</head>
<body>
    <?php include './components/nav.php'?>
    <img id="backgroundMotif" alt="background motif" src="/projet/assets/SVG/background.svg" />
    <section class="main signupLoginForm">
        <img src="/projet/assets/SVG/logo_filled.svg" />
        <h1>Login into your account</h1>
        <form>
            <label for="username">Username</label></br>
            <input type="text" name="username" id="username" placeholder="Your username here"  /></br>
            <label for="lastName">Password</label></br>
            <input type="text" name="password" id="password" placeholder="Type your password"  /></br>
            <div>
                <button class="button secondaryButton">Don't have an account? Create one here</button>
                <button class="button primaryButton">Login</button>
            </div>
        </form>
    </section>
    
</body>
</html>