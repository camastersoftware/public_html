<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>About Software </h2>
          <p>The software has been divided mainly into four sections :</p>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <img src="<?= esc(base_url('assets/site/img/software/taxcalendar.jpg')) ?>" class="w-100 mb-3">
              <h4><a href="javascript:void(0);">Masters and Tax Calendar</a></h4>
               <p>This section gives master details such as contact details, registration details etc. 
               of your clients in a systematic manner on the click of a button. 
               The due dates applicable to the each client under each Act or Law can be allocated.</p><br>
               <p>Similarly, all the due dates under various Acts are enlisted in Tax Calendar with the options to see them Act-wise, month-wise etc.</p> 
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
               <img src="<?= esc(base_url('assets/site/img/software/compliancemanagement.jpg')) ?>" class="w-100 mb-3">
              <h4><a href="javascript:void(0);">Compliance Management</a></h4>
              <p>This section is a core of this software. This is a controlling point of the Statutory due dates compliance which every CA or Tax Professional has to cope-up with. </p><br>
               <p>We have tried to cover most of the important Act which are being practised by the CAs & Tax Professionals. The additional Acts may be covered depending on the need of CAs.</p> 
            </div>
          </div>
          
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
               <img src="<?= esc(base_url('assets/site/img/software/administration.jpg')) ?>" class="w-100 mb-3">
              <h4><a href="javascript:void(0);">Administration & Management</a></h4>
              <p>
                <span class="font-weight-bold">Office Administration :</span>
                This covers most of the general office administrative works such as Holiday List, Inward/Outward Register etc.<br>
                
                <span class="font-weight-bold">Client Administration :</span>
                There are various functions which need control over such as expiry dates of Digital Signatures, passwords management etc.<br>
                
                <span class="font-weight-bold">Staff Management :</span>
                The staff management is a key for any service organization. We have tried to cover complete staff management including attendance & CTC etc.
                </p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 ">
            <div class="icon-box">
              <img src="<?= esc(base_url('assets/site/img/software/accounts.jpg')) ?>" class="w-100 mb-3">
              <h4><a href="javascript:void(0);">Accounts & Finance</a></h4>
                <p>This section deals with Billing & Receipts of CA firm. Similarly, it also gives Profitability Statement of the Firm. 
                The list is displayed where services are delivered but billing is not done or receipts are outstanding.</p><br> 
                <p>One can get details of each clientwise or groupwise or workwise billing done & receipts. 
                There are many more features such as percentage analysis, bar chart etc.</p> 
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-12 mt-3 other-info">
              <p>Besides, all the above, there are other features such as Cost Sheet, General works, Reminders, Contacts etc. 
              which are of day-to-day use. Many more aspects will be added in future depending on the requirements.</p>
          </div>
          
        </div>

      </div>
    </section><!-- End About Section -->


    <!-- ======= About Section ======= -->
 
    <!-- End About Section -->

  </main><!-- End #main -->

<?= $this->endSection(); ?>