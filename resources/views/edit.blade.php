
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Atlas Trailer Coach Products | 2021 Virtual Buying Show - Edit</title>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <!-- for input mask -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">




    <style>

.container {
  max-width: 960px;
}



@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}

      .summable{
        text-align: right;
      }

      th, td{
        vertical-align: top
      }

      #preview p{
        font-weight: bold
      }

      #preview .card-header{
        margin-bottom: 20px;
        margin-top: 50px
      }

      .total{
        font-size: 24px;
        text-align: right;
      }

      .error-label{
        font-size: 14px;
      }

      .card{
        cursor: pointer;
        margin-top: 0px
      }

      .bg-card-selected {
        background-color: #d7e9ff !important;
        margin-top: -10px
      }

      .form-label {
        font-weight: 600 !important;
      }


      .nav-tabs .nav-link.disabled {
          color: #ddd;
          background-color: transparent;
          border-color: transparent;
      }

      .active_tab1
      {
      background-color:#fff;
      color:#333;
      font-weight: 600;
      }
      .inactive_tab1
      {
      background-color: #f5f5f5;
      color: #333;
      cursor: not-allowed;
      }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .card input[type=radio] {
        width: 25px !important;
        height: 25px !important;
      }

  
      .card {
        -webkit-transform: translateY(0);
        -moz-transform: translateY(0);
        -ms-transform: translateY(0);
        -o-transform: translateY(0);
        transform: translateY(0);
        -webkit-transition: .5s;
        -o-transition: .5s;
        -moz-transition: .5s;
        transition: .5s;
      }

      .has-error{
        border-color:#cc0000;
      }
    </style>

    
    
  </head>
  <body class="">

    {{-- <body class="bg-light"> --}}
    
    
<div class="container">
  <main>
    
    


    <div class="py-2 text-center">
      <img class="d-block mx-auto mb-4" src="images/atlas_banner_bb.png" alt="" width="100%">
    </div>
    
    <div class="container">
      <div class="col-md-12">

        <ul class="nav nav-tabs d-print-none" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="supplier-tab" data-bs-toggle="tab" data-bs-target="#supplier" type="button" role="tab" aria-controls="supplier" aria-selected="true"> 
              <h4 class="mb-3">Supplier Information</h4>
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link disabled" id="specials-tab" data-bs-toggle="tab" data-bs-target="#specials" type="button" role="tab" aria-controls="specials" aria-selected="false">
              <h4 class="mb-3">Special Information</h4>
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link disabled  " id="seminar-tab" data-bs-toggle="tab" data-bs-target="#seminar" type="button" role="tab" aria-controls="seminar" aria-selected="false">
              <h4 class="mb-3">Vendor Seminar</h4>
            </button>
          </li>


          <li class="nav-item" role="preview">
            <button class="nav-link disabled " id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview" type="button" role="tab" aria-controls="preview" aria-selected="false">
              <h4 class="mb-3">Preview</h4>
            </button>
          </li>


        </ul>

<form action = "{{ route('edit') }}" id="atlasform" method="post" novalidate> 
@csrf

        <div class="tab-content pt-4" id="myTabContent" >
          @if(session('error'))
          
          <div class="alert alert-danger">{{session('error')}} </div>

           <script> 
            $.alert({
              columnClass: 'col-md-6',
              backgroundDismiss: true,
              icon: 'fa fa-warning',
              title: 'Encountered an error!',
              content: 'Something did not go well behind the scene!',
              type: 'red',
              typeAnimated: true,
            
            });
          </script>
          @endif
