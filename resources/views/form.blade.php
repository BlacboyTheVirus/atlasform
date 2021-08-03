
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Atlas Trailer Coach Products | 2021 Virtual Buying Show</title>
    
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

      .total{
        font-size: 24px;
        text-align: right;
      }

      .error-label{
        font-size: 14px;
      }

      .card{
        cursor: pointer;
      }

      .bg-card-selected {
        background-color: #d7e9ff !important;
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
      <img class="d-block mx-auto mb-4" src="images/atlas.png" alt="" height="150">
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
              <h4 class="mb-3">Specials Information</h4>
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

<form action = "{{ route('form') }}" id="atlasform" method="post" novalidate> 
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
                  <div class="form-control" >{{ $LoggedVendorInfo['name'] }}</div>
                  <input hidden  value="{{ $LoggedVendorInfo['name'] }}" >

                  <div class="invalid-feedback"></div>
                </div>
    
                <div class="col-sm-4">
                  <label for="address" class="form-label">2. Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="" value="{{ old('address') }}" required>
                  <span id="error_address" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="country" class="form-label">3. Country</label>
                  <select class="form-select" id="country" name="country" required>
                    <option value="" selected>Choose...</option>
                    <option value="Canada"  {{ old('country') == "Canada" ? 'selected':'' }}  >Canada</option>
                    <option value="USA" {{ old('country') == "USA" ? 'selected':'' }} >USA</option>
                  </select>
                  <span id="error_country" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="state" class="form-label">4. State</label>
                  <select class="form-select" id="state"  name="state" required>
                    <option value="" selected>Choose...</option>
                  </select>
                  <span id="error_state" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="city" class="form-label">5. City</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{ old('city') }}" required>
                  <span id="error_city" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-2">
                  <label for="zipCode" class="form-label">6. Zip/Postal Code</label>
                  <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="" value="{{ old('zipCode') }}" required>
                  <span id="error_zipCode" class="text-danger error-label"></span>
                </div>
              
            
                <div class="col-sm-3">
                  <label for="primaryContact" class="form-label">7. Primary Contact</label>
                  <input type="text" class="form-control" id="primaryContact" name="primaryContact" placeholder="" value="{{ old('primaryContact') }}" required>
                  <span id="error_primaryContact" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-3">
                  <label for="primaryEmail" class="form-label">8. Primary Email</label>
                  <input type="text" class="form-control" id="primaryEmail" name="primaryEmail" placeholder="" value="{{ old('primaryEmail', $LoggedVendorInfo['email'])  }}" required >
                  <span id="error_primaryEmail" class="text-danger error-label"></span>
                </div>                

                <div class="col-sm-2">
                  <label for="primaryTelephone" class="form-label">Telephone</label>
                  <input type="text" class="form-control" id="primaryTelephone" name="primaryTelephone" placeholder="" value="{{ old('primaryTelephone') }}" data-mask="(999) 999-9999" required>
                  <span id="error_primaryTelephone" class="text-danger error-label"></span>
                </div>

                

                <div class="col-sm-2">
                  <label for="primaryMobile" class="form-label">Mobile</label>
                  <input type="text" class="form-control" id="primaryMobile" name="primaryMobile" placeholder="" value="{{ old('primaryMobile') }}" data-mask="(999) 999-9999" >
                </div>

                <div class="col-sm-2 ">
                  <label for="primaryFax" class="form-label">Fax</label>
                  <input type="text" class="form-control" id="primaryFax" name="primaryFax" placeholder="" value="{{ old('primaryFax') }}" data-mask="(999) 999-9999">
                </div>



                <!-- CARD DECK -->
                <div class="row mt-3">
                  <label for="plan" class="form-label">Registration Levels (Choose 1)</label>                  

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
                            Unlimited Participants (Add Participants below)
                          </p>
                        </div>

                        <div class="card-footer form-control-lg" >
                            <input class="form-check-input" type="radio" name="plan" id="planA" value="A" style="margin-top: -20px;" {{ old('plan') == "A" ? 'checked':'' }} >
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
                          @if (old('plan')=="") checked @endif {{ old('plan') == "B" ? 'checked':'' }} >
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
                          <input class="form-check-input" type="radio" name="plan" id="planC" value="C" style="margin-top: -20px;" {{ old('plan') == "C" ? 'checked':'' }} >
                        </div>

                    </div>
                  </div>

                </div>
                <!-- END CARD DECK -->

                
  
                <div class="col-12" id="participantsForm">
                  <label class="form-label">Add Participant(s) $50 is charged per participant outside your plan</label>                  
                  <div id="error_newParticipants" class="text-danger error-label"></div>
                  <div class="mb-3" id="newParticipants"></div>
                  <button id="addParticipants" type="button" class="btn btn-success">Add Participants</button>
                </div>
                

              </div>

              <hr class="my-4">
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary btn-lg" type="button" id="nextOne">Next</button>
              </div>
              
            </div>
            <!-- END PANE ROW -->

