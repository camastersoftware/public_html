<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
        .ct_ht{
            height:500px !important;
        }
        
        .mr_tp{
            margin-top: 12% !important;
        }
        
        .fnt_cl{
            color: #015aac !important;
            font-size:27px !important;
        }
        
        .hd_cl{
            font-weight: 600 !important;
        }
    </style>

  <main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container ct_ht">

        <!--<div class="section-title" data-aos="fade-up">-->
        <!--  <h2>Contact Us</h2>-->
        <!--</div>-->

        <div class="row">
          <div class="col-lg-12 text-center mr_tp">
           <p class="fnt_cl"><span class="hd_cl">CA-Master</span> software is still under development. It will be available shortly.</p>
           <p class="fnt_cl">You may give your contact details. We will get back to you when it is ready.</p>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

<?= $this->endSection(); ?>