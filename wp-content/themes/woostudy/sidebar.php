<?php
if (!is_active_sidebar('sidebar-1')) { // если сайдбар не активен, то завершаем дальнейшее выполнение
    return;
}
?>


<div class="col-lg-3 col-md-4 woostudy-sidebar">
    <?php dynamic_sidebar('sidebar-1') ?>
</div>