<!-- END OF PANE -->




<!-- PANE SPECIALS -->                        
        <div class="tab-pane fade" id="specials" role="tabpanel" aria-labelledby="specials-tab">
              
              
              <!-- ROW -->
              <div class="row g-3">

               

                <div class="col-sm-3">
                  <label for="discount" class="form-label">Show Discounts(%)</label>
                  <div class="col-sm-12">
                  <input type="text" class="form-control numeric" id="discount" name="discount" placeholder="" value="" required  >
                  </div>
                  <span id="error_discount" class="text-danger error-label"></span>
                </div>

                <div class="col-sm-3">
                  <label for="discountAdditional" class="form-label">Additional Information</label>
                  <input type="text" class="form-control" id="discountAdditional" name="discountAdditional" placeholder="" value="" required>
                  <span id="error_discountAdditional" class="text-danger error-label"></span>
                </div>                

                
                <div class="row g-2">
                  <label for="dating" class="form-label">Special Dating Terms</label>
                  <div class="col-sm-2">
                    <select class="form-select" id="dating"  name="dating" required>
                      <option value="" selected>Choose...</option>
                      <option value="30" >30 days</option>
                      <option value="60" >60 days</option>
                      <option value="90" >90 days</option>
                      <option value="120" >120 days</option>
                      <option value="others" >Others</option>
                    </select>
                    <span id="error_dating" class="text-danger error-label"></span>
                  </div>

                  <div class="col-md-3">
                    <div class="form-check-inline" style="display: none; margin-left:  10px;">
                      <input type="text" class="form-control" id="datingOthers" name="datingOthers" placeholder="" value="" >
                      <span id="error_datingOthers" class="text-danger error-label"></span>
                    </div>
                  </div>
                
                </div>


                <div class="row g-2">
                  <div class="col-md-12 form-label">Number of discounted buys </div>

                  <div class="col-md-4">
                      <label for="showBuy1" class="form-label">1st Show Buy (by December 23, 2021)</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="showBuy1" name="showBuy1" placeholder="" value="" required  >
                      </div>
                      <span id="error_showBuy1" class="text-danger error-label"></span>
                  </div>

                  <div class="col-md-4">
                      <label for="showBuy2" class="form-label">2nd Show Buy (by March 31, 2022)</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="showBuy2" name="showBuy2" placeholder="" value="" required  >
                      </div>
                      <span id="error_showBuy2" class="text-danger error-label"></span>
                  </div>
                
                </div>


                <div class="row g-2">
                  <label for="incentive" class="form-label"> Dealer Incentive Program. Do you want to support the “Atlas Show Buck Program” as follows?</label>

                  <div class="col-sm-2">
                    <select class="form-select" id="incentive"  name="incentive" required>
                        <option value="" selected>Choose...</option>
                        <option value="0"> We won't be participating </option>
                        <option value="1"> 1% Rebate </option>
                        <option value="5"> 5% Rebate </option>
                        <option value="25">25% Rebate </option>
                        <option value="others">Others </option>
                    </select>
                    <span id="error_incentive" class="text-danger error-label"></span>
                  </div>

                  <div class="col-md-3">
                    <div class="form-check-inline" style="display: none; margin-left:  10px;">
                      <input type="text" class="form-control" id="incentiveOthers" name="incentiveOthers" placeholder="" value="" required  >
                      <span id="error_incentiveOthers" class="text-danger error-label"></span>
                    </div>
                  </div>
                
                </div>

                


                <div class="col-12">
                  <label for="hotbuys" class="form-label" style="margin-bottom: 0rem !important;">Hot Buys Special</label>                  

                    <div id="error_hotbuys" class="text-danger error-label"></div>
                  
                    <div class="mb-3" id="newHotbuys"></div>
                  <button id="addHotbuys" type="button" class="btn btn-success">Add Hotbuys</button>
                </div>




               


                <div class="col-12">
                  <label for="freeproducts" class="form-label" style="margin-bottom: 0rem !important;">Free Product Special</label>                  
                  
                  <div id="error_freeproducts" class="text-danger error-label"></div>

                  <div class="mb-3" id="newFreeproducts"></div>
                  <button id="addFreeproducts" type="button" class="btn btn-success">Add Free Product</button>
                </div>


                <div class="row g-2">
                  <label for="promoFlyer" class="form-label">  Promotional Flyers @ $50.00EA (Dealers will be able to see your flyers on the EOS)</label>

                  
                  <div class="col-md-1">
                    <input type="radio" id="promoFlyer1" name="promoFlyer" class="form-check-input" value="no" checked required>
                    <label class="custom-control-label" for="promoFlyer1">No</label>
                  </div>
                  
                  <div class=" col-md-1">
                    <input type="radio" id="promoFlyer2" name="promoFlyer" class="form-check-input" value="yes"  required>
                    <label class="custom-control-label" for="promoFlyer1">Yes</label>
                  </div>
                  

                  <div class="col-md-3">
                    <div class="form-check-inline">
                      <input type="text" class="form-control" id="promoflyerPages" name="promoflyerPages" placeholder="Specify number of pages" value="" required  style=" display: none">
                      <span id="error_promoflyerPages" class="text-danger error-label"></span>
                    </div>
                  </div>
                
                </div>



                <div class="row g-2">
                  <label for="brandRecognition" class="form-label">  Brand Recognition</label>
                  <div class="col-md-1">
                    <input type="radio" id="brandRecognition1" name="brandRecognition" class="form-check-input" value="No" required checked>
                    <label class="custom-control-label" for="brandRecognition1">No</label>
                  </div>
                  
                  <div class=" col-md-1">
                    <input type="radio" id="brandRecognition2" name="brandRecognition" class="form-check-input" value="Yes" required>
                    <label class="custom-control-label" for="brandRecognition2">Yes</label>
                  </div>
                  
                
                </div>


                  
                

             

              
              </div>
              <!-- END ROW -->


              <hr class="my-4">

                <div class="d-flex justify-content-center" >
                  <button class="btn btn-primary btn-lg" type="button" id="previousTwo" >Previous</button> 
                  <button class="btn btn-primary btn-lg" type="button" id="nextTwo">Next</button>
                </div>

              
    
        </div>
