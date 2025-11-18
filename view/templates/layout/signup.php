<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/projet/assets/styles/reset.css" rel="stylesheet" />
    <link href="/projet/assets/styles/styles.css" rel="stylesheet" />
    <link href="/projet/assets/styles/typo.css" rel="stylesheet" />

    <title>Sign Up | PteroTalk Forum</title>
</head>
<body>
    <?php include './components/nav.php'?>
    <img id="backgroundMotif" alt="background motif" src="/projet/assets/SVG/background.svg" />
    <section class="main signupLoginForm formSpace">
        <img src="/projet/assets/SVG/logo_filled.svg" />
        <h1>Create your account</h1>
        <form>
            <label for="firstName">First Name</label></br>
            <input type="text" name="firstName" id="firstName" placeholder="Your name here"  /></br>
            <label for="lastName">Last Name</label></br>
            <input type="text" name="lastName" id="lastName" placeholder="Your last name here"  /></br>
            <label for="username">Username</label></br>
            <input type="text" name="username" id="username" placeholder="Create a unique username"  /></br>
                <label for="email">Email</label></br>
                <input type="text" name="email" id="email" placeholder="Your name here"  /></br>
                <label for="password">Password</label></br>
                <input type="text" name="password" id="password" placeholder="Your name here"  /></br>
                <button class="button primaryButton" id="buttonExtend">Sign up</button></br>
        </form>
    </section>
    
</body>
</html>