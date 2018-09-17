
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="../../../assets/js/jquery/jquery-2.2.4.min.js"></script>
        <style>
                    /*custom font*/
            @import url(https://fonts.googleapis.com/css?family=Montserrat);

            /*basic reset*/
            * {margin: 0; padding: 0;}

            html {
                height: 100%;
                /*Image only BG fallback*/
                
                /*background = gradient + image pattern combo*/
                background: 
                    linear-gradient(#fbb710, #f7e2af);
            }

            body {
                font-family: montserrat, arial, verdana;
            }
            /*form styles*/
            #sellerform {
                display:none;
                width: 700px;
                margin: 50px auto;
                text-align: center;
                position: relative;
            }
            #sellerform fieldset {
                display: none;
                background: white;
                border: 0 none;
                border-radius: 3px;
                box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
                padding: 20px 30px;
                box-sizing: border-box;
                width: 80%;
                margin: 0 10%;
                
                /*stacking fieldsets above each other*/
                position: relative;
            }
            /*inputs*/
            #sellerform input, #sellerform textarea {
                padding: 15px;
                border: 1px solid #ccc;
                border-radius: 3px;
                margin-bottom: 10px;
                width: 100%;
                box-sizing: border-box;
                font-family: montserrat;
                color: #2C3E50;
                font-size: 13px;
            }
            /*buttons*/
            #sellerform .action-button {
                width: 100px;
                background: #fbb710;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 1px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 5px;
            }
            #sellerform .action-button:hover, #sellerform .action-button:focus {
                box-shadow: 0 0 0 2px white, 0 0 0 3px #898272;
            }
            /*buyer form start*/
            
            /*form styles*/
            #buyerform {
                display:none;
                width: 700px;
                margin: 50px auto;
                text-align: center;
                position: relative;
            }
            #buyerform fieldset {
                display: none;
                background: white;
                border: 0 none;
                border-radius: 3px;
                box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
                padding: 20px 30px;
                box-sizing: border-box;
                width: 80%;
                margin: 0 10%;
                
                /*stacking fieldsets above each other*/
                position: relative;
            }
            /*inputs*/
            #buyerform input, #buyerform textarea {
                padding: 15px;
                border: 1px solid #ccc;
                border-radius: 3px;
                margin-bottom: 10px;
                width: 100%;
                box-sizing: border-box;
                font-family: montserrat;
                color: #2C3E50;
                font-size: 13px;
            }
            /*buttons*/
            #buyerform .action-button {
                width: 100px;
                background: #fbb710;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 1px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 5px;
            }
            #buyerform .action-button:hover, #buyerform .action-button:focus {
                box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
            }
            /*headings*/
            .fs-title {
                font-size: 15px;
                text-transform: uppercase;
                color: #2C3E50;
                margin-bottom: 10px;
            }
            .fs-subtitle {
                font-weight: normal;
                font-size: 13px;
                color: #666;
                margin-bottom: 20px;
            }
            /*buyerformprogressbar*/
            #buyerformprogressbar {
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
            }
            #buyerformprogressbar li {
                list-style-type: none;
                color: white;
                text-transform: uppercase;
                font-size: 9px;
                width: 33.33%;
                float: left;
                position: relative;
            }
            #buyerformprogressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 20px;
                line-height: 20px;
                display: block;
                font-size: 10px;
                color: #333;
                background: white;
                border-radius: 3px;
                margin: 0 auto 5px auto;
            }
            /*progressbar connectors*/
            #buyerformprogressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: white;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1; /*put it behind the numbers*/
            }
            #buyerformprogressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none; 
            }
            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            #buyerformprogressbar li.active:before,  #buyerformprogressbar li.active:after{
                background: #898272;
                color: white;
            }
            /*sellerformprogressbar*/
            #sellerformprogressbar {
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
            }
            #sellerformprogressbar li {
                list-style-type: none;
                color: white;
                text-transform: uppercase;
                font-size: 9px;
                width: 25%;
                float: left;
                position: relative;
            }
            #sellerformprogressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 20px;
                line-height: 20px;
                display: block;
                font-size: 10px;
                color: #333;
                background: white;
                border-radius: 3px;
                margin: 0 auto 5px auto;
            }
            /*progressbar connectors*/
            #sellerformprogressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: white;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1; /*put it behind the numbers*/
            }
            #sellerformprogressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none; 
            }
            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            #sellerformprogressbar li.active:before,  #sellerformprogressbar li.active:after{
                background: #898272;
                color: white;
            }
            .center{
                margin: 100px auto;
                width: 300px;
                background-color:white;
                border: 0 none;
                border-radius: 3px;
                box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
                padding: 20px 30px;
                box-sizing: border-box;
                
            }
        </style>
    </head>
    <body>
        <div class="center" id="initform">
            CREATE ACCOUNT AS
            <br>
            <br>
            <div onclick="selectAccountType('seller')">Seller</div>
            <div onclick="selectAccountType('buyer')">Buyer</div>
            
        </div>
    <!-- multistep form -->
        <form id="sellerform" method="POST">
            <!-- progressbar -->
            <ul id="sellerformprogressbar">
                <li class="active">Account Setup</li>
                <li>Personal Details</li>
                <li>Personal Details</li>
                <li>Personal Details</li>
            </ul>
            <!-- fieldsets -->
            <fieldset id="sellerformfieldset-1">
                <h2 class="fs-title">Create your account</h2>
                <h3 class="fs-subtitle">This is step 1</h3>
                <input type="text" name="Username" placeholder="Username" />
                <input type="password" name="Password" placeholder="Password" />
                <input type="password" placeholder="Confirm Password" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset id="sellerformfieldset-2">
                <h2 class="fs-title">Employee Details</h2>
                <h3 class="fs-subtitle">Your presence on the social network</h3>
                <input type="text" name="EmpFName" placeholder="First Name" />
                <input type="text" name="EmpLName" placeholder="Last Name" />
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset id="sellerformfieldset-3">
                <h2 class="fs-title">Business Details</h2>
                <h3 class="fs-subtitle">We will never sell it</h3>
                <input type="text" name="SupplierName" placeholder="Supplier Name" />
                <input type="text" name="ContactNo" placeholder="Contact Number" />
                <input type="text" name="City" placeholder="City" />
                <input type="text" name="Province" placeholder="Province" />
                <input type="text" name="Street" placeholder="Street" />
                <input type="text" name="ZipCode" placeholder="Zip Code" />
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset id="sellerformfieldset-4">
                <h2 class="fs-title">Account Settings</h2>
                <h3 class="fs-subtitle">We will never sell it</h3>
                <input type="text" name="Email" placeholder="Paypal Email" />
                <input type="text" name="DeliveryFee" placeholder="Delivery Fee" />
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="submit" name="submit" class="submit action-button" value="Submit" />
            </fieldset>
            </form>
            <form id="buyerform" method="post">
                <!-- progressbar -->
                <ul id="buyerformprogressbar">
                    <li class="active">Account Details</li>
                    <li>Social Profiles</li>
                    <li>Personal Details</li>
                </ul>
                <!-- fieldsets -->
                <fieldset id="buyerformfieldset-1">
                    <h2 class="fs-title">Create your account</h2>
                    <h3 class="fs-subtitle">This is step 1</h3>
                    <input type="text" name="Username" placeholder="Username" />
                    <input type="password" name="Password" placeholder="Password" />
                    <input type="password" placeholder="Confirm Password" />
                    <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>
                <fieldset id="buyerformfieldset-2">
                    <h2 class="fs-title">Personal Details</h2>
                    <h3 class="fs-subtitle">We will never sell it</h3>
                    <input type="text" name="BuyerFName" placeholder="First Name" />
                    <input type="text" name="BuyerLName" placeholder="Last Name" />
                    <input type="text" name="ContactNo" placeholder="Contact Number" />
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>
                <fieldset id="buyerformfieldset-3">
                    <h2 class="fs-title">Geographical Details</h2>
                    <h3 class="fs-subtitle">We will never sell it</h3>
                    <input type="text" name="Street" placeholder="Street" />
                    <input type="text" name="City" placeholder="City" />
                    <input type="text" name="Province" placeholder="Province" />
                    <input type="text" name="ZipCode" placeholder="Zip Code" />
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input type="submit" name="submit" class="submit action-button" value="Submit" />
                </fieldset>
            </form>
        <script>
            var currentPage = 1;
            var selectedForm = '';
            $(".next").click(function(){
                $(`#${selectedForm}progressbar :nth-child(${currentPage+1})`).addClass('active');
                $(`#${selectedForm}fieldset-${currentPage}`).slideToggle();
                $(`#${selectedForm}fieldset-${currentPage+1}`).slideToggle();
                ++currentPage;
            });

            $(".previous").click(function(){
                $(`#${selectedForm}progressbar :nth-child(${currentPage})`).removeClass('active');
                $(`#${selectedForm}fieldset-${currentPage}`).slideToggle();
                $(`#${selectedForm}fieldset-${currentPage-1}`).slideToggle();
                --currentPage;
            });

            $(".submit").click(function(){
                if(selectedForm=="buyerform"){
                    $.ajax({
                        method: 'post',
                        url: "../../../controllers/generic/customers_registration.php",
                        data: $(`#${selectedForm}`).serialize(),
                        success: function(result){
                            var jsonResult = JSON.parse(result);
                            console.log(jsonResult);
                            if(jsonResult.Status=='Success'){
                                window.location.href="../../../views/containers/customers/";
                            }else{

                            }
                        },
                        fail: function(result){
                            console.log(result);
                        }
                    });
                }else{
                    $.ajax({
                        method: 'post',
                        url: "../../../controllers/generic/subscribers_registration.php",
                        data: $(`#${selectedForm}`).serialize(),
                        success: function(result){
                            console.log(result);
                            var jsonResult = JSON.parse(result);
                            if(jsonResult.Status=='Success'){
                                window.location.href="../../../views/containers/subscribers/";
                            }else{

                            }
                        },
                        fail: function(result){
                            console.log(result);
                        }
                    });
                }
                return false;
            })
            function selectAccountType(type){
                accountType = type;
                $(`#initform`).css('display', 'none');
                selectedForm = `${type}form`;
                $(`#${selectedForm}`).css('display', 'block');
                $(`#${selectedForm}fieldset-${currentPage}`).css('display', 'block');
            }
        </script>
    </body>
</html>