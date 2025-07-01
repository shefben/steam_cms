// Shortcut
function getEl(id) {
	return document.getElementById(id);
}

// Create a namespaces for DeskPRO
if (typeof DeskPRO == 'undefined') {
	DeskPRO = {};
	DeskPRO.Forms = {};
	DeskPRO.User = {};
	DeskPRO.Tech = {};
	DeskPRO.Widget = {};
}

if (typeof window.console == 'undefined' || typeof window.console.group == 'undefined') {
	console = {
		log: function() {},
		debug: function() {},
		warn: function() {},
		error: function() {},
		assert: function() {},
		dir: function() {},
		dirxml: function() {},
		trace: function() {},
		group: function() {},
		groupEnd: function() {},
		time: function() {},
		timeEnd: function() {},
		profile: function() {},
		profileEnd: function() {},
		count: function() {}
	};
}



String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
};
String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
};
String.prototype.rtrim = function() {
	return this.replace(/\s+$/,"");
};

// Init a DEVMODE object that can contain values
var DEVMODE = {};




/**
 * Create a delegate; a function that will be called
 * within the context of an object to keep the 'this'
 * reference correct.
 *
 * @param {Function} The function to call
 * @param {Object} The object context
 * @return {Function} The function delegate
 */
DeskPRO.createDelegate = function(fn, context, appendArgs) {
	return function() {

		var callArgs = arguments;

		if (appendArgs) {

			callArgs = [];

			for (i = 0, len = arguments.length; i < len; i++) {
				callArgs.push(arguments[i]);
			}

			for (i = 0, len = appendArgs.length; i < len; i++) {
				callArgs.push(appendArgs[i]);
			}
		}

		fn.apply(context, callArgs);
	};
};





/**
 * Generate a unique ID for an element in the document
 *
 * @return {String} The unique ID
 */
DeskPRO.genUniqueId = function(prefix) {

	if (!prefix) {
		prefix = 'deskpro_';
	}

	prefix += (new Date()).getTime() + '_';
	var id = '';

	do {
		id = prefix + DeskPRO.rand(1, 9999);
	} while (getEl(id));

	return id;
};





/**
 * Generate a random integer between min and max
 *
 * @param {Integer} The minimum number
 * @param {Integer} The maximum number
 * @return {Integer} A random number
 */
DeskPRO.rand = function(min, max) {

	if (!min) {
		min = 0;
	}

	if (!max) {
		max = -1;
	}

	if (min == max) {
		return min;
	}

	if (min > max) {
		var temp = min;
		min = max;
		max = temp;
	}

	return Math.floor( (Math.random() * (max - min)) + min);
};





/**
 * Alias for DeskPRO.registerWindowSelector, this is specific to single
 * classnames instead of a full selector.
 *
 * @param {String} className Which class to attach the window opener to
 * @param {Object} options Options (toolbar, width/hight etc) for the new window
 */
DeskPRO.registerWindowClass = function(className, options) {
	DeskPRO.registerWindowSelector('.' + className);
};





/**
 * Make a new window open for every element with className when clicked.
 *
 * @param {String} selector Which elements to apply to.
 * @param {Object} options Options (toolbar, width/hight etc) for the new window
 */
DeskPRO.registerWindowSelector = function(selector, options) {

	if (!selector) {
		return;
	}

	$(selector).bind('click', {options: options}, DeskPRO.openWindow(options, true));

};


DeskPRO.openWindow = function(options, returnFn) {
	var opt_str = '';
	var opts = [];

	// Only valid ones go in the string
	var include = [
		'toolbar', 'location', 'directories',
		'status', 'menubar', 'scrollbars',
		'resizable', 'width', 'height',
		'top', 'left'
	];

	if (options) {
		for(i in options) {
			if (DeskPRO.inArray(i, include)) {
				opts.push(i + '=' + options[i]);
			}
		}
	}

	var opt_str = opts.join(',');

	var fn = function(ev) {

		if (typeof options.url != 'undefined') {
			var url = options.url;
		} else if (ev) {
			var url = this.href;
		} else {
			var url = '';
		}

		if (typeof options.name != 'undefined') {
			var name = options.name;
		} else if (ev) {
			if (!this.id) {
				this.id = DeskPRO.genUniqueId();
			}
			var name = 'win_' + this.id;
		} else {
			var name = "";
		}

		var win = window.open(url, name, opt_str);

		if (ev) {
			ev.preventDefault();
		}
		
		return win;
	};
	
	if (returnFn) {
		return fn;
	} else {
		return fn();
	}
};





