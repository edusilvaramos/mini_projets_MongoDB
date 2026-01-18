
    <img id="backgroundMotif" alt="background motif" src="assets/SVG/background.svg" />
    <section class="main signupLoginForm">
        <img src="assets/SVG/logo_filled.svg" alt="logo" />
        <h1>Login into your account</h1>
        <form action="/login" method="post">
            <label for="email">Username or Email</label></br>
            <input type="text" name="email" id="username" placeholder="Your username or email here" /></br>
            <label for="lastName">Password</label></br>
            <input type="password" name="password" id="password" placeholder="Type your password" /></br>
            <div>
                <a href="index.php?ctrl=user&action=createUser">
                    <button type="button" class="button secondaryButton">Don't have an account? Create one here</button>
                </a>
                
                <button class="button primaryButton">Login</button>
            </div>
        </form>
    </section>
