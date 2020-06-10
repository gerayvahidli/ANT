
{{--$.ajax({--}}
    {{--type: 'POST',--}}
    {{--url: $(this).attr('action'),--}}
    {{--headers: {'X-CSRF-TOKEN': token},--}}
    {{--data: formData, // here $(this) refers to the ajax object not form--}}
        {{--dataType: 'json',--}}
        {{--success: function (data) {--}}
            {{--window.location.href = '{{ route('profile.index') }}';--}}
            {{--},--}}
        {{--error: function (data, status, error) {--}}
            {{--console.log(data.responseJSON);--}}
            {{--console.log(status);--}}
            {{--console.log(error);--}}
            {{--//parse json--}}
                {{--json = $.parseJSON(data.responseText);--}}
                {{--// show error box--}}
                    {{--$('.alert-danger').show();--}}
                    {{--$.each(json.errors, function (key, value) {--}}
                        {{--// split input name in case if input is arrray--}}
                            {{--fieldId = key.split(".")[0];--}}
                            {{--fieldNum = key.split(".")[0];--}}
                            {{--// if ( fieldNum ) {--}}
                                {{--//     console.log($('input[name="' +  fieldId + '"]')[fieldNum]);--}}
                                {{--//     $('input[name=" +  fieldId +"]')[fieldNum].addClass('is-invalid');--}}
                                {{--// } else  {--}}
                                {{--//     // $('#'+fieldId).addClass('is-invalid');--}}
                                {{--//     $('input[name=" +  fieldId +"]').addClass('is-invalid');--}}
                                {{--// }--}}

                                {{--// add invalid classes to input fields with error--}}
                                {{--$('#' + fieldId).addClass('is-invalid');--}}
                                {{--console.log($('#' + fieldId).closest('.form-group ').find('invalid-feedback'));--}}
                                {{--$('#' + fieldId).closest('.form-group ').find('.invalid-feedback').remove();--}}
                                {{--$('#' + fieldId).after('<div class="invalid-feedback">\n' +--}}
                                {{--'<strong>' + value + '</strong>\n' +--}}
                                {{--'</div>');--}}
{{--// add errors to error box--}}
    {{--$('#form-error-list').append('<li>' + value + '</li>');--}}
    {{--});--}}
{{--// scroll to error list--}}
    {{--$([document.documentElement, document.body]).animate({--}}
    {{--scrollTop: $('.alert-danger').offset().top--}}
    {{--}, 2000);--}}


{{--},--}}
{{--complete: function () {--}}
    {{--$('#loader').css("visibility", "hidden");--}}
    {{--}--}}
{{--});--}}
// stay.preventDefault();