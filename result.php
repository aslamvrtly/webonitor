<?php

if(isset($_GET['website']) && $_GET['website'] != ''){
  $website = strip_tags($_GET['website']);
}else{
  header('Location: /');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Result | Webonitor</title>
    <?php include('assets/contents/head.php'); ?>
  </head>
  <body>
    
  <?php include('assets/contents/navbar.php'); ?>

    <section id="result">
      <img src="assets/img/lines0.png" class="lines">
      <div class="gradient one"></div>
      <div class="gradient two"></div>
      <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 text-center z-index">
                <h3 class="main-heading">Website Analysis</h3>
                <p class="url">Website URL : <?php echo $website ?></h6>
            </div>
            <div class="col-md-4">
                <div class="result-card">
                    <p class="title">Website Status</p>
                    <div class="divider w-100"></div>
                    <div class="status-div d-none">
                        <img src="" class="img-fluid" width="170">
                        <div>
                            <p class="status"></p>
                        </div>
                    </div>
                    <img src="assets/img/hourglass.gif" class="img-fluid status-loader" width="140">
                </div>
            </div>
            <div class="col-md-4">

                <div class="result-card mb-3">
                    <div>
                        <p class="title">Domain Information</p>
                        <div class="divider"></div>
                        <div class="row text-start domain-div d-none">
                            <div class="col-4">
                                <p class="mb-1"><i class="bi bi-calendar me-2"></i> Expiry Date</p>
                            </div>
                            <div class="col-8">
                                <p class="mb-1">: &nbsp;&nbsp; <span id="domain_expiry"></span></p>
                            </div>
                            <div class="col-4">
                                <p class="mb-0"><i class="bi bi-clock me-2"></i> Remaining</p>
                            </div>
                            <div class="col-8">
                                <p class="mb-0">: &nbsp;&nbsp; <span id="domain_remaining"></span></p>
                            </div>
                        </div>
                        <img src="assets/img/loading.gif" class="img-fluid domain-loader" width="140">
                    </div>
                </div>
                <div class="result-card">
                    <p class="title">Nameservers</p>
                    <div class="divider w-100"></div>
                    <div class="ns-div d-none">
                        <ul id="ns"></ul>
                    </div>
                    <img src="assets/img/loading.gif" class="img-fluid ns-loader" width="140">
                </div>
            </div>
            <div class="col-md-4">
            <div class="result-card mb-3">
                    <div>
                        <p class="title">SSL Information</p>
                        <div class="divider"></div>
                        <div class="row text-start ssl-div d-none">
                            <div class="col-4">
                                <p class="mb-1"><i class="bi bi-toggles me-2"></i> SSL Status</p>
                            </div>
                            <div class="col-8">
                                <p class="mb-1">: &nbsp;&nbsp; <span id="ssl_status"></span></p>
                            </div>
                            <div class="col-4">
                                <p class="mb-1"><i class="bi bi-building me-2"></i> SSL Issuer</p>
                            </div>
                            <div class="col-8">
                                <p class="mb-1">: &nbsp;&nbsp; <span id="ssl_issuer"></span></p>
                            </div>
                            <div class="col-4">
                                <p class="mb-1"><i class="bi bi-calendar me-2"></i> Expiry Date</p>
                            </div>
                            <div class="col-8">
                                <p class="mb-1">: &nbsp;&nbsp; <span id="ssl_expiry"></span></p>
                            </div>
                            <div class="col-4">
                                <p class="mb-0"><i class="bi bi-clock me-2"></i> Remaining</p>
                            </div>
                            <div class="col-8">
                                <p class="mb-0">: &nbsp;&nbsp; <span id="ssl_remaining"></span></p>
                            </div>
                        </div>
                        <img src="assets/img/loading.gif" class="img-fluid ssl-loader" width="140">
                    </div>
                </div>
            </div>
            <div class="col-12 pb-5">
                <div class="result-card">
                    <p class="title mb-0">DNS Records</p>
                    <div class="divider w-100 mb-4 mt-3"></div>
                    <img src="assets/img/loading 2.gif" class="img-fluid dns-loader" width="140">
                    <div class="table-responsive w-100 dns-div d-none">
                    
                        <table class="table table-striped table-dark pt-3 datatable text-start">
                            <thead>
                                <tr>
                                    <th class="fit">Sl No</th>
                                    <th class="fit">Type</th>
                                    <th>Name</th>
                                    <th>Priority</th>
                                    <th>Content</th>
                                    <th>TTL</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    <section id="features">
      <div class="container">
        <div class="row justify-content-center">
        <?php include('assets/contents/support.php'); ?>
        </div>
      </div>
    </section>

    <?php include('assets/contents/footer.php'); ?>
    <?php include('assets/contents/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            const table = $('.datatable').DataTable({
                                pageLength: 100,
                                columnDefs: [{ orderable: false, targets: 0 }]
                            });
            $.ajax({
                type: "get",
                url: "functions/functions.php",
                data: {
                    is_status: true,
                    domain: '<?php echo $website ?>'
                },
                success: function (response) {
                    if(response == '1'){
                        $('.status-div').removeClass("d-none");
                        $(".status-div .status").text("Website is Live");
                        $(".status-div .status").addClass("up");
                        $(".status-div img").attr("src", "assets/img/up.gif");
                        $('.status-loader').addClass("d-none");
                    }else if(response == 'Domain is invalid'){
                        $('.status-div').removeClass("d-none");
                        $(".status-div .status").text("Domain is invalid");
                        $(".status-div .status").addClass("down");
                        $(".status-div img").attr("src", "assets/img/down.gif");
                        $('.status-loader').addClass("d-none");
                    }
                    else{
                        $('.status-div').removeClass("d-none");
                        $(".status-div .status").text("Website is Down");
                        $(".status-div .status").addClass("down");
                        $(".status-div img").attr("src", "assets/img/down.gif");
                        $('.status-loader').addClass("d-none");
                    }
                }
            });

            $.ajax({
                type: "get",
                url: "functions/functions.php",
                data: {
                    is_ssl: true,
                    domain: '<?php echo $website ?>'
                },
                success: function (response) {
                    let data = JSON.parse(response)
                    if(data.status == 'Secured'){
                        let ssl_expiry = new Date(data.validTo_time_t * 1000); // Assuming data.validTo_time_t is a UNIX timestamp
                        let now = new Date();

                        // Format ssl_expiry to DD-MM-YYYY HH:MM
                        let day = String(ssl_expiry.getDate()).padStart(2, '0');
                        let month = String(ssl_expiry.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        let year = ssl_expiry.getFullYear();
                        let hours = String(ssl_expiry.getHours()).padStart(2, '0');
                        let minutes = String(ssl_expiry.getMinutes()).padStart(2, '0');
                        let formattedExpiry = `${day}-${month}-${year} ${hours}:${minutes}`;

                        // Calculate remaining days
                        let remaining = Math.ceil((ssl_expiry - now) / (1000 * 3600 * 24));

                        $('.ssl-div').removeClass("d-none");
                        $(".ssl-div #ssl_status").text(data.status);
                        $(".ssl-div #ssl_status").addClass("success fw-bold");
                        $(".ssl-div #ssl_issuer").text(data.issuer.CN);
                        $(".ssl-div #ssl_expiry").text(formattedExpiry);
                        $(".ssl-div #ssl_remaining").text(remaining + " Days");
                        $('.ssl-loader').addClass("d-none");
                    }else{
                        $('.ssl-div').removeClass("d-none");
                        $(".ssl-div #ssl_status").text(data.status);
                        $(".ssl-div #ssl_status").addClass("failed fw-bold");
                        $(".ssl-div #ssl_issuer").text("Nil");
                        $(".ssl-div #ssl_expiry").text("Nil");
                        $(".ssl-div #ssl_remaining").text("Nil");
                        $('.ssl-loader').addClass("d-none");
                    }
                }
            });

            $.ajax({
                type: "get",
                url: "functions/functions.php",
                data: {
                    is_domain: true,
                    domain: '<?php echo $website ?>'
                },
                success: function (response) {
                    let data = JSON.parse(response)
                    let ns = data.nameserver;
                    if(data.status == 'success'){
                        let domain_expiry = new Date(data.expiry * 1000);
                        let now = new Date();

                        // Format ssl_expiry to DD-MM-YYYY HH:MM
                        let day = String(domain_expiry.getDate()).padStart(2, '0');
                        let month = String(domain_expiry.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                        let year = domain_expiry.getFullYear();
                        let hours = String(domain_expiry.getHours()).padStart(2, '0');
                        let minutes = String(domain_expiry.getMinutes()).padStart(2, '0');
                        let formattedExpiry = `${day}-${month}-${year} ${hours}:${minutes}`;

                        // Calculate remaining days
                        let remaining = Math.ceil((domain_expiry - now) / (1000 * 3600 * 24));

                        $('.domain-div').removeClass("d-none");
                        $(".domain-div #domain_expiry").text(formattedExpiry);
                        $(".domain-div #domain_remaining").text(remaining + " Days");
                        $('.domain-loader').addClass("d-none");

                        $('.ns-div').removeClass("d-none");
                        ns.forEach(element => {
                            $("#ns").append(`<li>${element}</li>`);
                        });
                        $('.ns-loader').addClass("d-none");
                    }else{
                        $('.domain-div').removeClass("d-none");
                        $(".domain-div #domain_expiry").text("Nil");
                        $(".domain-div #domain_remaining").text("Nil");
                        $('.domain-loader').addClass("d-none");
                    }
                }
            });

            $.ajax({
                type: "get",
                url: "functions/functions.php",
                data: {
                    is_dns: true,
                    domain: '<?php echo $website ?>'
                },
                dataType: "json",
                success: function (data) {
                    let domain = '<?php echo $website ?>';
                    domain = domain.replace("http://", "");
                    domain = domain.replace("https://", "");
                    $('.datatable tbody').html('')
                        data.forEach((dns, index) => {
                            const type = dns.type;
                            let name = "";
                            if(dns.host == domain)
                                name = '@'
                            else if((dns.host).includes(domain))
                                name = (dns.host).replace(`.${domain}`, '');
                            else
                                name = dns.host
                            const priority = type === "MX" ? dns.pri : "0";
                            const content = type === "A" ? dns.ip :
                                            type === "AAAA" ? dns.ipv6 :
                                            type === "MX" ? dns.target :
                                            type === "TXT" ? dns.txt :
                                            type === "CNAME" ? dns.target :
                                            type === "CAA" ? `${dns.flags} ${dns.tag} "${dns.value}"` :
                                            '';
                            const ttl = dns.ttl;
                            table.row.add([
                                index + 1,
                                type,
                                name,
                                priority,
                                content,
                                ttl
                            ]).draw();
                        });
                        $('.dns-div').removeClass("d-none");
                        $('.dns-loader').addClass("d-none");
                    }
            });
        })
    </script>
  </body>
</html>
