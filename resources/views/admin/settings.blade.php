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
            <h1>General settings</h1>
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
                <h3 class="card-title">Update Settings</h3>
              </div>
              <!-- /.card-header -->
              <form method="POST" action="{{ URL::to('/') }}/admin/update_settings">
                @csrf
              <div class="card-body ">

                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Site name</label>
                                <input type="text" class="form-control" name="site_name" required placeholder="Enter Site Name" value="<?php echo $settings->sitename; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Default Fees</label>
                              <input type="text" class="form-control" name="default_fees" required placeholder="Enter Default Fees" value="<?php echo $settings->default_fees; ?>">
                          </div>
                      </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">SMTP Port</label>
                                <input type="text" class="form-control" name="smtp_port" required placeholder="Enter SMTP Port" value="<?php echo $settings->smtpport; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">SMTP Host</label>
                                <input type="text" class="form-control" name="smtp_host" required placeholder="Enter SMTP Host" value="<?php echo $settings->smtphost; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">SMTP Email</label>
                                <input type="text" class="form-control" name="smtp_email" required placeholder="Enter SMTP Email" value="<?php echo $settings->smtpemail; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">SMTP Password</label>
                                <input type="password" class="form-control" name="smtp_password" required placeholder="Enter SMTP Password" value="<?php echo $settings->smtppassword; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row">
                        <?php 
                            $stripe_keys = json_decode($settings->stripe_keys);
                            $razor_keys = json_decode($settings->razor_keys);
                        ?>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stripe Public key</label>
                                <input type="text" class="form-control" name="str_pub" required placeholder="Enter Stripe Public key" value="<?php echo $stripe_keys->Stripe_Public_Key; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stripe Private key</label>
                                <input type="text" class="form-control" name="str_pri" required placeholder="Enter Stripe Private key" value="<?php echo $stripe_keys->Stripe_Private_Id; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Razor Public key</label>
                                <input type="text" class="form-control" name="raz_pub" required placeholder="Enter Razor Public key" value="<?php echo $razor_keys->razorPublicKey; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Razor Private key</label>
                                <input type="text" class="form-control" name="raz_pri" required placeholder="Enter Razor Private key" value="<?php echo $razor_keys->razorPrivateKey; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    
                </div>
                
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-info">Update</button>
              </div>
              </form>
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