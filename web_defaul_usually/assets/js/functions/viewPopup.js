  // button xem thông tin sản phẩm
  $('body').on('click', '.views_product_info', function() {
      let value = $(this).data('value');
      $.ajax({
          url: 'ajax/functions/ajaxViewInfo.php',
          type: 'POST',
          data: {
              value: value,
              form: 'view_info_product',
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
  // button xem thông tin thanh toán
  $('body').on('click', '.views_pay_info', function() {
      let value = $(this).data('value');
      $.ajax({
          url: 'ajax/functions/ajaxViewInfo.php',
          type: 'POST',
          data: {
              value: value,
              form: 'view_info_pay',
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
              loadApplication(false);
          },
          complete: function() {}
      });
  });
  // xem thông tin chi tiết
  $('body').on('click', '.views_product_detail', function() {
      let value = $(this).data('value');
      let active = $(this).data('active');
      $.ajax({
          url: 'ajax/functions/ajaxViewInfo.php',
          type: 'POST',
          data: {
              value: value,
              active: active,
              form: 'view_product_detail',
          },
          dataType: 'json',
          beforeSend: function() {
              loadApplication(true);
          },
          success: function(data) {
              $('body').append(data.html);
              _FRAMEWORK.loadWesite();
              _FRAMEWORK.Lazys();
              _FRAMEWORK.thumbsGallery();
              setTimeout(function() {
                  $('body .form_popup').find(".data_product_detail.active").css("display", "none");
              }, 1);
              $('body .form_popup').addClass('active');
              $("body ").css('overflow', 'hidden');
              $('body').on('click', '.close_form_popup', function() {
                  if ($(this).closest(' .form_popup').hasClass('active')) {
                      $(this).closest(' .form_popup').remove();
                      $("body ").css('overflow', 'auto');
                  }
              });

              $(".form_product_detail").btnNoneBlockPlugin({
                  button: 'btn_product_detail', // Thay thế class cho button
                  data: 'data_product_detail',
                  animation: false,
                  check_out: false,
                  close: false,
              });

              loadApplication(false);
          },
          complete: function() {}
      });
  });