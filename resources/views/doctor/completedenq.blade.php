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
            <h1>Completed Appointment</h1>
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
                <h3 class="card-title">Appointment List</h3>
                
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
                      <th>Description</th>
                      <th>Date & Time</th>
                      <th>slot</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($get_all_enquiry as $key => $value) { ?> 
                      <tr>
                        <td style="width: 10px">{{ $value->enquiry_id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                          <p class="tooltip-cell-width" data-container="body" data-toggle="tooltip" title="{{ $value->email }}">
                            {{ $value->email }}
                        </p>
                        </td>
                        <td>{{ $value->phone }}</td>
                        <td>
                          <p class="tooltip-cell-width" data-container="body" data-toggle="tooltip" data-html="true" title="<div class='desc_tt_cont'>{{ $value->description }}</div>">
                              {{ $value->description }}
                          </p>
                        </td>
                        <td>
                          <?php
                            if ($value->allocated_date) {
                              echo $value->allocated_date; 
                            } 
                            else {
                              echo "-";
                            }
                          ?>
                        </td>
                        <td>
                            <?php
                              if ($value->allocated_time) {
                                echo $value->allocated_time; 
                              } 
                              else {
                                echo "-";
                              }
                            ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="add_notes('<?php echo $value->enquiry_id; ?>');">Notes</button> 
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

<div class="modal fade" id="notes_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Notes</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ URL::to('/') }}/save_notes" >
          @csrf
          <div class="modal-body">
            <div class="form-group">
                <label class="control-label">
                    Notes<span class="text-danger"> *</span>
                </label>
                <div class="col-12">
                    <textarea class="form-control" required name="notes" id="notes" rows="3" placeholder="Enter Notes"></textarea>
                    <p class="text-danger" id="notes_err"></p>
                </div>
            </div>
          </div>
          <input type="hidden" id="notes_enq_id" name="notes_enq_id">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-primary">save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
      $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    });
    function add_notes(enq_id)
    {
        if(enq_id != '') {
            $.ajax({
                url: baseUrl+'/add_notes',
                type: "POST",
                async: false,
                data: {
                    enq_id: enq_id,            
                },
                success: function (res) {
                    $('#notes').val(res);
                    $('#notes_enq_id').val(enq_id);
                    $('#notes_modal').modal('show');
                }
            });
        }
    }
</script>


@endsection