<!-- END OF PANE -->


<!-- PANE -->            
            <div class="tab-pane fade" id="seminar" role="tabpanel" aria-labelledby="seminar-tab">
              
              <!-- ROW -->
              <div class="row g-3" id="hidder">

                <div class="sm-12">
                    <div class="cards">
                      <h6 class="card-header">Thank you for considering taking part in our Pre-Show Seminars.</h6>
                      <div class="card-body">
                        <p class="card-text">
                          <b>Times:</b> 9:00 am to 4:00 pm MST. <br/>                      
                          <b>Duration:</b> 30 minute sessions<br/>
                          Time slots will be allocated by Atlas and the seminars will be held during normal working hours.<br/>
                          Please indicate which day(s) works best and whether you prefer AM or PM.<br/>
                        </p>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-12">
                    <label for="discount" class="form-label">Additional Seminars (Additional seminars are $500.00/session outside your plan.)</label>
                    <div class="col-sm-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" id="seminarMinus" ><i class="fa fa-minus"></i></button>
                      </div>
                      <input type="text" id="seminarCount" name="seminarCount" class="form-control text-center" placeholder="" aria-label="" aria-describedby="basic-addon1" readonly value=0>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="seminarPlus"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-6" id="seminarTotal"></div>



                  </div>

                  <div class="col-sm-12">

                    <label for="address" class="form-label">Seminar Presenter</label>
                    <div id="error_semdays" class="text-danger error-label mb-2 "></div>
                    <table class="table table-bordered table-condensed" id="semtable">
                      
                        <thead>
                          <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>AM</th>
                            <th>PM</th>
                          </tr>
                        </thead>
                      
                        <tbody>
                        
                          <tr>
                            <td>Monday</td><td>Nov 8 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov8" value="8-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov8" value="8-PM"></td>
                          </tr>
                        
                          <tr>
                            <td>Tuesday</td><td>Nov 9 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov9" value="9-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov9" value="9-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Wednesday</td><td>Nov 10 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov10" value="10-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov10" value="10-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Friday</td><td>Nov 12 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov12" value="12-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov12" value="12-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Monday</td><td>Nov 15 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov15" value="15-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov15" value="15-PM"></td>
                          </tr>
                          
                          <tr>
                            <td>Tuesday</td><td>Nov 16 </td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov16" value="16-AM"></td>
                            <td><input type="checkbox" class="semdays" name="seminardays[]" data-date="nov16" value="16-PM"></td>
                          </tr>

                      </tbody>
                      
                    </table>
                  </div>

                  <div class="col-sm-4">
                    <label for="address" class="form-label">Seminar Presenter</label>
                    <input type="text" class="form-control" name="seminarName" id="seminarName" placeholder="Presenter Name" value="" required>
                    <span id="error_seminarName" class="text-danger error-label"></span>
                  </div>

                  <div class="col-sm-4">
                    <label for="address" class="form-label">&nbsp;</label>
                    <input type="text" class="form-control" name="seminarEmail" id="seminarEmail" placeholder="Presenter Email" value="" required>
                    <span id="error_seminarEmail" class="text-danger error-label"></span>
                  </div>

                  <div class="col-sm-4">
                    <label for="address" class="form-label">&nbsp;</label>
                    <input type="text" class="form-control" name="seminarPhone" id="seminarPhone" placeholder="Presenter Phone" value="" required data-mask="(999) 999-9999">
                    <span id="error_seminarPhone" class="text-danger error-label"></span>
                  </div>




                   

                    <div class="col-12">
                      <label for="additionalPresenters" class="form-label">Add Additional Presenter(s)</label>                  
                      <div id="error_additionalPresenters" class="text-danger error-label"></div>
                      <div class="mb-3" id="additionalPresenters"></div>
                      <button id="addPresenters" type="button" class="btn btn-success">Add Presenters</button>
                    </div>

              



              
              </div>
              <!-- END ROW -->



              <hr class="my-4">

              <div class="col-sm-12" id="costSummary">
                <div class="cards">
                  <h5 class="card-header">Cost Summary</h5>
                  <div class="card-body">
                   
                    <table class="table">
                      <tbody><tr>
                          <th>Registration Level <span id="planSummary"></span></th>
                          <th class="summable" id="regAmount"></th>
                      </tr>
                      <tr>
                          <th>Virtual Show Participant(s) 
                            <span  id="virtualParticipantCount"> </span></th>
                          <th class="summable" id="virtualParticipant"> </th>
                      </tr>
                      <tr>
                          <th>Promotional Flyers <span  id="promotionalFlyerPages"> </span></th>
                          <th class="summable" id="promotionalFlyerAmount"></th>
                      </tr>
                      <tr>
                          <th>Brand Recognition </th>
                          <th class="summable" id="brandAmount"></th>
                      </tr>
                      <tr>
                          <th>Seminar Sessions <span id="seminarsessionSum"> </span></th>
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
                <button class="btn btn-primary btn-lg" type="button" id="previousThree" >Previous</button> 
                <button class="btn btn-primary btn-lg" type="button" id="nextThree">Preview</button>
              </div>

            </div>
