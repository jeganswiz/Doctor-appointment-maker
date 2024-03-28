@extends('layout.master')
@section('content')
<style>
  .tooltip-inner {
    max-width: 100% !important;
  }
  .tooltip-cell-width{
    max-width: 75px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
  }
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Enquiry</h1>
          </div>
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol> -->
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::has('enq_message'))
          <div class="row">
            <div class="col-12">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('enq_message') }}
              </div>
            </div>
          </div>
        @endif
          
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Enquiry List</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Date</th>
                      <th>Slot</th>
                      <th>Action</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_all_enquiry as $key => $value) { ?> 
                      <tr>
                        <td style="width: 10px">{{ $value->enquiry_id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                          <p data-container="body" data-toggle="tooltip" title="{{ $value->email }}">
                            {{ $value->email }}
                          </p>
                        </td>
                        <td>{{ $value->phone }}</td>
                        <td>
                          <?php
                            if ($value->allocated_date) {
                              echo date("d-m-Y",strtotime($value->allocated_date)); 
                            } 
                            else {
                              echo "-";
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if ($value->allocated_time) { ?>
                              
                              <p data-container="body" data-toggle="tooltip" title="{{ $value->allocated_time }}">
                                {{ $value->allocated_time }}
                              </p>
                            <?php } 
                            else {
                              echo "-";
                            }
                          ?>
                        </td>
                        <td>
                          <?php 
                            if($value->status == 0) { ?>
                              <button type="button" class="btn btn-info" onclick="set_optional_dates('<?php echo $value->enquiry_id; ?>');">Proceed</button>
                          <?php  } 
                            else if($value->status == 1) {
                          ?>
                            <button type="button" class="tooltip-cell-width btn btn-warning" style="max-width: 90px !important;" data-container="body" data-toggle="tooltip" title="Waiting for payment">Waiting for payment</button>
                          <?php  } 
                            else if($value->status == 2) {
                          ?>
                            <button type="button" class="tooltip-cell-width btn btn-primary" style="max-width: 90px !important;" data-container="body" data-toggle="tooltip" title="Confirm payment" onclick="confirm_payment('<?php echo $value->enquiry_id; ?>');">Confirm</button>
                          <?php  } 
                            else if($value->status == 3) {
                          ?>
                            <button type="button" class="btn btn-success" data-container="body" data-toggle="tooltip" title="Moved to Doctor">Approved</button>
                          <?php } ?>
                        </td>
                        <td>
                          <a href="{{ URL::to('/') }}/admin/view_enquiry/{{ base64_encode($value->enquiry_id) }}" class="btn btn-info" ><i class="fas fa-eye"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-10">
                    
                  </div>
                  <div class="col-2">
                    {!! $get_all_enquiry->links("pagination::bootstrap-4") !!}
                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="update_date_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Dates</h4>
        <button type="button" class="close" onclick="close_update_dates_modal();" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ URL::to('/') }}/add_enquiry_optional_dates" onsubmit="return validate_dates();">
        @csrf
        <div class="modal-body">
          <div class="form-group">
              <label class="control-label">
                  Choose Appointment Dates<span class="text-danger"> *</span>
              </label>
              <div class="col-12">
                  <input type="text" id="yearPicker" name="dates" class="form-control input-sm" data-role="tagsinput" >
                  <p class="text-danger" id="date_err"></p>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label">
                  Fees<span class="text-danger"> *</span>
              </label>
              <div class="col-12">
                  <input type="text" id="enquiry_fees" name="enquiry_fees" class="form-control input-sm"  value="">
                  <p class="text-danger" id="fees_err"></p>
              </div>
          </div>
        </div>
        <input type="hidden" name="enquiry_id" id="enquiry_id" value="" />
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" onclick="close_update_dates_modal();">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="confirm_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Make sure, you want to do this action ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ URL::to('/') }}/update_status" >
        @csrf
        <!-- <div class="modal-body">
          <div class="row">
            <div class="container">
              <h6></h6>
            </div>
          </div>
        </div> -->
        <input type="hidden" id="confirm_enq_id" name="confirm_enq_id">
        <input type="hidden" id="confirm_status" name="confirm_status">
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  var chosen_dates = [];
  $(document).ready(function() {
      
      $("body").tooltip({ selector: '[data-toggle=tooltip]' });
      // alert('hii')
      $('#yearPicker').tagsinput({
          maxTags: 4,
          typeaheadjs: {
              minViewMode: 2,
              multidate: true,
              endDate: '+0y',
          }
      });
      $('#yearPicker').on('beforeItemRemove', function(event) {
        var index = chosen_dates.indexOf(event.item);
        if (index !== -1) {
          chosen_dates.splice(index, 1);
        }
        if (chosen_dates.length < 4) {
          $( '.bootstrap-tagsinput input[type="text"]' ).datepicker( "option", "disabled", false );
        }
        console.log(chosen_dates);
      });
      $('.bootstrap-tagsinput input[type="text"]').datepicker({
          minDate : 0,
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          multidate: true,
          endDate: '+0y',
          dateFormat: 'dd-mm-yy',
          onSelect: function(dateText) {
            // console.log(chosen_dates.length);
            if (chosen_dates.length >= 3) {
              $( '.bootstrap-tagsinput input[type="text"]' ).datepicker( "option", "disabled", true );
              $('#date_err').html('You can choose only 4 dates');
            }
            if (chosen_dates.length >= 4) {
              // alert('hi');
              
            }
            else {
              // alert('hii');
              if (chosen_dates.includes(dateText) === false) {
                chosen_dates.push(dateText);
              }
              else if(chosen_dates.length == 0) {
                chosen_dates.push(dateText);
              }
              $('#yearPicker').tagsinput('add', dateText);
              $('.bootstrap-tagsinput input[type="text"]').datepicker('setDate', null);
            }
            // console.log(chosen_dates);
        }
      });

  });
  function close_update_dates_modal() {
    $('#update_date_modal').modal('toggle');
    // location.reload();
  }
  function set_optional_dates(id) {
    $('#enquiry_id').val(id);
    $('#update_date_modal').modal('show');
    $('#enquiry_fees').val(avg_fees);
  }
  $('#enquiry_fees').keyup(function(){
      var val = $(this).val();
      if(isNaN(val)){
          val = val.replace(/[^0-9\.]/g,'');
          if(val.split('.').length>2) 
              val =val.replace(/\.+$/,"");
      }
      $(this).val(val); 
  });
  function validate_dates() {
    var err = 0;
    var price = $('#enquiry_fees').val();
    // console.log(yearPicker);
    if (price.trim() == '') {
      $('#fees_err').html('Fees required!');
      err++;
    }
    else {
      $('#fees_err').html('');
    }
    if (chosen_dates.length == 0) {
      $('#date_err').html('Date required!');
      err++;
    }
    else {
      $('#date_err').html('');
    }

    if (err > 0) {
      return false;
    }
    else {
      return true;
    }
  }
  function confirm_payment(id)
  {
    $('#confirm_modal').modal('show');
    $('#confirm_enq_id').val(id);
    $('#confirm_status').val('3');
  }
</script>
@endsection