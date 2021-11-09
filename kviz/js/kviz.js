
  jQuery(function($) {
$('.kviz__visual>div>div:nth-child(1)').first().addClass('kviz-circle-active');
var number = 0;
var maxNumber = $(".kviz-slider__item").length;
var $element = $(".kviz-slider__item").find("input, select, textarea");
var btnPrev = $(".prev-kviz");
var btnNext = $('.next-kviz');
var kvizTextNum = $(".kviz-slider__item").length;
var lengthQuiz = $(".kviz-slider__item").length;
var kvizText = $('.kviz__img-count');

var isValid;
var dataBlock;
var activeSlede = [];
if (number < lengthQuiz - 1) {
    $(".kviz-item__number-furst").text(number + 1);
}
$(".kviz-item__number-all").text("/ " + (maxNumber - 1));
kvizText.text(kvizTextNum +' питань');
for(var i = 0; i< maxNumber; i++){
  activeSlede[i] = false;
}

$element.on('change input click', function (e) {
  var value = $(this).val().trim();
  isValid = value !== "";
  if ($(`.kviz-slider__item-${number+1} input`).is(':checked')) {
    btnActive(!isValid);
} else if ($(`.kviz-slider__item-${number+1} input.kviz-slider__input`).is(":visible") && $(`.kviz-slider__item-${number+1} input.kviz-slider__input`).val() != '') {
    btnActive(!isValid);
    console.log(4545345);
} else if ($(`.kviz-slider__item-${number+1} input`).not(':checked')) {
    btnNext.prop('disabled', 'false');
}


  $(".text-subbtn").hide();
});

btnNext.on('click', function() {
     $('html, body').animate({
        scrollTop: $(".kviz-item__header").offset().top - 80  // класс объекта к которому приезжаем
    }, 500); // Скорость прокрутки
})


function btnActive(isValid) {
    btnPrev.prop('disabled', 'false');
    btnNext.prop('disabled', isValid);
    if (number != 0) {
        btnPrev.prop('disabled', false);
    }

    if(activeSlede[number] === true || isValid === false){
      btnNext.prop('disabled', false);
    }

}

// Прогрес
  function progress(num){
    var kvizBlock = ".kviz-block-" + num ;
    var kvizCircle= ".kviz-circle-" + (num + 1) ;
    $(kvizBlock).addClass('kviz-block-active');
    $(kvizCircle).addClass('kviz-circle-active');
  }
  progress(0);

function btnClick() {

  btnPrev.on('click', function(event) {
      $('html, body').animate({
         scrollTop: $(".kviz-item__header").offset().top - 80 // класс объекта к которому приезжаем
     }, 500);
    event.preventDefault();
    --number;
    $(".kviz-slider__item").hide();
    $(".kviz-slider__item").eq(number).fadeIn();
    btnActive(!isValid);

    if (number < kvizTextNum) {
        $(".kviz-item__number-furst").text(number + 1);
    }
      if(kvizTextNum != 1){
      kvizTextNum += 1;
      if(kvizTextNum < 5 && kvizTextNum > 1){
        kvizText.text( kvizTextNum + ' вопросa');
      }else if(kvizTextNum < 2){
        kvizText.text( kvizTextNum + ' вопрос');
      }else{
        kvizText.text( kvizTextNum + ' вопросов');
      }
    }else{
      $('#present_img').attr({
        "src": 'img/q_present.png',
      });
      kvizText.text('Ваш подарок');
      $('.kviz__img-title').hide();
      $('.kviz__img-price').hide();
    }

    // 2123213123213213312323
    progress(number);
    if(btnNext.prop('disabled')){
      $(".text-subbtn").show();
    }else{
      $(".text-subbtn").hide();
    }
  });


  btnNext.on('click', function(event) {
    event.preventDefault();
    activeSlede[number] = true;

    ++number;
      if(kvizTextNum != 1){
      kvizTextNum -= 1;
      if(kvizTextNum < 5 && kvizTextNum > 1){
        kvizText.text( kvizTextNum + ' вопросa');
      }else if(kvizTextNum < 2){
        kvizText.text( kvizTextNum + ' вопрос');
      }else{
        kvizText.text( kvizTextNum + ' вопросов');
      }
      $('.kviz__img-title').show();

    }

    $(".kviz-slider__item").hide();
    $(".kviz-slider__item").eq(number).fadeIn(1000);
    btnActive(!isValid);
    if(activeSlede[number] === true){
      btnNext.prop('disabled', false);
    }else{
      btnNext.prop('disabled', true);
    }

    if(number === maxNumber - 1){
      $('.kviz__btn-block').hide();
    }

     if(number === maxNumber - 2){
        $(".kviz__img-title").hide();
        kvizText.text('Ваш подарок');
        $('#present_img').attr({
          "src": 'img/q_present.png',
        });
     }

    if (number < lengthQuiz - 1) {
        $(".kviz-item__number-furst").text(number + 1);
    }
    progress(number);
    if(btnNext.prop('disabled')){
      $(".text-subbtn").show();
    }else{
      $(".text-subbtn").hide();
    }

  });

}
btnClick();
var presents;
$(".kviz-presents-slide").find('input').on('input change', function() {
    if($(this).val().trim() !== ""){
      presents = $(this).parents('.kviz-slider__elem').index();
    }
    $('.kviz__img-price').show();
    if(presents === 0){
      kvizText.text('Клінінг після ремонту');
      $('#present_img').attr({
        "src": 'img/item7_1.jpg',
      });
    }else  if(presents === 1){
      kvizText.text('Фотозйомка приміщення після ремонту');
      $('#present_img').attr({
        "src": 'img/item7_2.jpg',
      });
    }else  if(presents === 2){
      kvizText.text('Консультація керівника');
      $('#present_img').attr({
        "src": 'img/item7_3.jpg',
      });
    }
});

function triggerBtn(e) {
    $('html, body').animate({
       scrollTop: $(".kviz-item__header").offset().top - 80 // класс объекта к которому приезжаем
   }, 500);
    e.preventDefault();
    activeSlede[number] = true;

    ++number;
    // уцкукцук

      if(kvizTextNum != 1){
      kvizTextNum -= 1;
      if(kvizTextNum < 5 && kvizTextNum > 1){
        kvizText.text( kvizTextNum + ' вопросa');
      }else if(kvizTextNum < 2){
        kvizText.text( kvizTextNum + ' вопрос');
      }else{
        kvizText.text( kvizTextNum + ' вопросов');
      }
      $('.kviz__img-title').show();
      $('#present_img').attr({
          "src": 'img/present_big.png',
        });
    }


    $(".kviz-slider__item").hide();
    $(".kviz-slider__item").eq(number).fadeIn(1000);
    btnActive(!isValid);
    if(activeSlede[number] === true){
      btnNext.prop('disabled', false);
    }else{
      btnNext.prop('disabled', true);
    }

    if(number === maxNumber - 1){
      $('.kviz__btn-block').hide();
    }

     if(number === maxNumber - 2){
        $(".kviz__img-title").hide();
        kvizText.text('Ваш подарок');
        $('#present_img').attr({
          "src": 'img/q_present.png',
        });
     }
     if (number < lengthQuiz - 1) {
        $(".kviz-item__number-furst").text(number + 1);
     }


    progress(number);

    if(btnNext.prop('disabled')){
        $(".text-subbtn").show();
    }else{
          $(".text-subbtn").hide();
        }
    }

    $(".skipEl").click(function(){
      $(this).find(".customRadio_radio").prop("checked","checked");
      if($(event.currentTarget).find('input')[0].type != 'checkbox') triggerBtn(event);

    });
    var crdVal;
    $("#send-result-polzunok").on('keyup', function(event) {
      crdVal = $('#send-result-polzunok').val().trim();

      if(parseInt(crdVal) > 1000){
        $('#send-result-polzunok').val(1000);
      }

      if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
      }
      $( "#number-slider" ).slider( "value", $(this).val() );
    });

    $("#send-result-polzunok").on("change , input", function(){
      if(crdVal === ''){
        $('#send-result-polzunok').val();
      }
    });

    $("#no").on('change input', function() {
      if($(this).prop('checked')){
        $( "#number-slider" ).slider( "value", 0 );
        $( "#number-slider" ).slider( "disable" );
        $("#send-result-polzunok").val("0").attr({'disabled':'disabled'});
      }else{
        $( "#number-slider" ).slider( "enable" );
        $("#send-result-polzunok").removeAttr('disabled');
      }
    });


    $("#kvizForm").on("submit", function(){
        call();
        })
        function call(e) {
        	var msg   = $('#kvizForm').serializeArray();
          var letter = {};
          $.each(msg,function(index,value){
              if (!letter.hasOwnProperty($(`[name="${value['name']}"]`).attr('data-title'))) {
                letter[$(`[name="${value['name']}"]`).attr('data-title')] = value['value'];
              } else {
                letter[$(`[name="${value['name']}"]`).attr('data-title')] = letter[$(`[name="${value['name']}"]`).attr('data-title')] + ', ' + value['value'];
              }
          });
              $.ajax({
                type: 'POST',
                url: kvizVariable.template_url + '/kviz/sendLetter.php',
                data: letter,
                success: function(data) {
                    ;
                  $('#results').html(data);
                  window.location.replace(window.location.origin + '/thanks');
                },
                error:  function(xhr, str){
                   alert('Возникла ошибка: ' + xhr.responseCode);
                }
              });

          }


});
