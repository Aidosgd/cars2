$( document ).ready(function() {

    // Dropdown menu handler
    $('.dropdown-menu').find('form').on('click', function (e) {
        e.stopPropagation();
    });

    // Mobile Categories
    var select_menu = '<select class="form-control">';
    $(".categories a").each(function() {
        var el = $(this);
        select_menu += '<option value="'+el.attr("href")+'"';
        if (el.hasClass("active")) select_menu += ' selected';
        select_menu += '>'+el.html().replace(/<span>.*<\/span>/gi,'')+'</option>';
    });
    select_menu += '</select>';
    $(select_menu).appendTo(".mobile-categories");
    $(".mobile-categories select").change(function() {
        window.location = $(this).find("option:selected").val();
    });

    // Slider (on Front Page)
    $(".featured").slidesjs({
        width: 900,
        height: 300,
        navigation: false,
        play: {
            active: false,
            effect: "slide",
            interval: 4000,
            auto: true,
            swap: true,
            pauseOnHover: true,
            restartDelay: 2500
        }
    });

    // Carousel Thumnails Opacity Effect (on Classified detail page)
    $('#carousel-detail-classified').on('slid.bs.carousel', function(e) {
        var carouselData = $(this).data('bs.carousel');
        var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
        $('#thumbs-detail-classified ul li').removeClass('active');
        $('#thumbs-detail-classified ul li[data-slide-to="'+currentIndex+'"]').addClass('active');
    });

    $('#thumbs-detail-classified ul li').on('click', function() {
        $('#thumbs-detail-classified ul li').removeClass('active');
        $(this).addClass('active');
    });

    $('.list-group-item').on('click', function(){
        $(this).stop(true).next('.list-subgroups').slideToggle();
    });

});

function handleFileSelect() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {

        var files = event.target.files; //FileList object
        var output = document.getElementById("result");
        output.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            //Only pics
            if (!file.type.match('image')) continue;

            var picReader = new FileReader();
            picReader.addEventListener("load", function (event) {
                var picFile = event.target;
                var div = document.createElement("div");
                div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                output.insertBefore(div, null);
            });
            //Read the image
            picReader.readAsDataURL(file);
        }
    } else {
        console.log("Your browser does not support File API");
    }
};
var files = document.getElementById('files');
if(files){
    files.addEventListener('change', handleFileSelect, false);
}