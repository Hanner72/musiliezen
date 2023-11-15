<?php



include './assets/inc/01_doctype.php';

include './assets/inc/02_head.php';

include './assets/inc/03_sidebar.php';

include './assets/inc/04_right_panel.php';

include './assets/inc/05_header_nav.php';

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- content -->
  <div class="content mt-3">

      <div class="col-sm-12">
          <div class="alert  alert-success alert-dismissible fade show" role="alert">
              <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      </div>

  </div>
<!-- .content -->

<?php

include './assets/inc/15_right_panel_end.php';

include './assets/inc/20_footer.php';

?>