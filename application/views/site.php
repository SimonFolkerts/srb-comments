<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section>
    <?php foreach ($contents as $video) : ?>
    <div><?php echo $video->title; ?><span><?php echo anchor('site/index/' . $video->id, 'Link to Video Page ' . $video->id); ?></span></div>
    <?php endforeach ?>
    
</section>

</body>
</html>