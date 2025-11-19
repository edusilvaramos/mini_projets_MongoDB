<title>Sign Up | PteroTalk Forum</title>

<img id="backgroundMotif" alt="background motif" src="assets/SVG/background.svg" />
<section class="main signupLoginForm formSpace">
    <img src="assets/SVG/logo_filled.svg" alt="logo" />
    <h1>Create your account</h1>
    <form action="index.php?ctrl=user&action=newUser" method="post">
        <label for="firstName">First Name</label></br>
        <input type="text" name="firstName" id="firstName" placeholder="Your name here" /></br>
        <label for="lastName">Last Name</label></br>
        <input type="text" name="lastName" id="lastName" placeholder="Your last name here" /></br>
        <label for="userName">userName</label></br>
        <input type="text" name="userName" id="userName" placeholder="Create a unique userName" /></br>
        <label for="email">Email</label></br>
        <input type="text" name="email" id="email" placeholder="Your name here" /></br>
        <label for="password">Password</label></br>
        <input type="text" name="password" id="password" placeholder="Your name here" /></br>
        <button class="button primaryButton" id="buttonExtend">Sign up</button></br>
    </form>
</section>