<!-- PANE -->

            <div class="tab-pane fade show active" id="supplier" role="tabpanel" aria-labelledby="supplier-tab">
             

            <!-- PANE ROW -->              
              <div class="row g-3">

                <div class="col-12">
                  <label for="companyName" class="form-label">1. Company Name</label>
                  <input class="form-control" name="companyName" id="companyName" value="{{ $companyName }}" required>

                  <span id="error_companyName" class="text-danger error-label"></span>
                </div>
    
                <div class="col-sm-4">
                  <label for="address" class="form-label">2. Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="" value="{{ $address }}" required>
                  <span id="error_address" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="country" class="form-label">3. Country</label>
                  <select class="form-select" id="country" name="country" required>
                    <option value="" selected>Choose...</option>
                    <option value="Canada"  {{ $country == "Canada" ? 'selected':'' }}  >Canada</option>
                    <option value="USA" {{ $country == "USA" ? 'selected':'' }} >USA</option>
                  </select>
                  <span id="error_country" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="state" class="form-label">4. State</label>
                  <input hidden name="hiddenState" id="hiddenState" value="{{$state}}" >
                  <select class="form-select" id="state"  name="state" required>
                    <option value="" selected>Choose...</option>
                  </select>
                  <span id="error_state" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="city" class="form-label">5. City</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{ $city }}" required>
                  <span id="error_city" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="zipCode" class="form-label">6. Zip/Postal Code</label>
                  <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="" value="{{ $zipcode }}" required>
                  <span id="error_zipCode" class="text-danger error-label"></span>
                </div>
              
            
                <div class="col-sm-3">
                  <label for="primaryContact" class="form-label">7. Primary Contact</label>
                  <input type="text" class="form-control" id="primaryContact" name="primaryContact" placeholder="Contact Person" value="{{ $primaryContact }}" required>
                  <span id="error_primaryContact" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-3">
                  <label for="primaryEmail" class="form-label">8. Primary Email</label>
                  <input type="text" class="form-control" id="primaryEmail" name="primaryEmail" placeholder="Email Address" value="{{ $primaryEmail }}" required >
                  <span id="error_primaryEmail" class="text-danger error-label"></span>
                </div>                

                <div class="col-sm-2">
                  <label for="primaryTelephone" class="form-label">9. Telephone #</label>
                  <input type="text" class="form-control" id="primaryTelephone" name="primaryTelephone" placeholder="Telephone Number" value="{{ $primaryTelephone }}" data-mask="(999) 999-9999" required>
                  <span id="error_primaryTelephone" class="text-danger error-label"></span>
                </div>

                

                <div class="col-sm-2">
                  <label for="primaryMobile" class="form-label">10. Mobile #</label>
                  <input type="text" class="form-control" id="primaryMobile" name="primaryMobile" placeholder="Mobile Number" value="{{ $primaryMobile }}" data-mask="(999) 999-9999" >
                </div>

                <div class="col-sm-2 ">
                  <label for="primaryFax" class="form-label">11. Fax #</label>
                  <input type="text" class="form-control" id="primaryFax" name="primaryFax" placeholder="" value="{{ $primaryFax }}" data-mask="(999) 999-9999">
                </div>



                <!-- CARD DECK -->
                <div class="row mt-3">
                  <label for="plan" class="form-label" style="margin-bottom: 15px">12. Registration Levels (Choose 1)</label>                  

                  <div class="col-sm-4">
                    <div class="card mb-4 shadow-sm text-center">
                        <div class="card-header">
                          <p class="my-0 font-weight-normal fw-bold">Class A</p>
                        </div>

                        <div class="card-body">
                          <h4 class="card-title">$ 2,000</h4>
                          <p class="card-text">
                            <div style="border-bottom: 1px solid rgba(0,0,0,.125); padding: 5px">Show Registration <br/>&nbsp;</div>
                            <div style="border-bottom: 1px solid rgba(0,0,0,.125); padding: 5px">2 Seminar Spots included</div>
                            Unlimited Free Participants (Add Participants below)
                          </p>
                        </div>

                        <div class="card-footer form-control-lg" >
                            <input class="form-check-input" type="radio" name="plan" id="planA" value="A" style="margin-top: -20px;" {{ $plan == "A" ? 'checked':'' }} >
                        </div>

                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="card mb-4 shadow-sm text-center ">
                        <div class="card-header">
                          <p class="my-0 font-weight-normal fw-bold">Class B</p>
                        </div>

                        <div class="card-body">
                          <h4 class="card-title">$ 1,000</h4>
                          <p class="card-text">
                            <div style="border-bottom: 1px solid rgba(0,0,0,.125); padding: 5px">Show Registration <br/>(Main contact is the participant)</div>
                            <div style="border-bottom: 1px solid rgba(0,0,0,.125); padding: 5px">1 Seminar Spot included</div>
                            1 Free Participant (Add below at $50 per participant)
                          </p>
                        </div>

                        <div class="card-footer form-control-lg">
                          <input class="form-check-input" type="radio" name="plan" id="planB" value="B"  style="margin-top: -20px;"
                          @if ($plan == "") checked @endif {{ $plan == "B" ? 'checked':'' }} >
                        </div>

                    </div>                              
                  </div>

                  <div class="col-sm-4">
                    <div class="card mb-4 shadow-sm text-center">
                        <div class="card-header">
                          <p class="my-0 font-weight-normal fw-bold">Class C</p>
                        </div>

                        <div class="card-body ">
                          <h4 class="card-title">$ 500</h4>
                          <p class="card-text">
                            <div style="border-bottom: 1px solid rgba(0,0,0,.125); padding: 5px">Show Registration <br/>(Main contact is the participant)</div>
                            <div style="border-bottom: 0px solid rgba(0,0,0,.125); padding: 5px"></div><br/><br/><br/>
                          </p>
                        </div>

                        <div class="card-footer form-control-lg">
                          <input class="form-check-input" type="radio" name="plan" id="planC" value="C" style="margin-top: -20px;" {{ $plan == "C" ? 'checked':'' }} >
                        </div>

                    </div>
                  </div>

                </div>
                <!-- END CARD DECK -->

                
  
                <div class="col-12" id="participantsForm">
                  <label class="form-label">13. Add Participant(s) $50 is charged per participant outside your plan</label>                  
                  <div id="error_newParticipants" class="text-danger error-label"></div>
                  