/**
 * Check to see if a value is in an array.
 *
 * @param {mixed} what What you want to check for
 * @param {Array} array The array you want to check in
 * @param {Boolean} strict To use strict comparisons (=== instead of ==)
 */
DeskPRO.inArray = function(what, array, strict) {

	if (!array || !array.length) {
		return false;
	}

	if (DeskPRO.arraySearch(what, array, strict) != -1) {
		return true;
	} else {
		return false;
	}

};





/**
 * Check to see if a value is in an array.
 *
 * @param {mixed} what What you want to search for
 * @param {Array} array The array you want to search in
 * @param {Boolean} strict To use strict comparisons (=== instead of ==)
 */
DeskPRO.arraySearch = function(what, array, strict) {

	if (!array || !array.length) {
		return -1;
	}

	for(var i = 0; i < array.length; i++) {
		if (strict) {
			if (array[i] === what) {
				return i;
			}
		} else {
			if (array[i] == what) {
				return i;
			}
		}
	}

	return -1;
};





/**
 * Get all of the JS code in <script></script> tags embedded
 * in other HTML. Usually used from AJAX request to eval it after
 * something has been injected into the DOM.
 *
 * @param {String} html The HTML to parse
 * @return {String} One big string of JS code (all together)
 */
DeskPRO.getEmbeddedJS = function(html) {

	var scripts = [];
	var regexp = /<script[^>]*>([\s\S]*?)<\/script>/gi;
	
	while ((script = regexp.exec(html))) {
		scripts.push(script[1]);
	}
	
	scripts = scripts.join('\n');

	return scripts;
};





/**
 * Remove all <script></script> tags embedded in other HTML.
 * Usually done on a var after getEmbeddedJS was called on it
 * so other libs (like jQuery) don't double-eval scripts.
 *
 * @param {String} html The HTML to parse
 * @return {String} The HTML without script tags
 */
DeskPRO.clearEmbeddedJS = function(html) {

	var regexp = /<script[^>]*>([\s\S]*?)<\/script>/gi;
	
	while ((script = regexp.exec(html))) {
		html = html.replace(script[0], '');
	}
	
	return html;
};





/**
 * Eval scripts in the global scope
 *
 * @param {String} js The JS to eval
 */
DeskPRO.evalGlobal = function(js) {

	// IE has execScript
	if (window.execScript) {
		window.execScript(js);

	// Else just setTimeout now
	} else {
		window.setTimeout(js, 0);
	}
};





/**
 * Check str if it ends with checkStr.
 *
 * @param {String} str The string to check in
 * @param {String} checkStr The string to check at the end
 * @param {Booleab} icase To do a case-insensitive check
 * @return {Boolean} If checkStr is at the end of str
 */
DeskPRO.strEndsWith = function(str, checkStr, icase) {

	if (icase) {
		str = str.toLowerCase();
		checkStr = str.toLowerCase();
	}

	var checkPos = str.length - checkStr.length;

	if (checkPos >= 0 && str.lastIndexOf(checkStr) === checkPos) {
		return true;
	}

	return false;
};





/**
 * Check str if it starts with checkStr.
 *
 * @param {String} str The string to check in
 * @param {String} checkStr The string to check at the start
 * @param {Booleab} icase To do a case-insensitive check
 * @return {Boolean} If checkStr is at the beginning of str
 */
DeskPRO.strStartsWith = function(str, checkStr, icase) {

	if (icase) {
		str = str.toLowerCase();
		checkStr = str.toLowerCase();
	}

	if (str.indexOf(checkStr) === 0) {
		return true;
	}

	return false;
};





/**
 * Check str if it has checkStr within it.
 *
 * @param {String} str The string to check in
 * @param {String} checkStr The string to check for
 * @param {Booleab} icase To do a case-insensitive check
 * @return {Boolean} If checkStr is in str
 */
DeskPRO.strHasStr = function(str, checkStr, icase) {

	if (icase) {
		str = str.toLowerCase();
		checkStr = str.toLowerCase();
	}

	if (str.indexOf(checkStr) > -1) {
		return true;
	}

	return false;
};