<!-- END OF  PANE -->  







<!-- PREVIEW PANE  -->


<!-- PANE -->            
<div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
              

  <hr class="my-4">

  <div class="col-sm-12">
    
      <h5 class="card-header">PREVIEW</h5>

      <table class="table table-sm">
        <tbody>
          
          <tr>
            <th scope="row">Name of Company</th>
            <td id="companyName_prv"></td>
            
            <th scope="row">Primary Email</th>
            <td id="primaryEmail_prv"></td>
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


      <h6>Registration Level</h6>
      <table class="table table-sm" >
        <thead>
          <tr>
            <th scope="row" id="regPlan"></th>
            <td id="regDescr"></td>
          </tr>
        </thead>
        


      </table>


      <h6>Additional Participant(s)</h6>
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
            <td id="dating_prv" colspan="1"></td>
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


      <h6>Hot Buys Special</h6>
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
            <th scope="row">Promotional Flyers Pages (@ $50.00 EA)</th>
            <td id="promoFlyer_prv"></td>
            
            <th scope="row">Brand Recognition</th>
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



      <h6>Seminars</h6>
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


      <h6>Seminar Presenter(s)</h6>
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
    <button class="btn btn-primary btn-lg" type="button" id="previousFour" >Previous</button> 
    <button class="btn btn-primary btn-lg" type="submit" id="submit">Submit</button>
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
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
      <li class="list-inline-item"> | </li>
      <li class="list-inline-item"><a href="{{ route('auth.logout') }}">Logout</a></li>
    </ul>
  </footer>
