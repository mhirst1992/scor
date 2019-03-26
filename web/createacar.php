<div class="card my-2">
        <div class="card-body">
          <h5 class="card-title">Design your Car</h5>
          <hr>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval=false>
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="height: 180px;">
              <div class="carousel-item active">
                <img class="d-block w-100" src="https://nascar-galleries.s3.amazonaws.com/gallery-images/2018/04/18/big_thumbnail/41kurt_busch_2018_HaasAutomationEnergyFord_Richmond_1200x520.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://nascar-galleries.s3.amazonaws.com/gallery-images/2018/02/28/big_thumbnail/19daniel_suarez_2018_Coca-Cola_LasVegas_1200x520.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="https://nascar-galleries.s3.amazonaws.com/gallery-images/2018/08/29/big_thumbnail/14clint_bowyer_2018_CarolinaFordDealers_Darlington_1200x520.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" style="background-color:lightgrey;" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" style="background-color:lightgrey;" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <hr>
          <div class="input-group w-100 pb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="">Primary</span>
            </div>
            <div class="input-group-append w-50">
              <input class="w-100" style="height:50px; border: none;" type="color" id="color1" value="#121212" onchange="ColorChanged(1)">
            </div>
          </div>
          <div class="input-group w-100 pb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="">Secondary</span>
            </div>
            <div class="input-group-append w-50">
              <input class="w-100" style="height:50px; border: none;" type="color" id="color2" value="#d71e39" onchange="ColorChanged(2)">
            </div>
          </div>
          <div class="input-group w-100 pb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="">Alternate</span>
            </div>
            <div class="input-group-append w-50">
              <input class="w-100" style="height:50px; border: none;" type="color" id="color3" value="#9fef34" onchange="ColorChanged(3)">
            </div>
          </div>
          <div class="input-group w-100 pb-1">
            <div class="input-group-prepend w-50">
              <span class="input-group-text w-100" id="">Text Color</span>
            </div>
            <div class="input-group-append w-50">
              <input class="w-100" style="height:50px; border: none;" type="color" id="color4" value="#f3f3f3" onchange="ColorChanged(4)">
            </div>
          </div>
          <div class="input-group mb-1">
            <div class="input-group-prepend w-50">
              <label class="input-group-text w-100" for="fontDD">Font</label>
            </div>
            <select class="custom-select" id="fontDD">
              <option selected>Choose...</option>
              <option value="1">Font 1</option>
              <option value="2">Font 2</option>
              <option value="2">Font 3</option>
              <option value="2">Font 4</option>
            </select>
          </div>
         
          
        </div><!-- End of Card-Body -->
      </div><!-- End of Card -->
      
      
      
      <script>
          
          
          function ColorChanged(colornum){
    colval = document.getElementById("color"+colornum).value;
    console.log(colornum + "Changed to " + colval);
}
      </script>