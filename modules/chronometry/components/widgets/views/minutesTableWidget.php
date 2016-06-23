<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                    <div class="text">

                    </div>

                    <?= $active_form
                        ->field(
                            $chronometry_day_form,
                            // "[$hour][$minutes]activity_id"
                            "activity_id[$hour][$minutes]"
                            // ['template' => '{input}']
                        )
                        ->hiddenInput(['class' => 'hidden-activity_id'])
                        ->label(false); ?>

                    <?= $active_form
                        ->field(
                            $chronometry_day_form,
                            "[$hour][$minutes]note"
                            // ['template' => '{input}']
                        )
                        ->hiddenInput(['class' => 'hidden-note'])
                        ->label(false); ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>