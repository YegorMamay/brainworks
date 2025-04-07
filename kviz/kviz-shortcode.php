<?php
function kviz_function() {
    ob_start();  ?>
<section class="second-screen grey">
    <div class="kviz">
        <div class="container">
            <div class="kviz-item__content form-before">

                <div class="kviz-item__header">
                    <div class="kviz-item__progress">
                        <div class="kviz-item__number">
                            <span class="kviz-item__number-furst">01</span>
                            <span class="kviz-item__number-all">/ 07</span>
                        </div>
                        <div class="kviz__visual">
                            <?php $arrayKviz = get_field('page_builder');
                            for ($i = 0; $i <= count($arrayKviz); $i++) {
                                ?>
                            <div class="">
                                <div class="kviz-circle kviz-circle-<?php echo $i ?>">
                                </div>
                                <?php if ($i != count($arrayKviz)): ?>
                                <div class="kviz-block kviz-block-<?php echo $i ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="kviz__content">
                    <div class="kviz-slider__wrap" style="margin-right: auto;margin-left: auto;">
                        <form action="javascript:void(null);" id="kvizForm" class="kviz-form" method="POST">

                            <div class="kviz-slider">
                                <?php require_once get_template_directory() . '/kviz/block-builder.php'; ?>

                                <div class="kviz-slider__item" style="display: none;">

                                    <h3 class="kviz-slider__title">
                                        <?php _e('В який месенждер Вам зручно отримати результат?', 'brainworks') ?>
                                    </h3>

                                    <div class="kviz-slider__item-end">
                                        <div class="kviz-slider__item-end_inner" style="margin: 0 auto;">
                                            <div class="kviz-slider__form">

                                                <div class="kviz-slider__content">
                                                    <div class="kviz-slider__data stopro">
                                                        <div class="kviz-slider__elem kviz-slider__elem-radio">
                                                            <input type="radio" name="messen" class="customRadio_radio" id="messen_1" value="Viber" data-title="Месенджер">

                                                            <label for="messen_1" class="customRadio_label customRadio_label-fix">
                                                                <span class="customRadio_label-cirkle">
                                                                </span>
                                                                <span><i class="fab fa-viber" style="color: #574e92;"></i> Viber</span>
                                                            </label>
                                                        </div>
                                                        <div class="kviz-slider__elem kviz-slider__elem-radio">
                                                            <input type="radio" name="messen" class="customRadio_radio" id="messen_2" value="Telegram" data-title="Месенджер">

                                                            <label for="messen_2" class="customRadio_label customRadio_label-fix">
                                                                <span class="customRadio_label-cirkle">
                                                                </span>
                                                                <span><i class="fab fa-telegram-plane" style="color: #28a4e4;"></i> Telegram</span>

                                                            </label>
                                                        </div>
                                                        <div class="kviz-slider__elem kviz-slider__elem-radio">
                                                            <input type="radio" name="messen" class="customRadio_radio" id="messen_3" value="Whatsapp" data-title="Месенджер">

                                                            <label for="messen_3" class="customRadio_label customRadio_label-fix">
                                                                <span class="customRadio_label-cirkle">
                                                                </span>
                                                                <span><i class="fab fa-whatsapp" style="color: #00e676;"></i> Whatsapp</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="inputs_form">
                                                    <div class="main-input"><span class="icon-Phones"></span><input class="main-input__inner" type="tel" id="tel" placeholder="Ваш номер телефону" name="yourPhone" required data-title="Телефон">
                                                    </div>
                                                    <button class="btn_quiz btn" name="sendForm1" type="submit">Вiдправити</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="btn--wrap kviz__btn-block">
                                <button class=" btn-kviz prev-kviz" disabled="true">
                                    <span>
                                        <?php _e('Назад', 'brainworks') ?></span>
                                </button>
                                <button class="btn-kviz next-kviz" disabled="true">
                                    <span>
                                        <?php _e('Далее', 'brainworks') ?></span>

                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php return ob_get_clean();
}
add_shortcode("quiz", "kviz_function");
?>
