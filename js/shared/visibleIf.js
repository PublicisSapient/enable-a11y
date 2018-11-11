/*
 * This notice must be untouched at all times.
 * 
 * visibleIf.js - a cross browser form field manager that hides and shows
 * form fields depending on the values of other form fields.
 *
 * Version 1.0 released Feb 21, 2009
 * Version 2.0 released June 20, 2010.  Features new 
 *   rules engine originally developed for HTML5Widgets.js and HTML5 custom
 *   data- attribute support.
 * Version 3.0 released July 17, 2018.
 *   Remove IE8 support.
 *
 * Written by: Zoltan Hawryluk. 
 * 
 * Latest release available at http://www.useragentman.com/
 *
 * released under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */

var visibleIf = new function(){
    var me = this;
    
    var formInputCache = new Array();
    var changedInput = null;
    
    var visibleIfNodes;
    var mandatoryNodes;
    var varRe = /\s([a-zA-Z][a-zA-Z0-9\.]*)\s/g;
    var operatorRe = /\s*(~|!=|==|>={0,1}|<={0,1})\s*/g;
    var leftBkRe = /\(/g;
    var rightBkRe = /\)/g;
    var reRe = /~ \"([^\"]*)\"/g;
    var equalsRe = / == /g;
    var quotedStringRe = /"[^"]*"/g;
    var quotedStringOneOnlyRe = /"[^"]*"/;
    var placeHolderString = '_pLaCeHoLdEr_';
    var placeHolderRe = new RegExp(placeHolderString);
    
    var nodesWithEventsAttached = new Array();
    
    var inputsToClear;
    
    var req = null;
    
    var nameCounter = 0;
    var StringHelpers, XMLHelpers, DOMHelpers;
    /*
     * Things to look into:
     *
     * I don't think you need the options.isPageLoad checks inside
     * setFormElementsInside() since we are setting doClear accordingly.
     */
    me.init = function(reset){
        visibleIfNodes = document.getElementsByClassName('visibleIf');
        mandatoryNodes = document.getElementsByClassName('mandatoryIf');
        
        removeDisabledNodes();
        me.refreshPage({
            isPageLoad: true
        });
        setMandatoryStates();
        setEvents();
        //strutsHelpers.populateDynamicFormElements();
    }
    
    function removeDisabledNodes(){
    
        for (var i = 0; i < visibleIfNodes.length; i++) {
            var node = visibleIfNodes[i];
            
            var els = getAllFormElementsIn(node)
            
            for (var j = 0; j < els.length; j++) {
                var el = els[j];
                el.disabled = false;
                
            }
        }
    }
    
    function refreshPageEvent(e){
        me.refreshPage();
    }
    
    me.refreshPage = function(options){
    
        changedInput = this;
        
        inputsToClear = new Array();
        qsSb = new StringBuffer();
        for (var i = 0; i < visibleIfNodes.length; i++) {
            setVisibility(visibleIfNodes[i], options);
        }
        
        
        if (!(options && !options.isPageLoaded)) {
            for (i in inputsToClear) {
                var el = inputsToClear[i];
                if (i != 0) {
                    qsSb.append('&');
                }
                qsSb.append(i).append('=');
            }
            
            var qs = qsSb.toString();
            
            
            if (qsSb.getLength() > 0) {
            
                var url = document.body.getAttribute('data-visibleif-deletedataurl');
                
                if (url) {
                    req = XMLHelpers.getXMLHttpRequest(url, deleteRequestHandler, 'GET', qs);
                }
                
            }
            
            
            
            for (var i = 0; i < mandatoryNodes.length; i++) {
                setMandatoryStates(mandatoryNodes[i], options);
                
            }
        }
        
		var formNodes = document.getElementsByTagName('form');
		
		for (var i=0; i<formNodes.length; i++) {
			updateVisibilityProperties(formNodes[i]);
		}
    }
    
    function setMandatoryStates(e){
        changedInput = this;
        for (var i = 0; i < mandatoryNodes.length; i++) {
            setMandatoryState(mandatoryNodes[i]);
            
        }
        
    }
    
    function getRule(node, type){
        var r = node.getAttribute('data-' + type);
        
        if (!r) {
            r = node.getElementsByClassName(type);
            
            if (r.length == 0) {
                r = null;
            } else {
                r = r[0].innerHTML.trim()
            }
        }
        
        if (r) {
            r = StringHelpers.unentify(" " + r.replace(operatorRe, ' $1 ') + " ");
        }
        
        return r;
    }
    
    function setEvents(){
        visibleIfNodes = document.getElementsByClassName('visibleIf');
        mandatoryNodes = document.getElementsByClassName('mandatoryIf');
        var nodesToIndex = [visibleIfNodes, mandatoryNodes];
        var nameCounter = 0;
        var forms = document.getElementsByTagName('form');
        
        for (var i = 0; i < forms.length; i++) {
            forms[i].addEventListener('submit', formSubmitEvent);
        }
        
        
        
        for (var n = 0; n < nodesToIndex.length; n++) {
            var nodes = nodesToIndex[n];
            for (var i = 0; i < nodes.length; i++) {
                var node = nodes[i];
				var parentForm = DOMHelpers.getAncestorByTagName(node, 'form');
				
                var rule;
                var ruleType;
                if (n == 0) {
                    ruleType = "visibleIf-rule";
                } else {
                    ruleType = "mandatoryIf-rule";
                }
                
                rule = getRule(node, ruleType);
                
                if (!rule) {
                    throw "There is no rule for with the node with the following HTML:" + node.outerHTML;
                }
                
                
                
                var inputVars = getInputVars(rule);
                
                if (inputVars) {
                    for (var j = 0; j < inputVars.length; j++) {
                        var inputVar = inputVars[j];
                        if (!nodesWithEventsAttached[parentForm.id]|| !nodesWithEventsAttached[parentForm.id][inputVar]) {
							
							if (!nodesWithEventsAttached[parentForm.id]) {
								nodesWithEventsAttached[parentForm.id] = new Array();
							}
							
                            nodesWithEventsAttached[parentForm.id][inputVar] = true;
                            
                            if (inputVars.length > 0) {
                                                                
                                var fieldNode = parentForm[inputVars[j]];
                                //var fieldNode = document.getElementById(inputVars[j]);
                                
                                if (fieldNode != null) {
                                    if (fieldNode.nodeName != "SELECT" && fieldNode.length) {
                                        for (var k = 0; k < fieldNode.length; k++) {
                                            fieldNode[k].addEventListener('click', refreshPageEvent);
                                            
                                        }
                                    } else {
                                    
                                        fieldNode.addEventListener('change', refreshPageEvent);
                                    }
                                    
                                    if (fieldNode.type == 'text') {
                                    
                                        fieldNode.addEventListener('change', refreshPageEvent);
                                    }
                                    
                                    if (fieldNode.type == 'checkbox') {
                                        fieldNode.addEventListener('click', refreshPageEvent);
                                    }
                                }
                                
                            }
                        }
                    }
                }
            }
        }
        
    }
	
	function updateVisibilityProperties(formNode){
		var fields = formNode.elements;
		
		for (var i = 0; i < fields.length; i++) {
            var field = fields[i],
                fieldClassList = field.classList;
			if (!isVisible(field) && !fieldClassList.contains('visibleIf-submitIfInvisible')) {
				fieldClassList.add('visibleIf-notSubmitted');
				field.disabled = true;
			} else {
				fieldClassList.remove('visibleIf-notSubmitted');
				field.disabled = false;
			}
		}
	}
	
    function formSubmitEvent(e){
    
        if (this.classList.contains('visibleIf-submitInvisibleData')) {
            return;
        }
        
        updateVisibilityProperties(this);
    }
    
    function isVisible(node){
        return node.offsetWidth != 0;
    }
    
    
    
    function setVisibility(node, options){
        var rule = getRule(node, 'visibleIf-rule'),
            nodeClassList = node.classList;
        
        if (rule == null) {
            throw "There is no rule for with the node with the following HTML:" + node.outerHTML;
        }
        
        var isRuleTrue = evaluateRule(DOMHelpers.getAncestorByTagName(node, 'form'), rule);
        
        
        if (isRuleTrue) {
            nodeClassList.add('visibleIf-visible');
            setFormElementsInside(node, false, options);
        } else {
            nodeClassList.remove('visibleIf-visible');
            
            if (options && options.isPageLoad) {
                setFormElementsInside(node, false, options);
            } else {
                setFormElementsInside(node, true, options);
            }
        }
    }
    
    function setMandatoryState(node){
        var rule = getRule(node, 'mandatoryIf-rule'),
            nodeClassList = node.classList;
        
        if (rule == null) {
            throw "There is no rule for with the node with the following HTML:" + node.outerHTML;
        }
        
        
        var isRuleTrue = evaluateRule(DOMHelpers.getAncestorByTagName(node, 'form'), getRule(node, rule));
        
        
        if (isRuleTrue) {
            nodeClassList.add('mandatoryIf-mandatory');
            //setFormElementsInside(node, false);
        } else {
            nodeClassList.remove('mandatoryIf-mandatory');
            //setFormElementsInside(node, true);
        }
        
    }
    
    
    function evaluateRule(parentForm, rule){ //node, ruleNode) {
        //var rule = getRuleString(ruleNode);
        
        if (rule == "") {
            return true;
        } else {
        
        
            if (rule != null) {
            
                //var parentForm = DOMHelpers.getAncestorByTagName(node, 'form');
                if (!parentForm) {
                    throw "Error: the rule " + rule + " is not attached to a form."
                }
                
                var stringToEval;
                
                var formElem = parentForm[rule.name];
                
                // first, replace all quoted strings with placeholders:
                var diddledRule = rule.replace(quotedStringRe, placeHolderString);
                
                // next, grab all those quoted strings
                var quotedVals = rule.match(quotedStringRe);
                
                
                var formId = parentForm.id;
                
                if (!formId) {
                    formId = 'visibleIf-form' + nameCounter;
                    parentForm.id = formId;
                    
                    nameCounter++;
                }
                
                
                // now replace all variables with javascript form element values
                stringToEval = diddledRule.replace(leftBkRe, '( ').replace(rightBkRe, ' )').replace(varRe, 'getFieldValue(document.getElementById("' +
                formId +
                '")["$1"]) ').replace(reRe, '.match(/$1/)');
                
                // now, replace placeholders back to the original strings.
                if (quotedVals) {
                    for (var i = 0; i < quotedVals.length; i++) {
                        stringToEval = stringToEval.replace(placeHolderRe, quotedVals[i]);
                    }
                }
                
               
                try {
                    if (eval(stringToEval)) {
                        return true;
                    } else {
                        return false;
                    }
                } 
                catch (ex) {
                    //alert('Bad equation: ' + stringToEval)
                    return false;
                }
            }
        }
    }
    
    
    function setFormElementsInside(node, doClear, options){
    
    
    
        if (!options) {
            options = {};
        }
        
        var formElements = getAllFormElementsIn(node);
        
        for (var i = 0; i < formElements.length; i++) {
        
        
            var el = formElements[i],
                elClassList = el.classList;
            
            if (el != changedInput) {
            
                switch (el.nodeName) {
                    case "INPUT":
                        switch (el.type) {
                        
                            case "checkbox":
                                if (el.checked) {
                                    if (doClear) {
                                    
                                        if (!elClassList.contains('visibleIf-doNotReset')) {
                                            // cache the value
                                            formCache.setValue(el.name, el.value);
                                            el.checked = false;
                                            addToInputToClear(el);
                                        }
                                        
                                    } else if (formCache.getValue(el.name) == el.value) {
                                    //el.checked = true;
                                    
                                    }
                                }
                                break;
                            case "radio":
                                
                                if (doClear) {
                                
                                    if (!el.contains('visibleIf-doNotReset')) {
                                    
                                        // cache the value
                                        if (el.checked) {
                                            formCache.setValue(el.name, el.value);
                                            el.checked = false;
                                        }
                                        addToInputToClear(el);
                                        
                                    }
                                    
                                } else if (formCache.getValue(el.name) == el.value) {
                                //el.checked = true;
                                
                                }
                                
                                break;
                                
                            case "file":
                                
                                // do nothing to avoid a security error.
                                break;
                            case "hidden":
                                // don't do anything
                                break;
                            default:
                                if (doClear) {
                                
                                    /*
                             * The following code is for use with a seperate
                             * JavaScript library, fileChanger.js.  If
                             * it's a fileChanger widget, we need to do an Ajax call
                             */
                                    if (elClassList.contains('fileList_fileDisplay')) {
                                        elClassList.remove('fileList_fileDisplay');
                                        el.disabled = false;
                                        el.name = el.name.replace("_ignore", "")
                                        var html = el.outerHTML.replace(/text/, 'file');
                                        el.parentNode.innerHTML = html;
                                        
                                        // insert ajax call to delete file here.
                                        url = config.getScriptedValue('visibleIf.urls.deleteFiles', {
                                            files: StringHelpers.urlencode(el.value),
                                            formProperty: el.name
                                        })
                                        req = XMLHelpers.getXMLHttpRequest(url, deleteRequestHandler);
                                    }
                                    
                                    
                                    // cache the value
                                    formCache.setValue(el.name, el.value);
                                    if (options.isPageLoad) {
                                        el.value = el.getAttribute('value');
                                        if (el.value == "null") {
                                            el.value = "";
                                        }
                                    } else if (!elClassList.contains('visibleIf-doNotReset')) {
                                        el.value = "";
                                        addToInputToClear(el);
                                    }
                                    
                                } else {
                                //el.value = formCache.getValue(el.name);
                                }
                                break;
                        }
                        break;
                    case "TEXTAREA":
                        if (doClear) {
                            // cache the value
                            formCache.setValue(el.name, el.value);
                            if (options.isPageLoad) {
                            //el.value = DOMHelpers.getAttributeValue(el, 'value');
                            } else if (!elClassList.contains('visibleIf-doNotReset')) {
                                el.value = "";
                                addToInputToClear(el);
                            }
                        } else {
                        //el.value = formCache.getValue(el.name);
                        }
                        
                        break;
                    case "SELECT":
                        if (doClear) {
                        
                            if (!elClassList.contains('visibleIf-doNotReset')) {
                                // cache the value
                                formCache.setValue(el.name, el.selectedIndex);
                                
                                // TODO: should this be 0 or -1?
                                el.selectedIndex = 0;
                                addToInputToClear(el);
                            }
                            
                            el.disabled = true;
                            
                        } else {
                            //el.selectedValue =  formCache.getValue(el.name);
                            el.disabled = false;
                        }
                        break;
                        
                        
                }
            }
            
        }
        
        
        
        
        
        
        
    }
    
    function addToInputToClear(el){
        if (!inputsToClear[el.name]) {
            inputsToClear[el.name] = el;
        }
    }
    
    function deleteRequestHandler(){
    
        if (!req) {
            return;
        }
        
        // only if req shows "complete"
        if (req.readyState == ReadyState.COMPLETED) {
            // only if "OK"
            //DebugHelpers.log(req.getAllResponseHeaders());
            
            if (req.status == HttpCode.OK || req.status == HttpCode.LOCAL_OK) {
                // whatever
                //jslog.debug('Deleted Successfully')
            } else {
                throw "Something bad happened.  HTTP Status: " + req.status;
                
            }
        }
    }
    
    
    function getInputVars(rule){
        rule = rule.replace(leftBkRe, '( ').replace(rightBkRe, ' )');
        var vars = rule.match(varRe);
        
        if (vars == null) {
            return new Array();
        }
        
        for (var i = 0; i < vars.length; i++) {
            vars[i] = vars[i].trim();
        }
        
        
        return vars;
        
    }
    
    
    function getFieldValue(formElementNode){
        var r = "";
        var type;
        
        type = formElementNode.type
        
        if (!type) {
            if (formElementNode.length) 
                type = formElementNode[0].type;
        }
        
        
        switch (type) {
        
            case 'text':
            case 'hidden':
            case 'password':
            case 'textarea':
            case 'select-one':
                r = formElementNode.value;
            case 'checkbox':
                if (formElementNode.checked) {
                    r = formElementNode.value;
                }
                break;
            case 'radio':
                for (var i = 0; i < formElementNode.length; i++) {
                    if (formElementNode[i].checked) {
                        r = formElementNode[i].value;
                        break;
                    }
                }
                
                
        }
        
        if (formElementNode.length) {
            for (var i = 0; i < formElementNode.length; i++) {
                if (formElementNode[i].checked) {
                    r = formElementNode[i].value;
                }
            }
            
        }
        
        return r.replace('\n', '').replace('   ', '');
    }
    
    function getAllFormElementsIn(node){
        if (!node) {
            node = document;
        }
        
        var r = new Array();
        
        var elems = {
            inputs: node.getElementsByTagName('input'),
            selects: node.getElementsByTagName('select'),
            textareas: node.getElementsByTagName('textarea')
        };
        
        for (var i in elems) {
            var elem = elems[i];
            for (j = 0; j < elem.length; j++) {
                r.push(elem[j]);
            }
        }
        
        return r;
    }
    
    
    
    if (window.DOMHelpers) {
        DOMHelpers = window.DOMHelpers;
    } else {
        DOMHelpers = new function(){
            var me = this;
            
            me.getAncestorByTagName = function(obj, tagName){
            
                for (var node = obj.parentNode; node.nodeName.toLowerCase() != 'body'; node = node.parentNode) {
                
                    if (tagName.toLowerCase() == node.nodeName.toLowerCase()) {
                        return node;
                    }
                    
                }
                return null;
            }
        }
    }
    
    if (window.StringHelpers) {
        StringHelpers = window.StringHelpers;
    } else {
        StringHelpers = new function(){
            var me = this;
            me.initWhitespaceRe = /^\s\s*/;
            me.endWhitespaceRe = /\s\s*$/;
            me.whitespaceRe = /\s/;
            
            me.unentify = function(s){
                return s.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>');
            }
            
            // TODO: See if we can replace this with encodeURIComponent()
            me.urlencode = function(str){
                return escape(str).replace('+', '%2B').replace('%20', '+').replace('*', '%2A').replace('/', '%2F').replace('@', '%40');
            }
            
        }
    }
    
    if (window.XMLHelpers) {
        XMLHelpers = window.XMLHelpers;
    } else {
        XMLHelpers = new function(){
            var me = this;
            
            /**
             * Wrapper for XMLHttpRequest Object.  Grabbing data (XML and/or text) from a URL.
             * Grabbing data from a URL. Input is one parameter, url. It returns a request
             * object. Based on code from
             * http://www.xml.com/pub/a/2005/02/09/xml-http-request.html.  IE caching problem
             * fix from Wikipedia article http://en.wikipedia.org/wiki/XMLHttpRequest
             *
             * @param {String} url - the URL to retrieve
             * @param {Function} processReqChange - the function/method to call at key events of the URL retrieval.
             * @param {String} method - (optional) "GET" or "POST" (default "GET")
             * @param {String} data - (optional) the CGI data to pass.  Default null.
             * @param {boolean} isAsync - (optional) is this call asyncronous.  Default true.
             *
             * @return {Object} a XML request object.
             */
            me.getXMLHttpRequest = function(url, processReqChange) //, method, data, isAsync)
            {
                var argv = me.getXMLHttpRequest.arguments;
                var argc = me.getXMLHttpRequest.arguments.length;
                var httpMethod = (argc > 2) ? argv[2] : 'GET';
                var data = (argc > 3) ? argv[3] : "";
                var isAsync = (argc > 4) ? argv[4] : true;
                
                var req;
                // branch for native XMLHttpRequest object
                if (window.XMLHttpRequest) {
                    req = new XMLHttpRequest();
                // no support branch
                } else {
                    return null;
                }
                
                if (isAsync) {
                    req.onreadystatechange = processReqChange;
                }
                
                if (httpMethod == "GET" && data != "") {
                    url += "?" + data;
                }
                
                req.open(httpMethod, url, isAsync);
                
                //Fixes IE Caching problem
                req.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
                req.send(data);
                
                return req;
            }
            
        }
    }
    
    /*
     *  stringBuffer - ideas from
     *  http://www.multitask.com.au/people/dion/archives/000354.html
     */
    function StringBuffer(){
        var me = this;
        
        var buffer = [];
        
        
        me.append = function(string){
            buffer.push(string);
            return me;
        }
        
        me.appendBuffer = function(bufferToAppend){
            buffer = buffer.concat(bufferToAppend);
        }
        
        me.toString = function(){
            return buffer.join("");
        }
        
        me.getLength = function(){
            return buffer.length;
        }
        
        me.flush = function(){
            buffer.length = 0;
        }
        
    }
}

var formCache = new function(){
    var me = this;
    var values = new Array();
    
    me.setValue = function(name, value){
        values[name] = value;
    }
    
    me.getValue = function(name){
        if (values[name] == undefined) {
            return "";
        } else {
            return values[name];
        }
    }
}

visibleIf.init();