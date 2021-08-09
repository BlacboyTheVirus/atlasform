<?php
//require "DataManager.php";


use Dompdf\Dompdf;
class Atlas
{

   

    public static function regMail($vendor)
    {
        $application = DataManager::query("application","*","vendor_id={$vendor->id}");
        $application = $application[0];
        $vendorDetails = DataManager::query("vendor_details","*","vendor_id={$vendor->id}");
        $vendorDetails = $vendorDetails[0];
        $hotSpecials = DataManager::query("hot_special","*","application_id={$application->id}");
        $freeSpecials = DataManager::query("free_special","*","application_id={$application->id}");
        $participants = DataManager::query("participants","*","application_id={$application->id}");
        $presenters = DataManager::query("presenter","*","application_id={$application->id}",[],"type ASC");
        $seminar_days = DataManager::query("seminar_days","*","application_id={$application->id}");

        $cost = $application->plan =="A"?2000:($application->plan=="B"?1000:500);
        $prt =  ($application->plan =="A"?0:($application->plan=="B"?(count($participants)<=1?0:count($participants)-1):count($participants)))*50;
        $sem =  ($application->plan =="A"?(count($seminar_days)<=2?0:count($seminar_days)-2):($application->plan=="B"?(count($seminar_days)<=1?0:count($seminar_days)-1):count($seminar_days)))*500;
        $brnd = $application->brand_recognition=="yes"?50:0;
        $promotional_flyer = $application->promotional_flyer*50;
        $total = $promotional_flyer+$cost+$brnd+$sem+$prt;
        $dating = ["s30"=>"1/3-30,60, 90 Days","60"=>"60 days","90"=>"90 days","sothers"=>$application->dating];
        $incentives = ["s1"=>"1% Rebate.","s5"=>"5% Rebate.","s25"=>"25% Rebate."];




        $to = $vendor->primary_email;
        $from = 'info@atlasvirtualshow.com';
        
        $subject = '2022 Atlas Virtual Show Registration';

        
// To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            // "CC: habib.michael23@gmail.com". "\r\n" .
            //"BC: wisewindx@gmail.com". "\r\n" .
            'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
        $message = '<html><link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<body>';
        $message .= "<center><img align='center' width='640' src='' alt=''></center>";
        $message .="<table class=\"table table-bordered\"  style=\"font-size: 14px;\" border='1' width='100%' cellspacing='0'>
            <tr>
                <th>Name of Company: </th>
                <td>{$vendor->company_name}</td>
                <th>Primary Email : </th>
                <td>{$vendor->primary_email}</td>
            </tr>
            <tr>
                <th>Country: </th>
                <td>{$vendorDetails->country}</td>
                <th>State/Province</th>
                <td>{$vendorDetails->state}</td>
            </tr>
            <tr>
                <th>City: </th>
                <td>{$vendorDetails->city}</td>
                <th>Zip/Postal Code</th>
                <td>{$vendorDetails->zip}</td>
            </tr>
            <tr>
                <th>Primary Contact: </th>
                <td>{$vendorDetails->contact_person}</td>
                <th>Telephone: </th>
                <td>{$vendorDetails->telephone}</td>
            </tr>
            <tr>
                <th>Mobile: </th>
                <td>{$vendorDetails->mobile}</td>
                <th>Fax: </th>
                <td>{$vendorDetails->fax}</td>
            </tr>
            <tr>
                <th>Address: </th>
                <td colspan='3'>{$vendorDetails->company_address}</td>
            </tr>
            </table>
            
       
             <table  class='table table-bordered table-condensed' border='1' width='100%' cellspacing='0'>
                <tr>
                    <th colspan='4'>
                        Additional Users: 
                    </th>
                </tr>";
        $i=0;
        foreach ($participants as $participant){
            $i++;
            $message .="
                    <tr>
                        <td>$i</td>
                        <td>{$participant->name} </td>
                        <td>{$participant->email} </td>
                        <td>{$participant->cell} </td>
                    </tr>";
        }
        $message .="</table> 
        
                <table class='table table-bordered table-condensed' border='1' width='100%' cellspacing='0'>
                    <tr>
                        <th colspan='4'>Show Discount: </th>
                        <td>{$application->discount} %</td>
                        
                    </tr>
                </table>";

        $message .="
            <table  class='table table-bordered table-condensed' border='1' width='75%'  cellspacing='0'>
                <tr>
                   
                    <th>Special Dating Terms</th>
                    <td>".(isset($dating["s".$application->dating])?$dating["s".$application->dating]:$application->dating)."</td>
                </tr>
            </table>
            <table  class='table table-bordered table-condensed' border='1' width='100%'  cellspacing='0'>
                <tr>
                    <th>1st Show buy (by December 23, 2021): </th>
                    <td>{$application->showbuy_1}</td>
                    <th>2nd Show buy (by March 31, 2022): </th>
                    <td>{$application->showbuy_2}</td>
                </tr>
            </table>
            <table  class='table table-bordered table-condensed' border='1' width='75%'  cellspacing='0'>
            <tr>
                <th>Dealer Incentive Program. Do you want to support the “Atlas Show Buck Program” as follows?</th>
                <td>".($application->incentive=="others"?$application->incentiveInput:$incentives["s$application->incentive"])."</td>
                <th>Promotional Flyer @ $50.00 EA</th>
                <td>
                ";
        $message.=($application->promotional_flyer=="0"?"No":$application->promotional_flyer);
        $message .="</td>
            </tr>
            </table>
            <table  class='table table-bordered table-condensed' border='1' width='75%' cellspacing='0'>
                <tr>
                    <th>Brand Recognition: </th>
                    <td>{$application->brand_recognition}</td>
                    
                </tr>
            </table>
            <table  class='table table-bordered table-condensed' border='1' width='75%' cellspacing='0'>
                <tr>
                    <th colspan='3'>\"Hot Buy\" Special(s):</th>
                </tr>";
        $message .= count($hotSpecials)?"
                  <tr>
                            <th>Vendor</th>
                            <th>Description</th>
                            <th>Net Cost % Discount</th>
                        </tr>":"";

        foreach ($hotSpecials as $hotSpecial){
            $message.="<tr>
                                <td>{$hotSpecial->vendor} </td>
                                <td>{$hotSpecial->description} </td>
                                <td>{$hotSpecial->net_cost} </td>
                            </tr>";
        }

        $message .="
            </tr>
            </table>
            <table  class='table table-bordered table-condensed' border='1' width='100%' cellspacing='0'>
                <tr>
                    <th>Free Product Special: </th>
                    <td>";
        $message .=count($freeSpecials)?"<ul>":"";
        foreach ($freeSpecials as $freeSpecial){
            $message.="<li>{$freeSpecial->free_special}</li>";
        }
        $message .= count($freeSpecials)?"</ul>":"";
        $message .= "</td>
                </tr>
            </table>
            <table  class='table table-bordered table-condensed' border='1' width='100%' cellspacing='0'>
            <tr>
                <th colspan='4'>Seminar Presenters: </th>
            </tr>";
        $message .=count($presenters)?"
                        <tr> <th>Name</th>
                            <th>E-mail</th>
                            <th>Cell</th>
                            <th>Role</th>
                        </tr>":"";
        foreach ($presenters as $presenter){
            $message .="
                <tr>
                    <td>{$presenter->name} </td>
                    <td>{$presenter->email} </td>
                    <td>{$presenter->cell} </td>
                    <td>{$presenter->type} </td>
                </tr>";
        }

        $message .="</table><table  class='table table-bordered table-condensed' border='1' width='100%' cellspacing='0'>
                        <tr>
                        <th>Seminars: </th>
                        </tr>
                        <tr>
                        <td colspan='3'>
                            <ul>";
        foreach ($seminar_days as $seminar_day){
            $message .= "<li>{$seminar_day->session} Session {$seminar_day->date}th Nov (MST)</li>";
        }
        $message .= "</ul>
                        </td></tr>
                        ";
        $message .=  "
            </table>
            <table class='table table-bordered table-condensed' border='1' width='100%' cellspacing='0'>
                <tr>
                    <th >Show Cost</th>
                    <td >
                        <table  class='table table-bordered table-condensed'  cellspacing='0'>
                            <tr>
                                <td>Registration Level : = <b>Class $application->plan ( $cost)</b></td>
                                <td class=\"text-right\">$  $cost</td>
                            </tr>
                            <tr>
                                <td>Virtual Show Participants</td>
                                <td class=\"text-right\">$  $prt</td>
                            </tr>
                            <tr>
                                <td>Promotional Flyers</td>
                                <td class=\"text-right\">$ $promotional_flyer</td>
                            </tr>
                            <tr>
                                <td>Brand Recognition</td>
                                <td class=\"text-right\">$ $brnd</td>
                            </tr>
                            <tr>
                                <td>Seminar Sessions</td>
                                <td class=\"text-right\">$  $sem</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td class=\"text-right\">$  $total</td>
                            </tr>
    
                        </table>
                    </td>
                </tr>
        </table>";
        $message .= '</body></html>';




        

        $dompdf = new Dompdf();
        $dompdf->loadHtml($message);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('Letter', 'Portrait');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        //$dompdf->stream();
        file_put_contents("registration/".$vendor->company_name.".pdf", $dompdf->output());


        require 'mailer/Exception.php';
        require 'mailer/PHPMailer.php';
        require 'mailer/SMTP.php';
        $mail = new PHPMailer(true);
        $mail2 = new PHPMailer(true);

        try {
            //Recipients
            $mail->setFrom($from, 'Atlas Admin');
            $mail2->setFrom($from, 'System');
            $mail->addAddress($to, $vendorDetails->contact_person);     // Add a recipient
            $mail2->addAddress('michael.habib@atlastrailer.com', "Michael Habib");     // Add a recipient
            $mail->addReplyTo($from, 'Atlas Admin');

            // Attachments
            $mail->addAttachment('registration/'.$vendor->company_name.".pdf");         // Add attachments

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail2->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail2->Subject = $subject;
            $mail->Body    = "<p>Your registration was sucessful.</p>";
            $mail2->Body    = "<h1>Hello Admin</h1><p>The contact person for {$vendor->company_name} in person of {$vendorDetails->contact_person} has just registered a plan for the company he/she represents.</p>";

            $mail->send();
            $mail2->send();
            return  'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }

    public static function reports($where=[])
    {
        $_where_ ="";
        if(!empty($where)){
//            foreach (){
//
//            }
        }
        return DataManager::rawQuery("SELECT vendors.vendor_code,vendors.company_name,vendors.primary_email,application.plan,application.discount,application.dating,application.showbuy_1,application.showbuy_2,application.incentive,application.incentiveInput,application.promotional_flyer,application.brand_recognition,application.brand_promotion,vendor_details.company_address,vendor_details.country,vendor_details.state,vendor_details.city,vendor_details.zip,vendor_details.zip,vendor_details.contact_person,vendor_details.telephone,vendor_details.mobile,vendor_details.fax,vendors.id as vendor_id,GROUP_CONCAT(DISTINCT CONCAT(participants.name, '-',participants.email,'-',participants.cell) ORDER BY participants.id DESC SEPARATOR '~ ') AS participants,GROUP_CONCAT(DISTINCT CONCAT(presenter.name, '-',presenter.email,'-',presenter.cell,'-',presenter.type) ORDER BY presenter.type ASC SEPARATOR '~ ') AS presenter,GROUP_CONCAT(DISTINCT CONCAT(hot_special.vendor, '-',hot_special.description,'-',hot_special.net_cost) ORDER BY hot_special.vendor ASC SEPARATOR '~ ') AS hot_special,GROUP_CONCAT(DISTINCT free_special.free_special ORDER BY free_special.id DESC SEPARATOR '~ ') AS free_special,GROUP_CONCAT(DISTINCT CONCAT(seminar_days.session,' ',seminar_days.date,' NOV') ORDER BY seminar_days.session ASC SEPARATOR '~ ') AS seminar
            FROM vendors 
            JOIN vendor_details ON vendors.id=vendor_details.vendor_id 
            JOIN application ON application.vendor_id=vendors.id 
            LEFT JOIN participants ON participants.application_id=application.id 
            LEFT JOIN presenter ON presenter.application_id=application.id 
            LEFT JOIN hot_special ON hot_special.application_id=application.id 
            LEFT JOIN free_special ON free_special.application_id=application.id
            LEFT JOIN seminar_days ON seminar_days.application_id=application.id 
            GROUP BY vendors.id ");

    }

    public static function mostOf()
    {
        $presenter = DataManager::rawQuery("SELECT COUNT(id) AS count FROM presenter GROUP BY application_id ORDER BY count DESC");
        $hot_special = DataManager::rawQuery("SELECT COUNT(id) AS count FROM hot_special GROUP BY application_id ORDER BY count DESC");
        $free_special = DataManager::rawQuery("SELECT COUNT(id) AS count FROM free_special GROUP BY application_id ORDER BY count DESC");
        $participant = DataManager::rawQuery("SELECT COUNT(id) AS count FROM participants GROUP BY application_id ORDER BY count DESC");

        $presenter = count($presenter)?$presenter[0]->count:0;
        $hot_special = count($hot_special)?$hot_special[0]->count:0;
        $free_special = count($free_special)?$free_special[0]->count:0;
        $participant = count($participant)?$participant[0]->count:0;

        return ["presenter"=>$presenter,"hot_special"=>$hot_special,"free_special"=>$free_special,"participant"=>$participant];
    }

    public static function totals()
    {
        return DataManager::rawQuery("SELECT 
                application.plan AS plan,
                IF(application.plan='A',2000,IF(application.plan='B',1000,500)) AS planCost,
                (SELECT COUNT(id) FROM presenter WHERE presenter.application_id=application.id) as presenters,
                (SELECT COUNT(id) FROM seminar_days WHERE seminar_days.application_id=application.id) as seminar_days,
                (SELECT COUNT(id) FROM participants WHERE participants.application_id=application.id) AS participants,
                IF(application.brand_recognition='yes',50,0) AS brand_recognition,
                (application.promotional_flyer*50) as promotional_flyer
                
                FROM vendors 
                JOIN application ON application.vendor_id=vendors.id 
                WHERE 1 
                GROUP BY vendors.id");
    }

    public static function total($id)
    {
        return DataManager::rawQuery("SELECT 
                application.plan AS plan,
                IF(application.plan='A',2000,IF(application.plan='B',1000,500)) AS planCost,
                (SELECT COUNT(id) FROM presenter WHERE presenter.application_id=application.id) as presenters,
                (SELECT COUNT(id) FROM seminar_days WHERE seminar_days.application_id=application.id) as seminar_days,
                (SELECT COUNT(id) FROM participants WHERE participants.application_id=application.id) AS participants,
                IF(application.brand_recognition='yes',50,0) AS brand_recognition,
                (application.promotional_flyer*50) as promotional_flyer
                
                FROM vendors 
                JOIN application ON application.vendor_id=vendors.id 
                WHERE vendors.id='$id' 
                GROUP BY vendors.id")[0];
    }

    public static function grandTotals()
    {
        $totals = self::totals();
        $grand = 0;
        foreach ($totals as $total){
            $participants = ($total->plan =="A"?0:($total->plan=="B"?($total->participants<=1?0:$total->participants-1):$total->participants))*50;;
            $sem =  ($total->plan =="A"?($total->seminar_days<=2?0:$total->seminar_days-2):($total->plan=="B"?($total->seminar_days<=1?0:$total->seminar_days-1):$total->seminar_days))*500;
            $sem =  $sem<0?0:$sem;
            $grand += ($total->planCost + $total->brand_recognition + $total->promotional_flyer + $sem + $participants);
        }
        return $grand;
    }
}