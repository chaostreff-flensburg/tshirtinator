<!doctype html>
<html>
    <head>
    <script src="framework/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="framework/semantic.css">
        <script src="framework/semantic.js"></script>
        <meta charset="utf-8">
        <style type="text/css">
          body {
            position: relative;
            z-index: 0;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-image: url('./assets/background.jpg');
            background-repeat: repeat;
          }
          .ui.grid {
            margin: 0;
            width: 100%;
          }
          svg {
            margin: 20px auto;
            fill: #fff;
            width: 100%;
            height: 300px;
          }
          .ui.menu {
            position: relative;
            z-index: 5;
          }
        </style>
    </head>
    <body>
      <div class="ui stackable four column center aligned grid">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-176 170 488.1 255.3">
          <g id="XMLID_3030_">
          	<g id="XMLID_2391_">
          		<path id="XMLID_2465_" class="st0" d="M-31.6,218.3l25.4-23.2h34.1v20.6H-8.9v20.5h36.8v20.7h-59.5V218.3z"/>
          		<path id="XMLID_2463_" class="st0" d="M73,195.1h29.3v61.8H79.5v-41.1H57v41.1H34.3v-82.3H57v34.9L73,195.1z"/>
          		<path id="XMLID_2397_" class="st0" d="M138,256.9h-29.5v-38.6l25.5-23.2h42.4v61.8h-22.7v-14.3L138,256.9z M153.9,215.8h-22.5v20.5h22.5V215.8z"/>
          		<path id="XMLID_2394_" class="st0" d="M250.8,256.9H208l-25.2-23.1v-38.7h42.4l25.6,23.1V256.9z M205.7,236.3h22.5v-20.5h-22.5V236.3z"/>
          		<path id="XMLID_2392_" class="st0" d="M280,226.1h27.7v28.1l-25.5,23.2h-17v-20.5H285v-10.3h-27.7v-28.4l25.4-23.1h25v20.6H280V226.1z"/>
            </g>
            <g id="XMLID_2835_">
            	<path id="XMLID_2389_" class="st0" d="M-86.8,273.4l9-8.2h13.5v20.6h-22.5v38.7h-22.7V260l25.5-23.2h19.7v20.6h-22.5V273.4z"/>
        		  <path id="XMLID_2387_" class="st0" d="M-37.1,242.2v82.3h-22.7v-82.3H-37.1z"/>
            	<path id="XMLID_2384_" class="st0" d="M36,303.9v20.6h-52.3L-32,310.2v-24.4l25.4-23.1h42.5v26.7l-15.4,14.5H36z M13.2,283.4H-9.2v20.5h22.5V283.4z"/>
          		<path id="XMLID_2382_" class="st0" d="M42.2,262.8H65v14.4l15.8-14.4h29.4v61.8H87.4v-41.1H64.9v41.1H42.2L42.2,262.8L42.2,262.8z"/>
            	<path id="XMLID_2380_" class="st0" d="M139.4,293.7H167v28.1L141.5,345h-17v-20.5h19.8v-10.3h-27.7v-28.4l25.4-23.1h25v20.6h-27.7L139.4,293.7L139.4,293.7z"/>
          	</g>
            <g id="XMLID_2836_">
              <path id="XMLID_2377_" class="st0" d="M-133.4,330.4h29.4v38.7l-25.2,23.1h-42.8v-82.3h22.8v35L-133.4,330.4z M-149.2,351.1v20.5h22.5v-20.5H-149.2z"/>
            	<path id="XMLID_2375_" class="st0" d="M-29.8,392.2h-22.7v-14.4l-15.8,14.4h-29.4v-61.8h22.7v41.1h22.5v-41.1h22.7L-29.8,392.2L-29.8,392.2z"/>
          		<path id="XMLID_2372_" class="st0" d="M51.6,406.2l-16.2,14.4l-36.2-40.7v12.3h-22.6v-38.6L2,330.4h42.5v37.2l-16,14.3L51.6,406.2z M21.9,351.1H-0.6v20.5h22.5V351.1z"/>
          		<path id="XMLID_2369_" class="st0" d="M80.5,392.2H51v-38.6l25.4-23.2h42.5v67.3l-22.4,20.4l-22.9,0.2v-20.4l22.5-0.2v-19.9L80.5,392.2z M96.1,351.1H73.6v20.5h22.5V351.1z"/>
          	</g>
          </g>
        </svg>
        <div class="ui centered row">
          <div class="ui five wide large screen six wide computer eight wide tablet eight wide mobile column">
            <div class="ui raised segment">
              <form class="ui large error form" method="POST" action="">
                <div class="field">
                  <div class="ui left icon input">
                    <i class="tag icon"></i>
                    <input type="text" name="ordernumber" placeholder="Order-Number" autofocus="true" required="true">
                  </div>
                </div>
              <?php
              //set charset for php output
              header("Content-type: text/html; charset=utf-8");
              if(isset($_POST['button']))
              {
                  if(isset($_POST["ordernumber"]) && !empty($_POST["ordernumber"])) {
                     $orders = searchOrder($_POST['ordernumber']);
                     if($orders) {
                     echo '<div class="field"><table class="ui celled padded table">
                            <thead>
                              <tr>
                                <th class="single line">Order-Number</th>
                                <th>Status</th>
                                <th>Motive</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr>';
                    $iterator = 0;
                     foreach($orders as $item) {
                        
                        if($iterator == 1) {
                            $item = ($item == 1 ? "Done" : "Unfinished"); 
                        }
                       print_r(utf8_encode('<td>'.$item.'</td>'));
                       ++$iterator;
                     }
                     echo '</tr>
                     </tbody>
                     </table></div>';
                  } else { 
                    print_r('<div class="ui error message"><div class="header">Order not found!</div><p>Please check your order number. If you think this is an error, feel free to contact us!</p></div>'); 
                      
                  }
                  }
              }

              //function that crawls the csv file returning the order status
              function searchOrder($nr) {
                  //establish connection
                  $con = new mysqli(getenv('IP'), getenv('C9_USER'), "", "c9") or die("Failed to connect to MySQL: " . mysql_error());
                  //search order
                  $res = $con->query("SELECT * FROM Orders WHERE orderNumber = $nr");
                  $row = $res->fetch_assoc();
                  //return result
                  return $row;
              }
              ?>
                <div class="field">
                  <input class="ui large blue fluid submit button" type="submit" name="button" value="Check Order">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>