/**
 * Check if a string contains only whitespace (or nothing at all).
 *
 * @param {String} str The string to check
 * @return {Boolean} If the string is blank
 */
DeskPRO.strIsBlank = function(str) {
	return /^\s*$/.test(str);
};





/**
 * Remove removeStr from the end of str.
 *
 * @param {String} str The string to return
 * @param {String} checkStr The string to remove
 * @param {Booleab} icase To do a case-insensitive check
 * @return {String} str with removeStr removed
 */
DeskPRO.strRemoveFromEnd = function(str, removeStr, icase) {

	if (!DeskPRO.strEndsWith(str, removeStr, icase)) {
		return str;
	}

	return str.substring(0, str.length - removeStr.length);
};





/**
 * Remove removeStr from the start of str.
 *
 * @param {String} str The string to return
 * @param {String} checkStr The string to remove
 * @param {Booleab} icase To do a case-insensitive check
 * @return {String} str with removeStr removed
 */
DeskPRO.strRemoveFromStart = function(str, removeStr, icase) {

	if (!DeskPRO.strStartsWith(str, removeStr, icase)) {
		return str;
	}

	return str.substring(removeStr.length + 1);
};





/**
 * Convert newline characters to HTML breaks.
 * 
 * @param {String} str The string to work on
 */
DeskPRO.strNewlineToBr = function(str) {
	return str.replace(/\n|\r\n/g, '<br />');
};





/**
 * Encode a string for a URL.
 */
DeskPRO.urlencode = function(str) {
	str = escape(str);
	str = str.replace(/\+/, '%2B');
	str = str.replace(/\//, '%2F');

	return str;
};


/**
 * Decode HTML entities.
 */ 
DeskPRO.htmlEntityDecode = function(str) {	   
	var ta=document.createElement("textarea");
	ta.innerHTML=str.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\r?\n/g, "__DESKPRO__NEW__LINE__");
	return ta.value.replace(/__DESKPRO__NEW__LINE__/g, "\r\n");
};





/**
 *	Insert a value into a text/textarea field at the cursor point.
 *
 * @param {HTMLElement} field The field
 * @param {String} value The value to insert
 * @return {String} The old value
 */
DeskPRO.insertAtCursor = function(field, value) {

	var oldValue = field.value;

	// No content yet, can just set it and be done
	if (!field.value.length) {
		field.value = value;
		return oldValue;
	}
	
	if (document.selection) {
		field.focus();
		sel = document.selection.createRange();
		sel.text = value;
	} else if (field.selectionStart || field.selectionStart == '0') {
		field.value = field.value.substring(0, field.selectionStart) + value + field.value.substring(field.selectionEnd, field.value.length);
	} else {
		field.value += value;
	}
	
	return oldValue;
};





/**
 * Get the value of any form field: select, input, checkbox, etc
 *
 * @depreciated Use jQuery instead! $(el).val() works for all types. This is just an alias now.
 *
 * @param {HTMLElement / String} el An element or a string ID of an element
 * @return {Null / Array / String} Null if no value, an array for multi-selects, string otherwise
 */
DeskPRO.Forms.getValue = function(el) {

	if (typeof el == 'string') {
		el = $('#' + el).get(0);
	} else {
		el = $(el);
	}

	return el.val();
};










// ####################################################################
// ####################################################################
// ## CLASS : DeskPRO.DataStore
// ####################################################################
// ####################################################################

/**
 * Simple collection class.
 *
 * Is a slimmed down version of Ext's MixedCollection (see http://extjs.com)
 */
DeskPRO.Collection = function() {

	this.items = [];
	this.map = {};
	this.keys = [];
	this.length = 0;

};

DeskPRO.Collection.prototype.clear = function() {
	this.length = 0;
    this.items = [];
    this.keys = [];
    this.map = {};
};

DeskPRO.Collection.prototype.add = function(key, obj) {

	if (arguments.length == 1) {
		obj = arguments[0];
		key = this.getKey(obj);
	}

	// Just numeric
	if (typeof key == 'undefined' || key == null) {
		this.length++;
		this.items.push(obj);
		this.keys.push(null);

	// A key as well
	} else {
		var old = this.map[key];
        if (old){
            return this.replace(key, obj);
        }

        this.length++;
        this.items.push(obj);
        this.map[key] = obj;
        this.keys.push(key);
	}

	return obj;
};

