<form action="index.php?ctrl=comments&action=create" method="POST">
    <input type="hidden" name="postId" value="<?= htmlspecialchars((is_array($post['_id'] ?? null) && isset($post['_id']['$oid'])) ? (string) $post['_id']['$oid'] : (string) ($post['_id'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <label for="content">Text Content</label></br>
    <textarea class="button tertiaryButton textarea" id="content" name="content" rows="5" cols="40" placeholder="Type your content here..."></textarea>
    <div class="flex flexEnd">
        <button type="submit" class="button primaryButton largeButton">Comment</button>
    </div>
</form>
