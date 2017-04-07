/*------------------------------------------------------
    Author : www.webthemez.com
    License: Commons Attribution 3.0
    http://creativecommons.org/licenses/by/3.0/
---------------------------------------------------------  */

(function ($) {
    "use strict";
    var data, _this, y, id;
    var type = 'map';
    $.fn.extend({
    	mainApp : function(options){
    		_this = $(this);
    		id = _this.attr('id');
    		data = options.data;
    		y = options.y;
    		type = options.type;
    		this.type();
    		
    	},
    	
    	
    	line : function(){
    		Morris.Line({
	            element: id,
	            data: data,
	            xkey: 'y',
	            ykeys: y,
	            labels: y,
	            hideHover: 'auto',
	            resize: true
	        });
    	},
    	
    	type : function(){

    		this.line();

    	}
    });

})(jQuery);
