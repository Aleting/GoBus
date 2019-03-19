$(document).ready(function () {

    var heig = $(window).height()-$('#map').height()-$('#foot').height();
    $('#form').height(heig-55);
    $('#switchDiv').height($('#start').height()+$('#terminal').height());
    $('#switch').width($('#switchDiv').width());

});