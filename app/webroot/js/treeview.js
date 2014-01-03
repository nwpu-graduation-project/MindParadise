/*Код плагина 代码插件*/
(function ($) {
  $.fn.liHarmonica = function (params) {
    var p = $.extend({
      currentClass: 'cur', // 选定菜单项类(current)
      onlyOne: true, //true - 只能有一个项目被打开,
      speed: 500 // 动画速度
    }, params);
    return this.each(function () {
      var
      el = $(this).addClass('harmonica'),
        linkItem = $('ul', el).prev('a');
      el.children(':last').addClass('last');
      $('ul', el).each(function () {
        $(this).children(':last').addClass('last');
      });
      $('ul', el).prev('a').addClass('harFull');
      el.find('.' + p.currentClass).parents('ul').show().prev('a').addClass(p.currentClass).addClass('harOpen');
      linkItem.on('click', function () {
        if ($(this).next('ul').is(':hidden')) {
          $(this).addClass('harOpen');
        } else {
          $(this).removeClass('harOpen');
        }
        if (p.onlyOne) {
          $(this).closest('ul').closest('ul').find('ul').not($(this).next('ul')).slideUp(p.speed).prev('a').removeClass('harOpen');
          $(this).next('ul').slideToggle(p.speed);
        } else {
          $(this).next('ul').stop(true).slideToggle(p.speed);
        }
        return false;
      });
    });
  };
})(jQuery);

/*Инициализация плагина 初始化插件 */
$(function () {
  $('.anyClass').liHarmonica({
    onlyOne: false,
    speed: 500
  });
  $('.anyClass2').liHarmonica({
    onlyOne: true,
    speed: 400
  });
});
//@ sourceURL=pen.js