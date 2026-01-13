<form action="index.php?ctrl=post&action=add" method="post">
    <label for="title">Title</label></br>
    <input type="text" name="title" id="title" placeholder="Post title"  /></br>
    <label for="contenu">Content</label></br>
    <!-- <input type="text" name="content" id="content" placeholder="Write here"  /></br> -->
    <textarea name="content" id="content" rows="15" cols="100" placeholder="Write here"></textarea></br>
    
    <label for="category">Category</label></br>
    <select name="category" id="category">
        <option value="announcement">announcement</option>
        <option value="backend">backend</option>
        <option value="frontend">frontend</option>
        <option value="offtopic">offtopic</option>
        <option value="devops">devops</option>
        <option value="feedback">feedback</option>
    </select>
    <div class="flex flexEnd">
        <button type="button" class="button tertiaryButton largeButton">Save Draft</button>
        <button type="submit" class="button primaryButton largeButton">Post</button>
    </div>
</form>