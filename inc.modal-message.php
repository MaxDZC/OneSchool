<div class="modal" role="dialog" id="modal1<?php echo $row[0].$row[1];?>">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>View Class</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button onclick="studlist()" class="btn btn-md btn-primary">Student List</button>
                                            <button onclick="schedlist()" class="btn btn-md btn-secondary">Schedule List</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12" id="table"></div>
                                    </div>
                                </div>
                    </div>
                </div>        
      </div>
    </div>
  </div>