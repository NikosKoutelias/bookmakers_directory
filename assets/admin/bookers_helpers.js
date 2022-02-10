jQuery(function () {
  $("#sortlist").sortable({
    update: function (event, ui) {
      updateCustomShortcode($(this).attr("data-attribute"));
    },
  });

  updateCustomShortcode = function () {
    let attrs = " ";
    jQuery("#layout").each(function () {
      if (jQuery(this).val() != "")
        attrs =
          attrs +
          "" +
          jQuery(this).attr("data-attribute") +
          '="' +
          jQuery(this).val() +
          '"';
    });

    jQuery("#cta").each(function () {
      if (jQuery(this).val() != "")
        attrs =
          attrs +
          " " +
          jQuery(this).attr("data-attribute") +
          '="' +
          jQuery(this).val() +
          '"';
    });

    jQuery("#limit").each(function () {
      if (jQuery(this).val() != "")
        attrs =
          attrs +
          " " +
          jQuery(this).attr("data-attribute") +
          '="' +
          jQuery(this).val() +
          '"';
    });

    jQuery("#title").each(function () {
      if (jQuery(this).val() != "")
        attrs =
          attrs +
          " " +
          jQuery(this).attr("data-attribute") +
          '="' +
          jQuery(this).val() +
          '"';
    });

    jQuery("#order_by").each(function () {
      if (jQuery(this).val() != "" && jQuery("#sort_by").val() != "") {
        attrs =
          attrs +
          " " +
          jQuery("#sort_by").attr("data-attribute") +
          '="' +
          jQuery(this).val() +
          " " +
          jQuery("#sort_by").val() +
          '"';
      } else if (jQuery(this).val() != "" && jQuery("#sort_by").val() == "") {
        attrs =
          attrs +
          " " +
          jQuery("#sort_by").attr("data-attribute") +
          '="' +
          jQuery(this).val() +
          '"';
      } else {
        attrs =
          attrs +
          " " +
          jQuery("#sort_by").attr("data-attribute") +
          '="' +
          jQuery("#sort_by").val() +
          '"';
      }
    });

    if (document.getElementById("sorting_id").checked) {
      mVal = "";
      count = 0;
      if (jQuery("#limit").val() > 0) {
        jQuery("#sortlist")
          .find("li")
          .each(function () {
            //alert (jQuery(this).text());
            jQuery(this).attr("data-id");
            mVal += jQuery(this).attr("data-id") + ", ";
            count++;
            if (count == jQuery("#limit").val()) {
              return false;
            }
          });
      } else {
        jQuery("#sortlist")
          .find("li")
          .each(function () {
            //alert (jQuery(this).text());
            jQuery(this).attr("data-id");
            mVal += jQuery(this).attr("data-id") + ", ";
          });
      }
      mVal = mVal.substring(0, mVal.length - 2);

      if (mVal != "")
        attrs =
          attrs +
          " " +
          jQuery("#sortlist").attr("data-attribute") +
          '="' +
          mVal +
          '"';
    }
    jQuery("#results").val("[bookmakers_directory_short" + attrs + "]");
  };

  jQuery(".all_meta select").change(updateCustomShortcode);
  jQuery('.all_meta input[type="checkbox"]').change(updateCustomShortcode);
  jQuery('.all_meta input[type="text"]').blur(updateCustomShortcode);
  updateCustomShortcode();
});
