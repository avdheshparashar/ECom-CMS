<div class = "upload-image-messages"></div>

    <div class = "col-md-6">
        <!-- Generate the form using form helper function: form_open_multipart(); -->
        <?php echo form_open_multipart('gallery/upload', array('class' => 'upload-image-form'));?>
            <input type="file" multiple = "multiple" accept = "image/*" class = "form-control" name="uploadfile[]" size="20" /><br />
            <input type="hidden" name="album_id" value="<?php echo $album_id; ?>" />
            <input type="submit" name = "submit" value="Upload" class = "btn btn-primary" />
        </form>

        <script>                    
        jQuery(document).ready(function($) {

            var options = {
                beforeSend: function(){
                    // Replace this with your loading gif image
                    $(".upload-image-messages").html('<p><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
                },
                complete: function(response){
                    // Output AJAX response to the div container
                    $(".upload-image-messages").html(response.responseText);
                    $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top-100}, 150);
                    location.reload();
                    
                }
            };  
            // Submit the form
            $(".upload-image-form").ajaxForm(options);  

            return false;
            
        });
        </script>
    </div>
</div>
