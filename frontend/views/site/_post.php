<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="thumbnail">
    <div class="caption">
        <?php if(!empty($model->photo)): ?>
            <img src="<?= $model->photo ?>" width="100%" height="auto">
        <?php endif; ?>
        <br /><br />
        <p><?= HtmlPurifier::process($model->body) ?></p>
        <b>Теги: </b><?= $model->getTagValues() ?>
    </div>
</div>