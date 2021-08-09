
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


    
    
<div class="container">
  <main>
    
    


    <div class="py-2 text-center">
      <img class="d-block mx-auto mb-4" src="images/atlas_banner_bb.png" alt="" width="100%">
    </div>
    
    <div class="container">
      <div class="col-md-12">


        @if (session('success'))
             
              <div class="alert alert-success d-print-none"> 
                <i class="fa fa-info-circle mr-2"></i>
                 {{session('success')}} 
                </div>
        @endif




        <table class="table table-sm">
            <tbody>
              
              <tr>
                <th scope="row">Name of Company</th>
                 <td id="companyName_prv">{{ $companyName }} </td>
                
                <th scope="row">Primary Email</th>
                <td id="primaryEmail_prv"> {{ $primaryEmail }} </td>
              </tr>
              
              <tr>
                <th scope="row">Primary Contact</th>
                <td id="primaryContact_prv">{{ $primaryContact }}</td>
                
                <th scope="row">Telephone</th>
                <td id="primaryTelephone_prv">{{ $primaryTelephone }}</td>
              </tr>
    
              <tr>
                <th scope="row">Mobile</th>
                <td id="primaryMobile_prv">{{ $primaryMobile }}</td>
                
                <th scope="row">Fax</th>
                <td id="primaryFax_prv">{{ $primaryFax }}</td>
              </tr>
    
              <tr>
                <th scope="row">Address</th>
                <td id="address_prv" colspan="3" >{{ $address . ', '. $city . ', '. $state. ', '.$country. ', '. $zipcode }}</td>
              </tr>
    
            </tbody>
          </table>
    
    
          <h6>Registration Level</h6>
          <table class="table table-sm" >
            <thead>
              <tr>
                <th scope="row" id="regPlan">Class {{ $plan }}</th>
                <td id="regDescr">
                    @if ($plan == "A") $ 2,000 | Show Registration, 2 Seminar Spots included, Unlimited Participants @endif
                    @if ($plan == "B") $ 1,000 | Show Registration, Main contact is the participant, 1 Seminar Spot included, 1 Free Participant @endif
                    @if ($plan == "C") $ 500 | Show Registration, Main contact is the participant @endif

                </td>
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
            
            <tbody id="addUsersTBody">
                
                @if ($participants->count())
                    @foreach ($participants as $participant )
                    <tr>
                        <td>{{ $participant->participantsName }}</td>
                        <td>{{ $participant->participantsEmail }}</td>
                        <td>{{ $participant->participantsMobile }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="3">N / A</td>
                </tr>
                @endif


            </tbody>

          </table>
    
    
    <div class="pagebreak"> </div>
    <div class="mt-4"></div>
    
    
          <table class="table table-sm">
            <tbody>
              
              <tr>
                <th scope="row">Show Discount</th>
                <td id="discount_prv">{{ $discount }}%</td>
                
                 <th scope="row">Additional Information</th>
                <td id="discountAdditional_prv"> {{ $discountAdditional }} </td>
              </tr>
    
    
              <tr>
                <th scope="row">Special Dating Terms</th>
                <td id="dating_prv" colspan="1">
                   @if($dating == "others") {{ $datingOthers }} @else {{ $dating }} @endif days
                </td>
              </tr>
    
    
              <tr>
                <th scope="row">First Show Buy (December 23, 2021)</th>
                <td id="showBuy1_prv">{{ $showBuy1 }}</td>
                
                 <th scope="row">Second Show Buy (March 31, 2022)</th>
                <td id="showBuy2_prv">{{ $showBuy2 }}</td>
              </tr>
              
            </tbody>
          </table>
    
    
          <table class="table table-sm">
            <tbody>
              <tr>
                <th scope="row">Dealer Incentive Program. Do you want to support the “Atlas Show Buck Program” as follows?</th>
              </tr>
    
              <tr>
                <td id="incentive_prv">@if($incentive == "others") {{ $incentiveOthers }} @else {{ $incentive }}% Rebate @endif </td>
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
            <tbody id="hotBuysTBody">

                @if ($hotbuys->count())
                    @foreach ($hotbuys as $hotbuy)
                    <tr>
                        <td>{{ $hotbuy->hotbuysVendor }}</td>
                        <td>{{ $hotbuy->hotbuysDescription }}</td>
                        <td>{{ $hotbuy->hotbuysNetcost }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="3">N / A</td>
                </tr>
                @endif

            </tbody>
          </table>
    
          <table class="table table-sm">
            <tbody>
              
              <tr>
                <th scope="row">Promotional Flyers Pages (@ $50.00 EA)</th>
                <td id="promoFlyer_prv"> {{ $promoflyerPages }}  </td>
                
                <th scope="row">Brand Recognition</th>
                <td id="brandRecog_prv"> {{ $brandRecognition }} </td>
              </tr>
            
            </tbody>
          </table>
    
    
          <table class="table table-sm">
            <tbody>
              <tr>
                <th scope="row">Free Product Special</th>
              </tr>
    
              <tr>
                <td id="freeProducts_prv">

                    @if ($freeproducts->count())
                        @foreach ($freeproducts as $freeproduct)
                            {{ $freeproduct->freeProducts}} |                                                
                        @endforeach
                    @else
                        N / A
                    @endif


                </td>
              </tr>
    
            </tbody>
          </table>
    
    
    
    <div class="pagebreak"> </div>
    
          <div class="mt-4"></div>

          <h6>Seminars</h6>
          <table class="table table-sm">
              <tr>
                <th scope="row">Seminar Sessions</th>
                <td id="seminarSessions_prv">{{ $seminarCount + $addsem  }}</td>
              </tr>
              
              <tr>
                <th scope="row">Seminar Dates & Time</th>
                <td id="seminarDatesTime_prv">

                    @if ($seminardays->count())
                        @foreach ($seminardays as $seminarday)
                           November {{ $seminarday->seminarday}} |                                                
                        @endforeach
                    @else
                        N / A
                    @endif

                </td>
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
    
            <tbody id="addPresentersTBody">
                
                @if ($seminarName)
                <tr>
                    <td>{{ $seminarName }}</td>
                    <td>{{ $seminarEmail }}</td>
                    <td>{{ $seminarPhone }}</td>
                    <td>Lead Presenter</td>
                </tr>
                @else
                <tr>
                    <td colspan="4">N / A</td>
                </tr>
                @endif



                @if ($presenters && ($plan != "C"))
                @foreach ($presenters as $presenter)
                <tr>
                    <td>{{ $presenter->seminarAddName }}</td>
                    <td>{{ $presenter->seminarAddEmail}}</td>
                    <td>{{ $presenter->seminarAddMobile }}</td>
                    <td>Presenters</td>
                </tr>
                @endforeach
                @endif




            </tbody>
    
          </table>




          <hr class="my-4">

                  <h5 class="card-header">Cost Summary</h5>
                   
                    <table class="table">
                      <tbody><tr>
                          <th>Registration Level  | <span id="planSummary">Class {{ $plan}}</span></th>
                          <th class="summable" id="regAmount"> {{ $regamount}}</th>
                      </tr>
                      <tr>
                          <th>Virtual Show Participant(s) 
                             <span  id="virtualParticipantCount"> |  
                                 
                            @if ($plan == "C" )
                                (N/A) 
                            @elseif ($plan == "B" && $participants->count() <= 1 )
                                {{ $participants->count() }} total (1 free) | 0 additional participants @ $50  
                            @elseif ($plan == "B" && $participants->count() > 1 )
                                {{($participants->count() ) }} total  (1 free) | {{$participants->count() - 1}} additional participants @ $50
                            @elseif ($plan == "A")
                            {{$participants->count()}} (Unlimited Free Participants)
                            @endif


 
                            
                            </span></th>
                          
                             <th class="summable" id="virtualParticipant"> 
                                @if ($plan == "A" || $plan == "C" )
                                    0
                                @elseif ($plan == "B" && $participants->count() <= 1 )
                                    0
                                @elseif ($plan == "B" && $participants->count() > 1 )
                                {{ ($participants->count() - 1)*50 }}
                                @endif
                             </th>

                      </tr>
                      <tr>
                          <th>Promotional Flyers | <span  id="promotionalFlyerPages">{{ $promoflyerPages}} pages @ $50 per page </span></th>
                          <th class="summable" id="promotionalFlyerAmount"> {{ $promoflyerPages * 50}} </th>
                      </tr>
                      <tr>
                          <th>Brand Recognition @ $50 | ({{ $brandRecognition}})</th>
                          <th class="summable" id="brandAmount">
                            @if($brandRecognition =="Yes") 50 @else 0 @endif
                          </th>
                      </tr>
                      <tr>
                          <th>Seminar Sessions 
                              <span id="seminarsessionSum"> 
                                
                               | {{$addsem + $seminarCount}} total ({{ $addsem }} free) | {{$seminarCount}} additional sessions @ $500

                              </span>
                          </th>
                          <th class="summable" id="seminarsession"> {{$seminarCount * 500}}</th>
                      </tr>
                      <tr>
                          <th>TOTAL</th>
                          <th  class="total" id="total">

                           


                          </th>
                      </tr>
                  </tbody></table>


                  <script>

                    var sum = 0;
                    $(".summable").each(function () {
                        sum += parseFloat($(this).text());
                    });
                    $("#total").text( "$" + sum);

                  </script>
                
    








        <hr class="my-4">

        <div class="d-flex justify-content-center d-print-none" >
            <button class="btn btn-secondary btn-lg mx-1" type="button" id="print" onclick="window.print();" >Print</button> 
            <a href="{{ route('edit') }}" class="btn btn-primary btn-lg mx-1" type="button" id="submit">Edit</a>
            <a href="{{ route('auth.logout') }}" class="btn btn-danger btn-lg mx-1" type="button" id="submit">Logout</a>
        </div>

            

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





  </body>
</html>
