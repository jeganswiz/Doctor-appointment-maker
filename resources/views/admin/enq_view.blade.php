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
            <h1>View Enquiry</h1>
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
                <h3 class="card-title">Enquiry Details</h3>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body p-0">

                <div class="container">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $get_enq->name; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $get_enq->email; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $get_enq->phone; ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><?php echo $get_enq->description; ?></td>
                                </tr>
                                <tr>
                                    <th>Fees</th>
                                    <td><?php echo 'Rs '.number_format($get_enq->fees,2); ?></td>
                                </tr>
                                <tr>
                                    <th>Allocated date</th>
                                    <td>
                                        <?php 
                                            if ($get_enq->allocated_date) {
                                                echo date('d-m-Y',strtotime($get_enq->allocated_date)); 
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Allocated time</th>
                                    <td>
                                        <?php 
                                            if ($get_enq->allocated_time) {
                                                echo $get_enq->allocated_time; 
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment type</th>
                                    <td>
                                        <?php 
                                            if ($get_enq->payment_type) {
                                                echo $get_enq->payment_type; 
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment transaction id</th>
                                    <td>
                                        <?php 
                                            if ($get_enq->payment_transaction_id) {
                                                echo $get_enq->payment_transaction_id; 
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>
                    
                </div>
                
              </div>

              <div class="card-footer">
                <a href="javascript:;" onclick="history.back();" class="btn btn-info">Back</a>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
  
</script>
@endsection