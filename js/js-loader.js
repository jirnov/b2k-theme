/*
jQuery(window).load(function() {
  var permalink = jQuery('link[rel=canonical]').attr('href');

  jQuery.ajaxSetup({cache : true});

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '545514278883012',
      status     : true,
      cookie     : true,
      oauth      : true,
      xfbml      : true,
    });

    FB.Event.subscribe(
      'xfbml.render',
      function (response) {
        jQuery('.fb_tab').fadeIn(250);
      }
    );
  };

  jQuery.getScript('//connect.facebook.net/ru_RU/all.js');

  // Комментарии Facebook
  jQuery.getJSON(
    'https://graph.facebook.com/v2.7/?fields=share{comment_count}&id='+permalink,
    function(data) {
      if (!data['share']) {
        return;
      }
      var count = data['share']['comment_count'];

      if ("0" != count) {
        jQuery('#fb_comments_count').html(" (" + count + ")");
      }
    }
  );

  jQuery.getScript(
    '//blog2k.ru/wp-content/themes/simplepress-2/js/social-likes.min.js',
    function() {
      jQuery('.social-likes').on('popup_opened.social-likes',
        function(event, service, win) {
          ga('send', 'social', service, 'send', permalink);
        }
      );
    }
  );

  jQuery.getScript(
    '//vk.com/js/api/openapi.js',
    function() {
      VK.init({apiId: 3904727, onlyWidgets:true});

      VK.Widgets.Comments(
        "vk_comments", {
          limit: 10,
          attach: "*",
          autoPublish:"0",
          pageUrl:
          jQuery('link[rel=canonical]').attr('href')
        }
      );

      VK.Api.call(
        'widgets.getComments', {
          widget_api_id: "3904727",
          url: jQuery('link[rel=canonical]').attr('href')
        },
        function(r) {
          // Получаем количество комментариев
          var count = r.response.count;
          // Добавляем это количество в vk_comments_count
          if (count > 0) {
            jQuery('#vk_comments_count').html(" (" + count + ")");
          }
        }
      );

      jQuery('.vk_tab').fadeIn(250);
    }
  );
});*/

jQuery(window).ready(function() {
  jQuery('ul.tabs').on('click', 'li:not(.current)', function() {
    jQuery(this)
      .addClass('current')
      .siblings().removeClass('current')
      .parents('div.comments')
      .find('div.box').eq(jQuery(this).index()).fadeIn(250, function(){
        jQuery('html, body').animate({ scrollTop : jQuery('#comments').offset().top }, 500);
      })
      .siblings('div.box').hide();        
  });
});
