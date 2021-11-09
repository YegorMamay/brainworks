<?php if (have_rows('page_builder')) : while (have_rows('page_builder')) : the_row(); ?>

<?php if (get_row_layout() == 'checkbox_1') : ?>

   <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
       <h3 class="kviz-slider__title">
           <?php the_sub_field('title') ?>
       </h3>
       <div class="kviz-slider__content">
           <div class="kviz-slider__data">
               <?php $checkboxList =  get_sub_field('checkbox_list') ?>
               <?php foreach ($checkboxList as $key => $value): ?>
                   <div class="kviz-slider__elem kviz-slider__elem-radio skipEl">
                       <input type="radio" name="checkOnly<?php echo get_row_index () ?>" data-title="<?php the_sub_field('title') ?>" class="customRadio_radio"
                              id="check-<?php echo get_row_index () ?>-<?php echo $key ?>" value="<?php echo $value['title'] ?>">

                       <label for="check-<?php echo get_row_index () ?>-<?php echo $key ?>"
                              class="customRadio_label customRadio_label-fix">
                      <span class="customRadio_label-cirkle">
                      </span>
                           <span><?php echo $value['title'] ?></span>

                       </label>
                   </div>

               <?php endforeach; ?>
           </div>
           <div class="kviz-slider__img kviz-slider__img--2">
               <?php $img = get_sub_field('img') ?>
               <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
           </div>
       </div>
   </div>



  <?php elseif (get_row_layout() == 'checkbox_more') : ?>

    <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
        <h3 class="kviz-slider__title">
            <?php the_sub_field('title') ?>
        </h3>
        <div class="kviz-slider__content">
            <div class="kviz-slider__data">
                 <?php $checkboxList =  get_sub_field('checkbox_list') ?>
                 <?php foreach ($checkboxList as $key => $value): ?>
                    <div class="kviz-slider__elem kviz-slider__elem-radio">
                        <input type="checkbox" name="checkMore-<?php echo $key ?>-<?php echo get_row_index () ?>" class="customRadio_radio"
                               id="check-more-<?php echo get_row_index () ?>-<?php echo $key ?>" value="<?php echo $value['title'] ?>" data-title="<?php the_sub_field('title') ?>">

                        <label for="check-more-<?php echo get_row_index () ?>-<?php echo $key ?>"
                               class="customRadio_label customRadio_label-fix">
                       <span class="customRadio_label-cirkle">
                       </span>
                            <span><?php echo $value['title'] ?></span>

                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="kviz-slider__img kviz-slider__img--2">
                <?php $img = get_sub_field('img') ?>
                <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
            </div>

        </div>
    </div>

<?php elseif (get_row_layout() == 'checkbox_1_img') : ?>

    <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
        <h3 class="kviz-slider__title" style="text-align: center;"><?php the_sub_field('title') ?></h3>
        <div class="kviz-slider__content kviz-slider__content_img" style="padding: 0;border: 0;">

            <?php $checkboxList =  get_sub_field('checkbox_list') ?>
            <?php foreach ($checkboxList as $key => $value): ?>
            <div class="kviz-slider__elem kviz-slider__elem-min skipEl" style="margin-bottom: 15px;">
                <label class="kviz-slider__elem-min_img" for="check-img-<?php echo get_row_index () ?>-<?php echo $key ?>">
                    <span class="customRadio__img">
                        <?php $imgChek = $value['img'] ?>
                        <img src="<?php echo $imgChek['url'] ?>" alt="<?php echo $imgChek['alt'] ?>">
                    </span>

                </label>

                <input type="radio" name="checkImg<?php echo get_row_index() ?>" class="customRadio_radio"
                       id="check-img-<?php echo get_row_index () ?>-<?php echo $key ?>" value="<?php echo $value['text'] ?>" data-title="<?php the_sub_field('title') ?>">

                <label for="check-img-<?php echo get_row_index () ?>-<?php echo $key ?>" class="customRadio_label">
                       <span class="customRadio_label-cirkle">
                       </span>
                    <span class="customRadio__img-title"><?php echo $value['text'] ?></span>

                </label>
            </div>
            <?php endforeach; ?>

        </div>


    </div>