<!--  -->       <div class="mb-3" id="newParticipants">
                    @foreach ($participants as $participant)

                    <div class="row mt-2 inputFormParticipants" id="inputFormParticipants"> 
                        <span id="error_Participants" class="text-danger error-label"></span>

                        <div class="col-sm-4">
                            <input type="text" class="form-control participantsName " name="participantsName[]" placeholder="Participant's Name" value="{{ $participant->participantsName }}" required>
                            <div class="invalid-feedback">Participant's Name is required.</div>
                        </div>

                        <div class="col-sm-3">
                            <input type="text" class="form-control participantsEmail" name="participantsEmail[]" placeholder="Email" value="{{ $participant->participantsEmail }}" required>
                            <div class="invalid-feedback">Primary Email is required.</div>
                        </div>

                        <div class="col-sm-3">
                            <input type="text" class="form-control participantsMobile " name="participantsMobile[]" placeholder="Mobile Number" value="{{ $participant->participantsMobile }}" required data-mask="(999) 999-9999">
                            <div class="invalid-feedback">Primary Mobile is required.</div>
                        </div>

                        <div class="col-sm-2">
                            <div class="input-group-append">
                                <button id="removeParticipants" type="button" class="btn btn-danger">Remove <i class="fa fa-user-times"></i></button>
                            </div>
                        </div>

                    </div>


                    @endforeach
<!--  -->       </div>

                  <button id="addParticipants" type="button" class="btn btn-success">Add Participants <i class="fa fa-user-plus"></i></button>
                </div>
                

              </div>

              <hr class="my-4">
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary btn-lg w-25 mx-5" type="button" id="nextOne">Next <i class="fa fa-arrow-circle-right"></i></button>
              </div>
              
            </div>
            <!-- END PANE ROW -->

<!-- END OF PANE -->




<!-- PANE SPECIALS -->                        
        <div class="tab-pane fade" id="specials" role="tabpanel" aria-labelledby="specials-tab">
              
              
              <!-- ROW -->
              <div class="row g-3">

               

                <div class="col-sm-3">
                  <label for="discount" class="form-label">14. Show Discounts(%)</label>
                  <div class="col-sm-12">
                  <input type="text" class="form-control numeric" id="discount" name="discount" placeholder="" value="{{ $discount }}" required  >
                  </div>
                  <span id="error_discount" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-6">
                  <label for="discountAdditional" class="form-label">15. Additional Information</label>
                  <textarea  class="form-control" id="discountAdditional" name="discountAdditional" placeholder="" required>{{ $discountAdditional }}</textarea>
                  <span id="error_discountAdditional" class="text-danger error-label"></span>
                </div>                

                
                <div class="row g-2">
                  <label for="dating" class="form-label">16. Special Dating Terms</label>
                  <div class="col-sm-2">
                    <select class="form-select" id="dating"  name="dating" required>
                      <option value="" >Choose...</option>
                      <option  {{ $dating == '30'? 'selected':'' }} value="30" >30 days</option>
                      <option  {{ $dating == '60'? 'selected':'' }} value="60" >60 days</option>
                      <option  {{ $dating == '90'? 'selected': '' }}value="90" >90 days</option>
                      <option  {{ $dating == '120'? 'selected':'' }}value="120" >120 days</option>
                      <option  {{ $dating =='others'? 'selected':'' }} value="others" >Others</option>
                    </select> 
                    <span id="error_dating" class="text-danger error-label"></span>
                  </div>
                  {{-- @if($dating=='others'?'none':'' )@endif --}}
                  <div class="col-md-3">
                    <div class="form-check-inline" style=" {{ $dating =='others'? '':'display:none ;' }}    margin-left:  10px;">
                      <input type="text" class="form-control" id="datingOthers" name="datingOthers" placeholder="" value="{{ $dating == 'others' ? $datingOthers : '' }}" >
                      <span id="error_datingOthers" class="text-danger error-label"></span>
                    </div>
                  </div>
                
                </div>


                <div class="row g-2">
                  <div class="col-md-12 form-label">Number of discounted buys </div>

                  <div class="col-md-4">
                      <label for="showBuy1" class="form-label">17. 1st Show Buy (by December 23, 2021)</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="showBuy1" name="showBuy1" placeholder="" value="{{ $showBuy1 }}" required  >
                      </div>
                      <span id="error_showBuy1" class="text-danger error-label"></span>
                  </div>

                  <div class="col-md-4">
                      <label for="showBuy2" class="form-label">18. 2nd Show Buy (by March 31, 2022)</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="showBuy2" name="showBuy2" placeholder="" value="{{ $showBuy2 }}" required  >
                      </div>
                      <span id="error_showBuy2" class="text-danger error-label"></span>
                  </div>
                
                </div>


                <div class="row g-2">
                  <label for="incentive" class="form-label"> 19. Dealer Incentive Program. Do you want to support the “Atlas Show Buck Program” as follows?</label>

                  <div class="col-sm-2">
                    <select class="form-select" id="incentive"  name="incentive" required>
                        <option value="" >Choose...</option>
                        <option {{ $incentive == '0' ? 'selected':'' }} value="0"> We won't be participating </option>
                        <option {{ $incentive == '1' ? 'selected':'' }} value="1"> 1% Rebate </option>
                        <option {{ $incentive == '5' ? 'selected':'' }} value="5"> 5% Rebate </option>
                        <option {{ $incentive == '25' ? 'selected':'' }} value="25">25% Rebate </option>
                        <option {{ $incentive == 'others' ? 'selected':'' }} value="others">Others </option>
                    </select>
                    <span id="error_incentive" class="text-danger error-label"></span>
                  </div>

                  <div class="col-md-3">
                    <div class="form-check-inline" style="{{ $incentive =='others'? '':'display:none ;' }} margin-left:  10px;">
                      <input type="text" class="form-control" id="incentiveOthers" name="incentiveOthers" placeholder="" value="{{ $incentive == 'others' ? $incentiveOthers : '' }}" required  >
                      <span id="error_incentiveOthers" class="text-danger error-label"></span>
                    </div>
                  </div>
                
                </div>

                


                <div class="col-12">
                  <label for="hotbuys" class="form-label" style="margin-bottom: 0rem !important;">20. Hot Buys Special</label>                  
                    <div id="error_hotbuys" class="text-danger error-label"></div>
                  
