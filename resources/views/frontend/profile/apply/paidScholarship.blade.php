@extends('layouts.app')



@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>
            $( document ).ready(function() {
                $('[data-toggle="tooltip"]').tooltip({'placement': 'right'});
            });
        </script>
 
<script src="{{asset('js/dropzone.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/dropzone.css')}}"> 
<style type="text/css">
  .error
  {
      font-weight: bold;
      font-size: 11px;
  }

  .errorInput{
      background-color:#ffffcc;
      border-color: transparent; border: 1px solid #dc3545;
      padding-top: 8px;
      padding-left: 5px;
  }

   .required-asterisk{
    color:red;
  }
</style>

@endsection




@section('mainSection')


 


<div class="container">
<hr>



 <h3 style="text-align: center;">Ödənişli təcrübə proqramına müraciət</h3>
 <hr>
 {{Form::open(['url'=>'apply/paid/scholarship/'.Request::segment(4),'class'=>'form-horizontal'])}}
 <input type="hidden" name="program_id" value="{{Request::segment(4)}}">
 <div class="row">
<div class="col-md-10 " style="margin:0 auto;">
<div class="form-group">




    <label for="exampleInputPassword1">Hərbi xidmətdə olmusunuzmu? <span class="required-asterisk"> *</span></label><br>
    <div class="{{$errors->has('HasBeenAtArmy')?'errorInput':''}}"> <label class="radio-inline">
        {{ Form::radio('HasBeenAtArmy', '1' , false) }}
  Bəli
    </label>
    <label class="radio-inline">
    {{ Form::radio('HasBeenAtArmy', '0' , false) }}   Xeyr
    </label>

    </div>

<span class="error text-danger"> {{$errors->first('HasBeenAtArmy')}}</span>

<div id='army_avoid_reasons_list'> 
@if(old('HasBeenAtArmy')==0)
  {{ Form::select('army_avoid_reason_id', $reasons_array ,null,['class'=>'form-control']) }}
  
     
  


   

  @endif
</div>


 
  </div>
    
  <input type="hidden" id="filename" value="{{old('filename')}}" name="filename">
  

  <input type="hidden" id="dropzone_filezone" value="{{old('dropzone_filezone')}}" name="dropzone_filezone">


  <div class="form-group">
    <label for="exampleInputEmail1">Sənədinizi əlavə edin   <a class="btn btn-primary btn-xs" style="padding:0.05em 0.32rem;" href="#" data-toggle="tooltip" rel="tooltip" data-placement="top" title="Ümumi həcm 10MB-dan çox olmamalıdır."> ? </a> <span class="required-asterisk"> *</span></label>
 <div class="dropzone  {{$errors->has('filename')?'errorInput':''}}" id="myDropzone"><div class="dz-message" data-dz-message><span style="font-weight: bold"><i><u>.zip</u></i> və ya <i><u>.rar</u> </i>formatında olan sənədinizi dartıb bura atın və ya klik edib həmin sənədi seçin</span></div></div>
      <span class="error text-danger"> {{$errors->first('filename')}}</span> 
  </div>
  


 
  <button type="submit" class="btn btn-primary">Müraciət et</button>
  </div>
  </div>
</form>
</div>
<br>
<br>

@endsection

@section('bottom')
 <script type="text/javascript">
     $( document ).ready(function() {
       
      var select_option='{{ Form::select("army_avoid_reason_id", $reasons_array ,null,["class"=>"form-control","id"=>"army_avoid_reason_id"]) }}';

     //  $('#army_avoid_reasons_list').html("");
  
        $("input[name='HasBeenAtArmy']:radio").change(function(){
          if($(this).val() == '0')
          {
           $('#army_avoid_reasons_list').html(select_option);
          }
          else
          {
              $('#army_avoid_reasons_list').html("");
          }
   
      });
    
  if (!$("input[name='HasBeenAtArmy']:checked").val()) {
 $('#army_avoid_reasons_list').html("");
}
  
  });
  
   </script>


 @include('frontend.profile.apply.dropzone', ['folder' => 'paid'])
 
@endsection