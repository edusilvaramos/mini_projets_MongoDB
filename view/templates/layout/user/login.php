<img id="backgroundMotif" alt="background motif" src="assets/SVG/background.svg" />
<section class="main signupLoginForm">
    <img src="assets/SVG/logo_filled.svg" alt="logo" />
    <h1>Login into your account</h1>
    <form action="index.php?ctrl=user&action=loginForm" method="post">
        <label for="email">Username or Email</label></br>
        <input type="text" name="email" id="email" placeholder="Type your username or email" /></br>
        <label for="passwordHash">Password</label></br>
        <input type="password" name="passwordHash" id="passwordHash" placeholder="Type your password" /></br>
        <div>
        <a class="button secondaryButton" href="index.php?ctrl=user&action=createUser">Don't have an account? Create one here</a>
            <button class="button primaryButton" type="submit">Login</a></button>
        </div>
    </form>
</section>
