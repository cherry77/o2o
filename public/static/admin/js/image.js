$(function() {
    $("#file_upload").uploadify({
        'swf'              : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : 'ͼƬ�ϴ�',
        'fileTypeDesc'    :'Image files',
        'fileObjName'     :'file',
        'fileTypeExts'    :'*.gif;*.jpg;*.png',
        'onUploadSuccess' : function(file,data,response){

        }
    });
});