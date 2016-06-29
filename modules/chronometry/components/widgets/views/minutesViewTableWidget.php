<?php

use yii\helpers\Html;

?>

<table class="<?= $table_css_class ?>" id="<?= $table_css_id ?>">
    <tr>
        <th></th>
        <?php for ($minutes = 5; $minutes <= 60; $minutes = $minutes + 5) { ?>
            <th><?= $minutes ?></th>
        <?php } ?>
    </tr>
    <?php for ($hour = 0; $hour <= 23; $hour++) { ?>
        <tr>
            <th><?= $hour ?></th>

            <?php for ($minutes = 5; $minutes <= 60; $minutes = $minutes + 5) { ?>
                <td class="<?= $td_css_class ?>" id="minutesCell_<?= $hour ?>_<?= $minutes ?>">
                    <?= Html::tag(
                        'div',
                        $this->context
                            ->getCodeById($chronometry_items_array->activity_id[$hour][$minutes]),
                        [
                            'class' => 'text',
                            'title' => $chronometry_items_array->note[$hour][$minutes],
                            'data-toggle'=>'tooltip',
                        ]
                    ); ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>