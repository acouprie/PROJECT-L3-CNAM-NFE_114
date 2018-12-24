$(function() {
  $(".content").hover(function () {
      $('#asideRight').animate({width: 'show', top:'200px', right: '0'});
      $('#asideLeft').animate({width: 'show', top:'150px'});
  }, function() {
      $('#asideRight').animate({width: 'hide'});
      $('#asideLeft').animate({width: 'hide'});
  });
});
