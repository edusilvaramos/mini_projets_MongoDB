<img id="backgroundMotif" alt="background motif" src="assets/SVG/background.svg" />
<section class="main signupLoginForm">
    <img src="assets/SVG/logo_filled.svg" alt="logo" />
    <h1>Login into your account</h1>
    <form action="index.php?ctrl=user&action=loginForm" method="post">
        <label for="email">Username or Email</label></br>
        <input type="text" name="email" id="email" placeholder="Your username or email here" /></br>
        <label type="text" for="passwordHash">Password</label></br>
        <input type="password" name="passwordHash" id="passwordHash" placeholder="Type your password" /></br>
        <div>
            <button class="button secondaryButton" action="index.php?ctrl=user&action=createUser"><a href="index.php?ctrl=user&action=createUser">Don't have an account? Create one here </a></button>

            <button class="button primaryButton">Login</button>
        </div>
    </form>
</section>