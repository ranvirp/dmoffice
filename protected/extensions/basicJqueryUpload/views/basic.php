<style>
    .row + .row {
border-top:0;
}
.show-grid [class^="col-"] {
    background-color: rgba(86, 61, 124, 0.15);
    border: 1px solid rgba(86, 61, 124, 0.2);
    padding-bottom: 10px;
    padding-top: 10px;
}
</style>
 <div id="<?php echo get_class($model).'_'.$attribute.'_attachments';?>"></div>
    <div id="<?php echo get_class($model);?>_<?php echo $attribute;?>_files" class="container-fluid files ">
        <div class="row show-grid">
        <div class="col-md-12 pull-right"><span class="btn btn-success fileinput-button">
<i class="glyphicon glyphicon-plus"></i>
<span>Add files...</span>
        <input id="<?php echo get_class($model);?>_<?php echo $attribute;?>" type="file" name="<?php echo get_class($model);?>_<?php echo $attribute;?>_files[]" multiple>

            </span>
        </div>
        
    </div>
    <div class="row show-grid">
        <div class="col-md-4"><span>Preview</span></div>
        <div class="col-md-4">Title<span class="required">*</span></div>
        <div class="col-md-1"></div>
        <div class="col-md-2"><span>File</span></div>
        
    </div>
</div>
<!-- The fileinput-button span is used to style the file input field as button -->



<!-- The global progress bar -->
<div id="progress" class="progress">
<div class="progress-bar progress-bar-success"></div>
</div>
<!-- The container for the uploaded files -->



<script>
    var files="<?php echo get_class($model);?>_<?php echo $attribute;?>_files";
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
'use strict';
// Change this to the location of your server-side upload handler:
var url = '<?php echo Yii::app()->createUrl('/Basedata/files/uploadFile',array('field'=>get_class($model)."_".$attribute.'_files'));?>',

uploadButton = $('<button/>')
.addClass('btn btn-primary')
.prop('disabled', true)
.text('Processing...')
.on('click', function (event) {
 event.preventDefault();
var $this = $(this),
data = $this.data();
$this
.off('click')
.text('Abort')
.on('click', function () {
$this.remove();
data.abort();
});
data.submit().always(function (event) {
$this.remove();


});
});
$('#<?php echo get_class($model);?>_<?php echo $attribute;?>').fileupload({
url: url,
paramName:"<?php echo get_class($model);?>_<?php echo $attribute;?>_files[]",
dataType: 'json',
autoUpload: false,
acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,

maxFileSize: 5000000, // 5 MB
// Enable image resizing, except for Android and Opera,
// which actually support image resizing, but fail to
// send Blob objects via XHR requests:
disableImageResize: /Android(?!.*Chrome)|Opera/
.test(window.navigator.userAgent),
previewMaxWidth: 100,
previewMaxHeight: 100,
previewCrop: true
}).on('fileuploadadd', function (e, data) {
data.context = $('<div/>').appendTo('#<?php echo get_class($model)?>'+"_"+'<?php echo $attribute;?>'+'_files');
$.each(data.files, function (index, file) {
var node = $('<div class="row"><div class="col-md-4"><input class="hindiinput <?php echo get_class($model)?>'+"_"+'<?php echo $attribute;?>_title" name="<?php echo get_class($model)?>'+"_"+'<?php echo $attribute;?>_title[]"/></div> </div>');

if (!index) {
node
.append($('<div class="col-md-2"></div>')
.append(uploadButton.clone(true).data(data)));
}
node.appendTo(data.context);
});
}).on('fileuploadprocessalways', function (e, data) {
var index = data.index,
file = data.files[index],
node = $(data.context.children()[index]);
var preview =file.preview?file.preview:"";//for other file names

node
.prepend($('<div class="col-md-6"></div>')
.prepend(preview)
.append('<br/>')
.append($('<span/>').text(file.name)));;

if (file.error) {
node
.append('<div class="col-md-2"></div>')
.append($('<span class="text-danger"/>').text(file.error));
}
if (index + 1 === data.files.length) {
data.context.find('button')
.text('Upload')
.prop('disabled', !!data.files.error);
}
}).on('fileuploadprogressall', function (e, data) {
var progress = parseInt(data.loaded / data.total * 100, 10);
$('#progress .progress-bar').css(
'width',
progress + '%'
);
}).on('fileuploaddone', function (e, data) {
$.each(data.result, function (index, file) {
	$('#<?php echo get_class($model);?>_<?php echo $attribute;?>_attachments').append('<input type="hidden" name="<?php echo get_class($model);?>[<?php echo $attribute;?>][]" value="'+file.id+'" >');
if (file.url) {
var link = $('<a>')
.attr('target', '_blank')
.prop('href', file.url)
.prop('title',file.name)

.prop('class','thumbnail image-responsive');
var link1=$('<a>'+file.name+'</a>')
        .attr('target','_blank')
.prop('href', file.url)
.prop('title',file.name);
        
//$(data.context).prop('class','col-md-2');
$(data.context.children()[index]).children('div:eq(0)')
.wrapInner(link)
;
$(data.context.children()[index]).children('div:eq(1)')
.html(data.formData.title)
;
$(data.context.children()[index]).children('div:eq(2)')
.append(link1)
} else if (file.error) {
var error = $('<span class="text-danger"/>').text(file.error);
$(data.context.children()[index]).children('div:eq(2)')
.append('<br>')
.append(error);
}
});
}).on('fileuploadfail', function (e, data) {
$.each(data.files, function (index) {
var error = $('<span class="text-danger"/>').text('File upload failed.');
$(data.context.children()[index])
.append('<br>')
.append(error);
});
}).prop('disabled', !$.support.fileInput)
.parent().addClass($.support.fileInput ? undefined : 'disabled');
});
$('#<?php echo get_class($model);?>_<?php echo $attribute;?>').bind('fileuploadsubmit', function (e, data) {
    var input = $('.<?php echo get_class($model)?>'+"_"+'<?php echo $attribute;?>_title');
   
    data.formData = {title: input.val()};
    if (!data.formData.title) {
      data.context.find('button').prop('disabled', false);
      input.focus();
      return false;
    }
   
});
</script>


