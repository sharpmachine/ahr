/*
 * swfupload.queue.js - File queue uploading support derived from SWFUpload 
 * Copyright ?? 2008-2010 by Ingenesis Limited
 * Licensed under the GPLv3 {@see license.txt}
 */
var SWFUpload;if(typeof(SWFUpload)==="function"){SWFUpload.queue={};SWFUpload.prototype.initSettings=(function(a){return function(){if(typeof(a)==="function"){a.call(this)}this.qsettings={};this.qsettings.cancelled=false;this.qsettings.uploaded=0;this.qsettings.user_upload_complete_handler=this.settings.upload_complete_handler;this.qsettings.user_upload_start_handler=this.settings.upload_start_handler;this.settings.upload_complete_handler=SWFUpload.queue.uploadCompleteHandler;this.settings.upload_start_handler=SWFUpload.queue.uploadStartHandler;this.settings.queue_complete_handler=this.settings.queue_complete_handler||null}})(SWFUpload.prototype.initSettings);SWFUpload.prototype.startUpload=function(a){this.qsettings.cancelled=false;this.callFlash("StartUpload",[a])};SWFUpload.prototype.cancelQueue=function(){this.qsettings.cancelled=true;this.stopUpload();var a=this.getStats();while(a.files_queued>0){this.cancelUpload();a=this.getStats()}};SWFUpload.queue.uploadStartHandler=function(a){var b;if(typeof(this.qsettings.user_upload_start_handler)==="function"){b=this.qsettings.user_upload_start_handler.call(this,a)}b=(b===false)?false:true;this.qsettings.cancelled=!b;return b};SWFUpload.queue.uploadCompleteHandler=function(b){var d,a,c=this.qsettings.user_upload_complete_handler;if(b.filestatus===SWFUpload.FILE_STATUS.COMPLETE){this.qsettings.uploaded++}if(typeof(c)==="function"){d=(c.call(this,b)===false)?false:true}else{if(b.filestatus===SWFUpload.FILE_STATUS.QUEUED){d=false}else{d=true}}if(d){a=this.getStats();if(a.files_queued>0&&this.qsettings.cancelled===false){this.startUpload()}else{if(this.qsettings.cancelled===false){this.queueEvent("queue_complete_handler",[this.qsettings.uploaded]);this.qsettings.uploaded=0}else{this.qsettings.cancelled=false;this.qsettings.uploaded=0}}}}};