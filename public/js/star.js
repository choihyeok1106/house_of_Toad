function rating() {
    $('.fa-star').click(function () {
        var $this = $(this);
        $this.removeClass('checked');
        $this.siblings('.fa-star').removeClass('checked');
        $this.addClass('checked');
        $this.prevAll('.fa-star').addClass('checked');
        $this.siblings('input').eq(1).val($this.data('value'));
    });
};