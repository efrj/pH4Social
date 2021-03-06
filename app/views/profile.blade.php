@layout(layouts.fbhome)

@section('content')


    <style type="text/css">

        label.imgg {

            width: 16px;

            height: 14px;

            background: url('../public/imagesfb/cameras.png') 0 0 no-repeat;

            border: none;

            margin: 13px 12px;

            font-weight: bold;
            background-size: 16px 14px;

        }

        input.imggs {

            position: absolute;
            visibility: hidden;
        }

        label.vdo {

            width: 16px;

            height: 14px;

            background: url('../public/imagesfb/video1.png') 0 0 no-repeat;

            border: none;

            margin: 13px 10px;

            font-weight: bold;
            background-size: 16px 14px;

        }

        input.vdos {

            position: absolute;
            visibility: hidden;
        }


    </style>


    <script type="text/javascript">

        function displayPreview() {


            var name = document.getElementById('coversimages').value;
            var fileExtension = name.substr((name.lastIndexOf('.') + 1));

            if (fileExtension == 'jpg' || fileExtension == 'jpeg' || fileExtension == 'png' || fileExtension == 'JPG' || fileExtension == 'JPEG' || fileExtension == 'PNG') {


                var files = document.getElementById('coversimages').files[0];

                var reader = new FileReader();
                var img = new Image();


                reader.onload = function (e) {
                    img.src = e.target.result;
                    fileSize = Math.round(files.size / 1024);

                    img.onload = function () {


                        var ww = this.width;
                        if (parseInt(ww) < 1100) {
                            alert('Image dimension to small');
                            return false;
                        }
                        else {

                            document.getElementById('submits').click();
                        }

                    };


                };

                reader.readAsDataURL(files);

            }
            else {

                alert('Image Not Support');
                return false;
            }


        }


        $(document).ready(function (e) {


            $("#contactformr").on('submit', (function (e) {

                var dates = $('input[name="dates"]').val();
                var events = $('#events').val();
                var address = $('input[name="address"]').val();
                if (dates == '') {
                    e.preventDefault();

                    alert('Date and Time field required');
                    return false;
                }
                else if (events == '') {
                    e.preventDefault();

                    alert('Event field required');
                    return false;
                }
                else if (address == '') {
                    e.preventDefault();

                    alert('Address field required');
                    return false;
                }

                else {

                    return true;
                }

            }));


            $("#remos").click(function () {


                var id = $(this).attr('class');

                $('#help').show();
                $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');

                $.ajax({
                    url: "{{ asset('') }}index.php/changedefaults/" + id,
                    type: "GET",
                    contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                    dataType: 'json',
                    cache: false,         // To unable request pages to be cached
                    processData: false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                    success: function (data)     // A function to be called if request succeeds
                    {


                        var user = data[0].user;
                        $('.userphoto > img').attr('src', '../' + user + '');
                        $('#remos').attr('style', 'padding:0px; border-bottom:none;pointer-events:none');
                        $('img.myimgs').attr('src', '../' + user + '');

                        $('#help').hide("slow");
                    }
                });


            });


            $("#my_form").on('submit', (function (e) {
                e.preventDefault();


                var f = document.getElementById('coverimagek').files[0];
                var name = document.getElementById('coverimagek').value;
                var fileExtension = name.substr((name.lastIndexOf('.') + 1));

                var fileExtension = fileExtension.toLowerCase();
                if (fileExtension == 'jpg' || fileExtension == 'jpeg' || fileExtension == 'png') {


                    if (f.size < 2000000 || f.fileSize < 2000000) {


                        $('#help').show();
                        $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');


                        $.ajax({
                            url: "{{ asset('') }}index.php/fbmedia/save",
                            type: "POST",
                            xhr: function () { // custom xhr (is the best)

                                $('#percentage').show("slow");


                                if (document.getElementById('coverimagek').value != '') {


                                    var xhr = new XMLHttpRequest();
                                    var total = 0;

                                    // Get the total size of files
                                    $.each(document.getElementById('coverimagek').files, function (i, file) {
                                        total += file.size;
                                    });

                                    // Called when upload progress changes. xhr2
                                    xhr.upload.addEventListener("progress", function (evt) {
                                        // show progress like example
                                        var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                                        if (loaded > 100) {
                                            loaded = 100;
                                        }

                                        $('#percentage').text('' + loaded + '%');
                                    }, false);

                                    return xhr;
                                }
                                else if (document.getElementById('imagessvideo').value != '') {


                                    var xhr = new XMLHttpRequest();
                                    var total = 0;

                                    // Get the total size of files
                                    $.each(document.getElementById('imagessvideo').files, function (i, file) {
                                        total += file.size;
                                    });

                                    // Called when upload progress changes. xhr2
                                    xhr.upload.addEventListener("progress", function (evt) {
                                        // show progress like example
                                        var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                                        if (loaded > 100) {
                                            loaded = 100;
                                        }
                                        $('#percentage').text('' + loaded + '%');
                                    }, false);

                                    return xhr;

                                }
                                else {

                                    var xhr = new XMLHttpRequest();
                                    return xhr;
                                }


                            },
                            data: new FormData(this),    // Data sent to server, a set of key/value pairs representing form fields and values
                            contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                            dataType: 'json',
                            cache: false,         // To unable request pages to be cached
                            processData: false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                            success: function (data)     // A function to be called if request succeeds
                            {


                                var user = data[0].path;
                                var thumb = data[0].thumb;
                                $('.userphoto > img').attr('src', '../' + user + '');
                                $('#remos').attr('style', 'padding:0px; border-bottom:none');
                                $('img.myimgs').attr('src', '../' + thumb + '');

                                $('#help').hide("slow");
                                $('#percentage').hide("slow");
                                $('#percentage').text('');


                            }
                        });

                    }
                    else {
                        alert('Image is Too large');

                    }

                }
                else {

                    alert('Image Not Support');
                }

            }));


            $("#remo").click(function () {


                var id = $(this).attr('class');

                $('#help').show();
                $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');

                $.ajax({
                    url: "{{ asset('') }}index.php/changedefault/" + id,
                    type: "GET",
                    contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                    dataType: 'json',
                    cache: false,         // To unable request pages to be cached
                    processData: false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                    success: function (data)     // A function to be called if request succeeds
                    {


                        var user = data[0].user;
                        $('.cover > img').attr('src', '../' + user + '');
                        $('#remo').attr('style', 'color:#333;pointer-events:none');
                        $('#help').hide("slow");

                        $('label#coversimagess').attr('style', 'background:none repeat scroll 0 0 / 100% 100% #14ac9e; color:#018f81;');


                    }
                });


            });


            $("#contactform").on('submit', (function (e) {
                e.preventDefault();
                var f = document.getElementById('coversimages').files[0];


                var name = document.getElementById('coversimages').value;
                var fileExtension = name.substr((name.lastIndexOf('.') + 1));


                var fileExtension = fileExtension.toLowerCase();


                if (fileExtension == 'jpg' || fileExtension == 'jpeg' || fileExtension == 'png') {


                    if (f.size < 6000000 || f.fileSize < 6000000) {


                        $('#help').show();
                        $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');


                        $.ajax({
                            url: "{{ asset('') }}/index.php/fbcovermedia/save",
                            type: "POST",
                            xhr: function () { // custom xhr (is the best)

                                $('#percentage').show("slow");


                                if (document.getElementById('coversimages').value != '') {


                                    var xhr = new XMLHttpRequest();
                                    var total = 0;

                                    // Get the total size of files
                                    $.each(document.getElementById('coversimages').files, function (i, file) {
                                        total += file.size;
                                    });

                                    // Called when upload progress changes. xhr2
                                    xhr.upload.addEventListener("progress", function (evt) {
                                        // show progress like example
                                        var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                                        if (loaded > 100) {
                                            loaded = 100;
                                        }

                                        $('#percentage').text('' + loaded + '%');
                                    }, false);

                                    return xhr;
                                }
                                else if (document.getElementById('imagessvideo').value != '') {


                                    var xhr = new XMLHttpRequest();
                                    var total = 0;

                                    // Get the total size of files
                                    $.each(document.getElementById('imagessvideo').files, function (i, file) {
                                        total += file.size;
                                    });

                                    // Called when upload progress changes. xhr2
                                    xhr.upload.addEventListener("progress", function (evt) {
                                        // show progress like example
                                        var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                                        if (loaded > 100) {
                                            loaded = 100;
                                        }
                                        $('#percentage').text('' + loaded + '%');
                                    }, false);

                                    return xhr;

                                }
                                else {

                                    var xhr = new XMLHttpRequest();
                                    return xhr;
                                }


                            },
                            data: new FormData(this),    // Data sent to server, a set of key/value pairs representing form fields and values
                            contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                            dataType: 'json',
                            cache: false,         // To unable request pages to be cached
                            processData: false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                            success: function (data)     // A function to be called if request succeeds
                            {


                                var user = data[0].user;
                                $('.cover > img').attr('src', '../' + user + '');

                                $('#remo').attr('style', 'color:#333');
                                $('#help').hide("slow");
                                $('#percentage').hide("slow");
                                $('#percentage').text('');
                                $('label#coversimage').attr('style', 'background:none repeat scroll 0 0 / 100% 100% #00988a; color:#333;');
                                $('label#coversimagess').attr('style', 'background:none repeat scroll 0 0 / 100% 100% #00988a;');


                            }
                        });


                    }
                    else {
                        alert('Image is Too large');

                    }

                }
                else {

                    alert('Image Not Support');
                }


            }));


            $("#postfb").on('submit', (function (e) {
                e.preventDefault();

                var textpost = $('#textpost').val().trim();
                if (textpost == '') {

                    alert('Text field required');
                    return false;
                }

                $('#help').show();
                $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');


                $.ajax({
                    url: "{{ asset('index.php') }}/fbpost/save",
                    type: "POST",
                    xhr: function () { // custom xhr (is the best)

                        $('#percentage').show("slow");


                        if (document.getElementById('imagesss').value != '') {


                            var xhr = new XMLHttpRequest();
                            var total = 0;

                            // Get the total size of files
                            $.each(document.getElementById('imagesss').files, function (i, file) {
                                total += file.size;
                            });

                            // Called when upload progress changes. xhr2
                            xhr.upload.addEventListener("progress", function (evt) {
                                // show progress like example
                                var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                                if (loaded > 100) {
                                    loaded = 100;
                                }

                                $('#percentage').text('' + loaded + '%');
                            }, false);

                            return xhr;
                        }
                        else if (document.getElementById('imagessvideo').value != '') {


                            var xhr = new XMLHttpRequest();
                            var total = 0;

                            // Get the total size of files
                            $.each(document.getElementById('imagessvideo').files, function (i, file) {
                                total += file.size;
                            });

                            // Called when upload progress changes. xhr2
                            xhr.upload.addEventListener("progress", function (evt) {
                                // show progress like example
                                var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                                if (loaded > 100) {
                                    loaded = 100;
                                }
                                $('#percentage').text('' + loaded + '%');
                            }, false);

                            return xhr;

                        }
                        else {

                            var xhr = new XMLHttpRequest();
                            return xhr;
                        }


                    },
                    data: new FormData(this),    // Data sent to server, a set of key/value pairs representing form fields and values
                    contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                    dataType: 'json',
                    cache: false,         // To unable request pages to be cached
                    processData: false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                    success: function (data)     // A function to be called if request succeeds
                    {
                        $('#help').hide("slow");
                        $('#percentage').hide("slow");
                        $('#percentage').text('');


                        if (data[0].path != null) {


                            var user = data[0].user;

                            var post = data[0].post;
                            var curdate = data[0].curdate;
                            var insert_id = data[0].idss;
                            var path = data[0].path;
                            var profile = data[0].profiles;

                            var datas = '<div class="message_box" id="post' + insert_id + '"><div id="fleft' + insert_id + '"><div class="u-nformation"><img  alt="image" class="img-circle img_wid myimgs" src="{{ asset('') }}/public/' + profile + '"><a href="{{ asset("index.php") }}/profile"><?php  echo Auth::user()->name;?></a><button id="' + insert_id + '" class="postdelete pull-right"><span class="glyphicon glyphicon-remove"></span></button></div><div class="message_text"><a  class="fancybox" id="' + insert_id + '" style="cursor:pointer;"><img src="{{ asset('') }}/' + path + '" style="max-width:100%;"/></a></div><div class="message_text1"><p id="edit' + insert_id + '">' + post + '</p><button id="' + insert_id + '" class="postedit ed' + insert_id + '"><span class="">edit</span></button></div><div class="comment_box likebox"> <span class="date_text">' + curdate + '</span><div class="like"><ul><li><span class="glyphicon glyphicon-comment"></span></li><li><span id="countlike' + insert_id + '"></span></li><li><span><a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a' + insert_id + '" name="' + insert_id + '"></a></span></li></ul></div></div></div><div id="rleft' + insert_id + '"><div class="cl' + insert_id + '" style="display:none; float:right;"><a style="cursor:pointer;" name="' + insert_id + '" class="clx"><span class="glyphicon glyphicon-remove"></span></a></div><div class="message_text" id="ppcomment' + insert_id + '"></div><div class="comment_box comment_boxs"><form onsubmit="return comm(' + insert_id + ',this)" name="comments" id="uni' + insert_id + '" method="post" enctype="multipart/form-data" >{{ Form::token() }}<textarea style="width:98%; max-width:98%;" name="comment"  onkeydown="if (event.keyCode == 13) document.getElementById("submitbtn' + insert_id + '").click()" required="" id="comment' + insert_id + '" value="" placeholder="comment"></textarea><input type="hidden" name="user" id="user' + insert_id + '" value="<?php  echo Auth::user()->rand;?>"/><input type="hidden" id="post_id' + insert_id + '" name="post_id" value="' + insert_id + '"/><input type="hidden" name="name" id="name' + insert_id + '" value="<?php  echo Auth::user()->name;?>"/><label id="imagess' + insert_id + '" style="cursor:pointer;" class="imgg"><input onchange="image(' + insert_id + ');" class="imggs" id="imagesss' + insert_id + '" name="imagesss"  type="file"></label><label id="imagessvideos' + insert_id + '" style="cursor:pointer;" class="vdo"><input onchange="video(' + insert_id + ');" class="vdos" id="imagessvideo' + insert_id + '" name="imagessvideo"  type="file"></label><button  id="submitbtn' + insert_id + '" type="submit" class="buttonss' + insert_id + ' btn send_btn pull-right">send</button></form></div></div></div>';
                            $("#postapend").prepend(datas);

                            $('form#postfb ul li span label input#imagesss').val('');

                            $('label#imagess').css('background-image', 'url(../public/imagesfb/cameras.png)');
                            $('label#imagessvideo').css('background-image', 'url(../public/imagesfb/video1.png)');
                            $('textarea#textpost').val('');
                            $('form#postfb ul li span label input#imagessvideo').val('');
                            $('input#textvideobox').val('');
                        }
                        else if (data[0].imagessvideo != null) {

                            var user = data[0].user;

                            var post = data[0].post;
                            var curdate = data[0].curdate;
                            var insert_id = data[0].idss;
                            var imagessvideo = data[0].imagessvideo;
                            var profile = data[0].profiles;

                            var datas = '<div class="message_box" id="post' + insert_id + '"><div id="fleft' + insert_id + '"><div class="u-nformation"><img  alt="iamge" class="img-circle img_wid myimgs" src="{{ asset('') }}/public/' + profile + '"><a href="{{ asset("index.php") }}/profile"><?php  echo Auth::user()->name;?></a><button id="' + insert_id + '" class="postdelete pull-right"><span class="glyphicon glyphicon-remove"></span></button></div><div class="message_text"><video style="width:100%;" controls><source src="<?php echo asset("/"); ?>' + imagessvideo + '" type="video/mp4"><source src="<?php echo asset("/"); ?>' + imagessvideo + '" type="video/ogg"></video></div><div class="message_text1"><p id="edit' + insert_id + '">' + post + '</p><button id="' + insert_id + '" class="postedit ed' + insert_id + '"><span class="">edit</span></button></div><div class="comment_box likebox"> <span class="date_text">' + curdate + '</span><div class="like"><ul><li><span class="glyphicon glyphicon-comment"></span></li><li><span id="countlike' + insert_id + '"></span></li><li><span><a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a' + insert_id + '" name="' + insert_id + '"></a></span></li></ul></div></div></div><div id="rleft' + insert_id + '"><div class="cl' + insert_id + '" style="display:none; float:right;"><a style="cursor:pointer;" name="' + insert_id + '" class="clx"><span class="glyphicon glyphicon-remove"></span></a></div><div class="message_text" id="ppcomment' + insert_id + '"></div><div class="comment_box comment_boxs"><form onsubmit="return comm(' + insert_id + ',this)" name="comments" id="uni' + insert_id + '" method="post" enctype="multipart/form-data" >{{ Form::token() }}<textarea style="width:98%; max-width:98%;" name="comment"  onkeydown="if (event.keyCode == 13) document.getElementById("submitbtn' + insert_id + '").click()" required="" id="comment' + insert_id + '" value="" placeholder="comment"></textarea><input type="hidden" name="user" id="user' + insert_id + '" value="<?php  echo Auth::user()->rand;?>"/><input type="hidden" id="post_id' + insert_id + '" name="post_id" value="' + insert_id + '"/><input type="hidden" name="name" id="name' + insert_id + '" value="<?php  echo Auth::user()->name;?>"/><label id="imagess' + insert_id + '" style="cursor:pointer;" class="imgg"><input onchange="image(' + insert_id + ');" class="imggs" id="imagesss' + insert_id + '" name="imagesss"  type="file"></label><label id="imagessvideos' + insert_id + '" style="cursor:pointer;" class="vdo"><input onchange="video(' + insert_id + ');" class="vdos" id="imagessvideo' + insert_id + '" name="imagessvideo"  type="file"></label><button  id="submitbtn' + insert_id + '" type="submit" class="buttonss' + insert_id + ' btn send_btn pull-right">send</button></form></div></div></div>';
                            $("#postapend").prepend(datas);

                            $('form#postfb ul li span label input#imagessvideo').val('');
                            $('label#imagess').css('background-image', 'url(../public/imagesfb/cameras.png)');
                            $('label#imagessvideok').css('background-image', 'url(../public/imagesfb/video1.png)');
                            $('form#postfb ul li span label input#imagesss').val('');
                            $('textarea#textpost').val('');
                            $('input#textvideobox').val('');
                        }

                        else if (data[0].youtube != null) {

                            var user = data[0].user;

                            var post = data[0].post;
                            var curdate = data[0].curdate;
                            var insert_id = data[0].idss;
                            var youtube = data[0].youtube;
                            var profile = data[0].profiles;

                            var datas = '<div class="message_box" id="post' + insert_id + '"><div id="fleft' + insert_id + '"><div class="u-nformation"><img  alt="iamge" class="img-circle img_wid myimgs" src="{{ asset('') }}/public/' + profile + '"><a href="{{ asset("index.php") }}/profile"><?php  echo Auth::user()->name;?></a><button id="' + insert_id + '" class="postdelete pull-right"><span class="glyphicon glyphicon-remove"></span></button></div><div class="message_text"><object width="500" height="281"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="' + youtube + '" /><embed src="' + youtube + '" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="281"></embed></object></div><div class="message_text1"><p id="edit' + insert_id + '">' + post + '</p><button id="' + insert_id + '" class="postedit ed' + insert_id + '"><span class="">edit</span></button></div><div class="comment_box likebox"> <span class="date_text">' + curdate + '</span><div class="like"><ul><li><span class="glyphicon glyphicon-comment"></span></li><li><span id="countlike' + insert_id + '"></span></li><li><span><a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a' + insert_id + '" name="' + insert_id + '"></a></span></li></ul></div></div></div><div id="rleft' + insert_id + '"><div class="cl' + insert_id + '" style="display:none; float:right;"><a style="cursor:pointer;" name="' + insert_id + '" class="clx"><span class="glyphicon glyphicon-remove"></span></a></div><div class="message_text" id="ppcomment' + insert_id + '"></div><div class="comment_box comment_boxs"><form onsubmit="return comm(' + insert_id + ',this)" name="comments" id="uni' + insert_id + '" method="post" enctype="multipart/form-data" >{{ Form::token() }}<textarea style="width:98%; max-width:98%;" name="comment"  onkeydown="if (event.keyCode == 13) document.getElementById("submitbtn' + insert_id + '").click()" required="" id="comment' + insert_id + '" value="" placeholder="comment"></textarea><input type="hidden" name="user" id="user' + insert_id + '" value="<?php  echo Auth::user()->rand;?>"/><input type="hidden" id="post_id' + insert_id + '" name="post_id" value="' + insert_id + '"/><input type="hidden" name="name" id="name' + insert_id + '" value="<?php  echo Auth::user()->name;?>"/><label id="imagess' + insert_id + '" style="cursor:pointer;" class="imgg"><input onchange="image(' + insert_id + ');" class="imggs" id="imagesss' + insert_id + '" name="imagesss"  type="file"></label><label id="imagessvideos' + insert_id + '" style="cursor:pointer;" class="vdo"><input onchange="video(' + insert_id + ');" class="vdos" id="imagessvideo' + insert_id + '" name="imagessvideo"  type="file"></label><button  id="submitbtn' + insert_id + '" type="submit" class="buttonss' + insert_id + ' btn send_btn pull-right">send</button></form></div></div></div>';
                            $("#postapend").prepend(datas);

                            $('textarea#textpost').val('');
                            $('input#textvideobox').val('');
                        }

                        else if (data[0].vimeo != null) {

                            var user = data[0].user;

                            var post = data[0].post;
                            var curdate = data[0].curdate;
                            var insert_id = data[0].idss;
                            var vimeo = data[0].vimeo;
                            var profile = data[0].profiles;

                            var datas = '<div class="message_box" id="post' + insert_id + '"><div id="fleft' + insert_id + '"><div class="u-nformation"><img  alt="iamge" class="img-circle img_wid myimgs" src="{{ asset('') }}/public/' + profile + '"><a href="{{ asset("index.php") }}/profile"><?php  echo Auth::user()->name;?></a><button id="' + insert_id + '" class="postdelete pull-right"><span class="glyphicon glyphicon-remove"></span></button></div><div class="message_text"><object width="500" height="281"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="' + vimeo + '" /><embed src="' + vimeo + '" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="281"></object></div><div class="message_text1"><p id="edit' + insert_id + '">' + post + '</p><button id="' + insert_id + '" class="postedit ed' + insert_id + '"><span class="">edit</span></button></div><div class="comment_box likebox"> <span class="date_text">' + curdate + '</span><div class="like"><ul><li><span class="glyphicon glyphicon-comment"></span></li><li><span id="countlike' + insert_id + '"></span></li><li><span><a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a' + insert_id + '" name="' + insert_id + '"></a></span></li></ul></div></div></div><div id="rleft' + insert_id + '"><div class="cl' + insert_id + '" style="display:none; float:right;"><a style="cursor:pointer;" name="' + insert_id + '" class="clx"><span class="glyphicon glyphicon-remove"></span></a></div><div class="message_text" id="ppcomment' + insert_id + '"></div><div class="comment_box comment_boxs"><form onsubmit="return comm(' + insert_id + ',this)" name="comments" id="uni' + insert_id + '" method="post" enctype="multipart/form-data" >{{ Form::token() }}<textarea style="width:98%; max-width:98%;" name="comment"  onkeydown="if (event.keyCode == 13) document.getElementById("submitbtn' + insert_id + '").click()" required="" id="comment' + insert_id + '" value="" placeholder="comment"></textarea><input type="hidden" name="user" id="user' + insert_id + '" value="<?php  echo Auth::user()->rand;?>"/><input type="hidden" id="post_id' + insert_id + '" name="post_id" value="' + insert_id + '"/><input type="hidden" name="name" id="name' + insert_id + '" value="<?php  echo Auth::user()->name;?>"/><label id="imagess' + insert_id + '" style="cursor:pointer;" class="imgg"><input onchange="image(' + insert_id + ');" class="imggs" id="imagesss' + insert_id + '" name="imagesss"  type="file"></label><label id="imagessvideos' + insert_id + '" style="cursor:pointer;" class="vdo"><input onchange="video(' + insert_id + ');" class="vdos" id="imagessvideo' + insert_id + '" name="imagessvideo"  type="file"></label><button  id="submitbtn' + insert_id + '" type="submit" class="buttonss' + insert_id + ' btn send_btn pull-right">send</button></form></div></div></div>';
                            $("#postapend").prepend(datas);

                            $('input#textvideobox').val('');
                            $('textarea#textpost').val('');
                        }

                        else if (data[0].videourl != null) {

                            var user = data[0].user;

                            var post = data[0].post;
                            var curdate = data[0].curdate;
                            var insert_id = data[0].idss;
                            var videourl = data[0].videourl;
                            var profile = data[0].profiles;

                            var datas = '<div class="message_box" id="post' + insert_id + '"><div id="fleft' + insert_id + '"><div class="u-nformation"><img  alt="iamge" class="img-circle img_wid myimgs" src="{{ asset('') }}/public/' + profile + '"><a href="{{ asset("index.php") }}/profile"><?php  echo Auth::user()->name;?></a><button id="' + insert_id + '" class="postdelete pull-right"><span class="glyphicon glyphicon-remove"></span></button></div><div class="message_text"> <video style="width:100%;" controls><source src="' + videourl + '" type="video/mp4"><source src="' + videourl + '" type="video/ogg"><source src="' + videourl + '"></video></div><div class="message_text1"><p id="edit' + insert_id + '">' + post + '</p><button id="' + insert_id + '" class="postedit ed' + insert_id + '"><span class="">edit</span></button></div><div class="comment_box likebox"> <span class="date_text">' + curdate + '</span><div class="like"><ul><li><span class="glyphicon glyphicon-comment"></span></li><li><span id="countlike' + insert_id + '"></span></li><li><span><a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a' + insert_id + '" name="' + insert_id + '"></a></span></li></ul></div></div></div><div id="rleft' + insert_id + '"><div class="cl' + insert_id + '" style="display:none; float:right;"><a style="cursor:pointer;" name="' + insert_id + '" class="clx"><span class="glyphicon glyphicon-remove"></span></a></div><div class="message_text" id="ppcomment' + insert_id + '"></div><div class="comment_box comment_boxs"><form onsubmit="return comm(' + insert_id + ',this)" name="comments" id="uni' + insert_id + '" method="post" enctype="multipart/form-data" >{{ Form::token() }}<textarea style="width:98%; max-width:98%;" name="comment"  onkeydown="if (event.keyCode == 13) document.getElementById("submitbtn' + insert_id + '").click()" required="" id="comment' + insert_id + '" value="" placeholder="comment"></textarea><input type="hidden" name="user" id="user' + insert_id + '" value="<?php  echo Auth::user()->rand;?>"/><input type="hidden" id="post_id' + insert_id + '" name="post_id" value="' + insert_id + '"/><input type="hidden" name="name" id="name' + insert_id + '" value="<?php  echo Auth::user()->name;?>"/><label id="imagess' + insert_id + '" style="cursor:pointer;" class="imgg"><input onchange="image(' + insert_id + ');" class="imggs" id="imagesss' + insert_id + '" name="imagesss"  type="file"></label><label id="imagessvideos' + insert_id + '" style="cursor:pointer;" class="vdo"><input onchange="video(' + insert_id + ');" class="vdos" id="imagessvideo' + insert_id + '" name="imagessvideo"  type="file"></label><button  id="submitbtn' + insert_id + '" type="submit" class="buttonss' + insert_id + ' btn send_btn pull-right">send</button></form></div></div></div>';
                            $("#postapend").prepend(datas);

                            $('input#textvideobox').val('');
                            $('textarea#textpost').val('');
                        }


                        else {
                            var user = data[0].user;

                            var post = data[0].post;
                            var curdate = data[0].curdate;
                            var insert_id = data[0].idss;
                            var profile = data[0].profiles;

                            var datas = '<div class="message_box" id="post' + insert_id + '"><div id="fleft' + insert_id + '"><div class="u-nformation"><img  alt="iamge" class="img-circle img_wid myimgs" src="{{ asset('') }}/public/' + profile + '"><a href="{{ asset("index.php") }}/profile"><?php  echo Auth::user()->name;?></a><button id="' + insert_id + '" class="postdelete pull-right"><span class="glyphicon glyphicon-remove"></span></button></div><div class="message_text1"><p id="edit' + insert_id + '">' + post + '</p><button id="' + insert_id + '" class="postedit ed' + insert_id + '"><span class="">edit</span></button></div><div class="comment_box likebox"> <span class="date_text">' + curdate + '</span><div class="like"><ul><li><span class="glyphicon glyphicon-comment"></span></li><li><span id="countlike' + insert_id + '"></span></li><li><span><a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a' + insert_id + '" name="' + insert_id + '"></a></span></li></ul></div></div></div><div id="rleft' + insert_id + '"><div class="cl' + insert_id + '" style="display:none; float:right;"><a style="cursor:pointer;" name="' + insert_id + '" class="clx"><span class="glyphicon glyphicon-remove"></span></a></div><div class="message_text" id="ppcomment' + insert_id + '"></div><div class="comment_box comment_boxs"><form onsubmit="return comm(' + insert_id + ',this)" name="comments" id="uni' + insert_id + '" method="post" enctype="multipart/form-data" >{{ Form::token() }}<textarea style="width:98%; max-width:98%;" name="comment"  onkeydown="if (event.keyCode == 13) document.getElementById("submitbtn' + insert_id + '").click()" required="" id="comment' + insert_id + '" value="" placeholder="comment"></textarea><input type="hidden" name="user" id="user' + insert_id + '" value="<?php  echo Auth::user()->rand;?>"/><input type="hidden" id="post_id' + insert_id + '" name="post_id" value="' + insert_id + '"/><input type="hidden" name="name" id="name' + insert_id + '" value="<?php  echo Auth::user()->name;?>"/><label id="imagess' + insert_id + '" style="cursor:pointer;" class="imgg"><input onchange="image(' + insert_id + ');" class="imggs" id="imagesss' + insert_id + '" name="imagesss"  type="file"></label><label id="imagessvideos' + insert_id + '" style="cursor:pointer;" class="vdo"><input onchange="video(' + insert_id + ');" class="vdos" id="imagessvideo' + insert_id + '" name="imagessvideo"  type="file"></label><button  id="submitbtn' + insert_id + '" type="submit" class="buttonss' + insert_id + ' btn send_btn pull-right">send</button></form></div></div></div>';
                            $("#postapend").prepend(datas);
                            $('textarea#textpost').val('');
                            $('input#textvideobox').val('');
                        }


                    }
                });
            }));


        });

    </script>

    <script type="text/javascript">

        function comm(link_name, obj) {

            var id = $('#post_id' + link_name + '').val();

            var textpost = $('#comment' + id + '').val().trim();
            if (textpost == '') {

                alert('Comment field required');
                return false;
            }


            $('#help').show();
            $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');


            $.ajax({
                url: "ajaxreq/" + id,
                type: "POST",
                xhr: function () { // custom xhr (is the best)

                    $('#percentage').show("slow");


                    if (document.getElementById('imagesss' + link_name + '').value != '') {


                        var xhr = new XMLHttpRequest();
                        var total = 0;

                        // Get the total size of files
                        $.each(document.getElementById('imagesss' + link_name + '').files, function (i, file) {
                            total += file.size;
                        });

                        // Called when upload progress changes. xhr2
                        xhr.upload.addEventListener("progress", function (evt) {
                            // show progress like example
                            var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                            if (loaded > 100) {
                                loaded = 100;
                            }
                            $('#percentage').text('' + loaded + '%');
                        }, false);

                        return xhr;
                    }
                    else if (document.getElementById('imagessvideo' + link_name + '').value != '') {


                        var xhr = new XMLHttpRequest();
                        var total = 0;

                        // Get the total size of files
                        $.each(document.getElementById('imagessvideo' + link_name + '').files, function (i, file) {
                            total += file.size;
                        });

                        // Called when upload progress changes. xhr2
                        xhr.upload.addEventListener("progress", function (evt) {
                            // show progress like example
                            var loaded = Math.round((evt.loaded / total).toFixed(2) * 100); // percent
                            if (loaded > 100) {
                                loaded = 100;
                            }
                            $('#percentage').text('' + loaded + '%');
                        }, false);

                        return xhr;

                    }
                    else {

                        var xhr = new XMLHttpRequest();
                        return xhr;
                    }


                },
                data: new FormData(obj),    // Data sent to server, a set of key/value pairs representing form fields and values
                contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                dataType: 'json',
                cache: false,         // To unable request pages to be cached
                processData: false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                success: function (data)     // A function to be called if request succeeds
                {
                    $('#help').hide("slow");
                    $('#percentage').hide("slow");
                    $('#percentage').text('');
                    if (data[0].targetPath != null) {

                        var insert_id = data[0].insert_id;

                        var idss = data[0].idss;
                        var comment = data[0].comment;
                        var names = data[0].names;
                        var targetPath = data[0].targetPath;
                        var datas = '<div id="cc' + insert_id + '" class="coment_text"><h3>' + names + '</h3>' + '<p id="ppp' + insert_id + '">' + comment + '</p><br><div class="popupfcc' + insert_id + '"><div style="display:none; float:right;" class="clfcc' + insert_id + '"><a class="clxs" name="' + insert_id + '" style="cursor:pointer;"><span class="glyphicon glyphicon-remove"></span></a></div> <div style="cursor:pointer;" id="fcc' + insert_id + '" class="fancyboxs"><img src="../' + targetPath + '" style="max-width:100%;"></div></div><button id="' + insert_id + '" class="comedit eds' + insert_id + '"><span class="">edit</span></button><button class="comdel" id="' + link_name + '" onclick="myFunction(' + insert_id + ')"><span class="glyphicon glyphicon-remove"></span></button></div>';
                        $('#ppcomment' + link_name + '').append(datas);
                        $('#comment' + link_name + '').val('');

                        $('input#imagesss' + link_name + '').val('');

                        $('label#imagess' + link_name + '').css('background-image', 'url(../public/imagesfb/cameras.png)');
                    }
                    else if (data[0].targetvideo != null) {

                        var insert_id = data[0].insert_id;

                        var idss = data[0].idss;
                        var comment = data[0].comment;
                        var names = data[0].names;
                        var targetvideo = data[0].targetvideo;
                        var datas = '<div id="cc' + insert_id + '" class="coment_text"><h3>' + names + '</h3>' + '<p id="ppp' + insert_id + '">' + comment + '</p><br><video style="width:100%;" controls><source src="../' + targetvideo + '" type="video/mp4"><source src="../' + targetvideo + '" type="video/ogg"></video><button id="' + insert_id + '" class="comedit eds' + insert_id + '"><span class="">edit</span></button><button class="comdel" id="' + link_name + '" onclick="myFunction(' + insert_id + ')"><span class="glyphicon glyphicon-remove"></span></button></div>';
                        $('#ppcomment' + link_name + '').append(datas);
                        $('#comment' + link_name + '').val('');

                        $('input#imagessvideo' + link_name + '').val('');


                        $('label#imagessvideos' + link_name + '').css('background-image', 'url(../public/imagesfb/video1.png)');


                    }

                    else {
                        var insert_id = data[0].insert_id;

                        var idss = data[0].idss;
                        var comment = data[0].comment;
                        var names = data[0].names;
                        var datas = '<div id="cc' + insert_id + '" class="coment_text"><h3>' + names + '</h3>' + '<p id="ppp' + insert_id + '">' + comment + '</p><button id="' + insert_id + '" class="comedit eds' + insert_id + '"><span class="">edit</span></button><button class="comdel" id="' + link_name + '" onclick="myFunction(' + insert_id + ')"><span class="glyphicon glyphicon-remove"></span></button></div>';
                        $('#ppcomment' + link_name + '').append(datas);
                        $('#comment' + link_name + '').val('');


                    }


                }
            });


            return false;
        }


        function image(val) {

            var dd = 'imagesss' + val;
            var vals = document.getElementById('' + dd + '').value;
            var valss = vals.toLowerCase();
            var res = valss.split(".");

            if (res[1] == 'jpg' || res[1] == 'png' || res[1] == 'jpeg') {

                var f = document.getElementById('' + dd + '').files[0];

                if (f.size < 20000000 || f.fileSize < 20000000) {


                    var imgid = 'imagess' + val;
                    document.getElementById('' + imgid + '').style.backgroundImage = 'url(../public/imagesfb/camerasred.png)';
                    var imgids = 'imagessvideos' + val;
                    document.getElementById('' + imgids + '').style.backgroundImage = 'url(../public/imagesfb/video1.png)';
                    var imgidss = 'imagessvideo' + val;

                    document.getElementById('' + imgidss + '').value = '';

                }
                else {
                    alert('Image is Too large');

                }


            }
            else {
                var imgid = 'imagess' + val;
                document.getElementById('' + dd + '').value = '';
                alert('Not Valid Extension For Image');
                document.getElementById('' + imgid + '').style.backgroundImage = 'url(../public/imagesfb/cameras.png)';

            }

            return false;
        }
        function video(val) {

            var dd = 'imagessvideo' + val;
            var vals = document.getElementById('' + dd + '').value;
            var valss = vals.toLowerCase();
            var res = valss.split(".");

            if (res[1] == 'mp4') {

                var f = document.getElementById('' + dd + '').files[0];

                if (f.size < 20000000 || f.fileSize < 20000000) {


                    var imgid = 'imagessvideos' + val;

                    document.getElementById('' + imgid + '').style.backgroundImage = 'url(../public/imagesfb/video1red.png)';

                    var imgids = 'imagess' + val;
                    document.getElementById('' + imgids + '').style.backgroundImage = 'url(../public/imagesfb/cameras.png)';

                    var imgidss = 'imagesss' + val;

                    document.getElementById('' + imgidss + '').value = '';

                }
                else {
                    alert('Video is Too large');

                }


            }

            else {

                var imgid = 'imagessvideos' + val;
                document.getElementById('' + dd + '').value = '';
                alert('Not Valid Extension For Video');
                document.getElementById('' + imgid + '').style.backgroundImage = 'url(../public/imagesfb/video1.png)';


            }
            return false;
        }


    </script>



    <script type="text/javascript">
        $(function () {


            $('label.mainimg').data('default', $('label[class=mainimg]').text()).click(function () {
                $('#imagesss').click()
            });
            $('.mainimgs').on('change', function () {
                var files = this.files;


                if (!files.length) {
                    $('label[class=mainimg]').text($('.mainimgs').data('default'));
                    return;
                }

                var vals = document.getElementById('imagesss').value;
                var valss = vals.toLowerCase();
                var res = valss.split(".");


                if (res[1] == 'jpg' || res[1] == 'png' || res[1] == 'jpeg') {


                    var f = document.getElementById('imagesss').files[0];

                    if (f.size < 20000000 || f.fileSize < 20000000) {
                        document.getElementById('imagess').style.backgroundImage = 'url(../public/imagesfb/camerasred.png)';
                        //  document.getElementById('imagessvideok').style.backgroundImage = 'url(../imagesfb/video1.png)';
                        document.getElementById('imagessvideok').style.backgroundImage = 'url(../public/imagesfb/video1.png)';
                        document.getElementById("imagessvideo").value = '';
                        document.getElementById('textvideobox').value = '';

                    }
                    else {

                        alert('Image is Too large');
                    }

                }
                else {
                    document.getElementById('imagesss').value = '';
                    alert('Not Valid Extension For Image');
                    document.getElementById('imagess').style.backgroundImage = 'url(../public/imagesfb/cameras.png)';
                }


            });


            $('label.mainvdo').data('default', $('label[class=mainvdo]').text()).click(function () {
                $('#imagessvideo').click()
            });
            $('.mainvdos').on('change', function () {
                var files = this.files;
                if (!files.length) {
                    $('label[class=mainvdo]').text($('.mainvdos').data('default'));
                    return;
                }


                var vals = document.getElementById('imagessvideo').value;
                var fileExtension = vals.substr((vals.lastIndexOf('.') + 1));
                var res = fileExtension.toLowerCase();


                //var valss = vals.toLowerCase();
                //var res = valss.split(".");


                if (res == 'mp4') {

                    var f = document.getElementById('imagessvideo').files[0];

                    if (f.size < 20000000 || f.fileSize < 20000000) {

                        document.getElementById('imagessvideok').style.backgroundImage = 'url(../public/imagesfb/video1red.png)';
                        document.getElementById('imagess').style.backgroundImage = 'url(../public/imagesfb/cameras.png)';
                        document.getElementById("imagesss").value = '';
                        document.getElementById('textvideobox').value = '';
                    }
                    else {
                        alert('Video is Too large');

                    }
                }

                else {
                    document.getElementById('imagessvideo').value = '';
                    alert('Not Valid Extension For Video');
                    document.getElementById('imagessvideok').style.backgroundImage = 'url(../public/imagesfb/video1.png)';
                }

            });


        });


    </script>

    <section class="contentsection">
        <div id="help"></div>
        <div id="percentage"></div>
        <style scoped type="text/css">
            #help {

                height: 30px;
                left: 50%;
                position: fixed;
                width: 30px;
                z-index: 2147483647;
                display: none;
                top: 42%;

            }

            #percentage {

                height: 30px;
                left: 51%;
                position: fixed;
                width: 30px;
                z-index: 2147483647;
                display: none;
                top: 43%;
                font-weight: bold;
                color: red;

            }

        </style>
        <div class="container">
            <div class="row">
                <div class="cover">


                    @foreach( $profile as $hello)

                        <img src="{{ asset('/') }}public/{{$hello->cover}}" width="1170" height="334" alt=""
                             class="img-rounded"/>

                    @endforeach

                    <?php if($photos == 0)
                    {
                    $sex = Auth::user()->sex;
                    if ($sex == 'male') {

                        $males = 'male_cover.jpg';
                    } else {

                        $males = 'female_cover.jpg';
                    }
                    ?>


                    <img src="{{ asset('/') }}/public/imagesfb/{{$males}}" width="100%" height="334" alt=""
                         class="img-rounded img-responsive"/>
                    <?php
                    }

                    ?>


                </div>
                <div class="addyour">
                    <ul>
                        <li>
                            <input type="hidden" id="preview">

                        {{ Form:: open(array('url' => 'fbcovermedia/save' , 'method' => 'post','class' => 'covr','id' => 'contactform','files' => 'true', 'enctype' => 'multipart/form-data')) }} <!--contact_request is a router from Route class-->
                            @if($errors->any())

                                {{ implode('', $errors->all('<li>:message</li>'))  }}
                            @endif
                            {{ Form::token() }}
                            <label id="coversimage">
                                Add a Cover Photo
                                <input id="coversimages" name="image" required="" tabindex="1" type="file"
                                       onchange="displayPreview();">

                            </label>
                            <input id="rand" name="rand" type="hidden"
                                   value="<?php echo $email = Auth::user()->rand;?>">

                            <input name="submit" id="submits" tabindex="5" value="submit" type="submit"
                                   style="display:none;">
                            {{ Form:: close() }}

                            <a id="remo" class="<?php echo Auth::user()->uname; ?>"
                               style="color:#333; <?php if ($photos == 0) {
                                   echo 'pointer-events:none; color:#018f81;';
                               } ?> @foreach( $profile as $hello) <?php if ($hello->cover == 'imagesfb/male_cover.jpg' || $hello->cover == 'imagesfb/female_cover.jpg') {
                                   echo 'pointer-events:none; color:#018f81;';
                               } ?> @endforeach">
                                <label id="coversimagess" style="<?php if ($photos == 0) {
                                    echo 'background:#14ac9e;';
                                } ?> @foreach( $profile as $hello) <?php if ($hello->cover == 'imagesfb/male_cover.jpg' || $hello->cover == 'imagesfb/female_cover.jpg') {
                                    echo 'background:#14ac9e;';
                                } ?> @endforeach">
                                    Remove Cover Photo


                                </label>
                            </a>


                            <!--     <a href="#">Add a Cover Photo</a> -->


                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="user_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3">
                    <div class="row">
                        <div class="bg_nav">
                            <div class="nav">
                                <div class="userphoto">
                                    <a id="remos" style="padding:0px; border-bottom:none; <?php if ($photos == 0) {
                                        echo 'pointer-events:none';
                                    } ?> @foreach( $profile as $hello) <?php if ($hello->path == 'imagesfb/male.jpg' || $hello->path == 'imagesfb/female.jpg') {
                                        echo 'pointer-events:none';
                                    } ?> @endforeach" class="<?php echo Auth::user()->uname;?>">
                                        <span title="remove profile photo"
                                              style="cursor:pointer; color:red; float:right;"
                                              class="glyphicon glyphicon-remove"></span>
                                    </a>
                                    @foreach( $profile as $hello)
                                        <img src="{{ asset('/') }}public/{{$hello->path}}" alt="" class="img-circle"
                                             width="170" height="170"/>

                                    @endforeach

                                    <?php if($photos == 0)
                                    {
                                    $sex = Auth::user()->sex;
                                    if ($sex == 'male') {

                                        $male = 'male.jpg';
                                    } else {

                                        $male = 'female.jpg';
                                    }
                                    ?>


                                    <img src="{{ asset('/') }}public/imagesfb/{{$male}}" width="170" height="170" alt=""
                                         class="img-circle"/>
                                    <?php
                                    }

                                    ?>


                                </div>
                                <div id="nameuser"><?php echo Auth::user()->name;?></div>
                                <style>


                                    label#imagess {

                                        width: 16px;

                                        height: 14px;

                                        background: url('../public/imagesfb/cameras.png') 0 0 no-repeat;

                                        border: none;

                                        margin: 13px 12px;

                                        font-weight: bold;
                                        background-size: 16px 14px;

                                    }

                                    input#imagesss {

                                        position: absolute;
                                        visibility: hidden;
                                    }

                                    label#imagessvideok {

                                        width: 16px;

                                        height: 14px;

                                        background: url('../public/imagesfb/video1.png') 0 0 no-repeat;

                                        border: none;

                                        margin: 13px 10px;

                                        font-weight: bold;
                                        background-size: 16px 14px;

                                    }

                                    input#imagessvideo {

                                        position: absolute;
                                        visibility: hidden;
                                    }

                                    label#coversimagess {
                                        background: none repeat scroll 0 0 / 100% 100% #00988a;
                                        border: medium none;
                                        font-weight: bold;
                                        padding: 13px 4px 12px 0;
                                        text-align: center;
                                        width: 20%;
                                        cursor: pointer;
                                    }

                                    label#coversimagess:hover {

                                        width: 20%;

                                        /*background: url('../imagesfb/add_cover_hover.jpg') 0 0 no-repeat;*/
                                        background: none repeat scroll 0 0 #333333 !important;
                                        border: none;
                                        text-align: center;
                                        padding: 13px 4px 12px 0;
                                        font-weight: bold;
                                        color: white;
                                        cursor: pointer;

                                    }

                                    label#coversimage {

                                        width: 100%;

                                        height: 35px;

                                        /*background: url('../imagesfb/add_cover.jpg') 0 0 no-repeat;*/
                                        background: none repeat scroll 0 0 #00988a;
                                        border: none;

                                        padding: 0 4px 8px 0;
                                        text-align: center;
                                        font-weight: bold;
                                        background-size: 100% 100%;

                                    }

                                    label#coversimage:hover {

                                        width: 100%;

                                        height: 35px;

                                        /*background: url('../imagesfb/add_cover_hover.jpg') 0 0 no-repeat;*/
                                        background: none repeat scroll 0 0 #333333;
                                        border: none;

                                        padding: 0 4px 8px 0;

                                        font-weight: bold;
                                        background-size: 100% 100%;
                                        color: white;
                                        cursor: pointer;

                                    }

                                    input#coverimagek {

                                        position: absolute;
                                        visibility: hidden;
                                    }

                                    label#coversimage {

                                        width: 100%;

                                        height: 35px;

                                        /*background: url('../imagesfb/add_cover.jpg') 0 0 no-repeat;*/
                                        background: none repeat scroll 0 0 #00988a;
                                        border: none;

                                        padding: 0 4px 8px 0;
                                        text-align: center;
                                        font-weight: bold;
                                        background-size: 100% 100%;

                                    }

                                    label#coversimage:hover {

                                        width: 100%;

                                        height: 35px;

                                        /*background: url('../imagesfb/add_cover_hover.jpg') 0 0 no-repeat;*/
                                        background: none repeat scroll 0 0 #333333;
                                        border: none;

                                        padding: 0 4px 8px 0;

                                        font-weight: bold;
                                        background-size: 100% 100%;
                                        color: white;
                                        cursor: pointer;

                                    }

                                    input#coversimages {

                                        position: absolute;
                                        visibility: hidden;
                                    }

                                    .covr {
                                        float: left;
                                        width: 80%;

                                    }

                                </style>
                                <ul>

                                    <li>


                                    {{ Form:: open(array('url' => 'fbmedia/save' , 'method' => 'post','name' => 'my_form','id' => 'my_form','files' => 'true', 'enctype' => 'multipart/form-data')) }} <!--contact_request is a router from Route class-->
                                        @if($errors->any())

                                            {{ implode('', $errors->all('<li>:message</li>'))  }}
                                        @endif
                                        {{ Form::token() }}


                                        <label id="coverimage">
                                            <span class="glyphicon glyphicon-tasks"></span>Set a new photo
                                            <input id="coverimagek" name="image" required="" tabindex="1" type="file"
                                                   onchange="document.getElementById('submitf').click();">
                                            <input type="hidden" name="width" value="">


                                        </label>

                                        <input id="rand" name="rand" type="hidden"
                                               value="<?php echo $email = Auth::user()->rand;?>">


                                        <input name="submit" id="submitf" tabindex="5" value="submit" type="submit"
                                               style="display:none;">
                                        {{ Form:: close() }}
                                    </li>

                                    <!-- <li><a href="#"><span class="glyphicon glyphicon-facetime-video"></span> Upload Videos</a></li> -->
                                    <li><a href="{{ asset('/index.php/') }}/friendlist"><span
                                                    class="glyphicon glyphicon-tasks"></span> {{trans ('greeting.Friends List')}}
                                        </a></li>
                                    <li><a href="{{ asset('/index.php/') }}/gallery"><span
                                                    class="glyphicon glyphicon-calendar"></span> {{trans ('greeting.Gallery')}}
                                        </a></li>
                                    <li><a href="{{ asset('/index.php/') }}/news"><span
                                                    class="glyphicon glyphicon-calendar"></span> News Feed</a></li>
                                <!--    <li><a href="#"><span class="glyphicon glyphicon-music"></span> {{trans ('greeting.Upload a Song')}}</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>{{trans ('greeting.Create a Listing')}}</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-star"></span> {{trans ('greeting.Create a Page')}}</a></li>
            --> </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-9">
                    <div class="border">
                        <!-- Nav tabs -->
                    {{ Form:: open(array('url' => 'fbpost/save' , 'method' => 'post','id' => 'postfb','files' => 'true', 'enctype' => 'multipart/form-data')) }} <!--contact_request is a router from Route class-->
                        @if($errors->any())

                            {{ implode('', $errors->all('<li>:message</li>'))  }}
                        @endif
                        {{ Form::token() }}
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <h3 class="share">{{trans ('greeting.Share')}}

                                </h3>
                            </li>
                            <li class="active"><a href="#home" role="tab" data-toggle="tab"> <span
                                            class="glyphicon glyphicon-comment"></span> </a></li>
                            <!--             <li> <a href="#profile" role="tab" data-toggle="tab"> <span class="glyphicon glyphicon-map-marker"></span> </a> </li> -->
                            <li> <span class="">

             <label id="imagess" style="cursor:pointer;" class="mainimg"><input class="mainimgs" id="imagesss"
                                                                                name="image" type="file"></label>
             </span>


                            </li>

                            <li> <span class="">

             <label id="imagessvideok" style="cursor:pointer;" class="mainvdo"><input class="mainvdos" id="imagessvideo"
                                                                                      name="imagessvideo"
                                                                                      type="file"></label>
             </span>


                            </li>

                            <li> <span class="">

             <input class="videobox" id="textvideobox" name="videourl" type="text" placeholder="video url">
             </span>


                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">


                            <div class="tab-pane active" id="home">
                                <textarea style="max-width:616px;" id="textpost" required="true" name="post"
                                          class="form-control" rows="3"></textarea>
                            </div>

                            <!--     <input id="image" name="image" placeholder="Image" tabindex="1" type="file">  -->
                            <input id="rand" name="rand" type="hidden"
                                   value="<?php echo $email = Auth::user()->rand;?>">


                            <!--         <div class="tab-pane" id="profile">
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="tab-pane" id="messages">
              <textarea class="form-control" rows="3"></textarea>
            </div> -->
                        </div>
                        <div class="col-lg-12">
                            <div class="pull-right padding2"> <span class="dropdown ">
             <!--  <button class="friend_btn  dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span> Friends <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
              </ul>
              </span> -->





              <button name="submit" id="submitl" class="all_btn" type="submit">{{trans ('greeting.Submit')}}</button>
                <br/>
                            </div>
                        </div>
                        <div class="clear"></div>
                        {{ Form:: close() }}
                    </div>
                    <br/>


                    <span class="hr_bor"></span>

                    <div id="postapend"></div>

                    {{ HTML::script('public/jsfb/script.js') }}


                    <script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.4.2/jquery.min.js"></script>
                    <script type="text/javascript">

                        var ajax_online = function () {

                            var token = $("input[id=userid]").val();
                            $.ajax({

                                type: "GET",
                                url: "{{ asset('index.php') }}/onlineuser/" + token,
                                data: '',
                                dataType: 'json',
                                cache: false,
                                success: function (data) {


                                    var ids = '#chatmessenger ul li';
                                    $('' + ids + '').removeClass("yourClass");

                                    for (i = 0; i < Object.keys(data).length; i++) {


                                        var id = 'li#online' + data[i].userrand;
                                        $('' + id + '').addClass("yourClass");


                                    }


                                }
                            });


                            return false;


                        };

                        var intervalss = 60 * 60 * 1; // where X is your every X minutes

                        setInterval(ajax_online, intervalss);


                        var onlinech = function () {


//var token =  $("input[name=getid]").val();


                            var nb = $('.openbox').length;


                            for (var i = 0; i < nb; i++) {

                                var getval = '.openbox:eq(' + i + ')';


                                var uniid = $('' + getval + '').attr("id");

                                $.ajax({

                                    type: "GET",
                                    url: "{{ asset('index.php') }}/messtext/" + uniid,
                                    data: '',
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {

                                        if (data) {


                                            var blankids = '#uptextid' + data[0].idss;


                                            $('' + blankids + '').html('');
                                            for (var i = 0; i < Object.keys(data).length; i++) {


                                                if (data[i].rand == data[i].randuser) {
                                                    var datas = '<div class="media border-bottom margin-none bg-gray pull-right" id="messagebox"><a class="pull-right innerAll" href=""><img width="50" class="media-object" src="{{ asset('') }}/public/' + data[i].mainuserprofile + '" style="width: 30px; height: 30px; display: block; margin-left: auto; margin-right: auto;"></a><div class="media-body innerTB pull-right"><a class="text-small" href=""></a><div>' + data[i].chat + '</div><small class="text-muted ">' + data[i].timess + '</small></div></div><div class="clearfix"></div>';
                                                    var blankid = '#uptextid' + data[i].idss;
                                                    $('' + blankid + '').append(datas);


                                                    $('#newvalues' + data[i].idss + '').html('');


                                                }
                                                else {

                                                    var datas = '<div class="media border-bottom margin-none bg-gray pull-left"><a class="pull-left innerAll" href=""><img width="50" class="media-object" src="{{ asset('') }}/public/' + data[i].otheruserprofile + '" style="width: 30px; height: 30px; display: block; margin-left: auto; margin-right: auto;"></a><div class="media-body innerTB"><a class="text-small" href=""></a><div>' + data[i].chat + '</div><small class="text-muted ">' + data[i].timess + '</small></div></div><div class="clearfix"></div> ';
                                                    var blankid = '#uptextid' + data[i].idss;
                                                    $('' + blankid + '').append(datas);

                                                    if (data[i].counts == 1) {
                                                        $('#newvalues' + data[i].idss + '').html('');
                                                        $('#newvalues' + data[i].idss + '').append('<span class="notifationsss"><p id="newmess" class="">1</p></span>');
                                                    }
                                                    else {

                                                        $('#newvalues' + data[i].idss + '').html('');

                                                    }


                                                }


                                            }

                                        }


                                    }
                                });


                            }


                            return false;


                        };

                        var intervalss = 60 * 60 * 1; // where X is your every X minutes

                        setInterval(onlinech, intervalss);


                        var onlinechsss = function () {

                            var nb = $('.allchatbox').length;

                            for (var i = 0; i < nb; i++) {

                                var getval = '.allchatbox:eq(' + i + ')';


                                var uniid = $('' + getval + '').attr("id");

                                var idss = $('' + getval + '').attr("name");


                                var value = document.getElementById(uniid).style.display;


                                if (value == 'block') {

                                    $.ajax({

                                        type: "GET",
                                        url: "{{ asset('') }}index.php/opnnchat/" + idss,
                                        cache: false,
                                        success: function (data) {


                                        }


                                    });


                                }


                            }


                            return false;


                        };

                        var intervalss = 60 * 60 * 1; // where X is your every X minutes

                        setInterval(onlinechsss, intervalss);


                        $(document).ready(function () {


                            var w = window.innerWidth;

                            $('input[name="width"]').val(w);

                            $("#clickchat").click(function () {
                                $("#ulchat").toggle();


                            });


                            $(".onlineclick").click(function (e) {
                                e.preventDefault();

                                var uniid = $(this).attr("name");

                                var comment = $('#chat' + uniid + '').val();

                                if (comment == '') {
                                    alert('Required comment section');
                                }
                                else {

                                    var comment = $('#chat' + uniid + '').val();
                                    var user = $('#user' + uniid + '').val();
                                    var otheruser = $('#otheruser' + uniid + '').val();
                                    var name = $('#name' + uniid + '').val();
                                    var othername = $('#othername' + uniid + '').val();

                                    $.ajax({

                                        type: "GET",
                                        url: "{{ asset('/') }}/index.php/messagesonline",
                                        data: {
                                            user: user,
                                            comment: comment,
                                            otheruser: otheruser,
                                            name: name,
                                            othername: othername
                                        },
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {

                                            $('textarea[name="chat"]').val('');


                                            //   $(".uptext").animate({ scrollTop: $(document).height() }, 3000);

                                            $(".uptext").animate({scrollTop: '9634'}, "slow");


                                        }
                                    });
                                }


                            });


                            $(document).on("click", ".likes", function (e) {

                                var id = $(this).attr("id");
                                var classs = $(this).attr("class");
                                var name = $(this).attr("name");
//var dataString = 'id='+ id + '&name='+ name;

//var dataString = 'id='+ id;


                                if (classs == 'likes glyphicon glyphicon-thumbs-down' || classs == 'glyphicon-thumbs-down likes glyphicon') {


                                    $('' + id + '').removeClass('glyphicon-thumbs-down').addClass('glyphicon-thumbs-up');

                                }
                                else {


                                    $('' + id + '').removeClass('glyphicon-thumbs-up').addClass('glyphicon-thumbs-down');

                                }


                                $.ajax({

                                    type: "GET",
                                    url: "{{ asset('index.php') }}/rating/" + name,
                                    data: '',
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {

                                        for (i = 0; i < Object.keys(data).length; i++) {


                                            var id = 'span#countlike' + data[i].idss;


                                            $(id).html(data[i].likes);


                                        }


                                    }
                                });

                            });


                            $(".openbox").click(function () {


                                var id = $(this).attr("id");

                                var divs = '#boxs' + id;

                                var lenss = $('' + divs + ':visible').length;

                                if (lenss == 1) {

                                    $('' + divs + '').css({


                                        "display": "none"


                                    });


                                }
                                else {


                                    var len = $('.allchatbox:visible').length;


                                    var tot = len * 260;

                                    if (len == 0) {


                                        var divs = '#boxs' + id;


                                        $('' + divs + '').css({


                                            "background": "none repeat scroll 0 0 white",
                                            "border": "1px solid grey",
                                            "border-radius": "5px",
                                            "bottom": "20px",
                                            "display": "block",
                                            "position": "absolute",
                                            "right": "260px",
                                            "width": "230px",
                                            "z-index": "99"


                                        });

                                    }
                                    else if (len == 1) {


                                        var divs = '#boxs' + id;


                                        $('' + divs + '').css({


                                            "background": "none repeat scroll 0 0 white",
                                            "border": "1px solid grey",
                                            "border-radius": "5px",
                                            "bottom": "20px",
                                            "display": "block",
                                            "position": "absolute",
                                            "right": "500px",
                                            "width": "230px",
                                            "z-index": "99"


                                        });

                                    }

                                    else if (len == 2) {


                                        var divs = '#boxs' + id;


                                        $('' + divs + '').css({


                                            "background": "none repeat scroll 0 0 white",
                                            "border": "1px solid grey",
                                            "border-radius": "5px",
                                            "bottom": "20px",
                                            "display": "block",
                                            "position": "absolute",
                                            "right": "740px",
                                            "width": "230px",
                                            "z-index": "99"


                                        });

                                    }

                                    else {
                                        var tolss = tot + 'px';


                                        var divs = '#boxs' + id;


                                        $('' + divs + '').css({


                                            "background": "none repeat scroll 0 0 white",
                                            "border": "1px solid grey",
                                            "border-radius": "5px",
                                            "bottom": "20px",
                                            "display": "block",
                                            "position": "absolute",
                                            "right": "978px",
                                            "width": "230px",
                                            "z-index": "99"


                                        });

                                    }


                                }


                                $.ajax({

                                    type: "GET",
                                    url: "{{ asset('/') }}/index.php/opnnchat/" + id,
                                    //  data: { id: id, user: user, comment: comment, name: name},
                                    // dataType: 'json',
                                    cache: false,
                                    success: function (data) {


                                    }


                                });


                            });


                            $(".minbox").click(function () {


                                var id = $(this).attr("id");


                                var divs = 'form#bo' + id;


                                $('' + divs + '').css({


                                    "display": "none"


                                });


                            });

                            $(".maxbox").click(function () {


                                var id = $(this).attr("id");


                                var divs = 'form#bo' + id;


                                $('' + divs + '').css({


                                    "display": "block"


                                });


                            });


                            $(".closebox").click(function () {


                                var id = $(this).attr("id");


                                var divs = '#boxs' + id;


                                $('' + divs + '').css({


                                    "display": "none"


                                });


                                var len = $('.allchatbox:visible').length;


                                for (var i = 0; i < len; i++) {

                                    if (i == 0) {
                                        var ind = '260px';
                                    }
                                    else if (i == 1) {
                                        var ind = '500px';

                                    }
                                    else if (i == 2) {
                                        var ind = '740px';

                                    }
                                    else {
                                        var ind = '978px';

                                    }

                                    var value = $('.allchatbox:visible')[i];

                                    var divs = $(value).attr("id");

//var divs='#boxs'+id;


                                    $('#' + divs + '').css({


                                        "background": "none repeat scroll 0 0 white",
                                        "border": "1px solid grey",
                                        "border-radius": "5px",
                                        "bottom": "20px",
                                        "display": "block",
                                        "position": "absolute",
                                        "right": '' + ind + '',
                                        "width": "230px",
                                        "z-index": "99"


                                    });

                                }


                            });


                        });
                    </script>
                    <script type="text/javascript">

                        function myFunction(id) {


                            if (id == '') {
                                alert('Required comment section');
                            }
                            else {


                                $.ajax({

                                    type: "GET",
                                    url: "{{ asset('/') }}/index.php/postcomdelete/" + id,
                                    //  data: { id: id, user: user, comment: comment, name: name},
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {


                                        var comment = '#cc' + data[0].idss;
                                        $(comment).hide('slow');


                                    }
                                });
                            }


                        }

                        function savepost(id) {

                            var inputval = 'textarea#pp' + id;
                            var postval = $('' + inputval + '').val().trim();

                            if (postval == '') {
                                alert('Required Input text field');
                            }
                            else {


                                $.ajax({

                                    type: "GET",
                                    url: "{{ asset('/') }}/index.php/postupdate/" + id,
                                    data: {value: postval},
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {


                                        $('textarea#pp' + data[0].idss + '').replaceWith('<p id="edit' + data[0].idss + '">' + data[0].valuess + '</p>');
                                        $('button.ed' + data[0].idss + '').show("slow");
                                        $('button#sav' + data[0].idss + '').hide("slow");
                                    }
                                });
                            }


                        }

                        function savecom(id) {

                            var inputval = 'textarea#cc' + id;
                            var postval = $('' + inputval + '').val().trim();

                            if (postval == '') {
                                alert('Required Input text field');
                            }
                            else {


                                $.ajax({

                                    type: "GET",
                                    url: "{{ asset('/') }}/index.php/comupdate/" + id,
                                    data: {value: postval},
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {


                                        $('textarea#cc' + data[0].idss + '').replaceWith('<p id="ppp' + data[0].idss + '">' + data[0].valuess + '</p>');
                                        $('button.eds' + data[0].idss + '').show("slow");
                                        $('button#savcc' + data[0].idss + '').hide("slow");
                                    }
                                });
                            }


                        }


                    </script>

                    <style type="text/css">

                        /*#post11{
  position:fixed;
  top: 50%;
  left: 50%;
  width: 5%;
  height: 5%;
  z-index: 101;
  background-color:#fff;
  display:none;
}
*/

                    </style>


                    <script type="text/javascript">


                        $(document).ready(function () {

                            $(document).on("click", ".fancybox", function (e) {
                                var id = $(this).attr("id");
                                var divs = '#post' + id;
                                var left = '#fleft' + id;
                                var right = '#rleft' + id;
                                var img = 'a#' + id + ' > img';
                                var comment = '#rleft' + id + ' #ppcomment' + id;
                                var close = '.cl' + id;
                                var btn = 'button#' + id;
                                var imgs = 'a#' + id + ' > img';
                                //   $("#post11").css("display", "block");


                                $('' + imgs + '').css({

                                    "display": "block",
                                    "margin": "110px auto 0",
                                    "max-height": "500px",
                                    "max-width": "100%"


                                });


                                $('.like li').css({

                                    "border-left": "none"


                                });


                                $('.u-nformation').css({

                                    "font-size": "16px",
                                    "padding": "15px",
                                    "position": "absolute",
                                    "right": "0px",
                                    "border-bottom": "none",
                                    "width": "32%"


                                });

                                $('.message_text1').css({

                                    "height": "105px",
                                    "overflow-x": "hidden",
                                    "position": "absolute",
                                    "right": "0px",
                                    "top": "36px",
                                    "position": "absolute",
                                    "width": "33%"


                                });

                                $('' + comment + '').css({

                                    "min-height": "230px"


                                });


                                $('.likebox').css({

                                    "bottom": "72px",
                                    "position": "fixed",
                                    "width": "760px",
                                    "background": "#000",
                                    "border": "#000",
                                    "max-width": "58%"

                                });


                                $('body').css({
                                    "background": "none repeat scroll 0 0 #000000",

                                    "display": "table",
                                    "height": "100% !important",
                                    "table-layout": "fixed",
                                    "width": "100%",
                                    "overflow": "hidden"

                                });

                                $('' + btn + '').css({
                                    "display": "none"
                                });

                                $('' + close + '').css({
                                    "display": "block",
                                    "position": "absolute",
                                    "right": "-16px",
                                    "top": "-14px"
                                });


                                $('.comment_boxs').css({

                                    "position": "fixed",
                                    "width": "31.5%"


                                });


                                //   $("#post11").css("display", "block");

                                $('' + divs + '').css({

                                    "position": "fixed",
                                    "top": "10%",
                                    "left": "50%",
                                    "width": "5%",
                                    "height": "500px",
                                    "z-index": "1111111111",
                                    "background-color": "#fff",
                                    "display": "block"


                                });

                                $('.back').css({

                                    "background-color": "#000"

                                });

                                $('' + left + '').css({

                                    "float": "left",
                                    "width": "65%",
                                    "height": "498px",
                                    "background": "none repeat scroll 0 0 #000",
                                    "border-right": "1px solid #ccc",
                                    "overflow": "scroll",
                                    "overflow-x": "hidden",


                                });


                                $('' + right + '').css({

                                    "float": "left",
                                    "height": "234px",
                                    "overflow": "scroll",
                                    "overflow-x": "hidden",
                                    "width": "35%",
                                    "margin-top": "140px"


                                });


                                $('' + img + '').css({

                                    "max-height": "300px"

                                });


                                $('' + divs + '').animate({
                                    'width': '90%',
                                    'left': '5%'
                                }, 200, "swing", function () {
                                    $("#post11").animate({
                                        'height': '80%',
                                        'top': '14%'
                                    }, 200, "swing", function () {
                                    });


                                });


                                $(document).on("keydown", function (event) {
                                    if (event.keyCode === 27) {


                                        $('.like li').css({

                                            "border-left": "1px solid #d2d2d2"


                                        });


                                        $('' + imgs + '').css({


                                            "margin": "0px",
                                            "display": ""


                                        });


                                        $('.likebox').css({

                                            "bottom": "",
                                            "position": "",
                                            "width": "",
                                            "background": "",
                                            "border": "",
                                            "max-width": ""

                                        });


                                        $('.u-nformation').css({

                                            "font-size": "",
                                            "padding": "",
                                            "position": "",
                                            "right": "",
                                            "width": "",
                                            "border-bottom": "1px solid #d2d2d2"


                                        });


                                        $('.message_text1').css({

                                            "height": "",
                                            "overflow-x": "",
                                            "position": "",
                                            "right": "",
                                            "top": "",
                                            "position": "",
                                            "width": ""


                                        });


                                        $('' + comment + '').css({

                                            "min-height": "0px"


                                        });


                                        $('' + btn + '').css({
                                            "display": "block"
                                        });

                                        $('' + close + '').css({
                                            "display": "none",
                                            "position": "",
                                            "right": "",
                                            "top": ""
                                        });


                                        $('.comment_boxs').css({

                                            "position": "",
                                            "width": ""


                                        });
                                        // $(".modal-mask").css("display", "");

                                        $('body').css({
                                            "background": "",
                                            "opacity": "",
                                            "display": "",
                                            "height": "",
                                            "table-layout": "",
                                            "width": "",
                                            "overflow": ""

                                        });


                                        $('' + divs + '').css({
                                            "position": "",
                                            "top": "",
                                            "left": "",
                                            "width": "",
                                            "height": "",
                                            "z-index": "",
                                            "background-color": "",
                                            "display": ""
                                        });

                                        $('' + left + '').css({

                                            "float": "",
                                            "width": "",
                                            "height": "",
                                            "background": "",
                                            "border-right": "",
                                            "overflow": "",
                                            "overflow-x": "",


                                        });

                                        $('' + right + '').css({

                                            "float": "",
                                            "height": "",
                                            "overflow": "",
                                            "width": "",
                                            "overflow-x": "",
                                            "margin-top": ""


                                        });

                                        $('' + img + '').css({

                                            "max-height": ""

                                        });


                                    }
                                });


                            });


                            $(document).on("click", ".clx", function (e) {
                                var id = $(this).attr("name");

                                var divs = '#post' + id;
                                var left = '#fleft' + id;
                                var right = '#rleft' + id;
                                var img = 'a#' + id + ' > img';
                                var comment = '#rleft' + id + ' #ppcomment' + id;
                                var close = '.cl' + id;
                                var btn = 'button#' + id;

                                var imgs = 'a#' + id + ' > img';

                                $('.like li').css({

                                    "border-left": "1px solid #d2d2d2"


                                });


                                $('' + imgs + '').css({


                                    "margin": "0px",
                                    "display": ""


                                });


                                $('.likebox').css({

                                    "bottom": "",
                                    "position": "",
                                    "width": "",
                                    "background": "",
                                    "border": "",
                                    "max-width": ""

                                });


                                $('.u-nformation').css({

                                    "font-size": "",
                                    "padding": "",
                                    "position": "",
                                    "right": "",
                                    "width": "",
                                    "border-bottom": "1px solid #d2d2d2"


                                });

                                $('.message_text1').css({

                                    "height": "",
                                    "overflow-x": "",
                                    "position": "",
                                    "right": "",
                                    "top": "",
                                    "position": "",
                                    "width": ""


                                });


                                $('' + comment + '').css({

                                    "min-height": "0px"


                                });


                                $('.comment_boxs').css({

                                    "position": "",
                                    "width": ""


                                });

                                $('body').css({
                                    "background": "",
                                    "opacity": "",
                                    "display": "",
                                    "height": "",
                                    "table-layout": "",
                                    "width": "",
                                    "overflow": ""

                                });


                                $('' + close + '').css({
                                    "display": "none",
                                    "position": "",
                                    "right": "",
                                    "top": ""
                                });


                                $('' + btn + '').css({
                                    "display": "block"
                                });

                                $('' + divs + '').css({
                                    "position": "",
                                    "top": "",
                                    "left": "",
                                    "width": "",
                                    "height": "",
                                    "z-index": "",
                                    "background-color": "",
                                    "display": ""
                                });
                                $('' + left + '').css({

                                    "float": "",
                                    "width": "",
                                    "height": "",
                                    "background": "",
                                    "border-right": "",
                                    "overflow": "",
                                    "overflow-x": "",


                                });

                                $('' + right + '').css({

                                    "float": "",
                                    "height": "",
                                    "overflow": "",
                                    "width": "",
                                    "overflow-x": "",
                                    "margin-top": ""


                                });

                                $('' + img + '').css({

                                    "max-height": ""

                                });


                            });


                            $(document).on("click", ".clxs", function (e) {


                                var id = $(this).attr("name");


                                var close = '.clfcc' + id;

                                var divs = '.popupfcc' + id;

                                var imgss = '#fcc' + id + ' > img';

                                $('' + imgss + '').css({
                                    "max-height": ""
                                });


                                $('' + close + '').css({
                                    "display": "none",

                                    "float": "",
                                    "position": "",
                                    "right": "",
                                    "top": "",
                                    "width": ""
                                });


                                $('' + divs + '').css({

                                    "background": "",
                                    "border": "",
                                    "display": "",
                                    "height": "",
                                    "left": "",
                                    "min-height": "",
                                    "position": "",
                                    "text-align": "",
                                    "top": "",
                                    "width": "",
                                    "z-index": ""


                                });

                                $('body').css({
                                    "background": "",

                                    "display": "",
                                    "height": "",
                                    "table-layout": "",
                                    "width": "",
                                    "overflow": ""

                                });


                            });


                            $(document).on("click", ".fancyboxs", function (e) {

                                var id = $(this).attr("id");


                                var close = '.cl' + id;

                                var divs = '.popup' + id;


                                var imgss = '#' + id + ' > img';

                                $('' + imgss + '').css({
                                    "max-height": "450px"
                                });


                                $('' + close + '').css({
                                    "display": "block",
                                    "float": "right",
                                    "position": "absolute",
                                    "right": "0",
                                    "top": "-13px",
                                    "width": "10px"
                                });


                                $('' + divs + '').css({


                                    "background": "none repeat scroll 0 0 #000",
                                    "border": "1px solid #ccc",
                                    "display": "block",
                                    "height": "auto",
                                    "left": "12%",
                                    "max-height": "500px",
                                    "position": "fixed",
                                    "text-align": "center",
                                    "top": "20%",
                                    "width": "75%",
                                    "z-index": "2147483641"
                                });


                                $('body').css({
                                    "background": "none repeat scroll 0 0 #000000",

                                    "display": "table",
                                    "height": "100% !important",
                                    "table-layout": "fixed",
                                    "width": "100%",
                                    "overflow": "hidden"

                                });


                                $('' + divs + '').animate({
                                    'width': '75%',
                                    'left': '10%'
                                }, 200, "swing", function () {
                                    $("#post11").animate({
                                        'height': '80%',
                                        'top': '14%'
                                    }, 200, "swing", function () {
                                    });


                                });


                                $(document).on("keydown", function (event) {
                                    if (event.keyCode === 27) {
                                        // $(".modal-mask").css("display", "");
                                        $('' + imgss + '').css({
                                            "max-height": ""
                                        });


                                        $('' + close + '').css({
                                            "display": "none",

                                            "float": "",
                                            "position": "",
                                            "right": "",
                                            "top": "",
                                            "width": ""
                                        });


                                        $('' + divs + '').css({

                                            "background": "",
                                            "border": "",
                                            "display": "",
                                            "height": "",
                                            "left": "",
                                            "min-height": "",
                                            "position": "",
                                            "text-align": "",
                                            "top": "",
                                            "width": "",
                                            "z-index": ""


                                        });

                                        $('body').css({
                                            "background": "",

                                            "display": "",
                                            "height": "",
                                            "table-layout": "",
                                            "width": "",
                                            "overflow": ""

                                        });


                                    }
                                });


                            });


                            $(".comdel").click(function (e) {


                                var id = $(this).attr("id");


                                if (id == '') {
                                    alert('Required comment section');
                                }
                                else {


                                    $.ajax({

                                        type: "GET",
                                        url: "{{ asset('/') }}/index.php/postcomdelete/" + id,
                                        //  data: { id: id, user: user, comment: comment, name: name},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {


                                            var comment = '#cc' + data[0].idss;
                                            $(comment).hide('slow');


                                        }
                                    });
                                }


                            });


                            $(document).on("click", ".postdelete", function (e) {


                                var id = $(this).attr("id");

                                if (id == '') {
                                    alert('Required comment section');
                                }
                                else {


                                    $.ajax({

                                        type: "GET",
                                        url: "{{ asset('/') }}/index.php/postdelete/" + id,
                                        //  data: { id: id, user: user, comment: comment, name: name},
                                        dataType: 'json',
                                        cache: false,
                                        success: function (data) {


                                            var comment = '#post' + data[0].idss;
                                            $(comment).hide('slow');


                                        }
                                    });
                                }


                            });


                            $(document).on("click", ".postedit", function (e) {


                                var id = $(this).attr("id");


                                var para = 'p#edit' + id;

                                var postval = $(para).text();


                                if (id == '') {
                                    alert('Required comment section');
                                }
                                else {

                                    $('' + para + '').replaceWith('<textarea style="width:100%" name="pp' + id + '" id="pp' + id + '">' + postval + '</textarea><button id="sav' + id + '" onclick="savepost(' + id + ');">save</button>');
                                    $('button.ed' + id + '').hide("slow");

                                }


                            });


                            $(document).on('click', '.comedit', function (e) {


                                var id = $(this).attr("id");


                                var para = 'p#ppp' + id;


                                var postval = $(para).text();


                                if (id == '') {
                                    alert('Required comment section');
                                }
                                else {

                                    $('' + para + '').replaceWith('<textarea style="width:100%" name="cc' + id + '" id="cc' + id + '">' + postval + '</textarea><button id="savcc' + id + '" onclick="savecom(' + id + ');">save</button>');
                                    $('button.eds' + id + '').hide("slow");

                                }


                            });


                        });
                    </script>

                    <div id="pppost">

                        @foreach( $post as $hello)


                            <script type="text/javascript">
                                $(function () {


                                    $('label.imgg{{$hello->id}}').data('default', $('label[class=imgg{{$hello->id}}]').text()).click(function () {
                                        $('.imgg{{$hello->id}}').click()
                                    });
                                    $('.imggs{{$hello->id}}').on('change', function () {
                                        var files = this.files;
                                        if (!files.length) {
                                            $('label[class=imgg{{$hello->id}}]').text($('.imggs{{$hello->id}}').data('default'));
                                            return;
                                        }

                                        document.getElementById('imagess{{$hello->id}}').style.backgroundImage = 'url(../public/imagesfb/camerasred.png)';

                                    });


                                    $('label.vdo{{$hello->id}}').data('default', $('label[class=vdo{{$hello->id}}]').text()).click(function () {
                                        $('.vdo{{$hello->id}}').click()
                                    });
                                    $('.vdos{{$hello->id}}').on('change', function () {
                                        var files = this.files;
                                        if (!files.length) {
                                            $('label[class=vdo{{$hello->id}}]').text($('.vdos{{$hello->id}}').data('default'));
                                            return;
                                        }

                                        document.getElementById('imagessvideos{{$hello->id}}').style.backgroundImage = 'url(../public/imagesfb/video1red.png)';

                                    });


                                });


                            </script>



                            <script type="text/javascript">

                                $(document).ready(function (e) {

                                    /*

                                     $("#comments{{$hello->id}}").on('submit',(function(e) {
                                     e.preventDefault();
                                     $('#help').show();
                                     $('#help').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');

                                     var id = $('#post_id{{$hello->id}}').val();

                                     $.ajax({
                                     url: "ajaxreq/"+id,     // Url to which the request is send
                                     type: "POST",             // Type of request to be send, called as method
                                     data:  new FormData(this),    // Data sent to server, a set of key/value pairs representing form fields and values
                                     contentType: false,           // The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
                                     dataType: 'json',
                                     cache: false,         // To unable request pages to be cached
                                     processData:false,        // To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
                                     success: function(data)     // A function to be called if request succeeds
                                     {
                                     $('#help').hide("slow");

                                     if(data[0].targetPath!=null)
                                     {

                                     var insert_id=data[0].insert_id;

                                     var idss=data[0].idss;
                                     var comment=data[0].comment;
                                     var names=data[0].names;
                                     var targetPath=data[0].targetPath;
                                     var datas='<div id="cc'+insert_id+'" class="coment_text"><h3>'+names+'</h3>'+'<p id="ppp'+insert_id+'">'+comment+'</p><br><div class="popupfcc'+insert_id+'"><div style="display:none; float:right;" class="clfcc'+insert_id+'"><a class="clxs" name="'+insert_id+'" style="cursor:pointer;"><span class="glyphicon glyphicon-remove"></span></a></div> <div style="cursor:pointer;" id="fcc'+insert_id+'" class="fancyboxs"><img src="../'+targetPath+'" style="max-width:100%;"></div></div><button id="'+insert_id+'" class="comedit eds'+insert_id+'"><span class="">edit</span></button><button class="comdel" id="{{$hello->id}}" onclick="myFunction('+insert_id+')"><span class="glyphicon glyphicon-remove"></span></button></div>';
                                     $("#ppcomment{{$hello->id}}").append(datas);
                                     $('#comment{{$hello->id}}').val('');

                                     $('form#comments{{$hello->id}} input#imagesss{{$hello->id}}').val('');
                                     $('label#imagess{{$hello->id}}').css('background-image','url(../imagesfb/cameras.png)');

                                     }
                                     else if(data[0].targetvideo!=null)
                                     {

                                     var insert_id=data[0].insert_id;

                                     var idss=data[0].idss;
                                     var comment=data[0].comment;
                                     var names=data[0].names;
                                     var targetvideo=data[0].targetvideo;
                                     var datas='<div id="cc'+insert_id+'" class="coment_text"><h3>'+names+'</h3>'+'<p id="ppp'+insert_id+'">'+comment+'</p><br><video width="320" height="240" controls><source src="../'+targetvideo+'" type="video/mp4"><source src="../'+targetvideo+'" type="video/ogg"></video><button id="'+insert_id+'" class="comedit eds'+insert_id+'"><span class="">edit</span></button><button class="comdel" id="{{$hello->id}}" onclick="myFunction('+insert_id+')"><span class="glyphicon glyphicon-remove"></span></button></div>';
                                     $("#ppcomment{{$hello->id}}").append(datas);
                                     $('#comment{{$hello->id}}').val('');

                                     $('form#comments{{$hello->id}} input#imagessvideo{{$hello->id}}').val('');
                                     $('label#imagessvideos{{$hello->id}}').css('background-image','url(../imagesfb/video1.png)');

                                     }

                                     else
                                     {
                                     var insert_id=data[0].insert_id;

                                     var idss=data[0].idss;
                                     var comment=data[0].comment;
                                     var names=data[0].names;
                                     var datas='<div id="cc'+insert_id+'" class="coment_text"><h3>'+names+'</h3>'+'<p id="ppp'+insert_id+'">'+comment+'</p><button id="'+insert_id+'" class="comedit eds'+insert_id+'"><span class="">edit</span></button><button class="comdel" id="{{$hello->id}}" onclick="myFunction('+insert_id+')"><span class="glyphicon glyphicon-remove"></span></button></div>';
                                     $("#ppcomment{{$hello->id}}").append(datas);
                                     $('#comment{{$hello->id}}').val('');



                                     }








                                     }
                                     });
                                     }));


                                     */
// Function to preview image
                                    $(function () {
                                        $("#file").change(function () {
                                            $("#message").empty();         // To remove the previous error message
                                            var file = this.files[0];
                                            var imagefile = file.type;
                                            var match = ["image/jpeg", "image/png", "image/jpg"];
                                            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                                                $('#previewing').attr('src', 'noimage.png');
                                                $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                                                return false;
                                            }
                                            else {
                                                var reader = new FileReader();
                                                reader.onload = imageIsLoaded;
                                                reader.readAsDataURL(this.files[0]);
                                            }
                                        });
                                    });
                                    function imageIsLoaded(e) {
                                        $("#file").css("color", "green");
                                        $('#image_preview').css("display", "block");
                                        $('#previewing').attr('src', e.target.result);
                                        $('#previewing').attr('width', '250px');
                                        $('#previewing').attr('height', '230px');
                                    }
                                });

                            </script>






                            <div class="message_box" id="post{{$hello->id}}">
                                <div class="popup_bgg">


                                    <div id="fleft{{$hello->id}}" class="">
                                        <div class="u-nformation"><img alt="iamge" class="img-circle img_wid myimgs"
                                                                       src="{{ asset('') }}public/<?php if ($allimg) {
                                                                           foreach ($allimg as $img) {
                                                                               if ($img->user_rand == $hello->user_rand) {
                                                                                   $mm = $img->thumb;
                                                                                   echo $mm;
                                                                                   break;
                                                                               } else {
                                                                                   $mm = '';
                                                                               }
                                                                           }
                                                                       } if ($mm == '') {
                                                                           foreach ($alluser as $all) {
                                                                               if ($all->rand == $hello->user_rand) {
                                                                                   if ($all->sex == 'male') {
                                                                                       echo 'imagesfb/male.jpg';
                                                                                   } else {
                                                                                       echo 'imagesfb/female.jpg';
                                                                                   }
                                                                               }
                                                                           }
                                                                       } ?>"> <a
                                                    href="{{ asset('index.php') }}/profile"><?php  echo Auth::user()->name;?></a>
                                            <button id="{{$hello->id}}" class="postdelete pull-right"><span
                                                        class="glyphicon glyphicon-remove"></span></button>
                                        </div>
                                        <?php if($hello->path)
                                        {?>


                                        <div class="message_text">
                                            <a class="fancybox" id="{{$hello->id}}" style="cursor:pointer;"/>
                                            <img src="{{ asset('/') }}{{$hello->path}}" style="max-width:100%;"/>
                                            </a>
                                        </div>

                                        <?php
                                        }?>
                                        <?php if($hello->imagessvideo)
                                        {?>


                                        <div class="message_text">
                                            <?php

                                            if (starts_with($hello->imagessvideo, "http://www.youtube.com") || starts_with($hello->imagessvideo, "https://www.youtube.com") )

                                            {



                                            ?>

                                            <object width="500" height="281">
                                                <param name="allowfullscreen" value="true"/>
                                                <param name="allowscriptaccess" value="always"/>
                                                <param name="movie" value="{{$hello->imagessvideo}}"/>
                                                <embed src="{{$hello->imagessvideo}}"
                                                       type="application/x-shockwave-flash" allowfullscreen="true"
                                                       allowscriptaccess="always" width="500" height="281">


                                                </embed>
                                            </object>

                                            <?php
                                            }

                                            elseif (starts_with($hello->imagessvideo, "http://vimeo.com") || starts_with($hello->imagessvideo, "https://vimeo.com") )

                                            {


                                            ?>

                                            <object width="500" height="281">
                                                <param name="allowfullscreen" value="true"/>
                                                <param name="allowscriptaccess" value="always"/>
                                                <param name="movie" value="{{$hello->imagessvideo}}"/>
                                                <embed src="{{$hello->imagessvideo}}"
                                                       type="application/x-shockwave-flash" allowfullscreen="true"
                                                       allowscriptaccess="always" width="500" height="281">


                                                </embed>
                                            </object>

                                            <?php
                                            }


                                            else
                                            {

                                            $test = 0;
                                            ?>
                                            <video style="width:100%;" controls>
                                                <source src="<?php if ($test == 0) {
                                                    echo asset('/');
                                                } ?><?php echo $hello->imagessvideo; ?>" type="video/mp4"/>
                                                <source src="<?php if ($test == 0) {
                                                    echo asset('/');
                                                } ?><?php echo $hello->imagessvideo; ?>" type="video/ogg"/>
                                                <source src="<?php if ($test == 0) {
                                                    echo asset('/');
                                                } ?><?php echo $hello->imagessvideo; ?>"/>

                                            </video>


                                            <?php

                                            }

                                            ?>


                                        </div>

                                        <?php
                                        }?>

                                        <div class="message_text1">
                                            <p id="edit{{$hello->id}}">{{$hello->post}} </p>
                                            <button id="{{$hello->id}}" class="postedit ed{{$hello->id}}"><span
                                                        class="">{{trans ('greeting.edit')}}</span></button>
                                        </div>


                                        <div class="comment_box likebox"><span
                                                    class="date_text">{{$hello->curdate}} </span>
                                            <div class="like">
                                                <ul>
                                                    <li><span class="glyphicon glyphicon-comment"></span></li>
                                                    <li><span id="countlike{{$hello->id}}">{{$hello->like}}</span></li>
                                                    <li><span>
                   <a style="cursor:pointer;" class="likes glyphicon glyphicon-thumbs-down" id="a{{$hello->id}}"
                      name="{{$hello->id}}"></a>

                 </span>


                                                    </li>

                                                </ul>
                                            </div>
                                        </div>


                                    </div>


                                    <div id="rleft{{$hello->id}}">
                                        <div class="cl{{$hello->id}}" style="display:none; float:right;"><a
                                                    style="cursor:pointer;" name="{{$hello->id}}" class="clx"><span
                                                        class="glyphicon glyphicon-remove"></span></a></div>
                                        <div class="message_text" id="ppcomment{{$hello->id}}">


                                            @foreach( $postcomment as $hellos)




                                                <?php
                                                if($hellos->post_id == $hello->id)
                                                {?>
                                                <div id="cc{{$hellos->id}}" class="coment_text">
                                                    <h3>{{$hellos->name}} </h3>
                                                    <p id="ppp{{$hellos->id}}">{{$hellos->comment}} </p>


                                                    <?php if($hellos->path != null)
                                                    {
                                                    ?>
                                                    <br>

                                                    <div class="popupfcc{{$hellos->id}}">
                                                        <div class="clfcc{{$hellos->id}}"
                                                             style="display:none; float:right;"><a
                                                                    style="cursor:pointer;" name="{{$hellos->id}}"
                                                                    class="clxs"><span
                                                                        class="glyphicon glyphicon-remove"></span></a>
                                                        </div>
                                                        <div class="fancyboxs" id="fcc{{$hellos->id}}"
                                                             style="cursor:pointer;">
                                                            <img src="{{ asset('/') }}public/{{$hellos->path}}"
                                                                 style="max-width:100%;"/>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }


                                                    ?>

                                                    <?php if($hellos->imagessvideo != null)
                                                    {
                                                    ?>
                                                    <br>

                                                    <?php

                                                    if (starts_with($hellos->imagessvideo, "http://www.youtube.com") || starts_with($hellos->imagessvideo, "https://www.youtube.com"))

                                                    {
                                                    $test = 1;

                                                    $str = $hellos->imagessvideo;

                                                    $newval = str_ireplace('watch?v=', 'v/', $str);

                                                    ?>


                                                    <object width="500" height="281">
                                                        <param name="allowfullscreen" value="true"/>
                                                        <param name="allowscriptaccess" value="always"/>
                                                        <param name="movie" value="<?php if ($test == 0) {
                                                            echo asset('/');
                                                        } ?><?php echo $newval; ?>"/>
                                                        <embed src="<?php if ($test == 0) {
                                                            echo asset('/');
                                                        } ?><?php echo $newval; ?>" type="application/x-shockwave-flash"
                                                               allowfullscreen="true" allowscriptaccess="always"
                                                               width="500" height="281">


                                                        </embed>
                                                    </object>


                                                    <?php
                                                    }

                                                    elseif (starts_with($hellos->imagessvideo, "http://vimeo.com") || starts_with($hellos->imagessvideo, "https://vimeo.com") )

                                                    {
                                                    $test = 1;
                                                    $str = $hellos->imagessvideo;

                                                    $newval = str_ireplace('http://vimeo.com/channels/staffpicks/', 'http://vimeo.com/moogaloop.swf?clip_id=', $str);


                                                    ?>

                                                    <object width="500" height="281">
                                                        <param name="allowfullscreen" value="true"/>
                                                        <param name="allowscriptaccess" value="always"/>
                                                        <param name="movie" value="<?php if ($test == 0) {
                                                            echo asset('/');
                                                        } ?><?php echo $newval; ?>"/>
                                                        <embed src="<?php if ($test == 0) {
                                                            echo asset('/');
                                                        } ?><?php echo $newval; ?>" type="application/x-shockwave-flash"
                                                               allowfullscreen="true" allowscriptaccess="always"
                                                               width="500" height="281">


                                                            <?php
                                                            }

                                                            else
                                                            {

                                                            $test = 0;
                                                            ?>
                                                            <video style="width:100%;" controls>
                                                                <source src="<?php if ($test == 0) {
                                                                    echo asset('/');
                                                                } ?><?php echo $hellos->imagessvideo; ?>"
                                                                        type="video/mp4"/>
                                                                <source src="<?php if ($test == 0) {
                                                                    echo asset('/');
                                                                } ?><?php echo $hellos->imagessvideo; ?>"
                                                                        type="video/ogg"/>
                                                                <source src="<?php if ($test == 0) {
                                                                    echo asset('/');
                                                                } ?><?php echo $hellos->imagessvideo; ?>"/>
                                                            </video>

                                                            <?php

                                                            }

                                                            ?>






                                                            <?php
                                                            }
                                                            ?>

                                                            <button id="{{$hellos->id}}"
                                                                    class="comedit eds{{$hellos->id}}"><span
                                                                        class="">{{trans ('greeting.edit')}}</span>
                                                            </button>
                                                            <button id="{{$hellos->id}}" class="comdel"><span
                                                                        class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                </div>



                                                <?php
                                                }?>

                                            @endforeach
                                        </div>
                                        <div class="comment_box comment_boxs">
                                            <form onsubmit="return comm({{$hello->id}},this)" name="comments"
                                                  id="uni{{$hello->id}}" method="post" enctype="multipart/form-data">
                                                {{ Form::token() }}

                                                <textarea style="width:98%; max-width:98%;" name="comment"
                                                          onkeydown="if (event.keyCode == 13) document.getElementById('submitbtn{{$hello->id}}').click()"
                                                          required="" id="comment{{$hello->id}}" value=""
                                                          placeholder="comment"></textarea>

                                                <input type="hidden" name="user" id="user{{$hello->id}}"
                                                       value="<?php  echo Auth::user()->rand;?>"/>
                                                <input type="hidden" id="post_id{{$hello->id}}" name="post_id"
                                                       value="{{$hello->id}}"/>
                                                <input type="hidden" name="name" id="name{{$hello->id}}"
                                                       value="<?php  echo Auth::user()->name;?>"/>


                                                <label id="imagess{{$hello->id}}" style="cursor:pointer;"
                                                       class="imgg"><input onchange="image({{$hello->id}});"
                                                                           class="imggs" id="imagesss{{$hello->id}}"
                                                                           name="imagesss" type="file"></label>


                                                <label id="imagessvideos{{$hello->id}}" style="cursor:pointer;"
                                                       class="vdo"><input onchange="video({{$hello->id}});" class="vdos"
                                                                          id="imagessvideo{{$hello->id}}"
                                                                          name="imagessvideo" type="file"></label>


                                                <button id="submitbtn{{$hello->id}}" type="submit"
                                                        class="buttonss{{$hello->id}} btn send_btn pull-right">{{trans ('greeting.Send')}}</button>
                                            </form>
                                        </div>


                                    </div>
                                </div>


                            </div>

                        @endforeach

                    </div>
                    <div class="pagenav">
                        <?php echo $post->links(); ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="border">
                        <input name="userid" type="hidden" id="userid" value="<?php echo Auth::user()->id;?>"/>
                        <div class="u-event">Create Events</div>
                        <div class="col-lg-12 col-md-12 col-sm-12">

                        {{ Form:: open(array('url' => 'createevent' , 'method' => 'get','id' => 'contactformr','files' => 'true', 'enctype' => 'multipart/form-data')) }} <!--contact_request is a router from Route class-->
                            @if($errors->any())

                                {{ implode('', $errors->all('<li>:message</li>'))  }}
                            @endif
                            {{ Form::token() }}

                            <div class="form-group padding">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' required="" placeholder="Date and Time" readonly="readonly"
                                           name="dates" class="form-control"/>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span>
                                </div>
                                <div class="input-group padding">
                                    <input type="text" required pattern=".*\S+.*" placeholder="Event Name" name="event"
                                           class="form-control">
                                    <span class="input-group-addon glyphicon glyphicon-pencil"></span></div>
                                <div class="input-group padding">
                                    <input type="text" required pattern=".*\S+.*" placeholder="Location" name="address"
                                           class="form-control">
                                    <span class="input-group-addon glyphicon glyphicon-map-marker"></span></div>


                                <div class="padding">
                                    <button class="all_btn" type="submit">{{trans ('greeting.Create Event')}}</button>
                                </div>
                                <div class="padding"><span><!-- No birthdays coming up. --></span></div>
                            </div>
                            </form>

                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="border margin">
                        <div class="u-event">{{trans ('greeting.Upcoming Events')}} </div>
                        <?php $i = 0; ?>
                        <?php if($events)
                        { ?>

                        @foreach( $events as $hellos)
                            <?php

                            $cur = date("m/d/Y");

                            if($cur < $hellos->dates)
                            {



                            if($i < 3)
                            {


                            ?>

                            <div class="col-lg-12 col-md-12 col-sm-12 padding2 border-bottom">
                                <!-- <img src="../imagesfb/man.jpg" class="img-circle img-custom img_wid pull-left" alt="iamge"> -->
                                <div class="pull-left add-frnd"><a>{{$hellos->event}}</a><br/>
                                    <span>{{$hellos->dates}}-{{$hellos->timess}} <!-- - <a href="#">Hide</a></span>  -->
                                </div>
                            </div>



                            <?php

                            $i++;

                            }

                            }

                            ?>



                        @endforeach

                        <?php
                        }
                        else
                        {
                        ?>

                        <p> No Result Found</p>

                        <?php
                        }

                        ?>


                        <div class="col-lg-12 col-md-12 col-sm-12 padding2">
                            <a href="{{ asset('/index.php') }}/allevent/{{Auth::user()->uname;}}" class="all_btn"
                               type="submit">View All</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="chatmessenger" style="z-index:214748364;">
        <div id="chatmessengers">
            <!-- <span id="" class="notifationss glyphicon glyphicon-screenshot"><p id="newmess" class="messnotification"></p></span>  -->
            <h3 id="clickchat"><span style="cursor:move;"
                                     class="glyphicon glyphicon-user"></span> {{trans ('greeting.Chat Messenger')}}</h3>


        </div>
        <div id="ulchat">
            <ul>
                <?php
                if($outputs)
                {?>


                @foreach( $outputs as $hello)








                    <li id="online<?php echo $hello['idd']; ?>">
                        <span id=""></span>
                        <img style="float:left;" class="img-circle" alt="" width="30" height="30"
                             src="{{ asset('/') }}public/<?php echo $hello['profilephoto']; ?>">


                        <p class="openbox" id="<?php echo $hello['idd']; ?>"
                           style="float:left; cursor:pointer; margin-left:15px;  margin-right:10px;"><?php echo $hello['name']; ?></p>
                        <div id="newvalues<?php echo $hello['idd']; ?>"></div>

                        <div id="boxs<?php echo $hello['idd']; ?>" class="allchatbox"
                             name="<?php echo $hello['idd']; ?>">
                            <div class="backchat">
                                <div class="chat_top">
                                    <div id="nname" class="text_name">
                                        <a href="{{ asset('/index.php')}}/profileopen/<?php echo $hello['uname']; ?>">
                                            <?php echo $hello['name']; ?>
                                        </a>
                                    </div>
                                    <div id="<?php echo $hello['idd']; ?>" class="minbox">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </div>
                                    <div id="<?php echo $hello['idd']; ?>" class="maxbox">
                                        <span class="glyphicon glyphicon-export"></span>
                                    </div>
                                    <div id="<?php echo $hello['idd']; ?>" class="closebox">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </div>
                                </div>
                            </div>
                            <form id="bo<?php echo $hello['idd']; ?>">
                                <div class="uptext" id="uptextid<?php echo $hello['idd']; ?>">


                                </div>
                                <div class="downtext">

                                    <textarea rows="1"
                                              onkeydown="if (event.keyCode == 13) document.getElementById('submitbtns<?php echo $hello['idd']; ?>').click()"
                                              required="" name="chat" id="chat<?php echo $hello['idd']; ?>"
                                              placeholder="Write a reply" class="form-control"></textarea>
                                    <input type="hidden" id="user<?php echo $hello['idd']; ?>"
                                           value="{{Auth::user()->rand;}}" name="user">
                                    <input type="hidden" id="name<?php echo $hello['idd']; ?>"
                                           value="{{Auth::user()->name; }}" name="name">
                                    <input type="hidden" id="otheruser<?php echo $hello['idd']; ?>"
                                           value="<?php echo $hello['otherrands']; ?>" name="otheruser">
                                    <input type="hidden" id="othername<?php echo $hello['idd']; ?>"
                                           value="<?php echo $hello['name']; ?>" name="othername">

                                    <button id="submitbtns<?php echo $hello['idd']; ?>" class="onlineclick chat_btn"
                                            name="<?php echo $hello['idd']; ?>" type="button"><span
                                                class="glyphicon glyphicon-send"></span> {{trans ('greeting.Reply')}}
                                    </button>

                                </div>
                            </form>


                        </div>

                        <style scoped type="text/css">
                            #boxs<?php echo $hello['idd'];?>  {

                                display: none;

                            }


                        </style>
                    </li>


                @endforeach



                <?php
                }?>


                <?php
                if($outputss)
                {?>

                @foreach( $outputss as $hello)



                    <li id="online<?php echo $hello['idd']; ?>">
                        <span id=""></span>
                        <img style="float:left;" class="img-circle" alt=""
                             src="{{ asset('/') }}public/<?php echo $hello['profilephoto']; ?>" width="30" height="30">


                        <p class="openbox" id="<?php echo $hello['idd']; ?>"
                           style="float:left;  cursor:pointer;margin-left:15px;  margin-right:10px;"><?php echo $hello['name']; ?></p>
                        <div id="newvalues<?php echo $hello['idd']; ?>"></div>
                        <div id="boxs<?php echo $hello['idd']; ?>" class="allchatbox"
                             name="<?php echo $hello['idd']; ?>">
                            <div class="backchat">
                                <div class="chat_top">
                                    <div id="nname" class="text_name">

                                        <a href="{{ asset('/index.php')}}/profileopen/<?php echo $hello['uname']; ?>">
                                            <?php echo $hello['name']; ?>
                                        </a>

                                    </div>
                                    <div id="<?php echo $hello['idd']; ?>" class="minbox">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </div>
                                    <div id="<?php echo $hello['idd']; ?>" class="maxbox">
                                        <span class="glyphicon glyphicon-export"></span>
                                    </div>
                                    <div id="<?php echo $hello['idd']; ?>" class="closebox">

                                        <span class="glyphicon glyphicon-remove"></span>
                                    </div>
                                </div>
                            </div>
                            <form id="bo<?php echo $hello['idd']; ?>">
                                <div class="uptext" id="uptextid<?php echo $hello['idd']; ?>">


                                </div>
                                <div class="downtext">

                                    <textarea rows="1"
                                              onkeydown="if (event.keyCode == 13) document.getElementById('submitbtns<?php echo $hello['idd']; ?>').click()"
                                              required="" name="chat" id="chat<?php echo $hello['idd']; ?>"
                                              placeholder="Write a reply" class="form-control"></textarea>
                                    <input type="hidden" id="user<?php echo $hello['idd']; ?>"
                                           value="{{Auth::user()->rand;}}" name="user">
                                    <input type="hidden" id="name<?php echo $hello['idd']; ?>"
                                           value="{{Auth::user()->name; }}" name="name">
                                    <input type="hidden" id="otheruser<?php echo $hello['idd']; ?>"
                                           value="<?php echo $hello['otherrands']; ?>" name="otheruser">
                                    <input type="hidden" id="othername<?php echo $hello['idd']; ?>"
                                           value="<?php echo $hello['name']; ?>" name="othername">

                                    <button id="submitbtns<?php echo $hello['idd']; ?>" class="onlineclick chat_btn"
                                            name="<?php echo $hello['idd']; ?>" type="button"><span
                                                class="glyphicon glyphicon-send"></span> {{trans ('greeting.Reply')}}
                                    </button>

                                </div>
                            </form>


                        </div>

                        <style scoped type="text/css">
                            #boxs<?php echo $hello['idd'];?>  {

                                display: none;

                            }


                        </style>

                    </li>



                @endforeach



                <?php
                }?>

            </ul>

        </div>

    </div>

    <script type="text/javascript">

        var screenWidth = window.screen.width;

        if (screenWidth < 400) {
            $("a").removeClass("fancybox").addClass("fancyboxss");
            $("div").removeClass("fancyboxs").addClass("fancyboxss");
        }


    </script>

@endsection
