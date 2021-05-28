(function( $ ) {
	'use strict';

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
	 $(document).ready(function(){
		addmoreProducts();
		formvalidate();
		//validate();
		multisteps();
	});

	function multisteps(){
		console.log('multistep');
		console.log(
			$('form.multiStepForm').find('.tabs')
		);
		let tabs = $('form.multiStepForm').find('.tabs');
		let btngroup = $('.btn-group');
		let steps = 0;

		multiStepsNav(tabs, steps, btngroup)
		btngroup.find('#previous').css('display','none');

		btngroup.find('button').on('click', function(e){
			if(e.target.id == 'next'){
				steps++;
			}else{
				if(steps>0){
					steps--;
				}else{
					return false;
				}
			}
			multiStepsNav(tabs, steps, btngroup);
		});
	}
	
	function multiStepsNav(tabs, steps, btngroup){
		tabs.each(function(i, e){;
			if(steps != i){
				$(this).css('display','none');
			}else{
				$(this).css('display','block');
			}
		});
		if(tabs.length == (steps+1)){
			btngroup.find('#next').css('display','none');
			btngroup.find('input[type=submit]').css('display','inline-block');
			//btngroup.find('.previous').css('display','inline-block');
		}else{
			btngroup.find('input[type=submit]').css('display','none');
			btngroup.find('#next').css('display','inline-block');
		}
		if(steps == 0){
			btngroup.find('#previous').css('display','none');
		}else{
			btngroup.find('#previous').css('display','inline-block');
		}
	}

	function addmoreProducts(){
		var maxField = 10;
		var addButton = $('.add_button');
		var fieldHTML = `<div class="input-div">
		<div class="form-group"><label label-for="item_photo">Item Photo (upload photo): </label><input type="file" class="form-control-file" name="item_photo[]" required></div>
		<div class="form-group"><label label-for="item_url">Item URL: </label><input class="form-control" type="input" name="item_url[]"/></div>
		<div class="form-group"><label label-for="item_price">Item price: </label><input class="form-control" type="input" name="item_price[]"/></div>
		<div class="date-field-actions"><button class="button-qtymin removeBtn remove_button btn" id="removeBtn" name="removefields">-</button></div>
						</div>`;
		var fieldHTML1 = `<div class="input-div">
						<div class="form-group"><label label-for="item_photo">Item Photo (upload photo):</label> <input type="file" class="form-control-file" name="item_photo[]" required></div>
						<div class="date-field-actions"><button class="button-qtymin removeBtn remove_button btn" id="removeBtn" name="removefields">-</button></div>
						</div>`;						
		
		$(addButton).on('click', function(event){
			event.preventDefault();
			var formid = $(this).closest('form').attr('id');
			var divCount = $('#'+formid+' .input-div').length;
			if(divCount < maxField){
				if(this.id == 'addBtnbuy'){
					$(fieldHTML).insertAfter($('#'+formid+' .input-div')[divCount-1]);
				}else{
					$(fieldHTML1).insertAfter($('#'+formid+' .input-div')[divCount-1]);
				}
				
			}
			if(divCount == 0) {
				$(fieldHTML).insertAfter($('#'+formid+' .date-field-actions')[0]);
			}
		});
		
		$(document).on('click', '.remove_button' , function(e) {
			e.preventDefault();
			$(this).parent().parent('div').remove();
	   });

	}

	function formvalidate(){
		$('form#buy_for_me').submit(function(event) {
			let validation = validate();
			if(validation){
				$('form#buy_for_me').submit();
			}else{
				event.preventDefault();
			}
		});

		$('form#pack_and_ship').submit(function(event) {
			let validation = validate();
			if(validation){
				$('form#buy_for_me').submit();
			}else{
				event.preventDefault();
			}
		});
	}

	function validate(){
		let valid = true;
		console.log($('input[name="item_photo[]"]').length);
		for (let i = 0; i < $('input[name="item_photo[]"]').length; i++) {
			if($('input[name="item_photo[]"]')[i].files.length === 0){
				alert("Attachment Required");
				$('input[name="item_photo[]"]')[i].focus();
				valid = false;
			}
		}
		return valid;
	}


})( jQuery );