<!-- -->                <div class="mb-3" id="newHotbuys">
                        
                        @foreach ($hotbuys as $hotbuy)
                            <div class="row mt-2 inputFormHotBuys" id="inputFormHotbuys"> 
                                
                                <div class="col-sm-2">
                                    <input type="text" class="form-control hotbuysVendor" name="hotbuysVendor[]" placeholder="Enter Vendor #" value="{{ $hotbuy->hotbuysVendor }}" required="">
                                </div>
                                
                                <div class="col-sm-5">
                                    <input type="text" class="form-control hotbuysDescription" name="hotbuysDescription[]" placeholder="Description" value="{{ $hotbuy->hotbuysDescription }}" required="">
                                </div>
                                
                                <div class="col-sm-3">
                                    <input type="text" class="form-control hotbuysNetcost" id="hotbuysNetcost" name="hotbuysNetcost[]" placeholder="Net cost or Discount" value="{{ $hotbuy->hotbuysNetcost }}" required="">
                                </div>
                                
                                <div class="col-sm-2">
                                    <div class="input-group-append">
                                        <button id="removeHotbuys" type="button" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></button>
                                    </div>
                                </div>

                            </div>
                        @endforeach

<!-- -->                </div>

                  <button id="addHotbuys" type="button" class="btn btn-success">Add Hotbuys <i class="fa fa-cart-plus"></i></button>
                </div>




               


                <div class="col-12">
                  <label for="freeproducts" class="form-label" style="margin-bottom: 0rem !important;">21. Free Product Special</label>                  
                  
                  <div id="error_freeproducts" class="text-danger error-label"></div>

<!-- -->            <div class="mb-3" id="newFreeproducts">

                        @foreach($freeproducts as $freeproduct)
                        <div class="row mt-2 inputFreeproducts" id="inputFreeproducts"> 
                            <div class="col-sm-4">
                                <input type="text" class="form-control freeProducts" name="freeProducts[]" placeholder="e.g Buy 10 products and get 1 free" value="{{$freeproduct->freeProducts}}" required>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group-append">
                                    <button id="removeFreeproducts" type="button" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach

