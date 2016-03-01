(function($){
	$(document).ready(function(){
		var code = $("#code>textarea").text();
		var html = $('<ol></ol>').addClass('decimal');
		var line = ($.browser.msie ? '\r' : '\n' );

		while(code.indexOf(line)>=0){
			var c = code.substring(0,code.indexOf(line));
			//∏ﬂ¡¡
			c = htmlEncode(c);
			c = c.replace(/ (pa_ui_[^=]+)/ig,' <font size="2" color="#c60a00"><b>$1</b></font>');

			var item = $('<li></li>');
			//tab  ˝¡ø
			if(c.match(/\t/)){
				var l = c.match(/\t/g).length;
				item.css("padding-left", ( l * 20 ) + "px");
			}
			item.html(c).appendTo(html);
			code = code.substring(code.indexOf(line)+1);
		}

		$("#code>textarea").remove();
		$("#code").append(html);
	});

	function htmlEncode(s){
		s=s.replace(/</ig,'&lt;');
		s=s.replace(/>/ig,'&gt;');
		s=s.replace(/\//ig,'/');
		s=s.replace(/\"/ig,'&quot;');
		return s;
	}

})(jQuery);