DeskPRO.Collection.prototype.replace = function(key, obj) {

	if (arguments.length == 1) {
		obj = arguments[0];
		key = this.getKey(obj);
	}

	// If it doesn't exist, then add it
    var old = this.item(key);
    if (typeof key == 'undefined' || key === null || typeof old == 'undefined'){
         return this.add(key, obj);
    }

    // Otherwise we replace it
    var index = this.indexOfKey(key);
    this.items[index] = obj;
    this.map[key] = obj;

    return obj;
};

DeskPRO.Collection.prototype.insert = function(index, key, obj) {

    if(arguments.length == 2){
        obj = arguments[1];
        key = this.getKey(obj);
    }

    if(index >= this.length){
        return this.add(key, obj);
    }

    this.length++;
    this.items.splice(index, 0, obj);

    if (typeof key != 'undefined' && key != null){
        this.map[key] = obj;
    }

    this.keys.splice(index, 0, key);

    return obj;
};

DeskPRO.Collection.prototype.getKey = function(obj) {

	if (obj.id) {
		return obj.id;
	} else if (obj.name) {
		return obj.name;
	} else if (obj.key) {
		return obj.name;
	}

	return null;
};

DeskPRO.Collection.prototype.each = function(fn, scope, falseStops) {

	var res = false;

    for(var i = 0, len = this.items.length; i < len; i++) {
        res = fn.call(scope || this.items[i], this.items[i], i, len);

        if (falseStops && !res) {
        	break;
        }
    }
};

DeskPRO.Collection.prototype.eachKey = function(fn, scope, falseStops) {

	var res = false;

    for(var i = 0, len = this.keys.length; i < len; i++) {
        res = fn.call(scope || this.items[i], this.keys[i], this.items[i], i, len);

        if (falseStops && !res) {
        	break;
        }
    }
};

DeskPRO.Collection.prototype.remove = function(obj) {
	return this.removeAt(this.indexOf(obj));
};

DeskPRO.Collection.prototype.removeAt = function(index) {

	if (index < this.length && index >= 0){

        this.length--;

        var obj = this.items[index];
        var key = this.keys[index];

        this.items.splice(index, 1);
        this.keys.splice(index, 1);

        if (typeof key != 'undefined') {
            delete this.map[key];
        }

        return obj;
    }

    return null;
};

DeskPRO.Collection.prototype.removeKey = function(key) {
	return this.removeAt(this.indexOfKey(key));
};

DeskPRO.Collection.prototype.indexOf = function(obj) {

	if (!this.items.indexOf) {
        for(var i = 0, len = this.items.length; i < len; i++){
            if (this.items[i] == obj) {
            	return i;
            }
        }
        return -1;

    } else {
        return this.items.indexOf(obj);
    }
};

DeskPRO.Collection.prototype.indexOfKey = function(key) {

	if (!this.keys.indexOf) {
        for(var i = 0, len = this.keys.length; i < len; i++){
            if(this.keys[i] == key) {
            	return i;
            }
        }
        return -1;

    } else {
        return this.keys.indexOf(key);
    }
};

DeskPRO.Collection.prototype.item = function(key) {

	var item = typeof this.map[key] != "undefined" ? this.map[key] : this.items[key];

    return item;
};

DeskPRO.Collection.prototype.itemAt = function(index) {
	return this.items[index];
};

DeskPRO.Collection.prototype.key = function(inedx) {
	return this.map[key];
};

DeskPRO.Collection.prototype.contains = function(obj) {
	return this.indexOf(obj) != -1;
};

DeskPRO.Collection.prototype.containsKey = function(key) {
	return typeof this.map[key] != 'undefined';
};

DeskPRO.Collection.prototype.first = function() {
	return this.items[0];
};

DeskPRO.Collection.prototype.last = function() {
	return this.items[this.length-1];
};










// ####################################################################
// ####################################################################
// ## CLASS : DeskPRO.Select2Lvl
// ####################################################################
// ####################################################################

/**
 * Select2Lvl class takes care of fields with 2 levels of selects.
 *
 * @param {Object} preload The preloaded HTML for sub-selects
 * @param {Object} options The options for this instance of Select2Lvl (id's etc)
 */
