/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//
// window.Vue = require('vue');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
$(document).ready(function () {

// Select university by country
    /*$('select[id="country_id"]').on('change', function () {
        var countryId = $(this).val();
        var token = $("input[name='_token']").val();
        if (countryId) {
            $.ajax({
                url: '/getUniversitiesByCountry',
                type: "post",
                dataType: "json",
                data: {country_id: countryId, _token: token},
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },

                success: function (data) {

                    $('select[id="university_id"]').empty();

                    $.each(data, function (key, value) {

                        $('select[id="university_id"]').append('<option value="' + key + '">' + value + '</option>');

                    });
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[id="university_id"]').empty();
        }

    });//end select University by Country


    // add fields to form - profile

    //group add limit
    var maxGroup = 4;
    // previousEducationCount = 1;
    //add more fields group
    $("#addMore").click(function () {
        if ($('body').find('.fieldGroup').length < maxGroup) {
            previousEducationCount = $('body').find('.fieldGroup').length;
            console.log(previousEducationCount);
            var fieldHTML = '<div class="fieldGroup" id="fieldGroup' + previousEducationCount + '">' + $(".fieldGroupCopy").html() + '</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
            var countryId = $('select[id="previous_education_country_id"]');
            // var universityId = $('select[id="previous_education_university_id"]');
            countryId.change(changeUniversity(previousEducationCount));
        } else {
            $('#addMore').attr('disabled', true);
            alert('Maximum ' + maxGroup + ' education field group are allowed.');
        }
    });
    //remove fields group
    $("body").on("click", ".remove", function () {
        $(this).parents(".fieldGroup").remove();
    });


    function changeUniversity(count) {
        // Select university by country  for Previous Education 1
        $('#fieldGroup' + count + ' select[id="previous_education_country_id"]').on('change', function () {
            console.log($(this).val());
            var countryId = $(this).val();
            // alert(countryId);
            var token = $("input[name='_token']").val();
            if (countryId) {
                $.ajax({
                    url: '/getUniversitiesByCountry',
                    type: "post",
                    dataType: "json",
                    data: {country_id: countryId, _token: token},
                    beforeSend: function () {
                        $('#loader').css("visibility", "visible");
                    },

                    success: function (data) {

                        $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').empty();
                        console.log('count:' + count);

                        $.each(data, function (key, value) {
                            console.log('count each : ' + count);

                            $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').append('<option value="' + key + '">' + value + '</option>');

                        });
                    },
                    complete: function () {
                        $('#loader').css("visibility", "hidden");
                    }
                });
            } else {
                $('#fieldGroup' + count + ' select[id="previous_education_university_id"]').empty();
            }

        });//end select University by Country for Previous Education 1
    }*/

    // show work fields depending on radio buttons
    // $("#workFieldGroup").hide();
    $("#isCurrentlyWorking1").click(function () {
        $("#workFieldGroup").show();
    });
    $("#isCurrentlyWorking2").click(function () {
        $("#workFieldGroup").hide();
    });

    $("#isWorkingAtSocar1").click(function () {
        $("#socarWorkField").show();
    });
    $("#isWorkingAtSocar2").click(function () {
        $("#socarWorkField").hide();
    });

    // show scholarship fields depending on radio buttons
    // $("#scholarshipFieldGroup").hide();
    $("#hasAppliedToScholarship1").click(function () {
        $("#scholarshipFieldGroup").show();
    });
    $("#hasAppliedToScholarship2").click(function () {
        $("#scholarshipFieldGroup").hide();
    });

    // show date of scholarship depending on radio buttons
    // $("#scholarshipFieldGroup").hide();
    $("#haveBeenScholar1").click(function () {
        $("#previousScholarshipFieldGroup").show();
    });
    $("#haveBeenScholar2").click(function () {
        $("#previousScholarshipFieldGroup").hide();
    });

    // show internship fields depending on radio buttons
    // $("#scholarshipFieldGroup").hide();
    $("#haveBeenIntern1").click(function () {
        $(".internshipSection").show();
    });
    $("#haveBeenIntern2").click(function () {
        $(".internshipSection").hide();
    });
});

