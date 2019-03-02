<div tabindex="-1" class="modal fade" id="confirmModal" role="dialog" aria-hidden="true" aria-labelledby="staticModalLabel" style="padding-top: 85px; display: none;" data-backdrop="false">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticModalLabel">Confirmation</h5>
				<button class="close" aria-label="Close" type="button" data-dismiss="modal">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					
				</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
				<button class="btn btn-primary btn-sm" type="button" id="confirm-btn">{{ __('Confirm') }}</button>
			</div>
		</div>
	</div>
</div>


@push('pagescript')

<script type="text/javascript">

$('.btn-delete-form').on('click', function(e){
    e.preventDefault();
    var $form=$(this.form);
    var modal = $('#confirmModal');
    modal.find('.modal-body p').text($form.data('message'));   
    modal.modal()
        .on('click', '#confirm-btn', function(){
            $form.submit();
        });
});

</script>

@endpush