DeskPRO.Select2Lvl = function(preload, options) {

	this.options = {
		preloadPrefix: '',
		parentSelId: '',
		toggleClass: '',
		containChildId: ''
	};

	$.extend(this.options, options);

	this.childHTML = preload;
	this.parentSel = getEl(this.options.parentSelId);
	this.containChild = getEl(this.options.containChildId);

	$(this.parentSel).bind(
		'change',
		{instance: this},
		function(event) {
			event.data.instance.parentSelChanged(event.target);
		}
	);
};





/**
 * Fired when the parent selection was changed. This should
 * show the children if there are any.
 *
 * @param {HTMLElement} sel The select that fired the change
 */
DeskPRO.Select2Lvl.prototype.parentSelChanged = function(sel) {

	var parentKey = this.parentSel.options[this.parentSel.selectedIndex].value;
	var childHTML = this.childHTML[this.options.preloadPrefix + parentKey];

	var j_containChild = $(this.containChild);

	if (childHTML) {

		j_containChild.html(childHTML);

		if (j_containChild.css('display') == 'none') {
			j_containChild.css('display', '');
			$('.' + this.options.toggleClass).css('display', '');
		}

	} else {

		j_containChild.html('');

		if (j_containChild.css('display') != 'none') {
			j_containChild.css('display', 'none');
			$('.' + this.options.toggleClass).css('display', 'none');
		}

	}
};










// ####################################################################
// ####################################################################
// ## CLASS : DeskPRO.Forms.Validate
// ####################################################################
// ####################################################################

DeskPRO.Forms.Validate = function(options) {

	this.options = {
		formId: 'form_validate',

		// Run checks when field changes
		checkOnChange: true,

		// Run checks when submitted (no ajax this way, use ajaxSubmit)
		checkOnSubmit: false,

		// If checkOnSubmit is false, then this forces check routines on
		// fields who didn't run it at least once (ie. user skipped it)
		forceOneCheck: true,

		// Configure an ajax call to validate
		// the entire form at once
		ajaxSubmit: {
			url: false,
			data: false,
			messageId: false,
			showInvalidExpr: false,
			showValidExpr: false
		},

		successSubmit: false,
		failSubmit: false
	};

	$.extend(this.options, options);

	this.items = new DeskPRO.Collection();

	this.isOnSubmit = false;

	/*************************
	* Get refs to elements
	*************************/

	this.form = false;
	if (this.options.formId) {
		this.form = getEl(this.options.formId);
	}

	/*************************
	* Assign onsubmit to form
	*************************/

	if (this.form) {
		$(this.form).bind('submit', DeskPRO.createDelegate(this.processSubmit, this));
	}
};





/**
 * Add an auto validation to th
 */
DeskPRO.Forms.Validate.prototype.add = function(el, options) {

	/*************************
	* Sort out the form el
	*************************/

	if (typeof el == 'string') {
		el = getEl(el);
	} else if (el instanceof jQuery) {
		el = el.get(0);
	}

	if (!el) {
		return false;
	}

	if (!el.id || el.id.length == 0) {
		el.id = DeskPRO.getUniqueId();
	}

	/*************************
	* Sort out the options
	*************************/

	var data = {
		id: el.id,
		el: el,

		regex: false,
		minLength: -1,
		maxLength: -1,

		ajaxUrl: false,
		ajaxData: {},
		ajaxMessageId: false,
		ajaxLoadingExpr: false,

		callback: false,
		callbackData: false,
		callbackContext: false,

		showInvalidExpr: false,
		showValidExpr: false,

		addClassInvalid: false,
		removeClassValid: false,

		checkOnChange: this.options.checkOnChange,
		checkOnSubmit: this.options.checkOnSubmit
	};

	$.extend(data, options);

	data.checkCount = 0;

	/*************************
	* Add it
	*************************/

	this.items.add(el.id, data);

	// Add event handler if there are any 'change' options enabled
	if (data.checkOnChange || data.ajaxUrl) {
		$(el).change(DeskPRO.createDelegate(this.fieldChanged, this, [data]));
	}
};





/**
 * Process when the user chooses to submit the form.
 */
