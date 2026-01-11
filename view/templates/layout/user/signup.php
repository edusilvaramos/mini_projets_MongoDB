
<title>Sign Up | PteroTalk Forum</title>
<img id="backgroundMotif" alt="background motif" src="assets/SVG/background.svg" />
<section class="main signupLoginForm formSpace">
    <img src="assets/SVG/logo_filled.svg" alt="logo" />
    <h1><?= isset($user) ? 'Update your profile' : 'Create your account' ?></h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= ($error) ?>
        </div>  
    <?php endif; ?>
    <form action="index.php?ctrl=user&action=<?= isset($user) ? 'update' : 'newUser' ?>" method="post">
        <?php if (isset($user)): ?>
            <input type="hidden" name="id" value="<?= $user->id ?>">
        <?php endif; ?>

        <label for="firstName">First Name</label></br>
        
        <input
            type="text"
            name="firstName"
            id="firstName"
            value="<?= isset($user) ? $user->firstName : '' ?>"
            placeholder="Your name here" /></br>

        <label for="lastName">Last Name</label></br>
        <input
            type="text"
            name="lastName"
            id="lastName"
            value="<?= isset($user) ?  $user->lastName : '' ?>"
            placeholder="Your last name here" /></br>

        <label for="userName">Username</label></br>
        <input
            type="text"
            name="userName"
            id="userName"
            value="<?= isset($user) ?  $user->userName : '' ?>"
            placeholder="Create a unique username" /></br>

        <label for="email">Email</label></br>
        <input
            type="email"
            name="email"
            id="email"
            value="<?= isset($user) ?  $user->email : '' ?>"
            placeholder="Your email here" /></br>

        <?php if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ROLE_ADMIN'): ?>
            <label for="passwordHash">Password</label></br>
            <input
                type="password"
                name="passwordHash"
                id="passwordHash"
                placeholder="<?= isset($user) ? 'Leave blank to keep current password' : 'Choose a strong password' ?>" /></br>
        <?php endif; ?>
        <button class="button primaryButton" id="buttonExtend">
            <?= isset($user) ? 'Update' : 'Sign up' ?>
        </button></br>
    </form>
</section>