<?php elseif (get_row_layout() == 'checkbox_more_img') : ?>

    <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
        <h3 class="kviz-slider__title" style="text-align: center;"><?php the_sub_field('title') ?></h3>
        <div class="kviz-slider__content kviz-slider__content_img" style="padding: 0;border: 0;">

            <?php $checkboxList =  get_sub_field('checkbox_list') ?>
            <?php foreach ($checkboxList as $key => $value): ?>
            <div class="kviz-slider__elem kviz-slider__elem-min" style="margin-bottom: 15px;">
                <label class="kviz-slider__elem-min_img" for="check-img-more-<?php echo get_row_index () ?>-<?php echo $key ?>">
                    <span class="customRadio__img">
                        <?php $imgChek = $value['img'] ?>
                        <img src="<?php echo $imgChek['url'] ?>" alt="<?php echo $imgChek['alt'] ?>">
                    </span>

                </label>

                <input type="checkbox" name="checkImgMore-<?php echo $key ?>-<?php echo get_row_index() ?>" class="customRadio_radio"
                       id="check-img-more-<?php echo get_row_index () ?>-<?php echo $key ?>" value="<?php echo $value['text'] ?>" data-title=" <?php the_sub_field('title') ?>">

                <label for="check-img-more-<?php echo get_row_index () ?>-<?php echo $key ?>" class="customRadio_label">
                       <span class="customRadio_label-cirkle">
                       </span>
                    <span class="customRadio__img-title"><?php echo $value['text'] ?></span>

                </label>
            </div>
            <?php endforeach; ?>

        </div>


    </div>


<?php elseif (get_row_layout() == 'checkbox_1_col') : ?>

   <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
       <h3 class="kviz-slider__title">
           <?php the_sub_field('title') ?>
       </h3>
       <div class="kviz-slider__content">
           <div class="kviz-slider__data two-col">
                <?php $checkboxList =  get_sub_field('checkbox_list') ?>
                <?php foreach ($checkboxList as $key => $value): ?>
                   <div class="kviz-slider__elem kviz-slider__elem-radio skipEl">
                       <input type="radio" name="checkMoreCol-<?php echo $key ?>-<?php echo get_row_index () ?>" class="customRadio_radio"
                              id="check-more-<?php echo get_row_index () ?>-<?php echo $key ?>" value="<?php echo $value['title'] ?>" data-title="<?php the_sub_field('title') ?>">

                       <label for="check-more-<?php echo get_row_index () ?>-<?php echo $key ?>"
                              class="customRadio_label customRadio_label-fix">
                      <span class="customRadio_label-cirkle">
                      </span>
                           <span><?php echo $value['title'] ?></span>

                       </label>
                   </div>
               <?php endforeach; ?>
           </div>


       </div>
   </div>


<?php elseif (get_row_layout() == 'checkbox_more_col') : ?>

   <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
       <h3 class="kviz-slider__title">
           <?php the_sub_field('title') ?>
       </h3>
       <div class="kviz-slider__content">
           <div class="kviz-slider__data two-col">
                <?php $checkboxList =  get_sub_field('checkbox_list') ?>
                <?php foreach ($checkboxList as $key => $value): ?>
                   <div class="kviz-slider__elem kviz-slider__elem-radio">
                       <input type="checkbox" name="checkMoreCol-<?php echo $key ?>-<?php echo get_row_index () ?>" class="customRadio_radio"
                              id="check-more-<?php echo get_row_index () ?>-<?php echo $key ?>" value="<?php echo $value['title'] ?>" data-title="<?php the_sub_field('title') ?>">

                       <label for="check-more-<?php echo get_row_index () ?>-<?php echo $key ?>"
                              class="customRadio_label customRadio_label-fix">
                      <span class="customRadio_label-cirkle">
                      </span>
                           <span><?php echo $value['title'] ?></span>

                       </label>
                   </div>
               <?php endforeach; ?>
           </div>


       </div>
   </div>

<?php elseif (get_row_layout() == 'kviz_input') : ?>

    <div class="kviz-slider__item kviz-slider__item-<?php echo get_row_index () ?>">
        <h3 class="kviz-slider__title">
            <?php the_sub_field('title') ?>
        </h3>
        <div class="kviz-slider__content">
            <div class="kviz-slider__data">
                <div class="kviz-slider__elem">
                    <input type="text" name="check-input-<?php echo get_row_index() ?>"
                           id="whattype_1" value="" class="kviz-slider__input" placeholder="<?php the_sub_field('inp') ?>" data-title=" <?php the_sub_field('title') ?>">
                </div>

            </div>

        </div>

    </div>








<?php endif; ?>

<?php endwhile;
endif; ?>
