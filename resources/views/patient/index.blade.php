@extends('layout.front')
@section('title','Enquiry Form Page')
@section('content')
<section id="contact" class="section">
    <!-- Container Starts -->
    <div class="container">
      <!-- Start Row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="contact-text section-header text-center">  
            <div>   
              <h2 class="section-title">Enquiry Form</h2>
              <div class="desc-text">
                <p>Once your enquiry will confirmed, we will send a email to your attention, </p>
                <p>so kindly provide valid contact details</p>
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
        <form id="contactForm" method="POST" action="{{ URL::to('/') }}/add_enquiry">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" onkeypress="return isNameKey(this);" placeholder="Name" required data-error="Please enter your name" minlength="3" maxlength="15">
                <p class="text-danger" id="name_err"></p>
                <div class="help-block with-errors"></div>
              </div>                                 
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required data-error="Please enter your Email">
                <p class="text-danger" id="email_err"></p>
                <div class="help-block with-errors"></div>
              </div>                                 
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" placeholder="Phone Number" onkeypress="return isNumberKey(this);" id="phone" class="form-control" name="phone" required data-error="Please enter your Phone Number" minlength="7"  maxlength="13">
                <p class="text-danger" id="phone_err"></p>
                <div class="help-block with-errors"></div>
              </div> 
            </div>
            <div class="col-md-12">
              <div class="form-group"> 
                <textarea class="form-control" id="message"  name="message" placeholder="Write Message" rows="4" data-error="Write your message" minlength="3" required></textarea>
                <p class="text-danger" id="message_err"></p>
                <div class="help-block with-errors"></div>
              </div>
              <div class="submit-button">
                <button class="btn btn-common" id="submit" type="submit">Submit</button>
                <div id="msgSubmit" class="h3 hidden"></div> 
                <div class="clearfix"></div> 
              </div>
            </div>
          </div>            
        </form>
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
</section>
<script>
 
  function isNameKey(e)
  {
    var charCode = (e.which) ? e.which : event.keyCode;
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var str = String.fromCharCode(charCode);
    if (regex.test(str)) {
        return true;
    }
    return false;
  }
  function enq_validation() 
  {
    var err = 0;
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var message = $('#message').val();
    if (name.trim() == '') {
      $('#name_err').html("Name is required!");
      err++;
    }
    else {
      $('#name_err').html("");
    }

  }
  function isNumberKey(evt)
  {
    // console.log(evt);
      var charCode = (evt.which) ? evt.which : event.keyCode;
      if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
  }

</script>
@endsection