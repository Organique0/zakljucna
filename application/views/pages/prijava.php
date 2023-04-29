<h2 class = "text-center" ><?php echo 'Prijava'; ?></h2>


<?php // echo validation_errors(); ?>

<div class="row align-items-center h-50">
    <?php echo form_open('prijave/preveriPrijavo'); ?>
    <div class="container-sm p-3 my-3 border w-25">
    
        <div class="form-floating mb-3">
            <?php echo form_input('upoIme',$this->session->flashdata('ime'),'class="form-control" ');?>
            <?php echo form_label('Uporabnisko ime','upoIme',);?>
            <div class="text-danger">
                <?php echo $this->session->flashdata('napacnoIme');?>
                <?php echo $this->session->flashdata('niImena');?> 
            </div>
            <?php echo form_error('upoIme', '<div class="alert-danger">', '</div>'); ?>
        </div>
        
        <div class="form-floating mb-3">
            <?php echo form_password('upoGeslo','','class="form-control" ');?>
            <?php echo form_label('Geslo','upoGeslo',);?>
            <div class="text-danger">
                <?php echo $this->session->flashdata('napacnoGeslo');?>
                <?php echo $this->session->flashdata('niGesla');?> 
            </div>
            <?php echo form_error('upoGeslo', '<div class="alert-danger">', '</div>'); ?>
        </div>
        <div class="row justify-content-center ">
            <?php echo form_submit('submit', 'prijava','class="btn btn-outline-primary w-25"');?>
            <a href="registracija">registracija</a>
        </div>
    </div>   

    <?php form_close('</div>');?>

    
