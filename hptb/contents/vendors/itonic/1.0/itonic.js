//Created by Aman Ullah, E-mail: amanullah.en@gmail.com, Phone: +8801823022586

//Interactive Tonic (itonic) for interactive web application with Javascript

// NB: jquery is required!

//itonic pixel varifier
function it_is_pixel(px_) {
    if (px_ === "") {
        return false;
    }
    if (px_ === "inherit") {
        return false;
    }
    if (px_ === "auto") {
        return false;
    }
    var e = document.createElement("p");
    e.style.width = '10px';
    e.style.width = px_;
    if (e.style.width !== '10px') {
        return true;
    }
    e.style.width = '20px';
    e.style.width = px_;
    return e.style.width !== '20px';
}

//itonic color varifier
function it_is_color(clr_) {
    if (clr_ === "") {
        return false;
    }
    if (clr_ === "inherit") {
        return false;
    }
    if (clr_ === "transparent") {
        return false;
    }
    var e = document.createElement("p");
    e.style.color = "rgb(0, 0, 0)";
    e.style.color = clr_;
    if (e.style.color !== "rgb(0, 0, 0)") {
        return true;
    }
    e.style.color = "rgb(255, 255, 255)";
    e.style.color = clr_;
    return e.style.color !== "rgb(255, 255, 255)";
}

