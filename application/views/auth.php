<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo validation_errors(); ?>
<form action="#" method="post">
    Email:<br>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
    Password:<br>
    <input type="text" name="password" value="<?php echo set_value('password'); ?>"><br>
    <input type="submit" value="Submit">
</form>