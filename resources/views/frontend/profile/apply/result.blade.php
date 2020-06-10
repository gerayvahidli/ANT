@extends('layouts.app')


 



@section('mainSection')





 

<div class="container">
<hr>
<br>
<br> 

 <div class="alert-success" align="center"><br><br>
  Hörmətli <span style="font-weight: bold;"> {{Auth::user()->FirstName}} {{Auth::user()->LastName}},</span>  təqaüd proqramına müvəffəqiyyətlə müraciət etdiniz. Müraciətinizin nəticəsi ilə bağlı tezliklə qeyd etdiyiniz əlaqə vasitələri üzərindən məlumatlandırılacaqsınız. Təşəkkür edirik!<br><br>
</div>

  
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection

@section('bottom')
 
 
@endsection