<span class="pull-right cursor text-danger" data-toggle="modal"
      data-target="#<?php echo $modalDiv; ?>"><i class="fa fa-info-circle"></i> Help </span>

<div class="modal fade" id="<?php echo $modalDiv; ?>" tabindex="-1" role="dialog"
     aria-labelledby="<?php echo $modalDiv; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?php echo $modalDiv; ?>">Setting Up Tawk.To Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-success">
                <h4>1. Sign up for an account (<a href="https://tawk.to" target="_blank">https://tawk.to</a>)
                </h4>

                <h4>2. Create a property</h4>
                <div><img src="<?php echo assets('img/content/tawkto.png'); ?>" style="width:100%"/></div>
                <ul style="font-size:18px;" class="text-monospace font-normal">
                    <li>Select administration</li>
                    <li>Create a property</li>
                    <li>Select the property</li>
                    <li>Copy the Direct Chat link</li>
                    <li>Paste it here under Tawk.to integration</li>
                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>