//itonic input field varifier
function it_input_filter(text) {
  text.trim();
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

//itonic URL parameter parser
function it_hold_request(arr, url) {
    if(typeof url != 'string') url = window.location.href;
    var queryStart = url.indexOf("?") + 1;
    var queryEnd = url.indexOf("#") + 1 || url.length + 1;
    var query = url.slice(queryStart, queryEnd - 1);
    
    if (query + '#' === url || query === url || query === "") return;
    
    var pairs = query.replace(/\+/g, " ").split("&");
    var params = {};    
    
    pairs.forEach(function(val){
        var indval = val.split("=", 2);
        var indname = decodeURIComponent(indval[0]);
        var value = decodeURIComponent(indval[1]);
        
        if(arr){
            if (!params.hasOwnProperty(indname)) params[indname] = [];
            params[indname].push(value);
        }else{
            params[indname] = value;
        }
    });
    return params;
}

//itonic modal html and css appending with the exixting html document
$(function () {
    $('head').append("<style>#iM_{display:none;position:fixed;z-index:100001;padding-top: 100px;left:0;top:0;font-family: sans-serif;font-size: 12pt;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);}#iM_-content{display:none;position:relative;margin:auto;padding:0;border:1px solid #bfbfbf;box-shadow:0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}#iM_-close{float:right;font-size:28px;font-weight:bold;margin-top:-10px;cursor:pointer;}#iM_-header{box-sizing: border-box;padding:9px 10px;color:white;height:40px;}#iM_-header h3{margin:0px;font-family: sans-serif;font-size: 1.17em;}#iM_-body{padding:10px 10px;}#iM_-footer{box-sizing: border-box;padding:7px 16px;height:40px;}#iM_-footer button{border: 1px solid #b7b5b5;margin-left: 5px;font-weight:400;float:right;min-width:60px;height:26px;line-height:23px;vertical-align:middle;font-size:10pt;cursor:pointer;display:none;}#iM_-footer button:hover{border-color:#918d8d;}#iM_-msg{display:none;color:white;z-index:2147483647;margin:auto;font-family:sans-serif;font-size:20pt;text-align:center;position:fixed;top:calc(50% - 130px);left:0;right:0;}#iM_-loadspinner{display:none;height: 100px;width: 100px;z-index:2147483647;position:fixed;background-position: center;background-repeat: no-repeat;background-size: 100%;left:0;right:0;top:calc(50% - 50px);margin:auto;}@keyframes iM_Round{from{transform: rotate(0deg)}to{transform: rotate(360deg)}}</style>");
    $('body').append("<div id='iM_'><div id='iM_-loadspinner'></div><div id='iM_-msg'></div><div id='iM_-content'><div id='iM_-header'><span id='iM_-close'>&#10006;</span><h3></h3></div><div id='iM_-body'></div><div id='iM_-footer'><button></button><button></button><button></button><button></button><button></button><button></button><button></button><button></button><button></button><button></button></div></div></div>");
});

//itonic modal executor
function it_modal_execute(obj) {
    

    //headerText:           =>Header text
    //headerTextColor:      =>Header Text Color
    //headerColor:          =>Header Color only
    //footerColor:          =>Footer Color only
    //color:                =>Header Footer Combinedly set same Color
    //crossButtonColor:     =>Cancel button color
    //bodyHtml:             =>Body html content
    //bodyColor:            =>Modal background color
    //width:                =>modal size in pixel. ie: "400px"
    //createButton:         =>Write button names you want with comma saparated.
    //buttonColor:          =>Button background color
    //buttonTextColor:      =>Button text color
    //backLayerColor:       =>Modal back layer color
    //draggable:            =>boolean value true or false
    //aeris                 =>boolean value ture or false
    //action:               =>Make a function with a variable. variable will return the value of button text at onClick button. Calcel button will return boolean false.
    
    
    if(typeof obj != 'object') obj = {};
    
    {
        var n_ = $('#iM_-content');
        var h_ = $('#iM_-header');
        var ht_ = $('#iM_-header h3');
        var f_ = $('#iM_-footer');
        var b_ = $('#iM_-footer button');
    }
    
    // Controlling buttons
    if(typeof obj.createButton == 'string'){
         var btnAll = obj.createButton.split(',').reverse();
        btnAll.forEach(function(b,i){
            if($("#iM_-footer button:nth-child("+(i+1)+")").length){
                $("#iM_-footer button:nth-child("+(i+1)+")").text(b.trim()).css({
                    'display':'block'
                });
            }
        });
    }
   
    
    // Add Custom Header
    if (typeof obj.headerText == 'string') ht_.html(obj.headerText);
    else console.log('Warning: headerText is undefined or not string!');
    // Add custom Boday
    if (typeof obj.bodyHtml == 'string') $('#iM_-body').html(obj.bodyHtml);
    else console.log('Warning: bodyHtml is undefined or not string!');

    // setup width of the modal
    if (typeof obj.width == 'string' && it_is_pixel(obj.width)) {
        n_.css({
            'width': obj.width
        });
    } else {
        n_.css({
            'width': '400px'
        });
    }
    // setup color of the modal
    {
        if(typeof obj.backLayerColor == 'string' && it_is_color(obj.backLayerColor)){
            $('#iM_').css({
                'background-color': obj.backLayerColor
            });
        }else{
            $('#iM_').css({
                'background-color': 'rgba(0,0,0,0.4)'
            });
        }
        if(typeof obj.bodyColor == 'string' && it_is_color(obj.bodyColor)){
            n_.css({
                'background-color': obj.bodyColor
            });
        }else{
            n_.css({
                'background-color': 'white'
            });
        }
        if(typeof obj.color == 'string' && it_is_color(obj.color)){
            h_.css({
                'background-color': obj.color
            });
            f_.css({
                'background-color': obj.color
            });
        }else{
            if(typeof obj.headerColor == 'string' && it_is_color(obj.headerColor)){
                h_.css({
                    'background-color': obj.headerColor
                });
            }else{
                h_.css({
                    'background-color': 'gray'
                });
            }
            if(typeof obj.footerColor == 'string' && it_is_color(obj.footerColor)){
                f_.css({
                    'background-color': obj.footerColor
                });
            }else{
                f_.css({
                    'background-color': 'gray'
                });
            }
        }
        if(typeof obj.crossButtonColor == 'string' && it_is_color(obj.crossButtonColor)){
            $('#iM_-close').css({
                'color': obj.crossButtonColor
            });
        }else{
            $('#iM_-close').css({
                'color': 'white'
            });
        }
        if(typeof obj.buttonColor == 'string' && it_is_color(obj.buttonColor)){
            b_.css({
                'background-color': obj.buttonColor
            });
        }else{
            b_.css({
                'background-color': 'white'
            });
        }
        if(typeof obj.buttonTextColor == 'string' && it_is_color(obj.buttonTextColor)){
            b_.css({
                'color': obj.buttonTextColor
            });
        }else{
            b_.css({
                'color': '#444'
            });
        }
        if(typeof obj.headerTextColor == 'string' && it_is_color(obj.headerTextColor)){
            ht_.css({
                'color': obj.headerTextColor
            });
        }else{
            ht_.css({
                'color': 'white'
            });
        }
    }
    // aeris design
    if (obj.aeris == true){
        n_.css({
            'border-radius':'7px'
        });
        h_.css({
            'border-top-left-radius':'6px',
            'border-top-right-radius':'6px'
        });
        f_.css({
            'border-bottom-left-radius':'6px',
            'border-bottom-right-radius':'6px'
        });
        b_.css({
            'border-radius':'4px'
        });
    }
    // Making Draggable the modal section
    if (obj.draggable == true){
        if(typeof $.fn.draggable == 'function') n_.draggable({cancel : '#iM_-body'});
        else console.log('Error: Required jquery-ui with draggable function!');
    } 
    
    // Display the Modal Bacground
    {
        $('#iM_').css({
            'display': 'block'
        });
        n_.css({
            'display': 'block'
        });
        $('#iM_-loadspinner').css({
            'display': 'none'
        });
        $('#iM_-msg').css({
            'display': 'none'
        });
    }
    
    $('#iM_-close').unbind('click');
    $('#iM_-close').click(function () {
        if( !(rv_ = it_modal_close()) && typeof(obj.action)=='function') obj.action(rv_);
    });
    b_.unbind('click');
    b_.click(function () {
        if(typeof(obj.action)=='function') obj.action($(this).text());
        else console.log('Error: action function is not defined!');
    });
}

//itonic modal loading executor for graphical loading view
function it_modal_onduty(obj) {
    
    //message           =>Loading window message text in html format
    //messageColor      =>
    //graphics          =>Loading window animation graphics link
    //backLayerColor:   =>Modal back layer color
    
    if(typeof obj != 'object') obj = {};
    
    if(typeof obj.backLayerColor == 'string' && it_is_color(obj.backLayerColor)){
        $('#iM_').css({
            'background-color': obj.backLayerColor
        });
    }else{
        $('#iM_').css({
            'background-color': 'rgba(0,0,0,0.4)'
        });
    }
    if(typeof obj.messageColor == 'string' && it_is_color(obj.messageColor)){
        $('#iM_-msg').css({
            'color': obj.messageColor
        });
    }else{
        $('#iM_-msg').css({
            'color': 'white'
        });
    }
    
    if ((typeof obj.message) == 'string') {
        $('#iM_-msg').html(obj.message);
    }
    else {
        $('#iM_-msg').html("Execution is in progress....<br/>Please Wait !");
    }
    
    if ((typeof obj.graphics) == 'string') {
        $('#iM_-loadspinner').css({
            'border': 'none',
            'border-radius': '0',
            'animation': 'none',
            'background-image': 'url(' + obj.graphics + ')'
        });
    }
    else {
        $('#iM_-loadspinner').css({
            'border': '5px solid white'
            , 'border-top-color': '#ff7000'
            , 'border-radius': '100%'
            , 'background-image': 'none'
            , 'animation': 'iM_Round 2s linear infinite'
        });
    }
    $('#iM_').css({
        'display': 'block'
    });
    $('#iM_-content').css({
        'display': 'none'
    });
    $('#iM_-loadspinner').css({
        'display': 'block'
    });
    $('#iM_-msg').css({
        'display': 'block'
    });
}

//itonic modal close function to hide modal graphical view and dismiss the user interface code
function it_modal_close() {
    $('#iM_-header h3').text("");
    $('#iM_-body').html("");
    $("#iM_-footer button").css({
        'display': 'none'
    });
    $('#iM_').css({
        'display': 'none'
    });
    $('#iM_-content').css({
        'display': 'none'
    });
    $('#iM_-loadspinner').css({
        'display': 'none'
    });
    $('#iM_-msg').css({
        'display': 'none'
    });
    return false;
}

//itonic modal loading activator schema
function it_modal_loading(message, graphicslink, messagecolor, blcolor){
    it_modal_onduty({
        message: message,
        messageColor: messagecolor,
        graphics: graphicslink,
        backLayerColor: blcolor
    });
}

//itonic modal open schema
function it_modal_open(header, body, hfcolor, width, cbuttons, callback, btncolor, btntxtcolor, crsbtncolor){
    it_modal_execute({
        headerText: header,
        bodyHtml: body,
        color: hfcolor,
        width: width,
        createButton: cbuttons,
        draggable: true,
        aeris: false,
        action: callback,
        buttonColor: btncolor,
        buttonTextColor: btntxtcolor,
        crossButtonColor: crsbtncolor
    });
}

//itonic modal success view
function it_modal_success(bodyHtml){
    it_modal_execute({
        headerText: '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Success !',
        color: "#007E33",
        bodyHtml: bodyHtml,
        createButton: "OK",
        draggable: true,
        action: function(){it_modal_close();}
    });
}

//itonic modal error view
function it_modal_error(bodyHtml){
    it_modal_execute({
        headerText: '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Error !',
        color: "#CC0000",
        bodyHtml: bodyHtml,
        createButton: "OK",
        draggable: true,
        action: function(){it_modal_close();}
    });
}

//itonic modal warning view
function it_modal_warning(bodyHtml){
    it_modal_execute({
        headerText: '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Warning !',
        color: "#FF8800",
        bodyHtml: bodyHtml,
        createButton: "OK",
        draggable: true,
        action: function(){it_modal_close();}
    });
}

//itonic modal info view
function it_modal_info(bodyHtml){
    it_modal_execute({
        headerText: '<i class="fa fa-info-circle" aria-hidden="true"></i> Information !',
        color: "#0099CC",
        bodyHtml: bodyHtml,
        createButton: "OK",
        draggable: true,
        action: function(){it_modal_close();}
    });
}

//itonic modal message view
function it_modal_warning(bodyHtml){
    it_modal_execute({
        headerText: '<i class="fa fa-comment-o" aria-hidden="true"></i> Message !',
        color: "#33b5e5",
        bodyHtml: bodyHtml,
        createButton: "OK",
        draggable: true,
        action: function(){it_modal_close();}
    });
}

//itonic upload executor to drive the progress, success and error status
function it_upload_execute(obj) {
    //url:                  => target upload url
    //file:                 => file input field id (only id is accepable no class or element)
    //name:                 => the pass name.. ie: $_FILE['name']
    //format:               => define acceptable file formats in a string with comma saparation.
    //size:                 => give maximum file size in bytes.
    //progress:             => progress function return (0 to 100 parcent value, file size loaded, total file size, remaining file size)
    //success:              => status function return (status number, status comment/description)
    //fail:                 => response function return the oupu from target upload url as text format.

    if (typeof obj == 'object') {
        if (typeof obj.url == 'string' && typeof obj.file == 'string') {
            var crt = "Error: fail function is not defined!";
            var ffc = typeof obj.fail == "function";
            var file = document.getElementById(obj.file).files[0];
            var fileExt = $('#' + obj.file).val().split('.').pop().toLowerCase();
            var filesize = 10000000000; //default file size
            if (typeof obj.size == "number") filesize = obj.size;
            var fpname = "file"; // default file pass name
            if (typeof obj.name == "string") fpname = obj.name;
            //alert(file.name+" | "+file.size+" | "+file.type);
            if ($('#' + obj.file).val().length == 0) {
                if (ffc) obj.fail("File input field is empty!", 3);
                else console.log(crt);
            } else if (file.size > filesize) {
                if (ffc) obj.fail("Maximum file size is exceeded!", 5);
                else console.log(crt);
            } else {
                var acceptableFileFormat = false;
                if (typeof obj.format == "string") {
                    var fileFormats = obj.format.split(",");
                    fileFormats.forEach(function (r) {
                        if (r.toLowerCase().trim() == fileExt) acceptableFileFormat = true;
                    });
                } else if (typeof obj.format == "undefined") {
                    acceptableFileFormat = true;
                }
                if (acceptableFileFormat) {
                    var formdata = new FormData();
                    formdata.append(fpname, file);
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", function (event) {
                        if (event.total > 145) {
                            if (typeof obj.progress == "function") obj.progress(Math.round((event.loaded / event.total) * 100), event.loaded, event.total, event.total - event.loaded);
                            else console.log("Error: progress function is not defined!");
                        }
                    }, false);
                    ajax.addEventListener("load", function (event) {
                        //complete handler
                        if (typeof obj.success == 'function') obj.success(event.target.responseText, event);
                        else console.log("Error: success function is not defined!");
                    }, false);
                    ajax.addEventListener("error", function (event) {
                        // error handler
                        if (ffc) obj.fail(event, 1);
                        else console.log(crt);
                    }, false);
                    ajax.addEventListener("abort", function (event) {
                        // abort handler
                        if (ffc) obj.fail(event, 2);
                        else console.log(crt);
                    }, false);
                    ajax.open("POST", obj.url);
                    ajax.send(formdata);
                } else {
                    if (ffc) obj.fail("File format is not acceptable!", 4);
                    else console.log(crt);
                }
            }
        } else {
            console.log("Error: url or file parameter is missing in itonic upload section!");
        }
    } else {
        console.log("Error: JSON parameter required for itonic upload execution!");
    }
}

//itonic upload view schema
function it_upload_view(url, file, name, format, size, cbprogress, cbsuccess, cbfail){
    it_upload_execute({
        url: url,
        file: file,
        name: name,
        format: format,
        size: size,
        progress: cbprogress,
        success: cbsuccess,
        fail: cbfail
    });
}

//itonic fullscreen controller
function it_fullscreen_toggle(elem) {
    if(typeof elem == 'undefined') elem = document.body;
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}