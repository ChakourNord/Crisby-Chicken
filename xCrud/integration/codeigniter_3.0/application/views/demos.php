<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Patrick Mwathi, Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>xCRUD & CodeIgniter 3 Demos</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/"> -->

    <!-- Bootstrap core CSS -->
<!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<?php echo get_xcrud_css(); ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/blog.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/masthead.css'); ?>" rel="stylesheet">
  </head>
  <body>
    <div class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">xCRUD & CodeIgniter 3 Demos</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="<?php echo site_url('xcrud_ci'); ?>">Home</a>
        <a class="nav-link" href="<?php echo site_url('xcrud_ci/demos'); ?>">Demos</a>
      </nav>
    </div>
  </header>
</div>
</div>



    

<main role="main" class="container-fluid">
  <div class="row">
    <div class="col-md-10 blog-main">
      <h4 class="text-left" style="padding-top: 1.5em;"><?php echo $title; ?></h4>
      <p><?php echo $desc; ?></p>
      <p><?php //echo $path; ?></p>
      
      <?php echo $code; ?>
      <?php echo $content; ?>
      <?php echo $script ?? ''; ?>
    </div><!-- /.blog-main -->

    <aside class="col-md-2 blog-sidebar">
      <div class="p-4">
        <h4 class="font-italic">Demos</h4>
        <ol class="list-unstyled mb-0">
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/demos'); ?>">Simple Usage</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/base_field_types'); ?>">Base Field Types</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/bulk_delete'); ?>">Bulk Delete</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/buttons_panel'); ?>">Buttons Panel</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/ckeditor_and_custom'); ?>">CK Editor & Custom</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/column_width_cut'); ?>">Column Width/Cut</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/columns_and_fields'); ?>">Columns & Fields</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/dependent_dropdowns'); ?>">Dependent Dropdowns</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/edit_modal'); ?>">Edit Modal</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/edit_side_panel'); ?>">Edit Side Panel</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/field_grouping'); ?>">Field Grouping</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/gallery'); ?>">Gallery</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/grid_tricks'); ?>">Grid Tricks</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/grouping_form_fields'); ?>">Grouping Form Fields</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/highlights'); ?>">Highlights</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/inline_editing'); ?>">Inline Editing</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/labels_and_classes'); ?>">Labels and Classes</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/modal_and_buttons'); ?>">Modal & Buttons</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/multiple_instances'); ?>">Multiple Instances</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/nested_tables'); ?>">Nested Tables</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/nested_tables_in_tabs'); ?>">Nested Tables in Tabs</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/one_million_rows'); ?>">One Million Rows</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/parsley_validation'); ?>">Parsley Validation</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/simple_validation'); ?>">Simple Validation</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/subselect_and_sum_row'); ?>">Sub select & Sum Row</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/table_join'); ?>">Table Join</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/tabs'); ?>">Tabs</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/tabulator_simple'); ?>">Tabulator Simple</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/tabulator_grouping_level_2'); ?>">Tabulator Grouping 2nd Level</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/tooltips'); ?>">Tooltips</a></li>
          <li><a class="nav-link" href="<?php echo site_url('xcrud_ci/uploads'); ?>">Uploads</a></li>
          
        </ol>
      </div>
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
  <p>&copy; Copyright xCRUD. All Rights Reserved.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
<?php echo get_xcrud_js(); ?>
</body>
</html>
