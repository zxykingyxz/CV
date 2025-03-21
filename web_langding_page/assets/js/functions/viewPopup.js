  // button xem thông tin sản phẩm
  $('body').on('click', '.views_introduce_info', function() {
      let value = $(this).data('value');
      let form = $(this).data('form');

      $.ajax({
          url: 'ajax/functions/ajaxViewInfo.php',
          type: 'POST',
          data: {
              value: value,
              form: form,
          },
          dataType: 'json',
          beforeSend: function() {
              loadApplication(true);
          },
          success: function(data) {
              $('body').append(data.html);
              $('body .form_popup').addClass('active');
              $("body ").css('overflow', 'hidden');
              $('body').on('click', '.close_form_popup', function() {
                  if ($(this).closest(' .form_popup').hasClass('active')) {
                      $(this).closest(' .form_popup').remove();
                      $("body ").css('overflow', 'auto');
                  }
              });
              _FRAMEWORK.loadWesite();
              _FRAMEWORK.Lazys();
              _FRAMEWORK.thumbsGallery();
              loadApplication(false);
          },
          complete: function() {}
      });
  });