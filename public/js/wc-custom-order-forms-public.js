(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  $(document).ready(function () {
    addmoreProducts();
    formvalidate();
    //validate();
    //multisteps();
    //multistepValidate();
    clickToCopy();
  });

  function multisteps() {
    let tabs = $("form.multiStepForm").find(".tabs");
    let btngroup = $(".btn-group");
    let steps = 0;
    let fValid;

    multiStepsNav(tabs, steps, btngroup);
    btngroup.find("#previous").css("display", "none");

    btngroup.find("button").on("click", function (e) {
      if (e.target.id == "next") {
        fValid = multistepValidate(tabs, steps);
        if (fValid) {
          steps++;
        }
      } else {
        if (steps > 0) {
          steps--;
        } else {
          return false;
        }
      }
      multiStepsNav(tabs, steps, btngroup);
    });
  }

  function multiStepsNav(tabs, steps, btngroup) {
    tabs.each(function (i, e) {
      if (steps != i) {
        $(this).css("display", "none");
      } else {
        $(this).css("display", "block");
      }
    });
    if (tabs.length == steps + 1) {
      btngroup.find("#next").css("display", "none");
      btngroup.find("input[type=submit]").css("display", "inline-block");
      //btngroup.find('.previous').css('display','inline-block');
    } else {
      btngroup.find("input[type=submit]").css("display", "none");
      btngroup.find("#next").css("display", "inline-block");
    }
    if (steps == 0) {
      btngroup.find("#previous").css("display", "none");
    } else {
      btngroup.find("#previous").css("display", "inline-block");
    }
  }

  function addmoreProducts() {
    var maxField = 10;
    var addButton = $(".add_button");
    var fieldHTML = `<div class="input-div">
		<div class="form-row"><div class="col col-md-12"><label label-for="item_photo">Item Photo (upload photo): </label><input type="file" class="form-control-file" name="item_photo[]"></div></div>
		<div class="form-row"><div class="col col-md-12"><label label-for="item_url">Item URL: </label><input class="form-control" type="input" name="item_url[]" required/></div></div>
		<div class="form-row"><div class="col col-md-12"><label label-for="item_price">Item price: </label><input class="form-control" type="input" name="item_price[]" required/></div></div>
		<div class="date-field-actions" style="padding-left:15px;"><button class="button-qtymin removeBtn remove_button btn" id="removeBtn" name="removefields">-</button></div>
						</div>`;
    var fieldHTML1 = `<div class="input-div">
		<div class="form-row"><div class="col col-md-12"><label label-for="item_photo">Item Photo (upload photo): </label><input type="file" class="form-control-file" name="item_photo[]"></div></div>
		<div class="form-row"><div class="col col-md-12"><label label-for="item_description">Item Description: </label><input class="form-control" type="input" name="item_description[]" required/></div></div>
		<div class="form-row"><div class="col col-md-12"><label label-for="item_price">Item price: </label><input class="form-control" type="input" name="item_price[]" required/></div></div>
		<div class="date-field-actions" style="padding-left:15px;"><button class="button-qtymin removeBtn remove_button btn" id="removeBtn" name="removefields">-</button></div>
						</div>`;

    $(addButton).on("click", function (event) {
      event.preventDefault();
      var formid = $(this).closest("form").attr("id");
      var divCount = $("#" + formid + " .input-div").length;
      if (divCount < maxField) {
        if (this.id == "addBtnOnDemand") {
          $(fieldHTML1).insertAfter(
            $("#" + formid + " .input-div")[divCount - 1]
          );
        } else {
          $(fieldHTML).insertAfter(
            $("#" + formid + " .input-div")[divCount - 1]
          );
        }
        // if(this.id == 'addBtnbuy'){
        // 	$(fieldHTML).insertAfter($('#'+formid+' .input-div')[divCount-1]);
        // }else{
        // 	$(fieldHTML1).insertAfter($('#'+formid+' .input-div')[divCount-1]);
        // }
      }
      if (divCount == 0) {
        $(fieldHTML).insertAfter($("#" + formid + " .date-field-actions")[0]);
      }
    });

    $(document).on("click", ".remove_button", function (e) {
      e.preventDefault();
      $(this).parent().parent("div").remove();
    });
  }

  function formvalidate() {
    $("form#buy_for_me").submit(function (event) {
      let validation = validate();
      if (validation) {
        $("form#buy_for_me").submit();
      } else {
        event.preventDefault();
      }
    });

    $("form#pack_and_ship").submit(function (event) {
      let validation = validate();
      if (validation) {
        $("form#buy_for_me").submit();
      } else {
        event.preventDefault();
      }
    });
  }

  function validate() {
    let valid = true;
    // console.log($('input[name="item_photo[]"]'));
    // console.log($('input[name="item_url[]"]'));
    // console.log($('input[name="item_price[]"]'));
    // for (let i = 0; i < $('input[name="item_photo[]"]').length; i++) {
    // 	if($('input[name="item_photo[]"]')[i].files.length === 0){
    // 		alert("Attachment Required");
    // 		$('input[name="item_photo[]"]')[i].focus();
    // 		valid = false;
    // 	}
    // }
    let validateFieldsSet = [
      // 'input[name="item_photo[]"]',
      'input[name="item_url[]"]',
      'input[name="item_price[]"]',
    ];
    $(".input-div").each(function () {
      validateFieldsSet.every((element) => {
        $(this)
          .find(element)
          .each(function () {
            if ($(this).val() == "") {
              $(this).focus();
              valid = false;
              alert("Please fill all the form fields");
              return false;
            }
          });
        if (valid === false) {
          return;
        }
        return true;
      });
    });
    return valid;
  }

  function multistepValidate(tabs, steps) {
    let valid = true;
    $(tabs[steps])
      .find('input[type="text"]')
      .each(function () {
        //console.log($(this).attr('name'));
        if (
          $(this).val() == "" &&
          $(this).attr("name") != "shipping_address_02"
        ) {
          $(this).focus();
          valid = false;
          alert("Please fill all the form fields");
          return false;
        }
      });
    return valid;
  }

  function clickToCopy() {
    $("#clk_2_copy_add").hover(
      function () {
        $(".shipping_address").append(
          '<span class="hover_txt">Click to copy text</span>'
        );
      },
      function () {
        $(".shipping_address").find(".hover_txt").remove();
      }
    );
    $("#clk_2_copy_add").click(function (event) {
      var $tempElement = $("<input>");
      $("body").append($tempElement);
      $tempElement.val($(this).text()).select();
      document.execCommand("Copy");
      if ($(".shipping_address").find(".hover_txt").length) {
        $(".shipping_address").find(".hover_txt").text("Text copied");
      }
      $tempElement.remove();
    });
  }
})(jQuery);
