<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact Us</h2>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>66/2875, Mangal Co-operative
                  Housing Society, Gandhi Nagar,
                  Bandra (East),
                  Mumbai-400 051
              </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>camastersoftware@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p><a class="contact_no_clr" href="tel:+919870547500">+91 98705 47500</a></p>
              <p><a class="contact_no_clr" href="tel:+917045337500">+91 70453 37500</a></p>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-12 ">
           <!--  <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen>
              
            </iframe> -->

           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.104960956811!2d72.84698901516506!3d19.05912225745495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c921daaaaaab%3A0x8a841f395a753230!2sCAMaster%20Software%20Private%20Limited!5e0!3m2!1sen!2sin!4v1634728353852!5m2!1sen!2sin" style="border:0; width:100%; height:384px;" allowfullscreen="" loading="lazy" ></iframe>
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