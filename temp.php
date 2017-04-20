 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Grade Breakdown</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-header"><strong>Homeworks and Assignments</strong></div>
              <div class="card-block">
                <?php
              /*    $assT=mysqli_query($mysqli, "SELECT * FROM ")
                  <table class="table table-striped table-bordered">
                    <thead>
                      <th>1</th>
                      <th>2</th>
                      <th>3</th>
                      <th>4</th>
                      <th>5</th>
                    </thead>
                  </table>
                */?>
            </div> 
          </div>
          <div class="card">
              <div class="card-header"><strong>Seatworks</strong></div>
              <div class="card-block">
                  <table class="table table-striped table-bordered">
                      <thead>
                          <th>1</th>
                          <th>2</th>
                          <th>3</th>
                          <th>4</th>
                          <th>5</th>
                      </thead></table>
              </div>
          </div>
          <div class="card">
              <div class="card-header"><strong>Quizzes</strong></div>
              <div class="card-block">
                  <table class="table table-striped table-bordered">
                      <thead>
                          <th>1</th>
                          <th>2</th>
                          <th>3</th>
                          <th>4</th>
                          <th>5</th>
                      </thead></table>
              </div>
          </div>
          <div class="card">
              <div class="card-header"><strong>Projects and Major Exams</strong></div>
              <div class="card-block">
                  <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th colspan="3"><center>Projects</center></th>
                          <th rowspan="2"><center>Midterm</center></th>
                          <th rowspan="2"><center>Periodical</center></th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                        </tr>
                      </thead>
                  </table>
              </div>
          </div>
      </div>
    </div>
    </div>

    <script>
$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar1");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>

$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar2");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>
$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar3");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>

$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar4");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>
$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar5");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>

$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar6");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>
$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar7");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>

$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar8");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>
$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar9");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>

$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar10");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
<script>
$(document).ready(function() {    
    var options = {
        scales: {
            ticks: {
                max: 100
            }
        }
    };
    var ctx = $("#bar11");
        
        // data
    var colors = getRandomColors();
    var data = {
        labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10"],
        datasets: [
            {
                label: "Grade",
                backgroundColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderColor: [
                    colors[0],
                    colors[1],
                    colors[2],
                    colors[3],
                    colors[4],
                    colors[5],
                    colors[6],
                    colors[7],
                    colors[8],
                    colors[9]
                ],
                borderWidth: 1,
                data: [90.195, 91.364, 91.423 , 90.625,90,90,90,90,90,90],
            }]

    };

    // Property Type Distribution
    propertyTypes = new Chart(ctx ,{
        type: 'bar',
        data: data,
        options: {
            scales : {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 75
                    }
                }]
            }
        }
    });

    function getRandomColors(){
        var letters = "0123456789ABCDEF";
        var color = "#";
        var colors = new Array();
        var i, j;

        for(i = 0; i < 12; i++){
            for(j = 0; j < 6; j++){
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors[i] = color;
            color = "#";
        }

        return colors;
    }

});
</script>