<!-- -->            </div>


                  <button id="addFreeproducts" type="button" class="btn btn-success">Add Free Product <i class="fa fa-cart-plus"></i></button>
                </div>


                <div class="row g-2">
                  <label for="promoFlyer" class="form-label"> 22. Promotional Flyers @ $50.00EA (Dealers will be able to see your flyers on the EOS)</label>

                  
                  <div class="col-md-1">
                    <input type="radio" id="promoFlyer1" name="promoFlyer" class="form-check-input" value="no" 
                    {{ $promoFlyer == 'no' ? 'checked':'' }}  required>
                    <label class="custom-control-label" for="promoFlyer1">No</label>
                  </div>
                  
                  <div class=" col-md-1">
                    <input type="radio" id="promoFlyer2" name="promoFlyer" class="form-check-input" value="yes" 
                    {{ $promoFlyer == 'yes' ? 'checked':'' }} required>
                    <label class="custom-control-label" for="promoFlyer1">Yes</label>
                  </div>
                  

                  <div class="col-md-3">
                    <div class="form-check-inline">
                      <input type="text" class="form-control" id="promoflyerPages" name="promoflyerPages" placeholder="Specify number of pages" value="{{ $promoFlyer == 'yes' ? $promoflyerPages:'' }}" required  style=" {{ $promoFlyer =='yes'? '':'display:none ;' }}">
                      <span id="error_promoflyerPages" class="text-danger error-label"></span>
                    </div>
                  </div>
                
                </div>



                <div class="row g-2">
                  <label for="brandRecognition" class="form-label"> 23. Brand Recognition @ $50</label>
                  <div class="col-md-1">
                    <input type="radio" id="brandRecognition1" name="brandRecognition" class="form-check-input" value="No" required  {{ $brandRecognition == 'No' ? 'checked':'' }} >
                    <label class="custom-control-label" for="brandRecognition1">No</label>
                  </div>
                  
                  <div class=" col-md-1">
                    <input type="radio" id="brandRecognition2" name="brandRecognition" class="form-check-input" value="Yes"  {{ $brandRecognition == 'Yes' ? 'checked':'' }} required>
                    <label class="custom-control-label" for="brandRecognition2">Yes</label>
                  </div>
                  
                
                </div>


                  

              
              </div>
              <!-- END ROW -->


              <hr class="my-4">

                <div class="d-flex justify-content-center" >
                  <button class="btn btn-secondary btn-lg mx-5 w-25" type="button" id="previousTwo" ><i class="fa fa-arrow-circle-left"></i> Previous</button> 
                  <button class="btn btn-primary btn-lg w-25" type="button" id="nextTwo">Next <i class="fa fa-arrow-circle-right"></i></button>
                </div>

              
    
        </div>
<!-- END OF PANE -->


<!-- PANE -->            
            <div class="tab-pane fade" id="seminar" role="tabpanel" aria-labelledby="seminar-tab">
              
              <!-- ROW -->
              <div class="row g-3" id="hidder">

                <div class="sm-12">
                    <div class="cards">
                      <p class="card-header">Thank you for considering taking part in our Pre-Show Seminars.</p>
                      <div class="card-body">
                        <div class="card-text">
                          <b>Times:</b> 9:00 am to 4:00 pm MST. <br/>                      
                          <b>Duration:</b> 30 minute sessions<br/>
                          Time slots will be allocated by Atlas and the seminars will be held during normal working hours.<br/>
                          Please indicate which day(s) works best and whether you prefer AM or PM.<br/>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-12">
                    <label for="discount" class="form-label">24. Additional Seminars (Additional seminars are $500.00/session outside your plan.)</label>
                    <div class="col-sm-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" id="seminarMinus" ><i class="fa fa-minus"></i></button>
                      </div>
                      <input type="text" id="seminarCount" name="seminarCount" class="form-control text-center" placeholder="" aria-label="" aria-describedby="basic-addon1" readonly value= {{ $seminarCount }}>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="seminarPlus"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-6" id="seminarTotal"></div>



                  </div>

                  <div class="col-sm-12">

                    <label for="address" class="form-label">25. Seminar Presenter</label>
                    <div id="error_semdays" class="text-danger error-label mb-2 "></div>
                    <table class="table table-bordered table-condensed" id="semtable">
                      
                        <thead>
                          <tr>
                            <th>Day</th>    <th>Date</th>   <th>AM</th>     <th>PM</th>
                          </tr>
                        </thead>
                      
                        <tbody>

<?php
                            $semz = [] ;
                             foreach ($seminardays as $seminarday){
                                 $dt = explode('-', $seminarday->seminarday);
                                 $semz[$dt[0]][$dt[1]] = 1;
                             }
                            $i = 0;
                            $dates = [8, 9, 10, 12, 15, 16];
                            $days = ["Monday", "Tuesday", "Wednesday", "Friday"];
                            foreach ($dates as $date) {
                                echo "<tr>";
                                echo "<td>{$days[$i%count($days)]}</td>";
                                echo "<td>Nov {$dates[$i%count($dates)]} </td>";
                                
                                echo "<td><input type='checkbox' class='semdays' name='seminardays[]' data='nov{$date}' value='{$date}-AM'".(isset($semz[$date]["AM"])?"checked":"")."></td>";

                                echo "<td><input type='checkbox' class='semdays' name='seminardays[]' data='nov{$date}' value='{$date}-PM'".(isset($semz[$date]["PM"])?"checked":"")."></td>";

                                echo "</tr>";
                                $i++;
                            }
