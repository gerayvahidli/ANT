<script type="text/javascript">
Dropzone.autoDiscover = false;

var token = "{!! csrf_token() !!}";
var url = "{{url('upload/'.$folder.'/uploadArchiveFile')}}";
Dropzone.options.myDropzone = {
    url:url,
    //dictDefaultMessage: "<b>.zip və ya .rar formatında olan sənədinizi dartıb bura atın və ya klik edib həmin sənədi seçin</b>",
    paramName: "file",
    maxFilesize: 10,
	timeout: 180000,
    acceptedFiles: ".rar,.zip",
    maxFiles: 1,
     addRemoveLinks: true,
    params: {
        _token: token
    },
    init: function() {


@if(old('filename')!=null)
var mockFile = { 
			name: "{{old('dropzone_filezone')}}",
			size: " {{Storage::disk('public')->size('application/'.$folder.'/'.Auth::user()->id.'/temp/'.old('filename'))}}", 
			accepted: true, 
			dataURL:"{{asset('img/WinRAR.png')}}",
			}; // use actual id server uses to identify the file (e.g. DB unique identifier)
        this.emit("addedfile", mockFile);
        //this.createThumbnailFromUrl(mockFile, "{{asset('img/WinRAR.png')}}");
        this.emit("success", mockFile);
        

        this.emit("complete", mockFile);
        this.files.push(mockFile);

        $('.dz-image>img').attr('src',"{{asset('img/WinRAR.png')}}");


@endif




        this.on("addedfile", function(file) {
        	
 	var ext = file.name.split('.').pop();
  	

  	$(file.previewElement).find(".dz-image img").attr("src", "{{asset('img/WinRAR.png')}}"); 
 
        });

       /*  this.on("maxfilesexceeded", function(file) {
            this.removeAllFiles();
            this.addFile(file);
      })*/
        this.on("success", function(file, response) {
        $('#filename').val(response);
  		$('#dropzone_filezone').val(file.name);
  		console.log(file.name);
        });

    this.on("removedfile", function(file, response) {
    

    var name = $('#filename').val(); 
   
			  $.ajax({
			   type: 'POST',
			   url: "{{url('remove/'.$folder.'/file')}}",
			   type: "POST",
			       headers: {
			       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			   data: {
			   	name: name,
			   	slug:"{{$folder}}"
			   },
			   success: function(respone){
			  $('#filename').val("");
			   }
			  });



        });


            this.on("error", function(file, response) {
                // do stuff here.
              
        var error_message=response.errors.file[0];
     //   console.log(response);
        
        $(file.previewElement).find('.dz-error-message').html('<span style="word-wrap: break-word;">'+error_message+'</span>');
        
 
              });
    }
}

$('#myDropzone').dropzone();
</script>