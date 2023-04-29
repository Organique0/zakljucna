<div class="w-50 m-auto mt-5 pb-2">
    <?php echo form_open('admin','class="row"');?>
        <div class="col-auto">  
            <?php echo form_input('iskalnik',set_value('iskalnik'),'class="form-control " placeholder="Išči po imenu"');?>
        </div>
        <div class="col-auto">
            <?php echo form_submit('submit', 'išči','class="btn btn-outline-primary"');?>
        </div>
        <div class="col-auto">
            <a href="admin/reIskanje" class="btn btn-outline-primary">počisti</a>
        </div>
    </form>
    </div>