?>                            
                        
                          {{-- <tr>
                            <td>Monday</td><td>Nov 8 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov8" value="8th-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov8" value="8th-PM"></td>
                          </tr>
                        
                          <tr>
                            <td>Tuesday</td><td>Nov 9 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov9" value="9th-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov9" value="9th-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Wednesday</td><td>Nov 10 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov10" value="10th-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov10" value="10th-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Friday</td><td>Nov 12 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov12" value="12th-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov12" value="12th-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Monday</td><td>Nov 15 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov15" value="15th-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov15" value="15th-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Tuesday</td><td>Nov 16 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov16" value="16th-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov16" value="16th-PM"></td>
                          </tr> --}}

                      </tbody>
                      
                    </table>
                  </div>

                  <div class="col-sm-4">
                    <label for="address" class="form-label">26. Seminar Presenter</label>
                    <input type="text" class="form-control" name="seminarName" id="seminarName" placeholder="Presenter Name" value="{{ $seminarName }}" required>
                    <span id="error_seminarName" class="text-danger error-label"></span>
                  </div>

                  <div class="col-sm-4">
                    <label for="address" class="form-label">&nbsp;</label>
                    <input type="text" class="form-control" name="seminarEmail" id="seminarEmail" placeholder="Presenter Email" value="{{ $seminarEmail }}" required>
                    <span id="error_seminarEmail" class="text-danger error-label"></span>
                  </div>

                  <div class="col-sm-4">
                    <label for="address" class="form-label">&nbsp;</label>
                    <input type="text" class="form-control" name="seminarPhone" id="seminarPhone" placeholder="Presenter Phone" value="{{ $seminarPhone }}" required data-mask="(999) 999-9999">
                    <span id="error_seminarPhone" class="text-danger error-label"></span>
                  </div>



                    <div class="col-12">
                      <label for="additionalPresenters" class="form-label">27. Add Additional Presenter(s)</label>                  
                      <div id="error_additionalPresenters" class="text-danger error-label"></div>
                      
<!-- -->              <div class="mb-3" id="additionalPresenters">

                        @foreach($presenters as $presenter)

                        <div class="row mt-2 inputFormSeminar" id="inputFormSeminar"> 
                            <div class="col-sm-4">
                                <input type="text" class="form-control seminarAddName" name="seminarAddName[]" placeholder="Presenter Name" value="{{ $presenter->seminarAddName }}" required >
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control seminarAddEmail" name="seminarAddEmail[]" placeholder="Presenter Email" value="{{ $presenter->seminarAddEmail }}" required>
                            </div>

                            <div class="col-sm-3">
                                <input type="text" class="form-control seminarAddMobile" name="seminarAddMobile[]" placeholder="Presenter  Mobile" value="{{ $presenter->seminarAddMobile }}" required data-mask="(999) 999-9999">
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="input-group-append"><button id="removePresenters" type="button" class="btn btn-danger">Remove <i class="fa fa-user-times"></i> </button></div>
                            </div>
                        </div> 
                        
                        @endforeach

                        

<!-- -->              </div>

                      <button id="addPresenters" type="button" class="btn btn-success">Add Presenters <i class="fa fa-user-plus"></i></button>
                    </div>

              



              
              </div>
              <!-- END ROW -->



              <hr class="my-4">

              <div class="col-sm-12" id="costSummary">
                <div class="cards" id="cloneSummary">
                  <h5 class="card-header">Cost Summary</h5>
                  <div class="card-body">
                   
                    <table class="table">
                      <tbody><tr>
                          <th>Registration Level | <span id="planSummary"></span></th>
                          <th class="summable" id="regAmount"></th>
                      </tr>
                      <tr>
                          <th>Virtual Show Participant(s) |
                            <span  id="virtualParticipantCount"> </span></th>
                          <th class="summable" id="virtualParticipant"> </th>
                      </tr>
                      <tr>
                          <th>Promotional Flyers | <span  id="promotionalFlyerPages"> </span></th>
                          <th class="summable" id="promotionalFlyerAmount"></th>
                      </tr>
                      <tr>
                          <th>Brand Recognition @ $50 | <span  id="isbrandRecog"> </th>
                          <th class="summable" id="brandAmount"></th>
                      </tr>
                      <tr>
                          <th>Seminar Sessions | <span id="seminarsessionSum"> </span></th>
                          <th class="summable" id="seminarsession"></th>
                      </tr>
                      <tr>
                          <th>TOTAL</th>
                          <th  class="total" id="total"></th>
                      </tr>
                  </tbody></table>
                   
                  </div>
                </div>
              </div>


              

              <hr class="my-4">

              <div class="d-flex justify-content-center" >
                <button class="btn btn-secondary btn-lg mx-5 w-25" type="button" id="previousThree" ><i class="fa fa-arrow-circle-left"></i> Previous</button> 
                <button class="btn btn-primary btn-lg w-25" type="button" id="nextThree">Preview <i class="fa fa-search"></i></button>
              </div>

            </div>
