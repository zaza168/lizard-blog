$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;
		var links = this.el.find('.left_menu_title');
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();
		$next.slideToggle();
		$this.parent().toggleClass('open');
		if (!e.data.multiple) {
			$el.find('.left_menu_sub').not($next).slideUp().parent().removeClass('open');
		}
	}	
	var accordion = new Accordion($('.left_menu_a'), false);
});
/*********菜闭合专用*************/
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;
		var links = this.el.find('.left_menu_title1');
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();
		$next.slideToggle();
		$this.parent().toggleClass('off');
		if (!e.data.multiple) {
			$el.find('.left_menu_sub1').not($next).slideUp().parent().removeClass('off');
		}
	}	
	var accordion = new Accordion($('.left_menu_a'), false);
});