DeskPRO.Forms.Validate.prototype.processSubmit = function(ev) {

	var test = parseInt($('#cancel_js_submit_work').val());
	if (test) {
		return true;
	}

	var anyFail = false;
	this.isOnSubmit = true;

	console.group('Processing submit');

	this.items.eachKey(function(id, data) {

		console.log('Checking on submit: %s', id);

		// Dont do check if checkOnSubmit is off, and if forceOneCheck
		// has been satisfied
		if (!data.checkOnSubmit && (!this.options.forceOneCheck || !(this.options.forceOneCheck && data.checkCount))) {
			return;
		}

		var pass = this.checkField(id);

		if (!pass) {
			anyFail = true;
		}

	}, this);

	console.log('Any failures: %d', anyFail);
	console.groupEnd();

	/*************************
	* Return correct status,
	* call submit callbacks
	*************************/

	if (anyFail) {

		var ret = false;

		if (this.options.failSubmit) {
			var ret = this.options.failSubmit();
		}

	} else {

		if (this.options.ajaxSubmit.url) {
			// TODO
		} else {

			var ret = true;
			if (this.options.successSubmit) {
				var ret = this.options.successSubmit();
			}
		}
	}

	this.isOnSubmit = false;

	if (ret) {
		return true;
	} else {
		ev.preventDefault();
		return false;
	}
};





DeskPRO.Forms.Validate.prototype.fieldChanged = function(ev, data) {
	this.checkField(data.el.id);
};





/**
 * Process when the user changes a field
 */
DeskPRO.Forms.Validate.prototype.checkField = function(id) {

	var data = this.items.item(id);

	if (!data) {
		return false;
	}

	var el = data.el;
	var value = DeskPRO.Forms.getValue(el);

	var pass = true;

	console.group('Validate(%d) %o', el.id, el);

	// Min length
	if (pass && data.minLength != -1) {
		pass = value.length >= data.minLength;
		console.log('Min length(%d), field(%d), pass(%d)', data.minLength, value.length, pass);

		this.checkComplete(pass, data);
	}

	// Max length
	if (pass && data.maxLength != -1) {
		pass = value.length <= data.maxLength;
		console.log('Max length(%d), field(%d), pass(%d)', data.manLength, value.length, pass);

		this.checkComplete(pass, data);
	}

	// Regex
	if (pass && data.regex) {
		pass = value.match(data.regex);
		console.log('Regex(%s), pass(%d)', data.regex, value.length, pass);

		this.checkComplete(pass, data);
	}

	// Callback
	if (pass && data.callback) {
		var pass = (DeskPRO.createDelegate(data.callback, data.callbackContext || data.el, [value, el, data]))();
		console.log('Callback(%o), pass(%d)', data.callback, pass);

		this.checkComplete(pass, data);
	}

	// Ajax
	if (pass && data.ajaxUrl && !this.isOnSubmit) {

		console.log('Ajax(%s)', data.ajaxUrl);

		var sendData = {};
		$.extend(sendData, data.ajaxData, {value: value});

		$.ajax({
			success: DeskPRO.createDelegate(this.ajaxComplete, this, [data]),
			dataType: 'json',
			data: sendData,
			url: data.ajaxUrl
		});

		if (data.ajaxLoadingExpr) {
			$(data.ajaxLoadingExpr).css('display', '');
		}
	}

	console.groupEnd();

	return pass;
};





/**
 * Called once a check has been completed
 */
DeskPRO.Forms.Validate.prototype.checkComplete = function(pass, data) {

	data.checkCount++;
	this.items.replace(data.id, data);

	if (pass) {
		this.fieldValid(data);
	} else {
		this.fieldInvalid(data);
	}
};





/**
 * Called once the ajax check has finished loading
 */
DeskPRO.Forms.Validate.prototype.ajaxComplete = function(returnData, completeType, data) {

	if (data.ajaxLoadingExpr) {
		$(data.ajaxLoadingExpr).css('display', 'none');
	}

	if (returnData.message && data.ajaxMessageId) {
		$('#' + data.ajaxMessageId).html(returnData.message);
	}

	if (returnData.showExpr) {
		$(returnData.showExpr).show();
	}

	if (returnData.hideExpr) {
		$(returnData.hideExpr).hide();
	}

	this.checkComplete(returnData.pass, data);
};





/**
 * When a field is invalid, take care of showing the
 * elements with messages
 */
