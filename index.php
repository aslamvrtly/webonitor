<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Webonitor</title>
    <?php include('assets/contents/head.php'); ?>
  </head>
  <body>
    <?php include('assets/contents/navbar.php'); ?>

    <section id="banner">
      <div class="gradient"></div>
      <div class="container z-index">
        <img src="assets/img/element.png" class="img-fluid" width="300" />
          <form action="result.php" method="get" class="search-bar">
            <input type="text" name="website" id="website"
              placeholder="Enter Your Website URL! (www.example.com)" required />
            <button type="submit" class="">Check Now</button>
          </form>
          <p class="confirm">By using our website, you are agree to our <a href="privacy-policy" target="_blank">Privacy Policy</a> and <a href="terms-and-conditions" target="_blank">Terms & Conditions</a></p>
        <h1>Monitor Your Website Instantly</h1>
        <p>
          Check your website's status, domain details, SSL information, and DNS
          records in seconds.
        </p>
      </div>
    </section>

    <section id="features">
      <div class="container">
        <h1 class="section-heading">What Webonitor Can Do for You</h1>
        <p class="section-content">
          Webonitor provides everything you need to keep your website in check
        </p>
        <div class="row justify-content-center">
          <div class="col-12 col-md-6 mb-3">
            <div class="feature-card" data-aos="zoom-in">
              <div class="row">
                <div class="col-md-8">
                  <p class="heading">
                    <i class="bi bi-1-circle-fill me-1"></i> Website Status
                  </p>
                  <p class="content">
                    Quickly determine if your website is up and running or
                    experiencing downtime. Webonitor provides real-time status
                    checks to help you stay informed and take immediate action
                    if needed.
                  </p>
                </div>
                <div class="col-md-4 h-md-100">
                  <div class="icon mt-3 mt-md-0">
                    <i class="bi bi-speedometer2"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <div class="feature-card" data-aos="zoom-in">
              <div class="row">
                <div class="col-md-4 h-md-100">
                  <div class="icon mb-3 mb-md-0">
                    <i class="bi bi-globe2"></i>
                  </div>
                </div>
                <div class="col-12 col-md-8">
                  <p class="heading">
                    <i class="bi bi-2-circle-fill me-1"></i> Domain Expiry
                  </p>
                  <p class="content">
                    Know when your domain is about to expire with clear and
                    precise details. Avoid the risk of losing your domain by
                    staying ahead of expiry dates and renewing on time.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 mb-3 mb-md-0">
            <div class="feature-card" data-aos="zoom-in">
              <div class="row">
                <div class="col-md-8">
                  <p class="heading">
                    <i class="bi bi-3-circle-fill me-1"></i> SSL Certificate
                    Details
                  </p>
                  <p class="content">
                    Ensure your website is secure with detailed SSL certificate
                    information. Webonitor shows the issuer, expiry date, and
                    status, helping you maintain trust and protect your users'
                    data.
                  </p>
                </div>
                <div class="col-md-4 h-md-100">
                  <div class="icon mt-3 mt-md-0">
                    <i class="bi bi-shield-check"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="feature-card" data-aos="zoom-in">
              <div class="row">
                <div class="col-md-4 h-md-100">
                  <div class="icon mb-3 mb-md-0">
                    <i class="bi bi-list-ul"></i>
                  </div>
                </div>
                <div class="col-md-8">
                  <p class="heading">
                    <i class="bi bi-4-circle-fill me-1"></i> Nameservers & DNS
                    Records
                  </p>
                  <p class="content">
                    Access essential DNS records such as A, MX, and CNAME to
                    ensure your website’s configuration is correct. Webonitor
                    also checks your nameservers, so you can ensure smooth
                    operation and proper routing.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <?php include('assets/contents/support.php'); ?>

        </div>
      </div>
    </section>

    <?php include('assets/contents/footer.php'); ?>
    <?php include('assets/contents/scripts.php'); ?>
  </body>
</html>
