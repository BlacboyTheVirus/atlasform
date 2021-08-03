
 //  Registration Level = (fee from Card)
 //  Virtual Show User(s) = (added Users - No of freeUsers) * 50 (if plan is A or C == 0)
 //  Promotional Flyers = no of pages * 50
 //  Brand Recognition = 50
 //  Seminar sessions = seminarCount * 500



$(document).ready(function () {

  $("input[name='plan']:checked").closest('.card').addClass("bg-card-selected");


  const data = {
    plan            : "B",
    planFee         : 0,
    freeUsers       : 0,
    addedUsers      : 0,
    flyerPages      : 0,
    brandRecog      : 0,
    seminarCount    : 0,
    dating          : 0,
  };


  function updateData(data){
      switch (data.plan) {
        case 'A':
          data.planFee = 2000;
          data.adSem = 2;
          data.freeUsers = 0;
          break;
        case 'B':
          data.planFee = 1000;
          data.adSem = 1;
          data.freeUsers = 1;
          break;
        case 'C':
          data.planFee = 500;
          data.adSem = 0;
          data.freeUsers = 0;
          break;
      }

      if($('#dating').val() == "others"){
        data.dating = $('#datingOthers').val()*1;
      }else{
        data.dating = $('#dating').val()*1;
      }



      if($('#incentive').val() == "others"){
        data.incentive = $('#incentiveOthers').val()*1;
      }else{
        data.incentive = $('#incentive').val()*1;
      }


      if ($("input[name='promoFlyer']:checked").val() == "yes"){
        data.flyerPages = ($('#promoflyerPages').val())*1;
      }else{
        data.flyerPages = 0;
      }


      console.log(data);
  }



  function doSummary(data){

      var vshowAmount;

      if (data.plan == 'B'){

          $("#regAmount").text(data.planFee);

         
            if (data.addedUsers == 0) {
              data.addedUsers = data.addedUsers + 1;
            }
            
            vshowAmount = (data.addedUsers - data.freeUsers) * 50 ;
         

          $("#virtualParticipantCount").text( data.addedUsers + ' total  ('+ data.freeUsers + ' free) | ' + (data.addedUsers - data.freeUsers)  + ' participant(s) @ $50 each)');

          $("#virtualParticipant").text(vshowAmount);
          $("#planSummary").text('Class '+ data.plan);

          
          $("#promotionalFlyerPages").text(data.flyerPages + ' pages @ $50 per page');
          $("#promotionalFlyerAmount").text(data.flyerPages * 50);

          $("#brandAmount").text(data.brandRecog);

          $("#seminarsessionSum").text( (data.adSem + data.seminarCount) + ' total session (' + data.adSem + ' free) ' + data.seminarCount + ' additional sessions @ $500' );  

          $("#seminarsession").text( data.seminarCount * 500);    
      
      }  else if (data.plan == 'A') {

          $("#regAmount").text(data.planFee);

            vshowAmount = 0;

           
          
          $("#virtualParticipantCount").text( 'Unlimited free user)');
          $("#virtualParticipant").text( vshowAmount );

          $("#planSummary").text('Class '+ data.plan);

          
          $("#promotionalFlyerPages").text(data.flyerPages + ' pages @ $50 per page');
          $("#promotionalFlyerAmount").text(data.flyerPages * 50);

          $("#brandAmount").text(data.brandRecog);

          $("#seminarsessionSum").text( (data.adSem + data.seminarCount) + ' total session (' + data.adSem + ' free)' + data.seminarCount + ' additional sessions @ $500' );  

          $("#seminarsession").text( data.seminarCount * 500);    


      } else if (data.plan == 'C'){

        $("#regAmount").text(data.planFee);

            vshowAmount = 0;
          
          $("#virtualParticipantCount").text( ' | Not eligible');
          $("#virtualParticipant").text( vshowAmount );

          
          $("#promotionalFlyerPages").text(data.flyerPages + ' pages @ $50 per page');
          $("#promotionalFlyerAmount").text(data.flyerPages * 50);

          $("#brandAmount").text(data.brandRecog);

          $("#planSummary").text('Class '+ data.plan);

          $("#seminarsessionSum").text( ' | Not eligible' );  

          $("#seminarsession").text(0);   

      }

      $('#seminarTotal').text('You have ' + (data.seminarCount * 1 + data.adSem * 1) + ' seminar sessions.') ;

      var sum = 0;
        $(".summable").each(function () {
            sum += parseFloat($(this).text());
        });
        $("#total").text( "$" + sum);
      

  }


//////////////// DOPREVIEW //////////////////////////////////////////

  function doPreview(){
    $('#companyName_prv').text( $('#companyName').val() );
    $('#primaryEmail_prv').text( $('#primaryEmail').val() );
    $('#primaryContact_prv').text( $('#primaryContact').val() );
    $('#primaryTelephone_prv').text( $('#primaryTelephone').val() );
    $('#primaryMobile_prv').text( $('#primaryMobile').val() );
    $('#primaryFax_prv').text( $('#primaryFax').val() );

    $('#address_prv').text( $('#address').val() + ', ' + $('#city').val() +', '+ $('#state').val() +', '+ $('#country').val() + ', ' +$('#zipCode').val()  );



    $(".semdays:checked").each(function () {
          
      semtimeArray = $(this).val().split('-');
      semdate = semtimeArray[0];
      semtime = semtimeArray[1];

       seminar += semdate + ' November (' + semtime + ') // ';
    
    });


    var plan = $("input[name='plan']:checked").val();
    descr = "";
    if (plan == 'A'){
      descr = "$ 2,000 - Show Registration, 2 Seminar Spots included, Unlimited Users";
    } else if (plan == 'B'){
      descr = "$ 1,000 - Show Registration, (Main contact is the participant), 1 Seminar Spot included, 1 Free User (Additional users at $50 per User)";
    } else if (plan == 'C'){
       descr = "$ 500 - Show Registration, (Main contact is the participant)";
    }


    $('#regPlan').text( 'Class ' + plan );
    $('#regDescr').text( descr );


    // Adding a row inside the Additional Users tbody.
    var addUser='';    
    $('#addUsersTBody').empty();
        
    $("#newParticipants .inputFormParticipants").each(function(){
      addUser += '<tr>';
      addUser += '<td id="participantsName_prv"> '+ $(this).find(".participantsName").val() + ' </td>';
      addUser += '<td id="participantsEmail_prv"> '+ $(this).find(".participantsEmail").val() + ' </td>';
      addUser += '<td id="participantsMobile_prv"> '+ $(this).find(".participantsMobile").val() + ' </td>';
      addUser += '</tr>';
    });
    
    if ($("#newParticipants .inputFormParticipants").length == 0){
      addUser ='<tr><td colspan=3>  N / A  </td> </tr>';
    }

    $('#addUsersTBody').prepend(addUser);


    $('#discount_prv').text( $('#discount').val() + '%' );
    $('#discountAdditional_prv').text( $('#discountAdditional').val() );

    $('#dating_prv').text(data.dating + ' days');

    $('#showBuy1_prv').text( $('#showBuy1').val() );
    $('#showBuy2_prv').text( $('#showBuy2').val() );


    $('#incentive_prv').text( data.incentive + ' %');



     // Add Hotbuys  tbody.
     var addhotBuys ='';
     $('#hotBuysTBody').empty();
    
     $("#newHotbuys .inputFormHotBuys").each(function(){
       addhotBuys += '<tr>';
       addhotBuys += '<td>'+ $(this).find(".hotbuysVendor").val() + ' </td>';
       addhotBuys += '<td>'+ $(this).find(".hotbuysDescription").val() + ' </td>';
       addhotBuys += '<td>'+ $(this).find(".hotbuysNetcost").val() + ' </td>';
       addhotBuys += '</tr>';
     });

     if ($("#newHotbuys .inputFormHotBuys").length == 0){
       addhotBuys ='<tr><td colspan=3>  N / A  </td> </tr>';
     }
     
     $('#hotBuysTBody').prepend(addhotBuys);

     $('#promoFlyer_prv').text( data.flyerPages );

     $('#brandRecog_prv').text( (data.brandRecog)?'Yes':'No' );


    // Adding a row inside the Additional Users tbody.
    var freeProducts='';   
    $("#newFreeproducts .inputFreeproducts").each(function(){
      freeProducts +=  $(this).find(".freeProducts").val();
      freeProducts +=  ' | ';
    });

    if ($("#newFreeproducts .inputFreeproducts").length == 0){
      freeProducts ='N / A ';
    }

    $('#freeProducts_prv').text(freeProducts);




    // Add Seminar Presenters  tbody.
    var addPresenters ='';
      addPresenters += '<tr>';
      addPresenters += '<td>'+ $("#seminarName").val() + ' </td>';
      addPresenters += '<td>'+ $("#seminarEmail").val() + ' </td>';
      addPresenters += '<td>'+ $("#seminarPhone").val() + ' </td>';
      addPresenters += '<td> Lead </td>';
      addPresenters += '</tr>';


    $('#addPresentersTBody').empty();
   
    $("#additionalPresenters .inputFormSeminar").each(function(){
      addPresenters += '<tr>';
      addPresenters += '<td>'+ $(this).find(".seminarAddName").val() + ' </td>';
      addPresenters += '<td>'+ $(this).find(".seminarAddEmail").val() + ' </td>';
      addPresenters += '<td>'+ $(this).find(".seminarAddMobile").val() + ' </td>';
      addPresenters += '<td> Presenter </td>';
      addPresenters += '</tr>';
    });

    $('#addPresentersTBody').prepend(addPresenters);



    $('#seminarSessions_prv').text(data.adSem + data.seminarCount);

    var seminar = '';
    
    $(".semdays:checked").each(function () {
          
      semtimeArray = $(this).val().split('-');
      semdate = semtimeArray[0];
      semtime = semtimeArray[1];

       seminar += semdate + ' November (' + semtime + ') // ';
    
    });
    $('#seminarDatesTime_prv').text(seminar);



    var costSummary = $('#costSummary').clone();
    $('#costPreview').html(costSummary);
    






  }






////////////////////////////////////////////////////////////////////////  















  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

// Install numeric input filters.
//Discount 0.0-99.0 Decimal
$("#discount").inputFilter(function(value) {
    return /^\d*[.]?\d{0,1}$/.test(value) && (value === "" || parseFloat(value) <= 99); 
});


//Positive Integer
$("#showBuy1, #showBuy2, #promoflyerPages").inputFilter(function(value) {
  return /^\d*$/.test(value); 
});







  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Country and state lists
var country = [
  [""],
  ["Alberta","British Columbia","Manitoba","New Brunswick","Newfoundland and Labrador","Mnorthwest Territories","Nova Scotia","Nunavut","Ontario","Prince Edward Island","Quebec","Saskatchewan","Yukon"],
  ["Alabama","Alaska","Arizona","California","Colorado","Connecticut","Delware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Loiusiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hamshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
];

$("#country").on("change",function () {
    var cntry = $(this).val();

    switch (cntry) {
      case "":
        index = 0;
        break;
      
      case "Canada":
        index = 1;
        break;

      case "USA":
        index = 2;
        break;
    }

    $("#state").empty();
    $("#state").append("<option value=''>Choose...</option>");
    
    for (c of country[index]){
        $("#state").append("<option>"+c+"</option>");
    }


});



//Plan selection
$(".card").on("click", function () {
  $(".card").removeClass("bg-card-selected");
  $(this).find("input[name='plan']").prop("checked", true);
  $(this).addClass("bg-card-selected");
  
  var plan = $("input[name='plan']:checked").val();
  
  data.plan = plan;
  updateData(data);

  
  if (plan == 'C'){
    $('#participantsForm').hide();
    //disable seminar registration
    $('#seminarPlus, #seminarMinus, #seminarName, #seminarEmail, #seminarPhone, #addPresenters, .semdays').prop('disabled', true);
    $('#hidder').hide();
  } else {
    $('#participantsForm').show();
    //enable seminar registration
    $('#seminarPlus, #seminarMinus, #seminarName, #seminarEmail, #seminarPhone, #addPresenters, .semdays').prop('disabled', false);
    $('#hidder').show();
  }

  
});



// dating terms
$("#dating").on("change",function () {
  var dating = $(this).val();
  if(dating == "others"){
      $("#error_datingOthers").text('');
      $("#datingOthers").parent().show();
  }else{
      $("#datingOthers").parent().hide();
  }
  
});


// incentive
$("#incentive").on("change",function () {
  var incentive = $(this).val();
  if(incentive == "others"){
      $("#error_incentiveOthers").text('');
      $("#incentiveOthers").parent().show();
  }else{
      $("#incentiveOthers").parent().hide();
  }
});




$("input[name='promoFlyer']").on("click", function () {
  if($(this).prop("checked") && $(this).val()=="yes"){
      $("#promoflyerPages").show();
  }else{
      $("#promoflyerPages").hide();
      $("#error_promoflyerPages").text('');
      $("#promoflyerPages").removeClass("has-error");
  }
});



//////////////////////////////////////////////////////////////////////////////////////////////////  
// add participants
  $("#addParticipants").click(function () {

    var html = $('#participantTemplate').html();
    $('#newParticipants').append(html);

    data.addedUsers = $("#newParticipants > div").length;
    updateData(data);

    
  });

  // remove participants
  $(document).on('click', '#removeParticipants', function () {
      $(this).closest('#inputFormParticipants').remove();
      
      data.addedUsers = $("#newParticipants > div").length;
      updateData(data);
     
  });



//////////////////////////////////////////////////////////////////////////////////////////////////  
// add Hotbuys
$("#addHotbuys").click(function () {
  var html = $('#hotbuyTemplate').html();
  $('#newHotbuys').append(html);
  
      //filter Hotbuys net cost or discount
      $(".hotbuysNetcost").inputFilter(function(value) {
        return /^\d*[.]?\d{0,2}$/.test(value); 
      });

});

// remove Hotbuys
$(document).on('click', '#removeHotbuys', function () {
    $(this).closest('#inputFormHotbuys').remove();
});


//////////////////////////////////////////////////////////////////////////////////////////////////  
// add Hotbuys
$("#addFreeproducts").click(function () {
  var html = $('#freeProductsTemplate').html();
  $('#newFreeproducts').append(html);
});

// remove Hotbuys
$(document).on('click', '#removeFreeproducts', function () {
    $(this).closest('#inputFreeproducts').remove();
});



//////////////////////////////////////////////////////////////////////////////////////////////////  
// add Presenters
$("#addPresenters").click(function () {
  
  var html = $('#seminarTemplate').html();
  $('#additionalPresenters').append(html);
  
});

// remove participants
$(document).on('click', '#removePresenters', function () {
    $(this).closest('#inputFormSeminar').remove();
});




//////////////////////////////////////////////////////////////////////////////////////////////////  
// Additional Seminar  Slots


$("#seminarPlus").click(function () {
  var val = $('#seminarCount').val();
  $('#seminarCount').val((val*1)+1);

  data.seminarCount =  ($('#seminarCount').val())*1;
  updateData(data);
  doSummary(data);

  
});



$("#seminarMinus").click(function () {
  
  var val = $('#seminarCount').val();
  
  if (val == 0){
     return false;
  } else {
    valnew = (val*1)-1;
    $('#seminarCount').val(valnew);

    data.seminarCount =  ($('#seminarCount').val())*1;

    updateData(data);   
    doSummary(data);

    
  }
  
  
  var count = 0;
    $(".semdays:checked").each(function () {
        count++;
        if( ((data.seminarCount*1) +  data.adSem) < count){
            $(this).prop("checked",false);
        }
    });

});





/////////////////////////////////////////////////////////////////////////////////////////////////////////////
// F I R S T  P A N E  Submission

  $('#nextOne').click(function(){
    //check if all fields are filled
    var error_address = "";
    var error_country = "";
    var error_state = "";
    var error_city = "";
    var error_zipCode = "";
    var error_primaryContact = "";
    var error_primaryEmail = "";
    var error_primaryTelephone = "";
    var error_primaryMobile = "";
    var error_primaryFax = "";

    var errors = 0;

    if ($.trim($("#address").val()).length == 0) {
      error_address = "Address is required";
      $("#error_address").text(error_address);
      $("#address").addClass("has-error");
      errors++;
    } else {
      error_address = "";
      $("#error_address").text(error_address);
      $("#address").removeClass("has-error");
    }

    if ($("#country").val().length == 0) {
      error_country = "Country is required";
      $("#error_country").text(error_country);
      $("#country").addClass("has-error");
      errors++;
    } else {
      error_country = "";
      $("#error_country").text(error_country);
      $("#country").removeClass("has-error");
    }

    if ($.trim($("#state").val()).length == 0) {
      error_state = "State is required";
      $("#error_state").text(error_state);
      $("#state").addClass("has-error");
      errors++;
    } else {
      error_state = "";
      $("#error_state").text(error_state);
      $("#state").removeClass("has-error");
    }

    if ($.trim($("#city").val()).length == 0) {
      error_city = "City is required";
      $("#error_city").text(error_city);
      $("#city").addClass("has-error");
      errors++;
    } else {
      error_city = "";
      $("#error_city").text(error_city);
      $("#city").removeClass("has-error");
    }


    if ($.trim($("#zipCode").val()).length == 0) {
      error_zipCode = "Zip Code is required";
      $("#error_zipCode").text(error_zipCode);
      $("#zipCode").addClass("has-error");
      errors++;
    } else {
      error_zipCode = "";
      $("#error_zipCode").text(error_zipCode);
      $("#zipCode").removeClass("has-error");
    }

    if ($.trim($("#primaryContact").val()).length == 0) {
      error_primaryContact = "Contact is required";
      $("#error_primaryContact").text(error_primaryContact);
      $("#primaryContact").addClass("has-error");
      errors++;
    } else {
      error_primaryContact = "";
      $("#error_primaryContact").text(error_primaryContact);
      $("#primaryContact").removeClass("has-error");
    }

    if ($.trim($("#primaryEmail").val()).length == 0 ) {
      error_primaryEmail = "Email is required";
      $("#error_primaryEmail").text(error_primaryEmail);
      $("#primaryEmail").addClass("has-error");
      errors++;
    } else {
      error_primaryEmail = "";
      $("#error_primaryEmail").text(error_primaryEmail);
      $("#primaryEmail").removeClass("has-error");
    }

    if ( !isEmail($.trim($("#primaryEmail").val()) ) ) {
      error_primaryEmail = "Email is incorrect. Please Check.";
      $("#error_primaryEmail").text(error_primaryEmail);
      $("#primaryEmail").addClass("has-error");
      errors++;
    } else {
      error_primaryEmail = "";
      $("#error_primaryEmail").text(error_primaryEmail);
      $("#primaryEmail").removeClass("has-error");
    }

    if ($.trim($("#primaryTelephone").val()).length == 0) {
      error_primaryTelephone = "Telephone is required";
      $("#error_primaryTelephone").text(error_primaryTelephone);
      $("#primaryTelephone").addClass("has-error");
      errors++;
    } else {
      error_primaryTelephone = "";
      $("#error_primaryTelephone").text(error_primaryTelephone);
      $("#primaryTelephone").removeClass("has-error");
    }

    var plan = $("input[name='plan']:checked").val();
    if (   ($('#newParticipants input[required]').length == 0) && (plan != 'C')   ){
          error_newParticipants = "";
          $("#error_newParticipants").text(error_newParticipants);
          $(this).removeClass("has-error");
    }

    $('#newParticipants input[required]').each(function(){
        if($(this).val()==""){
          error_newParticipants = "Fill all Participant's details";
          $("#error_newParticipants").text(error_newParticipants);
          $(this).addClass("has-error");
          errors++;
        } else {
          error_newParticipants = "";
          $("#error_newParticipants").text(error_newParticipants);
          $(this).removeClass("has-error");
        }
    });

    if (!errors){
     // $('form').submit();

      $('#supplier-tab').removeClass('active');
      $('#supplier-tab').addClass('disabled');
      $('#supplier').removeClass('active');
      
      $('#specials-tab').addClass('active');
      $('#specials-tab').removeClass('disabled');
      $('#specials').addClass('active show in');

      $('html, body').animate({
        scrollTop: 0
      }, 100);


          //UPDATE

    updateData(data);
    

    } else {

      $.alert({
        columnClass: 'col-md-6',
        backgroundDismiss: true,
        onClose: function () {
            $('html, body').animate({
              scrollTop: $(".has-error").offset().top-40
            }, 100);
         },
        icon: 'fa fa-warning',
        title: 'Encountered an error!',
        content: 'Some required fields have not been filled. ',
        type: 'red',
        typeAnimated: true,
      
      });
       
    }


  });


////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////
// S E C O N D  P A N E  Submission

$('#nextTwo').click(function(){
  //check if all fields are filled
  var error_discount = "";
  var error_discountAdditional = "";
  var error_dating = "";
  var error_datingOthers = "";
  var error_showBuy1 = "";
  var error_showBuy2 = "";
  var error_incentive = "";
  var error_incentiveOthers = "";

  var errors = 0;


  if ($.trim($("#discount").val()).length == 0) {
    error_discount = "Discount is required";
    $("#error_discount").text(error_discount);
    $("#discount").addClass("has-error");
    errors++;
  } else {
    error_discount = "";
    $("#error_discount").text(error_discount);
    $("#discount").removeClass("has-error");
  }

  if ($.trim($("#discountAdditional").val()).length == 0) {
    error_discountAdditional = "Additional Information is required";
    $("#error_discountAdditional").text(error_discountAdditional);
    $("#discountAdditional").addClass("has-error");
    errors++;
  } else {
    error_error_discountAdditional = "";
    $("#error_discountAdditional").text(error_discountAdditional);
    $("#discountAdditional").removeClass("has-error");
  }

  if ($.trim($("#dating").val()).length == 0) {
    error_dating = "Dating is required";
    $("#error_dating").text(error_dating);
    $("#dating").addClass("has-error");
    errors++;
  } else {
    error_dating = "";
    $("#error_dating").text(error_dating);
    $("#dating").removeClass("has-error");

  }

  if ( ($("#dating").val()=="others") && ($.trim($("#datingOthers").val()).length == "") ) {
    error_datingOthers = "Other dating value is required";
    $("#error_datingOthers").text(error_datingOthers);
    $("#datingOthers").addClass("has-error");
    errors++;
  } else {
    error_datingOthers = "";
    $("#error_datingOthers").text(error_dating);
    $("#datingOthers").removeClass("has-error");
  }


  if ($.trim($("#showBuy1").val()).length == 0) {
    error_showBuy1 = "1st Show Buy is required";
    $("#error_showBuy1").text(error_showBuy1);
    $("#showBuy1").addClass("has-error");
    errors++;
  } else {
    error_showBuy1 = "";
    $("#error_showBuy1").text(error_showBuy1);
    $("#showBuy1").removeClass("has-error");
  }

  if ($.trim($("#showBuy2").val()).length == 0) {
    error_showBuy2 = "2nd Show Buy is required";
    $("#error_showBuy2").text(error_showBuy2);
    $("#showBuy2").addClass("has-error");
    errors++;
  } else {
    error_showBuy2 = "";
    $("#error_showBuy2").text(error_showBuy2);
    $("#showBuy2").removeClass("has-error");
  }


  if ($.trim($("#incentive").val()).length == 0) {
    error_incentive = "Incentive is required";
    $("#error_incentive").text(error_incentive);
    $("#incentive").addClass("has-error");
    errors++;
  } else {
    error_incentive = "";
    $("#error_incentive").text(error_incentive);
    $("#incentive").removeClass("has-error");

  }

  if ( ($("#incentive").val()=="others") && ($.trim($("#incentiveOthers").val()).length == "") ) {
    error_incentiveOthers = "Other value is required";
    $("#error_incentiveOthers").text(error_incentiveOthers);
    $("#incentiveOthers").addClass("has-error");
    errors++;
  } else {
    error_incentiveOthers = "";
    $("#error_incentiveOthers").text(error_incentive);
    $("#incentiveOthers").removeClass("has-error");
  }


  if ($('#newHotbuys input[required]').length == 0){
    error_hotbuys = "";
    $("#error_hotbuys").text(error_hotbuys);
    $(this).removeClass("has-error");
  }

  $('#newHotbuys input[required]').each(function(){
    if($(this).val()==""){
      error_hotbuys = "Fill all Hotbuy details";
      $("#error_hotbuys").text(error_hotbuys);
      $(this).addClass("has-error");
      errors++;
    } else {
      error_hotbuys = "";
      $("#error_hotbuys").text(error_hotbuys);
      $(this).removeClass("has-error");
    }
  });

  if ($('#newFreeproducts input[required]').length == 0){
    error_freeproducts = "";
    $("#error_freeproducts").text(error_freeproducts);
    $(this).removeClass("has-error");
  }

  $('#newFreeproducts input[required]').each(function(){
    if($(this).val()==""){
      error_freeproducts = "Fill all Free Products details";
      $("#error_freeproducts").text(error_freeproducts);
      $(this).addClass("has-error");
      errors++;
    } else {
      error_freeproducts = "";
      $("#error_freeproducts").text(error_freeproducts);
      $(this).removeClass("has-error");
    }
  });


  
  if ( $("input[name='promoFlyer']:checked").val() == "yes" && ($.trim($("#promoflyerPages").val()).length == 0) ) {
    error_promoflyerPages = "Promo Flyer Pages is required";
    $("#error_promoflyerPages").text(error_promoflyerPages);
    $("#promoflyerPages").addClass("has-error");
    errors++;
  } else {
    error_promoflyerPages = "";
    $("#error_promoflyerPages").text(error_promoflyerPages);
    $("#promoflyerPages").removeClass("has-error");
  }
 
  
  if (!errors){
   // $('form').submit();

    $('#specials-tab').removeClass('active');
    $('#specials-tab').addClass('disabled');
    $('#specials').removeClass('active');
    
    $('#seminar-tab').addClass('active');
    $('#seminar-tab').removeClass('disabled');
    $('#seminar').addClass('active show in');

    $('html, body').animate({
      scrollTop: 0
    }, 100);


    //UPDATE
    
    if($("input[name='promoFlyer']:checked").val() == "no"){
      data.flyerPages = 0;
    } else {
      data.flyerPages = ($("#promoflyerPages").val())*1;
    }

    if($("input[name='brandRecognition']:checked").val() == "No"){
      data.brandRecog = 0;
    } else {
      data.brandRecog = 50;
    }

    updateData(data);      
    doSummary(data);

  } else {

    $.alert({
      columnClass: 'col-md-6',
      backgroundDismiss: true,
      onClose: function () {
          $('html, body').animate({
            scrollTop: $(".has-error").offset().top-40
          }, 100);
       },
      icon: 'fa fa-warning',
      title: 'Encountered an error!',
      content: 'Some required fields have not been filled. ',
      type: 'red',
      typeAnimated: true,
    
    });
     
  }


});

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// S E C O N D  P A N E  Previous

$('#previousTwo').click(function(){

  $('#specials-tab').removeClass('active');
  $('#specials-tab').addClass('disabled');
  $('#specials').removeClass('active');
  
  $('#supplier-tab').addClass('active');
  $('#supplier-tab').removeClass('disabled');
  $('#supplier').addClass('active show in');

  $('html, body').animate({
    scrollTop: $("body").offset().top
  }, 100);

});

////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////
// T H I R D  P A N E  Submission

$('#nextThree').click(function(){
  //check if all fields are filled
  var error_semdays = "";
  var error_seminarName = "";
  var error_seminarEmail = "";
  var error_seminarPhone = "";

  var error_additionalPresenters = "";



  var errors = 0;

  if($(".semdays:checked").length < (data.seminarCount*1) + data.adSem){
    error_semdays = "Seminar slots selected is less than the sessions total you have.";
    $("#error_semdays").text(error_semdays);
    $("#semtable").addClass("has-error");
    errors++;
  } else {
    error_semdays = "";
    $("#error_semdays").text(error_semdays);
    $("#semtable").removeClass("has-error");
  }



  if ($.trim($("#seminarName").val()).length == 0) {
    error_seminarName = "Presenter Name is required";
    $("#error_seminarName").text(error_seminarName);
    $("#seminarName").addClass("has-error");
    errors++;
  } else {
    error_seminarName = "";
    $("#error_seminarName").text(error_seminarName);
    $("#seminarName").removeClass("has-error");
  }

 
  if ($.trim($("#seminarEmail").val()).length == 0) {
    error_seminarEmail = "Presenter Email is required";
    $("#error_seminarEmail").text(error_seminarEmail);
    $("#seminarEmail").addClass("has-error");
    errors++;
  } else {
    error_seminarEmail = "";
    $("#error_seminarEmail").text(error_seminarEmail);
    $("#seminarEmail").removeClass("has-error");
  }


  if ( !isEmail($.trim($("#seminarEmail").val()) ) ) {
    error_seminarEmail = "Email is incorrect. Please check.";
    $("#error_seminarEmail").text(error_seminarEmail);
    $("#seminarEmail").addClass("has-error");
    errors++;
  } else {
    error_seminarEmail = "";
    $("#error_seminarEmail").text(error_seminarEmail);
    $("#seminarEmail").removeClass("has-error");
  }

  


  if ($.trim($("#seminarPhone").val()).length == 0) {
    error_seminarPhone = "Presenter Phone is required";
    $("#error_seminarPhone").text(error_seminarPhone);
    $("#seminarPhone").addClass("has-error");
    errors++;
  } else {
    error_seminarPhone = "";
    $("#error_seminarPhone").text(error_seminarPhone);
    $("#seminarPhone").removeClass("has-error");
  }


  if ($('#additionalPresenters input[required]').length == 0){
    error_additionalPresenters = "";
    $("#error_additionalPresenters").text(error_additionalPresenters);
    $(this).removeClass("has-error");
  }

 $('#additionalPresenters input[required]').each(function(){
    if($(this).val()==""){
      error_additionalPresenters = "Fill all Presenters' details";
      $("#error_additionalPresenters").text(error_additionalPresenters);
      $(this).addClass("has-error");
      errors++;
      console.log(errors);
    } else {
      error_additionalPresenters = "";
      $("#error_additionalPresenters").text(error_additionalPresenters);
      $(this).removeClass("has-error");
      console.log(errors);
    }
  });

  


  if (!errors ||  (data.plan=="C")){
   // $('form').submit();

    $('#seminar-tab').removeClass('active');
    $('#seminar-tab').addClass('disabled');
    $('#seminar').removeClass('active');
    
    $('#preview-tab').addClass('active');
    $('#preview-tab').removeClass('disabled');
    $('#preview').addClass('active show in');

    $('html, body').animate({
      scrollTop: 0
    }, 100);


    //UPDATE
    updateData(data);      
    doSummary(data);
    doPreview();

  } else {

    // if (data.plan=="C"){
    //   errors = 0;

    //    //UPDATE
    //   updateData(data);      
    //   doSummary(data);
    //   doPreview();

    //   $('#seminar-tab').removeClass('active');
    //   $('#seminar-tab').addClass('disabled');
    //   $('#seminar').removeClass('active');
      
    //   $('#preview-tab').addClass('active');
    //   $('#preview-tab').removeClass('disabled');
    //   $('#preview').addClass('active show in');
  
    //   $('html, body').animate({
    //     scrollTop: 0
    //   }, 100);
      
    //   return false;

    // }

    $.alert({
      columnClass: 'col-md-6',
      backgroundDismiss: true,
      onClose: function () {
          $('html, body').animate({
            scrollTop: $(".has-error").offset().top-40
          }, 100);
       },
      icon: 'fa fa-warning',
      title: 'Encountered an error!',
      content: 'Some required fields have not been filled. ',
      type: 'red',
      typeAnimated: true,
    
    });
     
  }



});



//////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////
// T H I R D  P A N E  Previous

$('#previousThree').click(function(){

  $('#seminar-tab').removeClass('active');
  $('#seminar-tab').addClass('disabled');
  $('#seminar').removeClass('active');
  
  $('#specials-tab').addClass('active');
  $('#specials-tab').removeClass('disabled');
  $('#specials').addClass('active show in');

  $('html, body').animate({
    scrollTop: $("body").offset().top
  }, 100);

});



////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////
// F O U R T H  P A N E  S U B M I T 

$('#previousFour').click(function(){

  $('#preview-tab').removeClass('active');
  $('#preview-tab').addClass('disabled');
  $('#preview').removeClass('active');
  
  $('#seminar-tab').addClass('active');
  $('#seminar-tab').removeClass('disabled');
  $('#seminar').addClass('active show in');

  $('html, body').animate({
    scrollTop: $("body").offset().top
  }, 100);

});




///////////////////////////////////////////////////////////////////////////////////////////////////////////
// F O U R T H  P A N E  Previous

$("#submit").on("click", function(){
    $('#atlasform').submit();
});



////////////////////////////////////////////////////////////////////////

$(".semdays").on("click",function () {
  var plan = $("input[name='plan']:checked").val();

  updateData(data);      
  doSummary(data);

   
  if($(this).prop("checked")){
      $("input[data='"+$(this).attr("data")+"']").not($(this)).prop("checked",false);
     // if($(".semdays:checked").length > ($('#seminarCount').val()*1) + adSem){
      if($(".semdays:checked").length > (data.seminarCount*1) + data.adSem){
          $(this).prop("checked",false);
          
          $.alert({
            columnClass: 'col-md-6',
            backgroundDismiss: true,
            onClose: function () {
                $('html, body').animate({
                  scrollTop: $("#seminarCount").offset().top-40
                }, 100);
             },
            icon: 'fa fa-warning',
            title: 'Seminar Sessions exceeded!  !',
            content: 'You have exceeded the limit of Seminar Sessions for your Plan. Kindly add Seminar Sessions @ $500 each.',
            type: 'red',
            typeAnimated: true,
          });

      }else{

      }
  }

});

});








// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));
