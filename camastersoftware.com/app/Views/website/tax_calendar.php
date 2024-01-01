<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
        .marque {
            /*font-weight:600;*/
            font-size:20px;
            color:red;
            margin-bottom:10px;
        }
    </style>

  <main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container-fluid">
        <div class="row">
            <marquee class="marque">Disclaimer: The content is for guidance purpose only. You are requested to verify details from the relevant Acts-Laws before relying upon. CAMaster is not responsible for loss, if any.(Testing work still going on)</marquee>
          <div class="col-lg-12 ">
           <iframe src="<?= base_url('tax_calendar_view') ?>" id="myIframe" width="600" style="border:0; width: 100%; height: 100%; border: 1px solid #bdb9b9; border-radius: 5px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; overflow:hidden;" allowfullscreen="" loading="lazy"></iframe>
          </div>

          <!-- <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div> -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>

    <script>
        var iframe = document.getElementById("myIframe");
        
            iframe.onload = function(){
            
            // console.log($(iframe.contentWindow.document.body)[0].clientHeight);
            
            var iframeHeight=iframe.contentWindow.document.body.scrollHeight+50;
            
            // iframe.style.height = iframeHeight + 'px';
            iframe.style.height = '700px';
        
        }
    </script>

<?= $this->endSection(); ?>