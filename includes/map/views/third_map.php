<? /** @var array $regions */ ?>
<div class="container">
    <div class="map-container">
        <img src="<?= TP_URL ?>assets/images/maps/front/map3.png" style="max-width: 100%;">
        <? foreach ($regions as $region_key => $model): ?>
            <div class="point <?= $model['class'] ?>" title="<?= $model['value'] ?>"><?= $model['value'] ?></div>
        <? endforeach; ?>
    </div>
</div>