<!-- END OF  PANE -->  







<!-- PREVIEW PANE  -->


<!-- PANE -->            
<div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
              



  <div class="col-sm-12">
    
      <h5 class="card-header">Supplier Information</h5>

      <table class="table table-sm">
        <tbody>
          
          <tr>
            <th scope="row" width="20%">Name of Company</th>
            <td id="companyName_prv" width="30%"></td>
            
            <th scope="row" width="20%">Primary Email</th>
            <td id="primaryEmail_prv" width="30%"></td>
          </tr>
          
          <tr>
            <th scope="row">Primary Contact</th>
            <td id="primaryContact_prv"></td>
            
            <th scope="row">Telephone</th>
            <td id="primaryTelephone_prv"></td>
          </tr>

          <tr>
            <th scope="row">Mobile</th>
            <td id="primaryMobile_prv"></td>
            
            <th scope="row">Fax</th>
            <td id="primaryFax_prv"></td>
          </tr>

          <tr>
            <th scope="row">Address</th>
            <td id="address_prv" colspan="3" ></td>
          </tr>



        </tbody>
      </table>


      <p>Registration Level</p>
      <table class="table table-sm" >
        <thead>
          <tr>
            <th scope="row" id="regPlan" width="20%"></th>
            <td id="regDescr" width="80%"></td>
          </tr>
        </thead>
        


      </table>


      <p>Additional Participant(s)</p>
      <table class="table table-sm" >
        <thead>
          <tr>
            <th scope="row">Name</th>
            <th scope="row">Email</th>
            <th scope="row">Cell</th>
          </tr>
        </thead>
        <tbody id="addUsersTBody"></tbody>
      </table>


<div class="pagebreak"> </div>
<div class="mt-4"></div>

<h5 class="card-header">Special Information</h5>

      <table class="table table-sm">
        <tbody>
          
          <tr>
            <th scope="row">Show Discount</th>
            <td id="discount_prv"></td>
            
             <th scope="row">Addition Information</th>
            <td id="discountAdditional_prv"></td>
          </tr>


          <tr>
            <th scope="row">Special Dating Terms</th>
            <td id="dating_prv" colspan="3"></td>
          </tr>


          <tr>
            <th scope="row">First Show Buy (December 23, 2021)</th>
            <td id="showBuy1_prv"></td>
            
             <th scope="row">Second Show Buy (March 31, 2022)</th>
            <td id="showBuy2_prv"></td>
          </tr>
          
        </tbody>
      </table>


      <table class="table table-sm">
        <tbody>
          <tr>
            <th scope="row">Dealer Incentive Program. Do you want to support the “Atlas Show Buck Program” as follows?</th>
          </tr>

          <tr>
            <td id="incentive_prv"></td>
          </tr>

        </tbody>
      </table>


      <p>Hot Buys Special</p>
      <table class="table table-sm" >
        <thead>
          <tr>
            <th scope="row">Vendor #</th>
            <th scope="row">Description</th>
            <th scope="row">Net Cost / Discount</th>
          </tr>
        </thead>
        <tbody id="hotBuysTBody"></tbody>
      </table>

      <table class="table table-sm">
        <tbody>
          
          <tr>
            <th scope="row" width="">Promotional Flyers Pages (@ $50.00 EA)</th>
            <td id="promoFlyer_prv"></td>
            
            <th scope="row">Brand Recognition @ $50</th>
            <td id="brandRecog_prv"></td>
          </tr>
        
        </tbody>
      </table>


      <table class="table table-sm">
        <tbody>
          <tr>
            <th scope="row">Free Product Special</th>
          </tr>

          <tr>
            <td id="freeProducts_prv"></td>
          </tr>

        </tbody>
      </table>



