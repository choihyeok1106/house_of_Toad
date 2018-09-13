$(document).ready(function () {
    var i = 0;
    var $this = $(this);
    $('.add').click(function () {
        console.log($('.check option:selected').val() == "");
        if ($('.check option:selected').val() == "") {
            alert('항목을 선택해주세요');
        } else {
            if ($('.check option:selected').val() == 'text') {
                var optiontext = $('.check option:selected').text();
                var addInput = "<div class=\"form-group\">\n" +
                    "<input type=\"text\" class=\"form-control\" name=\"value[]\" placeholder=" + optiontext + ">\n" +
                    "</div>";
            } else if ($('.check option:selected').val() == 'point') {
                var optiontext = $('.check option:selected').text();
                var addInput = "<div class=\"form-group\">\n" +
                    "<label>" + optiontext +
                    "<div class=\"rating ml-1\" data-id=\"" + i + "\">\n" +
                    "<span class=\"fa fa-star checked\" data-value=\"1\" onclick=\"rating()\"></span>\n" +
                    "<span class=\"fa fa-star checked\" data-value=\"2\" onclick=\"rating()\"></span>\n" +
                    "<span class=\"fa fa-star checked\" data-value=\"3\" onclick=\"rating()\"></span>\n" +
                    "<span class=\"fa fa-star checked\" data-value=\"4\" onclick=\"rating()\"></span>\n" +
                    "<span class=\"fa fa-star checked\" data-value=\"5\" onclick=\"rating()\"></span>\n" +
                    "<input type=\"hidden\" value=\"5\" class=\"point\" name=\"value[]\">\n" +
                    "</div></label>" +
                    "</div>\n";
                i++
            }
            addInput += "<input type=\"hidden\" value=\"" + $('.check option:selected').val() + "\" name=\"type[]\">\n" +
                "<input type=\"hidden\" value=\"" + optiontext + "\" name=\"description[]\">";
            $('.addpoint').append(addInput);
            $('.check option:selected').remove();
        }
    });
});

function rating() {
    $('.fa-star').click(function () {
        var $this = $(this);
        $this.removeClass('checked');
        $this.siblings().removeClass('checked');
        $this.addClass('checked');
        $this.prevAll().addClass('checked');
        $this.siblings('input').val($this.data('value'));
    });
};