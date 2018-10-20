<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Content.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Vote Ranking | Admin Page</title>

    <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/viewranking.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="../global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="../global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../global/vendor/media-match/media.match.min.js"></script>
    <script src="../global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="../global/vendor/breakpoints/breakpoints.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition dashboard" onload="moveCandidate();">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Page -->
    <div class="title">
      VOTING
      <br/>
      RESULTS
    </div>
    <div class="divider">
    </div>
        <?php
        $countComponent = 0;
        $lstUser = $clsUser->Get();
        foreach($lstUser as $mdlUser){
          $countComponent ++;
        ?>

        <div class="c-wrapper" id="C<?php echo $countComponent; ?>">
          <div class="c-style"></div>

            <?php
            $userImage = "";
            $lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"150");
            foreach($lstImage as $mdlImg){
              $userImage = $clsImage->ToLocation($mdlImg);
            }
            if($userImage != ""){
              ?>
              <img src="../<?php echo $userImage; ?>" class="c-img" />
              <?php
            }
            ?>

          <div class="firstname">
            <?php
            echo $mdlUser->getFirstName();
            ?>
          </div>
          <div class="lastname">
            <?php
            echo $mdlUser->getLastName() . " " . $mdlUser->getSuffixName();
            ?>
          </div>
          <div class="vote" id="Vote<?php echo $countComponent; ?>" >
            20,000
          </div>
          <div class="percent" id="percentDisplay<?php echo $countComponent; ?>" >
            99%
          </div>
        </div>

        <?php
        }
        ?>

    <!-- Core  -->
    <script src="../global/vendor/jquery/jquery.js"></script>

    <script>
    function moveCandidate() {
      var votes = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
      var sorted = votes.slice().sort(function(a,b){return b-a})
      var ranks = votes.slice().map(function(v){ return sorted.indexOf(v)+1 });
      var percent = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

      var total = <?php echo $clsUser->CountAllRow(); ?>;
      var containerGap = 20;
      var top = 0;
      var left = 200;

      var pos = 1;
      var elem = document.getElementById("C"+pos);

      var currentTop = elem.offsetTop;
      var currentLeft = elem.offsetLeft;
      var targetTop = 10;
      var targetLeft = 200;
      var errmove = 0;
      var id = setInterval(frame, 10);
      function frame() {
          if (currentTop > targetTop) {
            currentTop = currentTop - 5;
            elem.style.top = currentTop + 'px';
          } else if (currentTop < targetTop) {
            currentTop = currentTop + 5;
            elem.style.top = currentTop + 'px';
          }else if (currentLeft > targetLeft) {
            currentLeft = currentLeft - 5;
            elem.style.left = currentLeft + 'px';
          } else if (currentLeft < targetLeft) {
            currentLeft = currentLeft + 5;
            elem.style.left = currentLeft + 'px';
          }else if(pos <= total && errmove == 0){
            pos++;
            elem = document.getElementById("C"+pos);
            currentLeft = elem.offsetLeft;
            currentTop = elem.offsetTop;
            if ((ranks[pos-1]%2) == 0) {
              targetLeft = 520;
            }else {
              targetLeft = 100;
            }
            switch (ranks[pos-1]) {
              case 1:
                targetTop = 150;
              break;
              case 2:
                targetTop = 150;
              break;
              case 3:
                targetTop = 230;
              break;
              case 4:
                targetTop = 230;
              break;
              case 5:
                targetTop = 310;
              break;
              case 6:
                targetTop = 310;
              break;
              case 7:
                targetTop = 390;
              break;
              case 8:
                targetTop = 390;
              break;
              case 9:
                targetTop = 470;
              break;
              case 10:
                targetTop = 470;
              break;
              case 11:
                targetTop = 570;
              break;
              case 12:
                targetTop = 570;
              break;
              case 13:
                targetTop = 650;
              break;
              case 14:
                targetTop = 650;
              break;
              case 15:
                targetTop = 730;
              break;
              case 16:
                targetTop = 730;
              break;
              default:

            }
          }else{
            pos=0;
            getPercent();
          }

      }
      function getPercent(){
      console.log(votes);
          for(var voteCount = 0;voteCount < votes.length;voteCount++){
          votes[voteCount] += Math.floor((Math.random() * 100) + 10);
          }
          var totalVotes = 0;
          for(var voteCount = 0;voteCount < votes.length;voteCount++){
            totalVotes += votes[voteCount];
          }
          for(var voteCount = 1;voteCount <= votes.length;voteCount++){
            percent[voteCount-1] = Math.round(votes[voteCount-1]/totalVotes*100);
            document.getElementById("percentDisplay"+voteCount).innerHTML = percent[voteCount-1]-1 + "%";
            document.getElementById("Vote"+voteCount).innerHTML = votes[voteCount-1];
          }
          sorted = votes.slice().sort(function(a,b){return b-a})
          ranks = votes.slice().map(function(v){ return sorted.indexOf(v)+1 });
          //console.log(ranks);
      }
    }
    </script>
  </body>
</html>
