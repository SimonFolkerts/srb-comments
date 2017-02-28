<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="cont">
    <div id="sect">
        <section>
            <?php foreach ($contents as $video) : ?>
                <a href="<?php echo 'index.php/site/index/' . $video->id; ?>">
                    <div class="card">
                        <div class="video">
                        </div>

                        <span>
                            <?php echo $video->title; ?>
                        </span>
                    </div>
                </a>
            <?php endforeach ?>
        </section>
    </div>
</div>
</body>
</html>
