<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
     <title>Atlas Trailer Coach Products | 2021 Virtual Buying Show</title>
    
   
    <style>

.container {
    max-width:100%;
}

.d-print-none{
    display: none!important;
}

@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */

    .d-print-none {
        display: none!important;
    }
}

.pagebreak { page-break-before: always; } /* page-break-after works, as well */

.card-header{
    margin: 30px 0px;
}

body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.8rem;

    background-color: #fff;
 
}

thead td{
    
  border-top: 2px solid #aaaaaa;
  border-bottom: 1px solid #aaaaaa;

}

 td, th {
  width: 100%;

  border-width: 1px;
  
  border-top: 1px solid #cecece;
  border-bottom: 1px solid #cecece;
  vertical-align: top;
  text-align: left;
  padding: 6px;
}



table {
  height: 10px;
  border-collapse: collapse;
  width: 100%;
  margin-top: 20px
  margin-bottom: 20px
}


.hd{
    font-weight: bold;
    text-align: left
}





/* 
table {
    caption-side: bottom;
    border-collapse: collapse;
    width: 100%
}


.table>tbody {
    vertical-align: inherit;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 1pt grey ;
    text-align: left;
    padding: 0.2em;
} */

.card-header{
    font-weight: 800;
    padding: 5px 2px;
    border-bottom: #aaaaaa 2px solid

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

      th, td{
        vertical-align: top
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
    
    


    


    
    <div class="container">
      <div class="col-md-12">

        <table class="table table-sm" style="width: 100%; margin: 10px auto 30px auto;">
            <tbody>
                <tr>
                  <td><img style="width:100%;" src="images/atlas_banner_bb.png" alt="" ></td>
                </tr>
            </tbody>
        </table>

        <h2 class="card-header">Supplier Information</h2>


        <table class="table table-sm">
            <tbody>
              
              <tr >
                <td class="hd">1. Name of Company</td>
                 <td id="companyName_prv">{{ $companyName }} </td>
                <td class="hd">2. Primary Email</td>
                <td id="primaryEmail_prv"> {{ $primaryEmail }} </td>
              </tr>
              
              <tr>
                <td class="hd">3. Primary Contact</td>
                <td id="primaryContact_prv">{{ $primaryContact }}</td>
                
                <td class="hd">4. Telephone #</td>
                <td id="primaryTelephone_prv">{{ $primaryTelephone }}</td>
              </tr>
    
              <tr>
                <td class="hd">5. Mobile #</td>
                <td id="primaryMobile_prv">{{ $primaryMobile }}</td>
                
                <td class="hd">6. Fax #</td>
                <td id="primaryFax_prv">{{ $primaryFax }}</td>
              </tr>
    
              <tr>
                <td class="hd">7. Address</td>
                <td id="address_prv" colspan="3" >{{ $address . ', '. $city . ', '. $state. ', '.$country.', '. $zipcode }}</td>
              </tr>
    
            </tbody>
          </table>
    
    
          <h4>8. Registration Level</h4>
          <table class="table table-sm" >
            <thead>
              <tr>
                <td class="hd" id="regPlan">Class {{ $plan }}</td>
                <td id="regDescr">
                    @if ($plan == "A") $ 2,000 | Show Registration, 2 Seminar Spots included, Unlimited Participants @endif
                    @if ($plan == "B") $ 1,000 | Show Registration, Main contact is the participant, 1 Seminar Spot included, 1 Free Participant @endif
                    @if ($plan == "C") $ 500 | Show Registration, Main contact is the participant @endif

                </td>
              </tr>
            </thead>
            
    
    
          </table>
    
    
          <h4>9. Additional Participant(s)</h4>
          <table class="table table-sm" >
            <thead>
              <tr>
                <td class="hd">Name</td>
                <td class="hd">Email</td>
                <td class="hd">Cell</td>
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
    
    <table class="table table-sm" style="width: 100%; margin: 10px auto 30px auto;">
        <tbody>
            <tr>
              <td><img style="width:100%;" src="images/atlas_banner_bb.png" alt="" ></td>
            </tr>
        </tbody>
    </table>
    
    <h2 class="card-header">Special Information</h2>

          <table class="table table-sm">
            <tbody>
              
              <tr>
                <td class="hd">10. Show Discount</td>
                <td id="discount_prv">{{ $discount }}%</td>
                
                 <td class="hd">11. Additional Information</td>
                <td id="discountAdditional_prv"> {{ $discountAdditional }} </td>
              </tr>
    
    
              <tr>
                <th class="hd">12. Special Dating Terms</th>
                <td id="dating_prv" colspan="1">
                   @if($dating == "others") {{ $datingOthers }} @else {{ $dating }} @endif days
                </td>
              </tr>
    
    
              <tr>
                <td class="hd">13. First Show Buy (December 23, 2021)</td>
                <td id="showBuy1_prv">{{ $showBuy1 }}</td>
                
                 <td class="hd">14. Second Show Buy (March 31, 2022)</td>
                <td id="showBuy2_prv">{{ $showBuy2 }}</td>
              </tr>
              
            </tbody>
          </table>
    
    
          <table class="table table-sm">
            <tbody>
              <tr>
                <td class="hd">15. Dealer Incentive Program. Do you want to support the “Atlas Show Buck Program” as follows?</td>
              </tr>
    
              <tr>
                <td id="incentive_prv">@if($incentive == "others") {{ $incentiveOthers }} @else {{ $incentive }}% Rebate @endif </td>
              </tr>
    
            </tbody>
          </table>
    
    
          <h4>16. Hot Buys Special</h4>
          <table class="table" >
            <thead>
              <tr>
                <td class="hd" width="25%">Vendor #</td>
                <td class="hd" width="50%">Description</td>
                <td class="hd" width="25%">Net Cost / Discount</td>
              </tr>
            </thead>
            <tbody id="hotBuysTBody">

                @if ($hotbuys->count())
                    @foreach ($hotbuys as $hotbuy)
                    <tr>
                        <td width="25%">{{ $hotbuy->hotbuysVendor }}</td>
                        <td width="50%">{{ $hotbuy->hotbuysDescription }}</td>
                        <td width="25%">{{ $hotbuy->hotbuysNetcost }}</td>
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
                <td class="hd">17. Promotional Flyers Pages (@ $50.00 EA)</td>
                <td id="promoFlyer_prv"> {{ $promoflyerPages }}  </td>
                
                <td class="hd">18. Brand Recognition @ $50</td>
                <td id="brandRecog_prv"> {{ $brandRecognition }} </td>
              </tr>
            
            </tbody>
          </table>
    
          <h4>Free Product Special</h4>
          <table class="table table-sm">
            <thead>
                <tr>
                  <td class="hd">19. Free Product Special</td>
                </tr>
              </thead>

            <tbody>
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
    
        
    
    
    <table class="table table-sm" style="width: 100%; margin: 10px auto 30px auto;">
        <tbody>
            <tr>
                <td><img style="width:100%;" src="images/atlas_banner_bb.png" alt="" ></td>
            </tr>
        </tbody>
    </table>


          <h2 class="card-header">Seminar Vendor</h2>

          <table class="table table-sm">
              <tr>
                <td class="hd" width="40%">20. Seminar Sessions</td>
                <td id="seminarSessions_prv" width="60%">{{ $seminarCount + $addsem  }}</td>
              </tr>
              
              <tr>
                <td class="hd" width="40%">21. Seminar Dates & Time</td>
                <td id="seminarDatesTime_prv" width="60%">

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
    
    
          <h4>22. Seminar Presenter(s)</h4>
          <table class="table table-sm" >
            <thead>
              
              <tr>
                <td class="hd">Name</td>
                <td class="hd">Email</td>
                <td class="hd">Cell</td>
                <td class="hd">Role</td>
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



                @if ($presenters)
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

                  <h2 class="card-header">Cost Summary</h2>
                   
                    <table class="table table-sm">
                      <tbody><tr>
                          <td>Registration Level  | <span id="planSummary">Class {{ $plan}}</span></th>
                          <td class="summable" id="regAmount"> {{ $regamount}}</td>
                      </tr>
                      <tr>
                          <td>Virtual Show Participant(s) 
                             <span  id="virtualParticipantCount"> |   
                                 
                            @if ($plan == "C" )
                                (N/A) 
                            @elseif ($plan == "B" && $participants->count() <= 1 )
                                {{$participants->count()}} total (1 free) | 0 additional participants @ $50  
                            @elseif ($plan == "B" && $participants->count() > 1 )
                                {{($participants->count() ) }} total  (1 free) | {{$participants->count() - 1}} additional participants @ $50
                            @elseif ($plan == "A")
                                {{$participants->count()}} total | (Unlimited Free Participants)
                            @endif


                                
                               
                            
                            </span></th>
                          
                             <td class="summable" id="virtualParticipant"> 
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
                          <td>Promotional Flyers | <span  id="promotionalFlyerPages">{{ $promoflyerPages}} pages @ $50 per page </span></th>
                          <td class="summable" id="promotionalFlyerAmount"> {{ $promoflyerPages * 50}} </td>
                      </tr>
                      <tr>
                          <td>Brand Recognition @ $50 |  ({{ $brandRecognition}})</th>
                          <td class="summable" id="brandAmount">
                            @if($brandRecognition =="Yes") 50 @else 0 @endif
                          </td>
                      </tr>
                      <tr>
                          <td>Seminar Sessions 
                              <span id="seminarsessionSum"> 
                                
                               | {{$addsem + $seminarCount}} total  ({{ $addsem }} free) | {{$seminarCount}} additional sessions @ $500

                              </span>
                          </td>
                          <td class="summable" id="seminarsession"> {{$seminarCount * 500}}</td>
                      </tr>
                    </tbody>
                      <thead>
                      <tr>
                          <td class="hd">TOTAL</th>
                          <td  class="hd total" id="total">
                            $
                            @if ($plan == "A" )
                                {{ 0 + ($seminarCount * 500) + ($promoflyerPages*50) + (($brandRecognition=="Yes")?50:0)  + 2000 }}
                            @elseif ($plan == "B" && $participants->count() <= 1  )
                                {{
                                0 + ($seminarCount * 500) + ($promoflyerPages*50)+ ( ($brandRecognition=="Yes")?50:0) + 1000   
                                }}
                            @elseif  ($plan == "B" && $participants->count() > 1  )  
                                {{ 
                                (($participants->count()-1)*50) + ($seminarCount * 500) + ($promoflyerPages*50)+ ( ($brandRecognition=="Yes")?50:0) + 1000 
                                }}
                            @elseif ($plan == "C" )
                                {{ 0 + ($seminarCount * 500) + ($promoflyerPages*50) + (($brandRecognition=="Yes")?50:0)  + 500 }}
                            @endif
                          </td>
                      </tr>
                    </thead>
                  </table>


                
    


       

            

      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small  ">
    <p class="mb-1">&copy; 2021 Atlas Trailer Coach Products </p>
  </footer>
</div>





  </body>
</html>
