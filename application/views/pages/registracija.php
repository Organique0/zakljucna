<h2 class = "text-center" ><?php echo 'Registracija'; ?></h2>

<?php // echo validation_errors(); ?>

<div>
<div class="row align-items-center h-50">
    <?php echo form_open('Registracije/preveriRegistracijo'); ?>
    <div class="container-sm p-3 my-3 border w-25">
    
        <div class="form-floating mb-3">
            <?php echo form_input('upoIme',$this->session->flashdata('ime'),'class="form-control" ');?>
            <?php echo form_label('Uporabnisko ime','upoIme',);?>
            <div class="text-danger">
                <?php echo $this->session->flashdata('obstajaIme');?>
                <?php echo $this->session->flashdata('niImena');?> 
            </div>
            <?php echo form_error('upoIme', '<div class="alert-danger">', '</div>'); ?>
        </div>

        <div class="form-floating mb-3">
            <?php echo form_input('upoMail',$this->session->flashdata('mail'),'class="form-control" ');?>
            <?php echo form_label('e-mail','upoMail',);?>
            <div class="text-danger">
                <?php echo $this->session->flashdata('obstajaMail');?>
                <?php echo $this->session->flashdata('niENaslova');?> 
            </div>
            <?php echo form_error('upoMail', '<div class="alert-danger">', '</div>'); ?>
        </div>
        
        <div class="form-floating mb-3">
            <?php echo form_password('upoGeslo','','class="form-control" ');?>
            <?php echo form_label('Geslo (najmanj 6 znakov)','upoGeslo',);?>
            <div class="text-danger">
                <?php echo $this->session->flashdata('niGesla');?>
                <?php echo $this->session->flashdata('prekratkoGeslo');?> 
            </div>
            <?php echo form_error('upoGeslo', '<div class="alert-danger">', '</div>'); ?>
        </div>

        <div class="form-floating mb-3">
            <?php echo form_password('upoGeslo2','','class="form-control" ');?>
            <?php echo form_label('Ponovite geslo','upoGeslo2',);?>
            <div class="text-danger">
                <?php echo $this->session->flashdata('niGesla2');?>
                <?php echo $this->session->flashdata('gesliNeUjemata');?> 
            </div>
            <?php echo form_error('upoGeslo2', '<div class="alert-danger">', '</div>'); ?>
        </div>

        <div class="row justify-content-center">
            <?php echo form_submit('submit', 'registracija','class="btn btn-outline-primary w-50"');?>
        </div>
    </div>   
</div>
    <?php form_close('</div>');?>
