<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-4">
    <!-- <a class="navbar-brand" href="schede-maltrattate.php">
        <img src="./assets/img/artemisia.png" height="50" alt="">
    </a> -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <!-- <script>
            // $(document).ready(function() {
            //     $('#drop-id.top').on("click", function() {
            //         if ($('#drop-id-middle').hasClass("show") == false) {
            //             $('#drop-id-top').addClass("show");
            //             $('#drop-id-middle').attr("aria-expanded", true);
            //             $('#drop-id-bottom').addClass("show");
            //         } else {
            //             $('#drop-id-top').removeClass("show");
            //             $('#drop-id-middle').attr("aria-expanded", false);
            //             $('#drop-id-bottom').removeClass("show");
            //         }
            //     })


            // });
            </script> -->
            <li class="nav-item" style="align-self: center; padding: 0.5rem">
                <div class="dropdown" type="button" id="dropdownwMenuButton" data-toggle="dropdoswn"
                    aria-haspopup="true" aria-expanded="false" style=" outline: 0; box-shadow: none; ">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Dropdown button

                    <div class="dropdown-menu" aria-labelledby="dropdownwMenuButton">
                        <a class="dropdown-item" href="company.php">Companys</a>
                        <a class="dropdown-item" href="filialen.php">Filialen</a>
                        <a class="dropdown-item" href="employee.php">Employees</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>