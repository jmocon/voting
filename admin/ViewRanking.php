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
    <link rel="stylesheet" href="../global/css/bootstrap.min.css">
    <link rel="stylesheet" href="../global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="assets/css/viewranking.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="../global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="../global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="../global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="../global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="../global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="../global/vendor/jquery-mmenu/jquery-mmenu.css">
    <link rel="stylesheet" href="../global/vendor/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="../global/vendor/chartist/chartist.css">
        <link rel="stylesheet" href="../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
        <link rel="stylesheet" href="../global/vendor/aspieprogress/asPieProgress.css">
        <link rel="stylesheet" href="../global/vendor/jquery-selective/jquery-selective.css">
        <link rel="stylesheet" href="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
        <link rel="stylesheet" href="../global/vendor/asscrollable/asScrollable.css">
        <link rel="stylesheet" href="../assets/examples/css/dashboard/team.css">


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
    <div class="page">
      <div class="page-content container-fluid">
        <?php
        $countComponent = 0;
        $lstUser = $clsUser->Get();
        foreach($lstUser as $mdlUser){
          $countComponent ++;
        ?>
        <div id="C<?php echo $countComponent; ?>" style="height:200px;width:500px;position:absolute;top:0px;left:0px;">

          <div class="row">
            <div class="col-sm-12">
              <div class="card card-shadow card-completed-options">
                <div class="card-block p-30">
                  <div class="row">
                    <div class="col-3">
                      <?php
                      $userImage = "";
                      $lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"150");
                      foreach($lstImage as $mdlImg){
                        $userImage = $clsImage->ToLocation($mdlImg);
                      }
                      if($userImage != ""){
                        ?>
                        <img src="../<?php echo $userImage; ?>" class="img-fluid" style="max-height:150px;" />
                        <?php
                      }
                      ?>
                    </div>
                    <div class="col-6">
                      <div class="row pl-3">
                        <div class="col-12 font-size-20">
                          <?php
                          echo $mdlUser->getFirstName();
                          ?>
                        </div>
                        <div class="col-12 counter-label font-size-30 font-weight-bold">
                          <?php
                          echo $mdlUser->getLastName() . " " . $mdlUser->getSuffixName();
                          ?>
                        </div>
                        <div class="col-12 counter-number font-size-30" id="Vote<?php echo $countComponent; ?>">
                          12,345
                        </div>
                      </div>
                    </div>
                    <div class="col-3">
                      <h1  id="percentDisplay<?php echo $countComponent; ?>">
                        50%
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>


    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="../global/vendor/jquery/jquery.js"></script>
    <script src="../global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="../global/vendor/bootstrap/bootstrap.js"></script>
    <script src="../global/vendor/animsition/animsition.js"></script>
    <script src="../global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="../global/vendor/asscrollable/jquery-asScrollable.js"></script>

    <!-- Plugins -->
    <script src="../global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
    <script src="../global/vendor/switchery/switchery.js"></script>
    <script src="../global/vendor/intro-js/intro.js"></script>
    <script src="../global/vendor/screenfull/screenfull.js"></script>
    <script src="../global/vendor/slidepanel/jquery-slidePanel.js"></script>
        <script src="../global/vendor/chartist/chartist.js"></script>
        <script src="../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js"></script>
        <script src="../global/vendor/aspieprogress/jquery-asPieProgress.js"></script>
        <script src="../global/vendor/matchheight/jquery.matchHeight-min.js"></script>
        <script src="../global/vendor/jquery-selective/jquery-selective.min.js"></script>
        <script src="../global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>

    <!-- Scripts -->
    <script src="../global/js/Component.js"></script>
    <script src="../global/js/Plugin.js"></script>
    <script src="../global/js/Base.js"></script>
    <script src="../global/js/Config.js"></script>

    <script src="../assets/js/Section/Menubar.js"></script>
    <script src="../assets/js/Section/Sidebar.js"></script>
    <script src="../assets/js/Section/PageAside.js"></script>
    <script src="../assets/js/Section/GridMenu.js"></script>

    <!-- Config -->
    <script src="../global/js/config/colors.js"></script>
    <script src="../assets/js/config/tour.js"></script>
    <script>Config.set('assets', '../assets');</script>

    <!-- Page -->
    <script src="../assets/js/Site.js"></script>
    <script src="../global/js/Plugin/asscrollable.js"></script>
    <script src="../global/js/Plugin/slidepanel.js"></script>
    <script src="../global/js/Plugin/switchery.js"></script>
        <script src="../global/js/Plugin/matchheight.js"></script>
        <script src="../global/js/Plugin/aspieprogress.js"></script>
        <script src="../global/js/Plugin/bootstrap-datepicker.js"></script>
        <script src="../global/js/Plugin/asscrollable.js"></script>

        <script src="../assets/examples/js/dashboard/team.js"></script>

    <script>
    function moveCandidate() {
      var votes = [0,0,0];
      var sorted = votes.slice().sort(function(a,b){return b-a})
      var ranks = votes.slice().map(function(v){ return sorted.indexOf(v)+1 });
      var percent = [0,0,0];

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
      var id = setInterval(frame, 20);
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
          }else if(pos <= total){
            console.log("C"+pos);
            pos++;
            elem = document.getElementById("C"+pos);
            currentTop = elem.offsetTop;
            currentLeft = elem.offsetLeft;
            targetTop = ((ranks[pos-1]-1)*200)+(ranks[pos-1]*10);
          }else{
            pos=0;
            getPercent();
          }

      }
      function getPercent(){
          votes[0] += Math.floor((Math.random() * 100) + 10);
          votes[1] += Math.floor((Math.random() * 100) + 10);
          votes[2] += Math.floor((Math.random() * 100) + 10);
          var totalVotes = 0;
          for(var voteCount = 0;voteCount < votes.length;voteCount++){
            totalVotes += votes[voteCount];
          }
          for(var voteCount = 1;voteCount <= votes.length;voteCount++){
            percent[voteCount-1] = Math.round(votes[voteCount-1]/totalVotes*100);
            document.getElementById("percentDisplay"+voteCount).innerHTML = percent[voteCount-1] + "%";
            document.getElementById("Vote"+voteCount).innerHTML = votes[voteCount-1];
          }
          sorted = votes.slice().sort(function(a,b){return b-a})
          ranks = votes.slice().map(function(v){ return sorted.indexOf(v)+1 });
          console.log(ranks);
      }
    }
    </script>
  </body>
</html>
