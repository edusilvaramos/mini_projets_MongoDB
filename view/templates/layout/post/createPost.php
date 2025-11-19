<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/projet/assets/styles/reset.css" rel="stylesheet" />
    <link href="/projet/assets/styles/styles.css" rel="stylesheet" />
    <link href="/projet/assets/styles/typo.css" rel="stylesheet" />

    <title>Create a Post | PteroTalk Forum</title>
</head>
<body class="gridBody">
    <nav>
        <div>
            <img class="logo" alt="logo" src="/projet/assets/SVG/logo.svg" />
            <h1>PteroTalk Forum</h1>
        </div>
        <div>
            <button class="button secondaryButton">Sign-up</button>
            <button class="button primaryButton">Login</button>
        </div>
    </nav>
    <section class="main">
        <div class="">
            <h2>Create Post</h2>
            <?php include __DIR__ . "/components/createPostForm.php";?>
    </section>
    <aside>
        <section>
            <h2>Your Posts</h2>
            <div class="postsContainer">
            <?php include __DIR__ . "/components/yourPosts.php";?>
            </div>
        </section>
        <section>
            <h2>Recent Online Users</h2>
            <div class="flex recentOnlineUsers">
                <?php include __DIR__ . "/components/onlineUsers.php";?>
                <?php include __DIR__ . "/components/onlineUsers.php";?>
            </div>
        </section>
    </aside>
</body>
</html>