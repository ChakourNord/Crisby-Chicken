<div class="xcrud-top-actions btn-group">
    <?php if ($this->is_next_previous) {
      echo "<div class='btn-group' role='group'>";
      echo $this->render_previous(
        "Previous",
        "edit",
        "",
        "xcrud-button xcrud-green btn btn-light",
        "",
        "edit"
      );
      echo $this->details_counter();
      echo $this->render_next(
        "Next",
        "edit",
        "",
        "xcrud-button xcrud-green btn btn-light",
        "",
        "edit"
      );
      echo "</div><br><br>";
    } ?>
</div>
<div class="xcrud-top-actions btn-group" id="save-btn">
    <?php
    echo $this->render_button(
      "save_return",
      "save",
      "list",
      "btn btn-primary none",
      "",
      "create,edit"
    );
    echo $this->render_button(
      "save_new",
      "save",
      "create",
      "btn btn btn-light",
      "",
      "create,edit"
    );
    echo $this->render_button(
      "save_edit",
      "save",
      "edit",
      "btn btn-light",
      "",
      "create,edit"
    );
    ?>
</div>
<form data-parsley-validate='' class="parsley-form">
    <div class="xcrud-view">
        <?php echo $mode == "view"
          ? $this->render_fields_list($mode, [
            "tag" => "table",
            "class" => "table",
          ])
          : $this->render_fields_list($mode, "div", "div", "label", "div"); ?>
    </div>
</form>
<div class="xcrud-nav form-inline">
    <?php echo $this->render_benchmark(); ?>
</div>

<?php
if ($this->parsley_active) {
  include "xcrud_parsley.php";
}

if ($this->bulk_image_upload_active) {
  include "bulk_image_upload.php";
}
?>
<div class="xcrud-top-actions btn-group" id="save-btn-ifr">
    <script>
    $('.task-com').on("click", function() {
        setTimeout(
            Xcrud.show_message('.xcrud-ajax', 'Fulfillment is ready for edit', 'info'), 2000);

    });
    </script>
    <?php
    echo $this->render_button(
      "continue",
      "save",
      "edit",
      "btn btn-primary continue task-com",
      "",
      "create"
    );
    echo $this->render_button(
      "contisacvdxcnue",
      "save",
      "list",
      "btn btn-primary continue",
      "",
      "edit"
    );
    echo $this->render_button("close", "list", "", "btn btn-warning");