<div class="pagebreak"> </div>

      <div class="mt-4"></div>

      <h5 class="card-header">Vendor Seminar</h5>


      <table class="table table-sm">
          <tr>
            <th scope="row">Seminar Sessions</th>
            <td id="seminarSessions_prv"></td>
          </tr>
          
          <tr>
            <th scope="row">Seminar Dates & Time</th>
            <td id="seminarDatesTime_prv"></td>
          </tr>

        </tbody>
      </table>


      <p>Seminar Presenter(s)</p>
      <table class="table table-sm" >
        <thead>
          <tr>
            <th scope="row">Name</th>
            <th scope="row">Email</th>
            <th scope="row">Cell</th>
            <th scope="row">Role</th>

          </tr>
        </thead>

        <tbody id="addPresentersTBody"></tbody>

      </table>

      <div id="costPreview" class="mt-4"></div>


    
  </div>


  <hr class="my-4">

  <div class="d-flex justify-content-center d-print-none" >
    <button class="btn btn-secondary btn-lg mx-5 w-25" type="button" id="previousFour" > <i class="fa fa-arrow-circle-left"></i> Previous</button> 
    <button class="btn btn-primary btn-lg w-25" type="submit" id="submit">Submit <i class="fa fa-arrow-circle-up"></i></button>
  </div>


</div>
<!-- END OF  PANE -->       


<!-- END PREVIEW -->


          
        </div>

      </form>

      
      

      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small  d-print-none">
    <p class="mb-1">&copy; 2021 Atlas Trailer Coach Products </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="{{ route('auth.logout') }}">Logout</a></li>
    </ul>
  </footer>
</div>




<div id="participantTemplate" style="display: none;">
  <div class="row mt-2 inputFormParticipants" id="inputFormParticipants"> 
  <span id="error_Participants" class="text-danger error-label"></span>
  <div class="col-sm-4"><input type="text" class="form-control participantsName " name="participantsName[]" placeholder="Participant's Name" value="" required><div class="invalid-feedback">Participant's Name is required.</div></div>
  <div class="col-sm-3"><input type="text" class="form-control participantsEmail" name="participantsEmail[]" placeholder="Email" value="" required><div class="invalid-feedback">Primary Email is required.</div></div>
  <div class="col-sm-3"><input type="text" class="form-control participantsMobile " name="participantsMobile[]" placeholder="Mobile Number" value="" required data-mask="(999) 999-9999"><div class="invalid-feedback">Primary Mobile is required.</div></div>
  <div class="col-sm-2"><div class="input-group-append"><button id="removeParticipants" type="button" class="btn btn-danger">Remove <i class="fa fa-user-times"></i></button></div></div>
  </div>
</div>

<div id="seminarTemplate" style="display: none;">
  <div class="row mt-2 inputFormSeminar" id="inputFormSeminar"> 
    <div class="col-sm-4">
      <input type="text" class="form-control seminarAddName" name="seminarAddName[]" placeholder="Presenter Name" value="" required ><div class="invalid-feedback">Presenter Name is required.</div></div>
    <div class="col-sm-3">
      <input type="text" class="form-control seminarAddEmail" name="seminarAddEmail[]" placeholder="Presenter Email" value="" required><div class="invalid-feedback">Presenter Email is required.</div></div>
    <div class="col-sm-3">
      <input type="text" class="form-control seminarAddMobile" name="seminarAddMobile[]" placeholder="Presenter  Mobile" value="" required data-mask="(999) 999-9999"><div class="invalid-feedback">Presenter Mobile is required.</div></div>
    <div class="col-sm-2"><div class="input-group-append"><button id="removePresenters" type="button" class="btn btn-danger">Remove <i class="fa fa-user-times"></i> </button></div></div>
  </div>
</div>

<div id="freeProductsTemplate" style="display: none;">
  <div class="row mt-2 inputFreeproducts" id="inputFreeproducts"> 
  <div class="col-sm-4"><input type="text" class="form-control freeProducts" name="freeProducts[]" placeholder="e.g Buy 10 products and get 1 free" value="" required><div class="invalid-feedback">Free Products is required</div></div>
  <div class="col-sm-2"><div class="input-group-append"><button id="removeFreeproducts" type="button" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></button></div></div></div>
</div>



<div id="hotbuyTemplate" style="display: none;">
  <div class="row mt-2 inputFormHotBuys" id="inputFormHotbuys"> <div class="col-sm-2">
    <input type="text" class="form-control hotbuysVendor" name="hotbuysVendor[]" placeholder="Enter Vendor #" value="" required=""><div class="invalid-feedback">Vendor # is required.</div></div><div class="col-sm-5">
    <input type="text" class="form-control hotbuysDescription" name="hotbuysDescription[]" placeholder="Description" value="" required=""><div class="invalid-feedback">Description is required.</div></div><div class="col-sm-3">
    <input type="text" class="form-control hotbuysNetcost" id="hotbuysNetcost" name="hotbuysNetcost[]" placeholder="Net cost or Discount" value="" required=""><div class="invalid-feedback">Net Cost or Discount</div></div><div class="col-sm-2"><div class="input-group-append"><button id="removeHotbuys" type="button" class="btn btn-danger">Remove <i class="fa fa-minus-square"></i></button></div></div></div>
</div>
   

  </body>
</html>