DeskPRO.Forms.Validate.prototype.fieldInvalid = function(data) {

	if (data.addClassInvalid) {
		for(var index = 0; index < data.addClassInvalid.length; index++) {
			var info = data.addClassInvalid[index];
			var el = $(info[0]);

			if (el.length) {
				for (var x = 1; x < info.length; x++) {
					el.addClass(info[x]);
				}
			}
		}
	}

	if (data.showValidExpr) {
		$(data.showValidExpr).hide();
	}

	if (data.showInvalidExpr) {
		$(data.showInvalidExpr).show();
	}

	if (data.ajaxMessageId) {
		$('#' + data.ajaxMessageId).show();
	}
};





/**
 * When a field is invalid, take care of hiding the
 * elements with messages
 */
DeskPRO.Forms.Validate.prototype.fieldValid = function(data) {

	if (data.removeClassValid) {
		for(var index = 0; index < data.removeClassValid.length; index++) {
			var info = data.removeClassValid[index];
			var el = $(info[0]);

			if (el.length) {
				for (var x = 1; x < info.length; x++) {
					el.removeClass(info[x]);
				}
			}
		}
	}

	if (data.showValidExpr) {
		$(data.showValidExpr).show();
	}

	if (data.showInvalidExpr) {
		$(data.showInvalidExpr).hide();
	}

	if (data.ajaxMessageId) {
		$('#' + data.ajaxMessageId).hide();
	}
};










// ####################################################################
// ####################################################################
// ## CLASS : DeskPRO.Widget.CenterScreen
// ####################################################################
// ####################################################################

DeskPRO.Widget.CenterScreen = function(wrapElId) {

	this.wrapEl = $('#' + wrapElId);
	this.wrapEl.hide();

	// Cant be nested, absolute positions are relative to parents
	// So need to move it to <body> at the top
	this.wrapEl.prependTo($(document.body));

	// We do init when first showing since some browsers need
	// it to be actually visible. To prevent "jumping" we should position
	// it absolutely now and set top/left so it'll float above any content
	// for the few millisections before reloacting to center
	this.wrapEl.css('position', 'absolute');
	this.wrapEl.css('z-index', '1000000');
	this.wrapEl.css('top', 0);
	this.wrapEl.css('left', 0);

	this.hasInit = false;

};

DeskPRO.Widget.CenterScreen.prototype.show = function() {

	this.wrapEl.show();
	console.log('Showing');

	if (!this.hasInit) {
		console.log('Initing');
		this.hasInit = true;

		var docW = $(window).width();
		var docH = $(window).height();

		var elW = this.wrapEl.width();
		var elH = this.wrapEl.height();

		var posLeft = (docW / 2) - (elW / 2);
		var posTop = (docH / 2) - (elH / 2);

		this.wrapEl.css('top', posTop);
		this.wrapEl.css('left', posLeft);
	}
};

DeskPRO.Widget.CenterScreen.prototype.hide = function() {

	this.wrapEl.hide();

};





/**
 * Checks to see if the soundManager object is loaded and ready for use.
 * Since it uses flash, you might want to use this to check if you should use
 * a backup feature like simple embed's.
 */
DeskPRO.useSoundManager = function() {
	if (soundManager && soundManager.enabled && !soundManager._disabled) {
		return true;
	}
	
	return false;
};






if (typeof Ext != 'undefined' && typeof Ext.tree != 'undefined' && typeof Ext.tree.TreeDropZone != 'undefined') {
	// TODO: Remove when fixed
	// - Fix for bug in Ext2 RC1
	// - Now allowing to append to a leaf node
	Ext.tree.TreeDropZone.prototype.getDropPoint = function(e, n, dd){
	    var tn = n.node;
	    if(tn.isRoot){
	        return tn.allowChildren !== false ? "append" : false; // always append for root
	    }
	    var dragEl = n.ddel;
	    var t = Ext.lib.Dom.getY(dragEl), b = t + dragEl.offsetHeight;
	    var y = Ext.lib.Event.getPageY(e);
	    var noAppend = tn.allowChildren === false;
	    if(this.appendOnly || tn.parentNode.allowChildren === false){
	        return noAppend ? false : "append";
	    }
	    var noBelow = false;
	    if(!this.allowParentInsert){
	        noBelow = tn.hasChildNodes() && tn.isExpanded();
	    }
	    var q = (b - t) / (noAppend ? 2 : 3);
	    if(y >= t && y < (t + q)){
	        return "above";
	    }else if(!noBelow && (noAppend || y >= b-q && y <= b)){
	        return "below";
	    }else{
	        return "append";
	    }
	};
}