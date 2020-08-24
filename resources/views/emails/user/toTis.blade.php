@component('mail::message')

<b>İsmarıc:</b> {{ $data['message'] }}
<br>
<hr>
<b>İstifadəçi:</b> {{ $data['full_name'] }}<hr>
<b>E-mail:</b> {{ $data['email'] }}<hr>
<b>Əlaqə telefonu:</b> {{ $data['phone_number'] }}<hr>
<b>Fin kod:</b> {{ $data['id_pin'] }}<hr>
<b>Tarix:</b> {{ $data['date'] }}<hr>

<br><br><br>

@if(isset($data['file']))
    Əlavə edilmiş fayla nəzər yetirin
@endif
<br>

{{--@component('mail::table')--}}
    {{--| Laravel       | Table         | Example  |--}}
    {{--| ------------- |:-------------:| --------:|--}}
    {{--| Col 2 is      | Centered      | $10      |--}}
    {{--| Col 3 is      | Right-Aligned | $20      |--}}
{{--@endcomponent--}}

{{--Hörmətlə,<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
 