</div>




<div id="participantTemplate" style="display: none;">
  <div class="row mt-2 inputFormParticipants" id="inputFormParticipants"> 
  <span id="error_Participants" class="text-danger error-label"></span>
  <div class="col-sm-4"><input type="text" class="form-control participantsName " name="participantsName[]" placeholder="Participants Name" value="" required><div class="invalid-feedback">Participants Name is required.</div></div>
  <div class="col-sm-3"><input type="text" class="form-control participantsEmail" name="participantsEmail[]" placeholder="Participants Email" value="" required><div class="invalid-feedback">Primary Contact is required.</div></div>
  <div class="col-sm-3"><input type="text" class="form-control participantsMobile " name="participantsMobile[]" placeholder="Participants Mobile" value="" required><div class="invalid-feedback">Primary Contact is required.</div></div>
  <div class="col-sm-2"><div class="input-group-append"><button id="removeParticipants" type="button" class="btn btn-danger">Remove</button></div></div>
  </div>
</div>

<div id="seminarTemplate" style="display: none;">
  <div class="row mt-2 inputFormSeminar" id="inputFormSeminar"> 
    <div class="col-sm-4">
      <input type="text" class="form-control seminarAddName" name="seminarAddName[]" placeholder="Presenter Name" value="" required ><div class="invalid-feedback">Presenter Name is required.</div></div>
    <div class="col-sm-3">
      <input type="text" class="form-control seminarAddEmail" name="seminarAddEmail[]" placeholder="Presenter Email" value="" required><div class="invalid-feedback">Presenter Email is required.</div></div>
    <div class="col-sm-3">
      <input type="text" class="form-control seminarAddMobile" name="seminarAddMobile[]" placeholder="Presenter  Mobile" value="" required><div class="invalid-feedback">Presenter Mobile is required.</div></div>
    <div class="col-sm-2"><div class="input-group-append"><button id="removePresenters" type="button" class="btn btn-danger">Remove</button></div></div>
  </div>
</div>

<div id="freeProductsTemplate" style="display: none;">
  <div class="row mt-2 inputFreeproducts" id="inputFreeproducts"> 
  <div class="col-sm-4"><input type="text" class="form-control freeProducts" name="freeProducts[]" placeholder="e.g Buy 10 products and get 1 free" value="" required><div class="invalid-feedback">Free Products is required</div></div>
  <div class="col-sm-2"><div class="input-group-append"><button id="removeFreeproducts" type="button" class="btn btn-danger">Remove</button></div></div></div>
</div>



<div id="hotbuyTemplate" style="display: none;">
  <div class="row mt-2 inputFormHotBuys" id="inputFormHotbuys"> <div class="col-sm-2">
    <input type="text" class="form-control hotbuysVendor" name="hotbuysVendor[]" placeholder="Enter Vendor #" value="" required=""><div class="invalid-feedback">Vendor # is required.</div></div><div class="col-sm-5">
    <input type="text" class="form-control hotbuysDescription" name="hotbuysDescription[]" placeholder="Description" value="" required=""><div class="invalid-feedback">Description is required.</div></div><div class="col-sm-3">
    <input type="text" class="form-control hotbuysNetcost" id="hotbuysNetcost" name="hotbuysNetcost[]" placeholder="Net cost or Discount" value="" required=""><div class="invalid-feedback">Net Cost or DIscount</div></div><div class="col-sm-2"><div class="input-group-append"><button id="removeHotbuys" type="button" class="btn btn-danger">Remove</button></div></div></div>
</div>
   

  </body>
</html>
