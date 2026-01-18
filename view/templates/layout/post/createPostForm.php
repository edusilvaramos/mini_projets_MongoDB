<form action="index.php?ctrl=post&action=add" method="post">
    <label for="title">Title</label></br>
    <input class="button tertiaryButton textarea" type="text" name="title" id="title" placeholder="Post title"  /></br>
    <label for="contenu">Content</label></br>
    <!-- <input type="text" name="content" id="content" placeholder="Write here"  /></br> -->
    <textarea class="button tertiaryButton textarea" name="content" id="content" rows="15" placeholder="Write here"></textarea></br>
    
    <label for="category">Category</label></br>
    <select class="button tertiaryButton textarea" name="category" id="category">
        <option value="announcement">announcement</option>
        <option value="backend">backend</option>
        <option value="frontend">frontend</option>
        <option value="offtopic">offtopic</option>
        <option value="devops">devops</option>
        <option value="feedback">feedback</option>
    </select>
    <div class="flex flexEnd">
        <button type="submit" class="button primaryButton largeButton">Post</button>
    </div>
</form>