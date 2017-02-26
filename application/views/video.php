<section>
    <?php echo $video->title; ?>
    <iframe width="420" height="315"
            src="<?php echo $video->url; ?>">
    </iframe>

    <?php foreach ($comments as $comment) : ?>
        <div>
            <?php echo $comment->comment; ?>
            <span><?php echo anchor('site/index/' . $video->id . '/' . $comment->id, 'Edit'); ?></span>
            <span><?php echo anchor('site/deleteComment/' . $comment->id . '/' . $comment->video_id, 'Delete'); ?></span>
        <?php endforeach ?>

    </div>
    <form method="post" action="#">
        <textarea name='comment' rows="10" cols="50"><?php echo isset($editComment) ? $editComment : 'Submit a comment!'; ?></textarea>
        <input type="submit" value="Submit">
    </form>
</section>