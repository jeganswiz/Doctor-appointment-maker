@extends('layout.front')
@section('title','Enquiry Form Page')
@section('content')
<section id="appointment" class="section">
    <!-- Container Starts -->
    <?php 
    if($enq_info->status > 1 && $enq_info->payment_transaction_id != '') { ?>
    <div class="container">
        <!-- Start Row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="contact-text section-header text-center">  
              <div>   
                <h2 class="section-title">Confirmed Appointment</h2>
                <div class="desc-text">
                  
                </div>
              </div> 
            </div>
          </div>
  
        </div>
        <!-- End Row -->
        <!-- Start Row -->
        <div class="row">
          <!-- Start Col -->
          <div class="col-lg-12 col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Confirmed Date</th>
                        <th>Confirmed Slot</th>
                        <th>Paid Amount</th>
                        <th>Payment On</th>
                        <th>Transaction Id</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $enq_info->name; ?></td>
                        <td><?php echo $enq_info->email; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($enq_info->allocated_date)); ?></td>
                        <td><?php echo $enq_info->allocated_time; ?></td>
                        <td><?php echo 'Rs '.number_format($enq_info->fees,2); ?></td>
                        <td><?php echo $enq_info->payment_type; ?></td>
                        <td><?php echo $enq_info->payment_transaction_id; ?></td>
                        <td>
                            <label class="badge badge-success">paid</label>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
          </div>
          <!-- End Col -->
          <!-- Start Col -->
            
          </div>
          <!-- End Col -->
          <!-- Start Col -->
          
          <!-- End Col -->
          <!-- Start Col -->
          <div class="col-lg-1">
          </div>
          <!-- End Col -->
  
        </div>
        <!-- End Row -->
    </div>
    <?php } else if($enq_info->status == 1) { ?>
    <div class="container">
      <!-- Start Row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="contact-text section-header text-center">  
            <div>   
              <h2 class="section-title">Confirm Appointment</h2>
              <div class="desc-text">
                <p>Hi <?php echo $enq_info->name ?>, kindly choose a slot on given date,</p>
                <p>And kindly make a online payment <span class="text-primary">₹ <?php echo $enq_info->fees; ?></span></p>
              </div>
            </div> 
          </div>
        </div>

      </div>
      <!-- End Row -->
      <!-- Start Row -->
      <div class="row">
        <!-- Start Col -->
        <div class="col-lg-6 col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control" id="date" name="date">
                    <option value="">Choose Date</option>
                    <?php foreach ($enq_date_info as $key => $value) { ?>
                        <option value="{{ $value->date }}"><?php echo date('d-m-Y',strtotime($value->date)); ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger" id="date_err"></p>
                <div class="help-block with-errors"></div>
              </div>                                 
            </div>
            
            <div class="col-md-12">
                <?php 
                    $time_slot_arr = [
                        '09.00 AM - 10.00 AM',
                        '10.00 AM - 11.00 AM',
                        '11.00 AM - 12.00 PM',
                        '12.00 PM - 01.00 PM',
                        '01.00 PM - 02.00 PM',
                        '02.00 PM - 03.00 PM',
                        '03.00 PM - 04.00 PM',
                        '04.00 PM - 05.00 PM',
                        '05.00 PM - 06.00 PM',
                        '06.00 PM - 07.00 PM',
                        '07.00 PM - 08.00 PM'
                    ];
                ?>
              <div class="form-group"> 
                @foreach ($time_slot_arr as $key => $value)
                    <button style="width:220px;margin-top:2px;" type="button" class="slot_btn btn btn-sm btn-dark" id="time_slot_{{ $key }}" onclick="select_slot({{ $key }});">{{ $value }}</button>
                @endforeach
                <p class="text-danger" id="slot_err"></p>
                <input type="hidden" name="slot" id="slot" />                
              </div>
              <div class="submit-button">
                <button class="btn btn-common" id="pay_with_stripe" onclick="appointment_pay('1');" type="button">Pay with stripe</button>
                <button class="btn btn-common" id="pay_with_razor" onclick="appointment_pay('2');" type="button">Pay with Razor</button>
                <div id="msgSubmit" class="h3 hidden"></div> 
                <div class="clearfix"></div> 
              </div>
              <p class="text-danger" id="payment_err"></p>
              <p class="text-success" id="payment_succ"></p>
            </div>
          </div>
        </div>
        <!-- End Col -->
        <!-- Start Col -->
        <div class="col-lg-1">
          
        </div>
        <!-- End Col -->
        <!-- Start Col -->
        <div class="col-lg-4 col-md-12">
          <div class="contact-img">
            <img src="{{ URL::to('/') }}/public/front/img/doctor_appointment.jpg" class="img-fluid" alt="">
          </div>
        </div>
        <!-- End Col -->
        <!-- Start Col -->
        <div class="col-lg-1">
        </div>
        <!-- End Col -->

      </div>
      <!-- End Row -->
    </div>
    <?php } ?>
</section>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    function select_slot(id)
    {
        if ($('.slot_btn').hasClass('btn-info')) {
            $('.slot_btn').removeClass('btn-info');
            $('.slot_btn').addClass('btn-dark');
        }
        $('#time_slot_'+id).removeClass('btn-dark');
        $('#time_slot_'+id).addClass('btn-info');
        var selected_slot = $('#time_slot_'+id).text();
        $('#slot').val(selected_slot);
        // alert(selected_slot);
    }
    function appointment_pay(pay_type) {
        var err = 0;
        var date = $('#date').val();
        var slot = $('#slot').val();
        var enquiry_id = '{{ $enq_info->enquiry_id }}';
        if (date == "") {
            $('#date_err').html("Date is required");
            err++;
        }
        else {
            $('#date_err').html("");
        }
        if (slot == "") {
            $('#slot_err').html("Slot is required");
            err++;
        }
        else {
            $('#slot_err').html("");
        }
        if (err == 0) {
            // pay type 1 is stripe, 2 is razorpay
            if (pay_type == '1') {
                $.ajax({
                    url: baseUrl+'/get_stripe_payment_url',
                    cache: false,
                    type: 'POST',
                    data: { enquiry_id: enquiry_id,chosen_date : date,chosen_slot : slot },
                    success: function(res){
                        // console.log(res)
                        var res_arr = JSON.parse(res);
                        console.log(res_arr);
                        if (res_arr.status && res_arr.status == true) {
                            $('#payment_err').html('');
                            window.location = res_arr.url;
                        }
                        else {
                            $('#payment_err').html('Failed to initiate payment, try again.');
                        }
                    },
                    error: (error) => {
                        $('#payment_err').html('Failed to initiate payment, try again.');
                    }
                });
            }
            else if(pay_type == '2') {
                $.ajax({
                    url: baseUrl+'/paystatusrazor',
                    type: "POST",
                    //dataType: "html",
                    data: {
                        enquiry_id: enquiry_id,chosen_date : date,chosen_slot : slot
                    },
                    success: function (response) {
                        
                        response = response.trim();
                        console.log(response);
                        //return false;
                        response = JSON.parse(response);
                        if(response.status=="true"){
                            var options = {
                                "key": response.result.keyid, // Enter the Key ID generated from the Dashboard
                                "amount": response.result.price, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                "currency": response.result.currency,
                                "name": response.result.sitename,
                                "description": response.result.sitename,
                                "image": response.result.logo,
                                "order_id": response.result.orderid, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                                "theme": {
                                    "color": "#0098F7"
                                },
                                //"callback_url": "<?php //echo $baseUrl.'/products/razorsuccess/';?>",
                                "handler": function (response){
                                    $('#cover-spin').show();
                                    console.log(response);
                                    var razorpay_payment_id = response.razorpay_payment_id;
                                    var razorpay_order_id = response.razorpay_order_id;
                                    var razorpay_signature = response.razorpay_signature;
                                    if(razorpay_payment_id && razorpay_order_id && razorpay_signature){
                                        $.ajax({
                                            url: baseUrl+'/update_razor_payment',
                                            type: "POST",
                                            //dataType: "html",
                                            data: {
                                                razorpay_payment_id: razorpay_payment_id,
                                                razorpay_order_id: razorpay_order_id,
                                                razorpay_signature: razorpay_signature,
                                                enquiry_id: enquiry_id,
                                                chosen_date : date,
                                                chosen_slot : slot
                                                
                                            },
                                            success: function (response1) {
                                                $('#cover-spin').hide();
                                                var response1 = response1.trim();
                                                if (response1 == '1') {
                                                    $('#payment_succ').html("Payment completed, slot booked successfully");
                                                    setTimeout(function () {
                                                        $('#payment_succ').html('');
                                                        location.reload();
                                                    }, 2000);
                                                }
                                                else {
                                                    $('#payment_err').html('Failed to initiate payment, try again.');
                                                    setTimeout(function () {
                                                        $('#payment_err').html('');
                                                    }, 2000);
                                                }
                                                
                                            }
                                        });
                                    }
                                }
                            };

                            var rzp1 = new Razorpay(options);
                            rzp1.open();
                        }else{
                            $('#payment_err').html('Failed to initiate payment, try again.');
                            setTimeout(function () {
                                $('#payment_err').html('');
                            }, 1500);
                            return false;
                        }
                    }
                    });
            }
        }
    }
</script>
@endsection