<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\chronometry\components\widgets\MinutesTableWidget;

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
                        <?= $this->context->getCodeById($chronometry_day_form->activity_id[$hour][$minutes]) ?>
                    </div>

                    <?= $active_form
                        ->field(
                            $chronometry_day_form,
                            "activity_id[$hour][$minutes]",
                            ['template' => '{input}']
                        )
                        ->hiddenInput(['class' => 'hidden-activity_id'])
                        ->label(false); ?>

                    <?= $active_form
                        ->field(
                            $chronometry_day_form,
                            "note[$hour][$minutes]",
                            ['template' => '{input}']
                        )
                        ->hiddenInput(['class' => 'hidden-note'])
                        ->label(false); ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>