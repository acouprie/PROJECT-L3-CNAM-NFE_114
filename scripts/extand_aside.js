// animate asides in index after 3 sec
setTimeout(function () {
    $('#asideRight').animate({width: 'show', top:'200px', right: '0'});
    $('#asideLeft').animate({width: 'show', top:'150px'});
}, 3000);